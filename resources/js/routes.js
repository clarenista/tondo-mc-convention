import Home from './components/Home.vue';
import Registration from './components/Registration.vue';


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
];