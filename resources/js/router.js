import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/auth/:provider/redirect",
            name: "social.redirect",
            component: () => import("./Pages/Auth/Login.vue"),
        },
    ],
});

export default router;
