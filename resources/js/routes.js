import Home from './components/Home.vue';
import Registration from './components/Registration.vue';
import Login from './components/Login.vue';
import BoothMan from './components/BoothMan.vue';


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
            is_admin : true
         }
    },
    {
        name: 'Login',
        path: '/login',
        component: Login
    },  
    {
        name: 'boothman',
        path: '/boothman',
        component: BoothMan,
        meta: { 
            requiresAuth: true,
            is_sponsor : true
         }
    },   
    
];