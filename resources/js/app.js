require('./bootstrap');

import { createApp } from 'vue'
import axios from 'axios';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = axios;
 
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const app = createApp({});

app.component('admin', require('./components/Admin.vue').default);

app.mount('#app');
