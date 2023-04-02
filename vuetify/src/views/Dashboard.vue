<template>
    <v-container>
        <v-row>
            <v-card max-width="344" style="width: 800px; margin-right: 15px">
                <v-card-title class="blue pa-4">
                    <v-icon dark size="42" class="mr-4">
                        mdi mdi-home-city
                    </v-icon>
                    <h2 style="color: #fff">Départements</h2>
                </v-card-title>
                <v-card-text>
                    <h1
                        class="text--primary"
                        style="
                            font-size: 50px;
                            margin-top: 25px;
                            margin-bottom: 20px;
                        "
                    >
                        {{ nbrDepartements }}
                    </h1>
                    <h5 style="font-size: 18px; color: black">
                        Le nombre total des départements
                    </h5>
                </v-card-text>
            </v-card>
            <v-card max-width="344" style="width: 800px; margin-right: 15px">
                <v-card-title class="blue pa-4">
                    <v-icon dark size="42" class="mr-4"> mdi mdi-home </v-icon>
                    <h2 style="color: #fff">Filières</h2>
                </v-card-title>
                <v-card-text>
                    <h1
                        class="text--primary"
                        style="
                            font-size: 50px;
                            margin-top: 25px;
                            margin-bottom: 20px;
                        "
                    >
                        {{ nbrFilieres }}
                    </h1>
                    <h5 style="font-size: 18px; color: black">
                        Le nombre total des filières
                    </h5>
                </v-card-text>
            </v-card>
            <v-card max-width="344" style="width: 800px; margin-right: 15px">
                <v-card-title class="blue pa-4">
                    <v-icon dark size="42" class="mr-4">
                        mdi mdi-account-school
                    </v-icon>
                    <h2 style="color: #fff">Etudiants</h2>
                </v-card-title>
                <v-card-text>
                    <h1
                        class="text--primary"
                        style="
                            font-size: 50px;
                            margin-top: 25px;
                            margin-bottom: 20px;
                        "
                    >
                        {{ nbrEtudiants }}
                    </h1>
                    <h5 style="font-size: 18px; color: black">
                        Le nombre total des étudiants
                    </h5>
                </v-card-text>
            </v-card>
        </v-row>
        <v-row>
            <v-card
                max-width="344"
                style="width: 800px; margin-right: 15px; margin-top: 15px"
            >
                <v-card-title class="blue pa-4">
                    <v-icon dark size="42" class="mr-4">
                        mdi mdi-human-male-board-poll
                    </v-icon>
                    <h2 style="color: #fff">Professeurs</h2>
                </v-card-title>
                <v-card-text>
                    <h1
                        class="text--primary"
                        style="
                            font-size: 50px;
                            margin-top: 25px;
                            margin-bottom: 20px;
                        "
                    >
                        {{ nbrEtudiants }}
                    </h1>
                    <h5 style="font-size: 18px; color: black">
                        Le nombre total des professeurs
                    </h5>
                </v-card-text>
            </v-card>
            <v-card
                max-width="344"
                style="width: 800px; margin-right: 15px; margin-top: 15px"
            >
                <v-card-title class="blue pa-4">
                    <v-icon dark size="42" class="mr-4">
                        mdi mdi-palette-swatch
                    </v-icon>
                    <h2 style="color: #fff">Matieres</h2>
                </v-card-title>
                <v-card-text>
                    <h1
                        class="text--primary"
                        style="
                            font-size: 50px;
                            margin-top: 25px;
                            margin-bottom: 20px;
                        "
                    >
                        {{ nbrMatieres }}
                    </h1>
                    <h5 style="font-size: 18px; color: black">
                        Le nombre total des matieres
                    </h5>
                </v-card-text>
            </v-card>
            <v-card
                max-width="344"
                style="width: 800px; margin-right: 15px; margin-top: 15px"
            >
                <v-card-title class="blue pa-4">
                    <v-icon dark size="42" class="mr-4"> mdi mdi-book </v-icon>
                    <h2 style="color: #fff">Examens</h2>
                </v-card-title>
                <v-card-text>
                    <h1
                        class="text--primary"
                        style="
                            font-size: 50px;
                            margin-top: 25px;
                            margin-bottom: 20px;
                        "
                    >
                        {{ nbrExamen }}
                    </h1>
                    <h5 style="font-size: 18px; color: black">
                        Le nombre total des examens
                    </h5>
                </v-card-text>
            </v-card>
        </v-row>
        <v-row>
            <v-card
                max-width="344"
                style="width: 800px; margin-right: 15px; margin-top: 15px"
            >
                <v-card-title class="blue pa-4">
                    <v-icon dark size="42" class="mr-4">
                        mdi mdi-comment-question
                    </v-icon>
                    <h2 style="color: #fff">Questions</h2>
                </v-card-title>
                <v-card-text>
                    <h1
                        class="text--primary"
                        style="
                            font-size: 50px;
                            margin-top: 25px;
                            margin-bottom: 20px;
                        "
                    >
                        {{ nbrQuestions }}
                    </h1>
                    <h5 style="font-size: 18px; color: black">
                        Le nombre total des questions
                    </h5>
                </v-card-text>
            </v-card>
        </v-row>
    </v-container>
</template>

<script>
import axios from "axios";
export default {
    name: "DepartementsList",
    data: () => ({
        departements: [],
        nbrDepartements: 0,
        nbrFilieres: 0,
        nbrEtudiants: 0,
        nbrProfesseurs: 0,
        nbrMatieres: 0,
        nbrExamen: 0,
        nbrQuestions: 0,
    }),
    created() {
        this.getDepartements();
        this.getFilieres();
        this.getEtudiants();
        this.getProfesseurs();
        this.getMatieres();
        this.getExamens();
        this.getQuestions();
    },
    mounted() {
        console.log("mounted() called");
    },
    methods: {
        getDepartements() {
            var page = process.env.VUE_APP_DEPARTEMENTS_API;
            axios.get(page).then(({ data }) => {
                this.nbrDepartements = data.length;
            });
        },
        getFilieres() {
            var page = process.env.VUE_APP_FILIERES_API;
            axios.get(page).then(({ data }) => {
                console.log(data);
                this.nbrFilieres = data.length;
            });
        },
        getEtudiants() {
            var page = process.env.VUE_APP_ETUDIANTS_API;
            axios.get(page).then(({ data }) => {
                this.nbrEtudiants = data.length;
            });
        },
        getProfesseurs() {
            var page = process.env.VUE_APP_PROFESSEURS_API;
            axios.get(page).then(({ data }) => {
                this.nbrProfesseurs = data.length;
            });
        },
        getMatieres() {
            var page = process.env.VUE_APP_MATIERES_API;
            axios.get(page).then(({ data }) => {
                this.nbrMatieres = data.length;
            });
        },
        getExamens() {
            var page = "http://127.0.0.1:8000/api/examens/";
            axios.get(page).then(({ data }) => {
                this.nbrExamen = data.length;
            });
        },
        getQuestions() {
            var page = "http://127.0.0.1:8000/api/questions/";
            axios.get(page).then(({ data }) => {
                this.nbrQuestions = data.length;
            });
        },
    },
};
</script>
