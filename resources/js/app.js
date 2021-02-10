require('./bootstrap');
import Vue from 'vue/dist/vue';
import store  from './store/store'

import App from './App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    store,
    mounted() {
    },
    router: router,
    render: h => h(App),
});