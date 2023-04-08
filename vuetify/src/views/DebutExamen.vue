<!-- <template>
    <v-container>
        <v-row no-gutters>
            <v-col cols="12" sm="6" md="2">
                <v-card class="pa-2" outlined tile> time </v-card>
            </v-col>
            <v-col cols="6" md="10">
                <v-card class="pa-2" outlined tile> questions </v-card>
            </v-col>
        </v-row>
    </v-container>
</template> -->
<!-- debut exam -->
<template>
    <v-container>
        <!-- <v-card class="mx-auto mt-16 pa-6" max-width="700">
            <v-chip
                class="ma-2"
                color="primary"
                text-color="white"
                style="font-weight: bold"
            >
                <v-avatar left>
                    <v-icon>mdi mdi-clock</v-icon>
                </v-avatar>
                00:25:23
            </v-chip>
            <v-card-subtitle>
                <h2 style="line-height: 1.3">
                    Quel événement utilisez-vous pour exécuter quelque chose une
                    fois le chargement du page est terminé?
                </h2>
            </v-card-subtitle>
            <v-card-actions style="margin-top: -20px">
                <v-radio-group>
                    <v-radio label="onfinished" value="qdf"></v-radio>
                    <v-radio label="onload" value="easy"></v-radio>
                    <v-radio label="onunload" value="medium"></v-radio>
                    <v-radio label="oncomplete" value="hard"></v-radio>
                </v-radio-group>
            </v-card-actions>
            <v-btn depressed color="primary"> Suivant </v-btn>
        </v-card> -->
        <v-row>
            <v-card
                class="pa-2 ma-2"
                max-width="344"
                style="width: 800px; margin-right: 15px; margin-top: 15px"
                v-for="examen in examens"
                :disabled="disableCard"
                :class="isPassed(examen)"
            >
                <v-card-text>
                    <div>{{ examen.matiere_id }}</div>
                    <p
                        class="text-h4 text--primary"
                        style="font-weight: 500; margin-top: 10px"
                    >
                        {{ examen.nom }}
                    </p>
                    <p style="margin-top: -15px">
                        Pr. {{ examen.professeur_id }}
                    </p>
                    <div style="margin-top: 3px">
                        <v-chip
                            color="primary"
                            text-color="white"
                            style="font-weight: bold"
                        >
                            <v-avatar left>
                                <v-icon>mdi mdi-calendar-today</v-icon>
                            </v-avatar>
                            {{ examen.date }}
                        </v-chip>
                        <v-chip
                            class="ma-2"
                            color="primary"
                            text-color="white"
                            style="font-weight: bold"
                        >
                            <v-avatar left>
                                <v-icon>mdi mdi-clock</v-icon>
                            </v-avatar>
                            {{ examen.duree }}
                        </v-chip>
                    </div>
                </v-card-text>
                <v-card-actions>
                    <router-link
                        style="text-decoration: none; color: inherit"
                        :to="{
                            params: { id: examen.id },
                            name: 'startexam',
                        }"
                    >
                        <v-btn
                            text
                            color="primary accent-4"
                            style="margin-top: -17px"
                            @click="started(examen)"
                        >
                            Commencer
                        </v-btn>
                    </router-link>
                </v-card-actions>
            </v-card>
        </v-row>
    </v-container>
</template>

<script>
import axios from "axios";
export default {
    data: () => ({
        passedExam: [],
        examens: [],
        professeurs: [],
        matieres: [],
        disableCard: false,
    }),
    created() {
        this.getMatieres();
        this.getProfesseurs();
        this.getExamens();
        this.passedExam = JSON.parse(localStorage.getItem("passedExam"));
    },
    mounted() {
        console.log("mounted() called");
    },
    computed: {
        //
    },
    methods: {
        getExamens() {
            var page = "http://127.0.0.1:8000/api/examens/";
            axios.get(page).then(({ data }) => {
                this.examens = data;
                this.examens.forEach((examen) => {
                    this.professeurs.forEach((professeur) => {
                        if (examen.professeur_id == professeur.id) {
                            examen.professeur_id = `${professeur.nom} ${professeur.prenom}`;
                        }
                    });
                    this.matieres.forEach((matiere) => {
                        if (examen.matiere_id == matiere.id) {
                            examen.matiere_id = matiere.nom;
                        }
                    });
                });
            });
        },

        getProfesseurs() {
            var page = process.env.VUE_APP_PROFESSEURS_API;
            axios.get(page).then(({ data }) => {
                this.professeurs = data;
            });
        },
        getMatieres() {
            var page = process.env.VUE_APP_MATIERES_API;
            axios.get(page).then(({ data }) => {
                this.matieres = data;
            });
        },
        started(examen) {
            this.passedExam.push(examen.id);
            localStorage.setItem("duree", examen.duree);
            localStorage.setItem("passedExam", JSON.stringify(this.passedExam));
        },
        isPassed(examen) {
            console.log(this.passedExam);
            this.passedExam.forEach((exam) => {
                if (exam == examen.id) {
                    this.disableCard = true;
                } else {
                    this.disableCard = false;
                }
            });
        },
    },
};
</script>
