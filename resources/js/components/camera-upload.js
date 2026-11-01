/**
 * Browser-side normalisation for photos coming from mobile cameras.
 *
 * The server deliberately accepts only JPEG/PNG/PDF for ticket attachments.
 * HEIC/HEIF is converted before Livewire receives the file, so the client and
 * the Ticket media collection keep the same persistence contract.
 *
 * A 12 MP camera photo is 5-12 MB, more than the default PHP (2 MB upload,
 * 8 MB post) and nginx (1 MB body) limits: prepare() shrinks it before it is
 * sent, so the upload no longer depends on how the server is configured.
 * No user-facing text lives here: callers map failures to translated messages.
 */
const HEIC_BRANDS = [
    'heic',
    'heix',
    'hevc',
    'hevx',
    'heim',
    'heis',
    'mif1',
    'msf1',
];
// iOS Safari fails above 16,777,216 canvas pixels; stay below it.
const MAX_CANVAS_PIXELS = 16_000_000;
const QUALITIES = [0.85, 0.75, 0.65, 0.55];
const SHRINK_ATTEMPTS = 3;

const ascii = bytes => String.fromCharCode(...bytes);

// Sniff the bytes: Safari 17+ can hand over a JPEG named *.heic, and a real HEIC can arrive without a type.
async function isHeic(file) {
    const head = new Uint8Array(await file.slice(0, 12).arrayBuffer());

    return (
        ascii(head.slice(4, 8)) === 'ftyp' &&
        HEIC_BRANDS.includes(ascii(head.slice(8, 12)))
    );
}

// createImageBitmap honours EXIF orientation only when asked: without it portrait photos upload sideways.
// ponytail: a 50 MP photo is decoded at full size before the downscale; use the resize options of
// createImageBitmap if low-end devices run out of memory.
async function decode(file) {
    if (window.createImageBitmap) {
        try {
            const bitmap = await createImageBitmap(file, {
                imageOrientation: 'from-image',
            });

            return {
                source: bitmap,
                width: bitmap.width,
                height: bitmap.height,
                release: () => bitmap.close(),
            };
        } catch {
            // no decoder for this format (e.g. HEIC outside Safari): try <img> before giving up
        }
    }

    const url = URL.createObjectURL(file);
    const image = new Image();
    image.src = url;

    try {
        await image.decode();
    } catch (error) {
        URL.revokeObjectURL(url);
        throw error;
    }

    return {
        source: image,
        width: image.naturalWidth,
        height: image.naturalHeight,
        release: () => URL.revokeObjectURL(url),
    };
}

const toBlob = (canvas, quality) =>
    new Promise(resolve => canvas.toBlob(resolve, 'image/jpeg', quality));

async function encode(decoded, scale, maxBytes) {
    const canvas = document.createElement('canvas');
    canvas.width = Math.max(1, Math.round(decoded.width * scale));
    canvas.height = Math.max(1, Math.round(decoded.height * scale));

    const context = canvas.getContext('2d');
    // a 50 MP -> 3 MP downscale in one drawImage looks blocky with the default (low) smoothing
    context.imageSmoothingQuality = 'high';
    // JPEG has no alpha channel: transparent PNG areas would turn black.
    context.fillStyle = '#fff';
    context.fillRect(0, 0, canvas.width, canvas.height);
    context.drawImage(decoded.source, 0, 0, canvas.width, canvas.height);

    try {
        for (const quality of QUALITIES) {
            const blob = await toBlob(canvas, quality);
            if (blob && blob.size <= maxBytes) return blob;
        }

        return null;
    } finally {
        // iOS Safari keeps canvas memory until GC and, past a total cap, getContext() returns null: free it now.
        canvas.width = 0;
        canvas.height = 0;
    }
}

window.FixcityCameraUpload = {
    async toJpeg(file) {
        // HEIC support is only needed after a user selects a HEIC/HEIF file;
        // keep the large converter out of the first-load bundle.
        const { default: heic2any } = await import('heic2any');
        const converted = await heic2any({
            blob: file,
            toType: 'image/jpeg',
            quality: 0.9,
        });
        const blob = Array.isArray(converted) ? converted[0] : converted;

        if (!(blob instanceof Blob)) {
            throw new Error('HEIC conversion did not return an image blob.');
        }

        return new File([blob], file.name.replace(/\.(heic|heif)$/i, '.jpg'), {
            type: 'image/jpeg',
            lastModified: file.lastModified,
        });
    },

    /**
     * Returns a JPEG/PNG (or the untouched PDF) no larger than maxBytes and maxEdge pixels.
     * Rejects when the image cannot be read or cannot be brought under maxBytes.
     */
    async prepare(file, { maxBytes = Infinity, maxEdge = 2048 } = {}) {
        // Android pickers and Drive sometimes hand over a PDF with an empty type: the extension is enough.
        if (file.type === 'application/pdf' || /\.pdf$/i.test(file.name))
            return file;

        // Browser decoder first: Safari reads HEIC natively, so the ~1.3 MB heic2any converter and a
        // full-size intermediate JPEG are only needed where decoding fails (e.g. Chromium).
        let working = file;
        let decoded;
        try {
            decoded = await decode(file);
        } catch (error) {
            if (!(await isHeic(file))) throw error;
            working = await this.toJpeg(file);
            decoded = await decode(working);
        }

        try {
            const longEdge = Math.max(decoded.width, decoded.height);
            const isSmall =
                ['image/jpeg', 'image/png'].includes(working.type) &&
                working.size <= maxBytes &&
                longEdge <= maxEdge;
            if (isSmall) return working;

            let scale = Math.min(
                1,
                maxEdge / longEdge,
                Math.sqrt(MAX_CANVAS_PIXELS / (decoded.width * decoded.height))
            );
            const name = `${file.name.replace(/\.[^.]+$/, '')}.jpg`;

            for (let attempt = 0; attempt < SHRINK_ATTEMPTS; attempt += 1) {
                const blob = await encode(decoded, scale, maxBytes);
                if (blob)
                    return new File([blob], name, {
                        type: 'image/jpeg',
                        lastModified: file.lastModified,
                    });
                scale *= 0.75;
            }
        } finally {
            decoded.release();
        }

        throw new Error('Image cannot be reduced below the upload limit.');
    },
};
