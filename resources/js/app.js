import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import CKEditor from '@ckeditor/ckeditor5-vue';

import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/md-light-indigo/theme.css';
import 'primevue/resources/primevue.min.css';
import MultiSelect from 'primevue/multiselect';
import Chips from 'primevue/chips';

// const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const appName = 'AxelPortfolio';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(CKEditor)
            .use(PrimeVue)
            .component('MultiSelect',MultiSelect)
            .component('Chips',Chips)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
