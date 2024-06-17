import './assets/main.css'
import axios from 'axios';
import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue'
import RestUserSession from './libs/RestUserSession';
import UserSessionRepository from './libs/UserSessionRepository';
import setupAxios from './libs/ProtectAPI';

const app = createApp(App)

const routes: Route[] = [

]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

const UNPROTECTED_ROUTES = ['/','/sign_in', '/sign_up'];

router.beforeEach(async (to, from) => {
    if(!UNPROTECTED_ROUTES.includes(to.path)){
        let userSessionRepository = new UserSessionRepository(localStorage);
        let restUserSession = new RestUserSession(axios);
        let access_token = userSessionRepository.getAccessToken();
        
        if(!access_token){
            return { path: '/sign_in' };
        }

        try {
            let response = await restUserSession.checkAuth(access_token);
            if(response.error){
                userSessionRepository.clear();
                return { path: 'sign_in' };
            }
            
            app.provide('axios', setupAxios(access_token));
        } catch (error) {
            console.log(error);
        }
        
    }
});

app.use(router);
app.mount('#app')
