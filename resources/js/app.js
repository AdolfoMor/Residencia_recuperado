import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { Ziggy } from './ziggy';  // El archivo ziggy generado por @routes en Blade
import route from 'ziggy-js';
import PrimeVue from 'primevue/config';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(PrimeVue);

        // Definimos globalmente la función $route para usar Ziggy en los componentes Vue
        app.config.globalProperties.$route = (name, params = {}, absolute = true) => route(name, params, absolute, Ziggy);

        app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
