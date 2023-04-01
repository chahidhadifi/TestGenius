import Vue from "vue";
import VueRouter from "vue-router";
import HomeView from "../views/HomeView.vue";
import Departements from "../views/Departements.vue";
import Dashboard from "../views/Dashboard.vue";
import Filieres from "../views/Filieres";
import Professeurs from "../views/Professeurs";
import Etudiants from "../views/Etudiants";
import Matieres from "../views/Matieres";
import Examens from "../views/ExamensView.vue";
import Questions from "../views/QuestionsView.vue";
import Propositions from "../views/PropositionsView.vue";
import ContenuExamen from "../views/ContenuExamen.vue";
import DebutExamen from "../views/DebutExamen.vue";
import ResultatExamen from "../views/ResultatExamen.vue";

Vue.use(VueRouter);

const routes = [
    {
        path: "/auth",
        name: "auth",
        component: HomeView,
        meta: {
            isAuth: false,
        },
    },
    {
        path: "/",
        name: "dashboard",
        component: Dashboard,
        meta: {
            isAuth: true,
        },
    },
    {
        path: "/departements",
        name: "departements",
        component: Departements,
        meta: {
            isAuth: true,
        },
    },
    {
        path: "/filieres",
        name: "filieres",
        component: Filieres,
        meta: {
            isAuth: true,
        },
    },
    {
        path: "/professeurs",
        name: "professeurs",
        component: Professeurs,
        meta: {
            isAuth: true,
        },
    },
    {
        path: "/etudiants",
        name: "etudiants",
        component: Etudiants,
        meta: {
            isAuth: true,
        },
    },
    {
        path: "/matieres",
        name: "marieres",
        component: Matieres,
        meta: {
            isAuth: true,
        },
    },
    {
        path: "/examens",
        name: "examens",
        component: Examens,
        meta: {
            isAuth: true,
        },
    },
    {
        path: "/questions",
        name: "questions",
        component: Questions,
        meta: {
            isAuth: true,
        },
    },
    {
        path: "/propositions",
        name: "propositions",
        component: Propositions,
        meta: {
            isAuth: true,
        },
    },
    {
        path: "/contenuexamen",
        name: "contenuexamen",
        component: ContenuExamen,
        meta: {
            isAuth: true,
        },
    },
    {
        path: "/start",
        name: "start",
        component: DebutExamen,
        meta: {
            isAuth: true,
        },
    },
    {
        path: "/result",
        name: "result",
        component: ResultatExamen,
        meta: {
            isAuth: true,
        },
    },
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.isAuth)) {
        let user = localStorage.getItem("token");
        if (!user) {
            next("/auth");
        }
    }
    next();
});

export default router;
