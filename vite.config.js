import { defineConfig } from 'vite';
import commonjs from 'rollup-plugin-commonjs'
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        commonjs(),
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    
    build: {
        commonjsOptions: {
            exclude: [
                  'ckeditor5-custom-build', 
            ]
        }
     },
     optimizeDeps: {
           include: [
                 'ckeditor5-custom-build',
           ],
     }
});
