import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress'
import axios from 'axios';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = axios;
 
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


createInertiaApp({
    resolve: name => require(`./Pages/${name}`),

    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        app.config.globalProperties.$route = route; 
        
        app.use(plugin).mount(el);
    },
})

InertiaProgress.init();
