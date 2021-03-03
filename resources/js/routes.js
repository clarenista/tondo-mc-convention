import Vue from 'vue/dist/vue';
import store  from './store/store'
import VueRouter from 'vue-router';

import Home from './components/Home.vue';
import Registration from './components/Registration.vue';
import Login from './components/Login.vue';
import BoothMan from './components/BoothMan.vue';
import Gallery from './components/Gallery.vue';
import NotFound from './components/NotFound.vue';

Vue.use(VueRouter);


export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home,
        meta: { 
            requiresAuth: true,
         }
    },
    {
        name: 'registration',
        path: '/registration',
        component: Registration,
        meta: { 
            requiresAuth: true,
            requireCanCreateUser: true
         }
    },
    {
        name: 'login',
        path: '/login',
        component: Login,
        meta: { 
            requiresAuth: false,
            requireCanManageBooth: true
         }
    },  
    {
        name: 'boothman',
        path: '/boothman',
        component: BoothMan,
        meta: { 
            requiresAuth: true,
            requireCanManageBooth: true
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
    {
        name: 'notFound',
        path: '/404',
        component: NotFound,
    },

    
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

router.beforeEach((to, from, next) => {
    // console.log(to.matched.some(record => record.meta.requireCanCreateUser))
    if(to.matched.some(record => record.meta.requiresAuth)){
        if(!store.getters.user){
            next({
                name: 'login'
            })
        }else{
            if(to.matched.some(record => record.meta.requireCanCreateUser)){
                if(store.getters.permissions.includes('create user')){
                    next()
                }else{
                    next({
                        name: 'notFound'
                    })
                }
            }else if(to.matched.some(record => record.meta.requireCanManageBooth)){
                if(store.getters.permissions.includes('manage booth')){
                    next()
                }else{
                    next({
                        name: 'notFound'
                    })
                }
            }
            
            else{
                next()
            }
        }
    }else{
        next()
    }
});

export default router;