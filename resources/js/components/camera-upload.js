/**
 * Browser-side normalisation for photos coming from mobile cameras.
 *
 * The server deliberately accepts only JPEG/PNG/PDF for ticket attachments.
 * HEIC/HEIF is converted before Livewire receives the file, so the client and
 * the Ticket media collection keep the same persistence contract.
 */
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
};
