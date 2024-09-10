import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,  // "refresh" est une option spécifique au plugin laravel-vite
        }),
        vue(),  // Le plugin Vue doit être ici, à côté du plugin Laravel
    ],
});

