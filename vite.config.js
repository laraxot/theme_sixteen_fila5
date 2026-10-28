import { createRequire } from 'node:module';
import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { resolve } from 'path';

const require = createRequire(import.meta.url);

// L'export esiste da laravel-vite-plugin 3 (Vite 8). Il tema installato e' il 2.1:
// un import statico ferma `vite build` prima di copiare publicDir. DCP-183 tiene i font in fonts.css.
function googleFontProvider() {
    try {
        return require('laravel-vite-plugin/fonts').google;
    } catch {
        return null;
    }
}

function fontOptions() {
    const google = googleFontProvider();
    if (!google) {
        return {};
    }

    return {
        fonts: [
            google('Titillium Web', {
                alias: 'sans',
                weights: [300, 400, 600, 700],
                styles: ['normal', 'italic'],
                subsets: ['latin', 'latin-ext'],
                display: 'swap',
                preload: [
                    { weight: 400 },
                    { weight: 700 },
                ],
                fallbacks: ['system-ui', 'sans-serif'],
            }),
            google('Lora', {
                alias: 'serif',
                weights: [400, 700],
                styles: ['normal', 'italic'],
                subsets: ['latin', 'latin-ext'],
                display: 'swap',
                fallbacks: ['Georgia', 'serif'],
            }),
            google('Roboto Mono', {
                alias: 'mono',
                weights: [400, 700],
                styles: ['normal', 'italic'],
                subsets: ['latin', 'latin-ext'],
                display: 'swap',
                fallbacks: ['ui-monospace', 'monospace'],
            }),
        ],
    };
}

export default defineConfig({
    base: '/themes/Sixteen/',

    // outDir e' public: non e' una cartella in cui depositare file a mano.
    // publicDir e' la sorgente che `vite build` copia cosi' com'e' dentro outDir.
    // Lo sprite tiene l'URL stabile dei template (`.../sprites.svg#it-expand`):
    // un import nel bundle lo hasherebbe e romperebbe ogni <use>.
    publicDir: resolve(import.meta.dirname, 'resources/static'),

    build: {
        outDir: './public',
        emptyOutDir: false,
        manifest: 'manifest.json',
        // The optional HEIC converter is a separate lazy chunk; it is not part
        // of the homepage request and is intentionally measured at its own size.
        chunkSizeWarningLimit: 1400,
        rollupOptions: {
            output: {
                entryFileNames: 'assets/[name]-[hash].js',
                chunkFileNames: 'assets/[name]-[hash].js',
                assetFileNames: 'assets/[name]-[hash].[ext]',
                manualChunks(id) {
                    // Keep the entrypoint small: maps and optional theme behaviours
                    // are shared by several pages but are not part of every first paint.
                    if (id.includes('/Modules/Geo/')) {
                        return 'theme-map';
                    }

                    if (id.includes('/resources/js/components/')) {
                        return 'theme-components';
                    }

                    if (id.includes('/resources/js/theme/')) {
                        return 'theme-behavior';
                    }

                    if (!id.includes('node_modules')) {
                        return undefined;
                    }

                    if (id.includes('leaflet')) {
                        return 'vendor-map';
                    }

                    if (id.includes('chart.js')) {
                        return 'vendor-charts';
                    }

                    if (id.includes('heic2any')) {
                        return 'vendor-image-conversion';
                    }

                    if (id.includes('alpinejs') || id.includes('@alpinejs')) {
                        return 'vendor-alpine';
                    }

                    if (id.includes('lit')) {
                        return 'vendor-lit';
                    }

                    if (id.includes('axios') || id.includes('lodash') || id.includes('moment')) {
                        return 'vendor-data';
                    }

                    if (id.includes('@splidejs') || id.includes('flowbite') || id.includes('@popperjs')) {
                        return 'vendor-ui';
                    }

                    return 'vendor-core';
                },
            },
        },
    },

    plugins: [
        laravel({
            publicDirectory: '../../../public_html/',

            input: [
                resolve(import.meta.dirname, 'resources/css/app.css'),
                resolve(import.meta.dirname, 'resources/css/app-test.css'),
                resolve(import.meta.dirname, 'resources/js/app.js'),
            ],

            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
                'resources/views/**/*.blade.php',
            ],

            ...fontOptions(),
        }),

        tailwindcss(),
    ],

    resolve: {
        dedupe: ['lit', 'leaflet', 'leaflet.heat', 'leaflet.markercluster', 'heic2any'],
        alias: {
            '@': resolve(import.meta.dirname, 'resources'),
            '@modules': resolve(import.meta.dirname, '../../Modules'),
            '@theme-leaflet-css': resolve(
                import.meta.dirname,
                'resources/css/thematic/leaflet.css',
            ),
        },
    },
});
