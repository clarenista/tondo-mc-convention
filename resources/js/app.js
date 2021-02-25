require('./bootstrap');
import Vue from 'vue/dist/vue';
import store  from './store/store'

import App from './App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
// import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
// Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
// Vue.use(IconsPlugin)

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if(to.matched.some(record => record.meta.is_admin)) {
            console.log('role', store.getters.user.role)
            if(store.getters.user.role == 1){
                next()
            }
            else{
                next({ name: 'Login'})
            }
        }else if(to.matched.some(record => record.meta.is_sponsor)){
            if(store.getters.user.role == 2){
                next()
            }
            else{
                next({ name: 'Login'})
            }

        }
        else {
            next()
        }
    }else{
        next()
    }
  })

const app = new Vue({
    el: '#app',
    store,
    mounted() {
    },
    router: router,
    render: h => h(App),
});

