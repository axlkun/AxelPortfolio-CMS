import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import commonjs from "vite-plugin-commonjs";

export default defineConfig({
    plugins: [
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
        commonjs({
            filter(id) {
              if (["ckeditor5/build/ckeditor.js"].includes(id)) {
                return true;
              }
            },
          }),
    ],

    optimizeDeps: {
        include: ["ckeditor5-custom-build"],
      },
      build: {
        commonjsOptions: { exclude: ["ckeditor5-custom-build"] },
      },
});
