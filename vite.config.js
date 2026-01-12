import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import path from 'path'; // <--- Añade esto

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    // --- AÑADE ESTO PARA FORZAR LA RUTA ---
    resolve: {
        alias: {
            'tailwindcss': path.resolve(__dirname, 'node_modules/tailwindcss'),
        },
    },
});