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
import { ForgotPasswordVue } from './screens/forgot_password';
import { ResetPasswordVue } from './screens/reset_password';
import { VerifyEmailVue } from './screens/verify_email';
import { HomeVue } from './screens/home';
import { AppLayoutVue } from './layouts/app_layout';
import 'flowbite';
import { gsap } from 'gsap';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin';
import { ProfileVue } from './screens/profile';
import { CartsVue } from './screens/carts';
import { OrdersVue } from './screens/orders';
import { LoadingVue } from './components/loading';
import { ToastVue } from './components/toast';
import { OrderPreviewVue } from './screens/orders/preview';
import { ContactVue } from './screens/contact';
import { ProductByCategoryVue } from './screens/products_by_category';
import { WishlistVue } from './screens/wishlist';
import { PaymentVue } from './screens/payment';
import { NotFoundVue } from './screens/not_found';
import i18n from './i18n';

gsap.registerPlugin(ScrollToPlugin);
const app = createApp(App)

const routes: RouteRecordRaw[] = [
    { path: '/sign-in', component: SignInVue},
    { path: '/sign-up', component: SignUpVue},
    { path: '/password/reset', component: ForgotPasswordVue},
    { path: '/password/reset/:token', component: ResetPasswordVue},
    { path: '/email/verify', component: VerifyEmailVue},
    {
        path: '/',
        name: 'Root',
        redirect: '/',
        component: AppLayoutVue,
        children:[ 
            { path: '/', component: HomeVue },
            { path: '/profile', component: ProfileVue },
            { path: '/carts', component: CartsVue },
            { path: '/orders', component: OrdersVue },
            { path: '/order-preview/:id', component: OrderPreviewVue },
            { path: '/contact', component: ContactVue },
            { path: '/wishlist', component: WishlistVue },
            { path: '/product-by-categroy/:category', component: ProductByCategoryVue },
            { path: '/payment-method/:id', component: PaymentVue },
            { path: '/:pathMatch(.*)*', name: 'NotFound', component: NotFoundVue }
        ]
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

const isPublicRoute = (path: string) => {
    const UNPROTECTED_ROUTES = ['/', '/sign-in', '/sign-up', '/password/reset', '/email/verify', '/contact'];
    return UNPROTECTED_ROUTES.includes(path) || 
           path.startsWith('/password/reset/') || 
           path.startsWith('/product-by-categroy/');
};

const isLoggedIn = ref(false);
app.provide('isLoggedIn', isLoggedIn);
app.provide('axios', axios);

router.beforeEach(async (to) => {
    const userSessionRepository = new UserSessionRepository(localStorage);
    const restUserSession = new RestUserSession(axios);
    const access_token = userSessionRepository.getAccessToken();

    if (access_token) {
        try {
            const response = await restUserSession.getCurrentUser(access_token);
            if(response && !response.error) {
                if (response.lang) {
                    (i18n.global.locale as any).value = response.lang;
                    document.documentElement.dir = response.lang === 'ar' ? 'rtl' : 'ltr';
                }
                isLoggedIn.value = true;
                setupAxios(access_token);
                return;
            } else {
                userSessionRepository.clear();
                delete axios.defaults.headers.common['Authorization'];
                isLoggedIn.value = false;
            }
        } catch (error) {
            console.log(error);
            isLoggedIn.value = false;
        }
    } else {
        delete axios.defaults.headers.common['Authorization'];
        isLoggedIn.value = false;
    }

    if (to.name !== 'NotFound' && !isPublicRoute(to.path)) {
        return { path: '/sign-in' };
    }
});

app.component("Loading", LoadingVue);
app.component("Toast", ToastVue);

app.use(i18n);
app.use(router);
app.mount('#app');
