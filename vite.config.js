import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin'
import tailwindcss from '@tailwindcss/vite'
import nodeResolve from '@rollup/plugin-node-resolve';
import path from 'path';

export default defineConfig({
<<<<<<< HEAD
    base: '/themes/Sixteen/',
=======
>>>>>>> 7aabf76 (.)
    resolve: {
        alias: {
            '@modules': path.resolve(__dirname, '../../Modules'),
            '@theme-lit': path.resolve(__dirname, 'node_modules/lit/index.js'),
            '@theme-leaflet': path.resolve(__dirname, 'node_modules/leaflet/dist/leaflet-src.js'),
            '@theme-leaflet-css': path.resolve(__dirname, 'node_modules/leaflet/dist/leaflet.css'),
        },
    },
    optimizeDeps: {
        include: ['leaflet', 'lit'],
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/app-test.css',
                'resources/js/app.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
        tailwindcss(),
    ],
    build: {
        outDir: './public',
        emptyOutDir: true,
        manifest: 'manifest.json',
        chunkFileNames: 'js/[name]-[hash].js',
        entryFileNames: 'js/[name]-[hash].js',
        assetFileNames: (assetInfo) => {
            const ext = assetInfo.name.split('.').pop();
            if (ext === 'css') return 'css/[name]-[hash].[ext]';
            if (['png','jpg','jpeg','gif','svg','webp','ico'].includes(ext)) return 'images/[name]-[hash].[ext]';
            if (['woff','woff2','eot','ttf','otf'].includes(ext)) return 'fonts/[name]-[hash].[ext]';
            return 'assets/[name]-[hash].[ext]';
        },
        minify: 'esbuild',
        sourcemap: false,
        target: 'es2020',
        cssCodeSplit: true,
        assetsInlineLimit: 4096,
        rollupOptions: {
            plugins: [
                nodeResolve({
                    browser: true,
                    preferBuiltins: false,
                    extensions: ['.mjs', '.js', '.json', '.node', '.css'],
                }),
            ],
        },
    },
    server: {
        hmr: { host: 'localhost' }
    },
});
