import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin'
import path from 'path';
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
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
        emptyOutDir: false,
        manifest: 'manifest.json',
        rollupOptions: {
            output: {
                manualChunks: {
                    // Core vendor libraries
                    'vendor-core': ['alpinejs', 'livewire'],
                    // UI libraries
                    'vendor-ui': ['bootstrap-italia'],
                    // Chart libraries
                    'vendor-charts': ['chart.js'],
                    // Map libraries
                    'vendor-maps': ['leaflet'],
                    // Utility libraries
                    'vendor-utils': ['lodash', 'moment']
                },
                // Optimize chunk names
                chunkFileNames: (chunkInfo) => {
                    const facadeModuleId = chunkInfo.facadeModuleId ? chunkInfo.facadeModuleId.split('/').pop().replace('.js', '') : 'chunk';
                    return `js/[name]-[hash].js`;
                },
                entryFileNames: 'js/[name]-[hash].js',
                assetFileNames: (assetInfo) => {
                    const info = assetInfo.name.split('.');
                    const ext = info[info.length - 1];
                    if (/\.(css)$/.test(assetInfo.name)) {
                        return `css/[name]-[hash].${ext}`;
                    }
                    if (/\.(png|jpe?g|gif|svg|webp|ico)$/.test(assetInfo.name)) {
                        return `images/[name]-[hash].${ext}`;
                    }
                    if (/\.(woff2?|eot|ttf|otf)$/.test(assetInfo.name)) {
                        return `fonts/[name]-[hash].${ext}`;
                    }
                    return `assets/[name]-[hash].${ext}`;
                }
            }
        },
        // Minification settings
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true,
                pure_funcs: ['console.log', 'console.info', 'console.debug', 'console.warn']
            },
            mangle: {
                safari10: true
            }
        },
        // Source maps for production debugging
        sourcemap: false,
        // Target modern browsers
        target: 'es2015',
        // CSS code splitting
        cssCodeSplit: true,
        // Asset inlining threshold
        assetsInlineLimit: 4096
    },
    // Development server settings
    server: {
        hmr: {
            host: 'localhost'
        }
    },
    // Optimize dependencies
    optimizeDeps: {
        include: [
            'alpinejs',
            'livewire',
            'bootstrap-italia',
            'chart.js',
            'leaflet',
            'lodash',
            'moment'
        ]
    },
});
