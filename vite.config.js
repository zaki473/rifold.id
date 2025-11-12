// vite.config.js

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'; // Impor plugin

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // Sesuaikan dengan path file Anda
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(), // Tambahkan plugin di sini
    ],
});
