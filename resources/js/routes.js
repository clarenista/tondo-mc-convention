import Home from './components/Home.vue';
import Registration from './components/Registration.vue';
import Login from './components/Login.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'registration',
        path: '/registration',
        component: Registration
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },    
];