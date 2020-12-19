import {createRouter, createWebHistory} from 'vue-router'

const routes= [
    {path: "/", name: "Home", component: import("./components/Home")},
    {path: "/page", name: "Page", component: () => import("./components/Page1")}

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
