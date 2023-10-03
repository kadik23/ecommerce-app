import {createRouter, createWebHistory} from 'vue-router'

import Login from '../views/Login.vue'
import Dashboard from '../views/Dashboard.vue'
import Registration from '../views/Registration.vue'
import RequestPassword from "../views/RequestPassword.vue";
import ResetPassword from "../views/ResetPassword.vue";
import NotFoundPage from "../views/NotFoundPage.vue";
const routes=[
    {
        path:'/dashboard',
        name:'dashboard',
        component:Dashboard
    },
    {
        path:'/login',
        name:'login',
        component:Login
    },
    {
        path:'/registration',
        name:'registration',
        component:Registration
    },
    {
        path: '/request-password',
        name: 'requestPassword',
        component: RequestPassword,
        meta: {
          requiresGuest: true
        }
      },
      {
        path: '/reset-password/:token',
        name: 'resetPassword',
        component: ResetPassword,
        meta: {
          requiresGuest: true
        }
      },
      {
        path: '/:pathMatch(.*)',
        name: 'notfound',
        component: NotFoundPage,
      }
]
const router = createRouter({
    history:createWebHistory(),
    routes
})
export default router