import { createRouter, createWebHistory } from 'vue-router'
import index from '../pages/views/index.vue'
import register from '../pages/views/register.vue'
import login from '../pages/views/login.vue'
import login_admin from '../pages/views/login_admin.vue'
import reservations from '../pages/views/admin/reservations.vue'
import daysoff from '../pages/views/admin/daysoff.vue'
import maxplace from '../pages/views/admin/maxplace.vue'
import notFound from '../pages/notFound.vue'

const routes = [
    {   
        name: 'index',
        path: '/',
        component: index,
         meta: {
            requiresAuth: true
        }
        
    },
    
    {   
        name: 'reservations',
        path: '/reservations',
        component: reservations,
         meta: {
            requiresAuth: true
        }
        
    },
    {   
        name: 'daysoff',
        path: '/daysoff',
        component: daysoff,
         meta: {
            requiresAuth: true
        }
        
    },
    {   
        name: 'maxplace',
        path: '/maxplace',
        component: maxplace,
         meta: {
            requiresAuth: true
        }
        
    },

    {   
        name: 'register',
        path: '/register',
        component: register,
         meta: {
            requiresAuth: false
        }
        
    },
    {   
        name: 'login',
        path: '/login',
        component: login,
         meta: {
            requiresAuth: false
        }
        
    },
    {   
        name: 'login_admin',
        path: '/login_admin',
        component: login_admin,
         meta: {
            requiresAuth: false
        }
        
    },

    {
        path: '/:pathMatch(.*)*',
        component: notFound,
        
    }

]

const router = createRouter({
    history: createWebHistory(),
    routes,

})

router.beforeEach((to,from) =>{
    if(to.meta.requiresAuth && !sessionStorage.getItem('token')){
        return { name: 'login' }
    }

    // if(to.meta.requiresAuth == false && localStorage.getItem('token')){
    //     return { name: 'index' }
    // }
})

export default router
