import Vue from "vue";
import VueRouter from "vue-router";
import HomeView from "../views/Home.vue";
import Departements from "../views/Departements.vue";
import Dashboard from "../views/Dashboard.vue";
import Filieres from "../views/Filieres.vue";
import Professeurs from "../views/Professeurs.vue";
import Etudiants from "../views/Etudiants.vue";
import Matieres from "../views/Matieres.vue";
import Examens from "../views/Examens.vue";
import Questions from "../views/Questions.vue";
import Propositions from "../views/Propositions.vue";
import ContenuExamen from "../views/ContenuExamen.vue";
import ResultatExamen from "../views/ResultatExamen.vue";
import DebutExamen from "../views/DebutExamen.vue";
import DebutExamenSpec from "../views/DebutExamenSpec.vue";
import Reponses from "../views/ReponsesView.vue";
import Notes from "../views/NotesView.vue";

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
        path: "/debut/:id",
        name: "debutexamenspec",
        component: DebutExamenSpec,
        meta: {
            isAuth: true,
        },
    },
    {
        path: "/debut",
        name: "debutexamen",
        component: DebutExamen,
        meta: {
            isAuth: true,
        },
    },
    {
        path: "/resultat",
        name: "resultat",
        component: ResultatExamen,
    },
    
    {
        path: "/reponses",
        name: "reponses",
        component: Reponses,
        meta: {
            isAuth: true,
        },
    },
    {
        path: "/notes",
        name: "notes",
        component: Notes,
        meta: {
            isAuth: true,
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
