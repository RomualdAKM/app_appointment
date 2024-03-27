import { createRouter, createWebHistory } from 'vue-router'
import index from '../pages/views/index.vue'
import notFound from '../pages/notFound.vue'

const routes = [
    {   
        name: 'index',
        path: '/',
        component: index,
        
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

export default router
