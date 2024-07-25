import './assets/main.css'
import axios from 'axios';
import { createApp, ref } from 'vue'
import { createRouter, createWebHistory, type RouteRecordRaw } from 'vue-router';
import App from './App.vue'
import RestUserSession from './libs/RestUserSession';
import UserSessionRepository from './libs/UserSessionRepository';
import setupAxios from './libs/ProtectAPI';
import { SignInVue } from './screens/sign_in';
import { SignUpVue } from './screens/sign_up';
import { HomeVue } from './screens/home';
import { AppLayoutVue } from './layouts/app_layout';
import 'flowbite';
import { gsap } from 'gsap';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin';
import { ProfileVue } from './screens/profile';
import { CartsVue } from './screens/carts';
import { OrdersVue } from './screens/orders';

gsap.registerPlugin(ScrollToPlugin);
const app = createApp(App)

const routes: RouteRecordRaw[] = [
    { path: '/sign-in', component: SignInVue},
    { path: '/sign-up', component: SignUpVue},
    {
        path: '/',
        name: 'Root',
        redirect: '/',
        component: AppLayoutVue,
        children:[ 
            { path: '/', component: HomeVue },
            { path: '/profile', component: ProfileVue },
            { path: '/carts', component: CartsVue },
            { path: '/orders', component: OrdersVue }
        ]
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

const UNPROTECTED_ROUTES = [ '/sign-in', '/sign-up'];

const isLoggedIn = ref(false);
app.provide('isLoggedIn', isLoggedIn);

router.beforeEach(async (to, from) => {
    if(!UNPROTECTED_ROUTES.includes(to.path)){
        let userSessionRepository = new UserSessionRepository(localStorage);
        let restUserSession = new RestUserSession(axios);
        let access_token = userSessionRepository.getAccessToken();
        
        if(!access_token){
            return { path: '/sign-in' };
        }

        try {
            let response = await restUserSession.getCurrentUser(access_token);
            if(response.error){
                userSessionRepository.clear();
                return { path: 'sign-in' };
            }
            isLoggedIn.value = true;
            app.provide('axios', setupAxios(access_token));
        } catch (error) {
            console.log(error);
        }
    }
});

app.use(router);
app.mount('#app');
