import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import Ziggy from 'ziggy-js';
import PrimeVue from 'primevue/config';
import VueSplash from 'vue-splash';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Ziggy, Ziggy)
            .use(PrimeVue)
            .use(VueSplash)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

