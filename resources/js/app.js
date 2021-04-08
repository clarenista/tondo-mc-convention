require('./bootstrap');
import Vue from 'vue/dist/vue';
import store  from './store/store'

import App from './App.vue';

import VueAxios from 'vue-axios';
import axios from 'axios';
import router from './routes';

import Permissions from './mixins/Permissions'
import SendEvent from './mixins/SendEvent'
import 'pannellum'

require('pannellum/build/pannellum.css')
// import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
// Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
// Vue.use(IconsPlugin)

Vue.mixin(Permissions);
Vue.mixin(SendEvent);
Vue.use(VueAxios, axios);

const app = new Vue({
    el: '#app',
    store,
    created() {
        if(localStorage.getItem('access_token') != null){
            this.getUser()
        }
        if(localStorage.getItem('bgmStart')){
            this.$store.commit('updateBgmStart', true)
        }else{
            this.$store.commit('updateBgmStart', false)

        }
    },
    router,
    render: h => h(App),
    methods: {
        async getUser(){
            let {data} = await axios.get('api/v1/user?api_token='+localStorage.getItem('access_token'))
            store.commit('changeUser', data)
            store.commit('updateIsWelcomed', false)
        }
    },
});

