import Vue from 'vue/dist/vue';
import store  from './store/store'
import VueRouter from 'vue-router';

import Home from './components/Home.vue';
import Registration from './components/Registration.vue';
import Login from './components/Login.vue';
import BoothMan from './components/BoothMan.vue';
import Gallery from './components/Gallery.vue';

Vue.use(VueRouter);


export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'registration',
        path: '/registration',
        component: Registration,
        meta: { 
            requiresAuth: true,
         }
    },
    {
        name: 'Login',
        path: '/login',
        component: Login,
        meta: { 
            requiresAuth: false,
         }
    },  
    {
        name: 'boothman',
        path: '/boothman',
        component: BoothMan,
        meta: { 
            requiresAuth: true,
         }
    },   
    {
        name: 'gallery',
        path: '/gallery',
        component: Gallery,
        meta: { 
            requiresAuth: true,
            is_admin : true
         }
    },

    
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)){
        if(!store.getters.user){
            next({
                name: 'Login'
            })
        }else{
            next()
        }
    }else{
        next()
    }
});

export default router;