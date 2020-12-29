import { createRouter, createWebHistory } from 'vue-router';
import Home from './views/Home';
import UserController from './UserController'

const routes = [
    { path: "/", name: "Home", component: Home },
    { path: "/dodaj", name: "AddNote", component: () => import("./views/NewNote") },
    { path: "/rankingi", name: "Rankings", component: () => import("./views/Rankings") },
    { path: "/konto", name: "Account", component: () => import("./views/Account"), meta: { requiresAuth: true } },
    { path: "/logowanie", name: "Login", component: () => import("./views/Login") },
    { path: "/uwaga/:id", name: "NoteView", component: () => import("./views/NoteView") },
    { path: "/rejestracja", name: "Register", component: () => import("./views/Register") },
]

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach(async (to, from, next) => {
    const requiresAuth = to.matched.some(x => x.meta.requiresAuth)
    if (requiresAuth && !await UserController.check()) next('/logowanie');
    else next();
})

export default router;
