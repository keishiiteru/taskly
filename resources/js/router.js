import { createRouter, createWebHistory } from "vue-router"
import Dashboard from './components/Dashboard.vue'

const routes = [
     {
        path:'/dashboard',
        component: Dashboard
        // meta: { requiresAuth: true }
    }

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
