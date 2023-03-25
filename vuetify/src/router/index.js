import Vue from "vue";
import VueRouter from "vue-router";
import HomeView from "../views/HomeView.vue";
import Departements from "../views/Departements.vue";
import Dashboard from "../views/Dashboard.vue";
import Filieres from "../views/Filieres";
import Professeurs from "../views/Professeurs";
import Etudiants from "../views/Etudiants";
import Matieres from "../views/Matieres";

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
    {
        path: "/professeurs",
        name: "professeurs",
        component: Professeurs,
    },
    {
        path: "/etudiants",
        name: "etudiants",
        component: Etudiants,
    },
    {
        path: "/matieres",
        name: "marieres",
        component: Matieres,
    },
    {
      path: "/examens",
      name: "examens",
      component: Examens,
    },
    {
      path: "/questions",
      name: "questions",
      component: Questions,
    },
    {
      path: "/propositions",
      name: "propositions",
      component: Propositions,
    },
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
});

export default router;
