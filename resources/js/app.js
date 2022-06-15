import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress'

createInertiaApp({
    resolve: name => require(`./Pages/${name}`),

    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        app.config.globalProperties.$route = route; 
        
        app.use(plugin).mount(el);
    },
})

InertiaProgress.init();
