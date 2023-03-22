import Vue from "vue";
import VueRouter from "vue-router";
import HomeView from "../views/HomeView.vue";
import Departements from "../views/Departements.vue";
import Dashboard from "../views/Dashboard.vue";
import Filieres from "../views/Filieres";

Vue.use(VueRouter);

const routes = [
    {
        path: "/auth",
        name: "auth",
        component: HomeView,
    },
    {
        path: "/dashboard",
        name: "dashboard",
        component: Dashboard,
    },
    {
        path: "/departements",
        name: "departements",
        component: Departements,
    },
    {
        path: "/filieres",
        name: "filieres",
        component: Filieres,
    },
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
});

export default router;
