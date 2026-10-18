import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
    root: resolve(__dirname, '../public/themes/sixteen'),
    build: {
        outDir: resolve(__dirname, '../public/themes/sixteen/dist'),
        emptyOutDir: true,
        rollupOptions: {
            input: {
                main: resolve(__dirname, '../public/themes/sixteen/assets/main.css'),
                login: resolve(__dirname, '../public/themes/sixteen/assets/login.js'),
            },
        },
    },
});