require('./bootstrap');
import Vue from 'vue/dist/vue';
import store  from './store/store'

import App from './App.vue';

import VueAxios from 'vue-axios';
import axios from 'axios';
import router from './routes';

import Permissions from './mixins/Permissions'
// import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
// Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
// Vue.use(IconsPlugin)

Vue.mixin(Permissions);
Vue.use(VueAxios, axios);



const app = new Vue({
    el: '#app',
    store,
    mounted() {
    },
    router,
    render: h => h(App),
});

