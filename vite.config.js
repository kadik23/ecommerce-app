import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

import i18n from 'laravel-vue-i18n/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/global.css',
                'resources/css/app.css'
            ],
            refresh: true,
        }),
        i18n(),
    ],
    resolve: {
        alias: {},
    },
});
