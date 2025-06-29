import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import route from 'ziggy-js';          // Importa la función route
import PrimeVue from 'primevue/config';
import VueSplash from 'vue-splash';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

// Plugin Vue para inyectar $route en todos los componentes
const ZiggyPlugin = {
  install(app) {
    app.config.globalProperties.$route = (name, params = {}, absolute = true) =>
      route(name, params, absolute, window.Ziggy);
  }
};

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyPlugin)       // Usa el plugin personalizado
      .use(PrimeVue)
      .use(VueSplash)
      .mount(el);
  },
  progress: {
    color: '#4B5563',
  },
});
