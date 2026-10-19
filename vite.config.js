
import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { google } from 'laravel-vite-plugin/fonts';
import { resolve } from 'path';

export default defineConfig({
    base: '/themes/Sixteen/',

    build: {
        outDir: './public',
        emptyOutDir: false,
        manifest: 'manifest.json',
        rollupOptions: {
            output: {
                entryFileNames: 'assets/[name]-[hash].js',
                chunkFileNames: 'assets/[name]-[hash].js',
                assetFileNames: 'assets/[name]-[hash].[ext]',
            },
        },
    },

    plugins: [
        laravel({
            publicDirectory: '../../../public_html/',

            input: [
                resolve(__dirname, 'resources/css/app.css'),
                resolve(__dirname, 'resources/css/app-test.css'),
                resolve(__dirname, 'resources/js/app.js'),
            ],

            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
                'resources/views/**/*.blade.php',
            ],

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
        }),

        tailwindcss(),
    ],

    resolve: {
        alias: {
            '@': resolve(__dirname, 'resources'),
            '@modules': resolve(__dirname, '../../Modules'),
            '@theme-leaflet-css': resolve(
                __dirname,
                'resources/css/thematic/leaflet.css',
            ),
        },
    },
});
