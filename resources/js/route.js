import { createRouter, createWebHistory } from 'vue-router';
import Home from './views/Home';

const routes= [
    { path: "/", name: "Home", component: Home },
    { path: "/dodaj", name: "AddNote", component: () => import("./views/Home") },
    { path: "/rankingi", name: "Rankings", component: () => import("./views/Home") },
    { path: "/konto", name: "Account", component: () => import("./views/Home"), meta: { requiresAuth: true } },
    { path: "/logowanie", name: "Login", component: () => import("./views/Login") },
    { path: "/rejestracja", name: "Register", component: () => import("./views/Register") },
]

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some(x => x.meta.requiresAuth)
    if (requiresAuth && localStorage.getItem('logged') === "true") next('/logowanie');
    else next();
})

export default router;
