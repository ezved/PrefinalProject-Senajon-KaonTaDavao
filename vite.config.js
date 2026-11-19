// Load Vite, Laravel's integration, and Tailwind.
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        // Build the CSS and JavaScript used by the shared layout.
        laravel({ input: ['resources/css/app.css', 'resources/js/app.js'], refresh: true }),
        // Compile the Tailwind utilities found in the templates.
        tailwindcss(),
    ],
});
