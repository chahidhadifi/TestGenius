<template>
    <v-container>
        <v-row no-gutters>
            <v-col cols="12" sm="6" md="5">
                <v-sheet>
                    <v-col cols="12" sm="13">
                        <h2 style="margin-bottom: 9px">
                            <v-icon large color="primary">
                                mdi mdi-note-search
                            </v-icon>
                            Entrez le nom d'examen
                        </h2>
                        <v-col sm="10">
                            <v-select
                                :items="examens"
                                label="Nom d'examen"
                                v-model="idexamen"
                                outlined
                                item-text="nom"
                                item-value="id"
                                style="margin-top: 16px"
                            ></v-select>
                        </v-col>
                        <v-btn
                            class="ma-2"
                            :loading="loading"
                            :disabled="loading"
                            color="primary"
                            @click="
                                loader = 'loading';
                                getNotes();
                            "
                        >
                            <v-icon style="margin-right: 5px"
                                >mdi mdi-eye</v-icon
                            >
                            Afficher le résultat
                        </v-btn>
                    </v-col>
                </v-sheet>
            </v-col>
            <v-spacer></v-spacer>
            <v-col cols="6" md="7">
                <v-container>
                    <v-sheet>
                        <h2 style="margin-bottom: 9px" v-if="beforeDisplayRes">
                            <v-icon large color="primary">
                                mdi mdi-alert
                            </v-icon>
                            Résultat de l'examen apparaîtra ici
                        </h2>
                        <h2 style="margin-bottom: 9px" v-if="notPassed">
                            <v-icon large color="error">
                                mdi mdi-alert-circle
                            </v-icon>
                            Vous n'avez pas encore passé cet examen
                        </h2>
                        <h2 style="margin-bottom: 9px" v-if="infoExam">
                            <v-icon large color="primary">
                                mdi mdi-note-check
                            </v-icon>
                            Résultat de l'examen
                        </h2>
                        <div style="margin-left: 30px" v-if="infoExam">
                            <h2 style="margin-bottom: 9px">
                                <v-icon large color="primary">
                                    mdi mdi-circle-medium
                                </v-icon>
                                Nom de l'examen
                            </h2>
                            <h2
                                class="primary--text"
                                style="margin-left: 39px; margin-top: -10px"
                            >
                                {{ resExam }}
                            </h2>
                            <h2 style="margin-bottom: 9px">
                                <v-icon large color="primary">
                                    mdi mdi-circle-medium
                                </v-icon>
                                Résultat de l'examen
                            </h2>
                            <h2
                                class="primary--text"
                                style="margin-left: 39px; margin-top: -10px"
                            >
                                {{ resNote }}
                            </h2>
                        </div>
                    </v-sheet>
                    <v-spacer></v-spacer>
                    <v-sheet>
                        <h2 style="margin-top: 40px" v-if="infoExam">
                            <v-icon large color="primary">
                                mdi mdi-note-edit
                            </v-icon>
                            Informations sur l'examen
                        </h2>
                        <div style="margin-left: 30px" v-if="infoExam">
                            <h2 style="margin-bottom: 9px; margin-top: 5px">
                                <v-icon large color="primary">
                                    mdi mdi-circle-medium
                                </v-icon>
                                Date de l'examen
                            </h2>
                            <h2
                                class="primary--text"
                                style="margin-left: 39px; margin-top: -10px"
                            >
                                {{ resDateExam }}
                            </h2>
                            <h2 style="margin-bottom: 9px">
                                <v-icon large color="primary">
                                    mdi mdi-circle-medium
                                </v-icon>
                                Duree de l'examen
                            </h2>
                            <h2
                                class="primary--text"
                                style="margin-left: 39px; margin-top: -10px"
                            >
                                {{ resDurExam }}
                            </h2>
                        </div>
                    </v-sheet>
                </v-container>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import axios from "axios";
export default {
    name: "ResultatList",
    data: () => ({
        overlay: false,
        loader: null,
        loading: false,
        idexamen: "",
        idetudiant: "",
        resExam: "",
        resNote: "",
        email: "",
        resDateExam: "",
        resDurExam: "",
        infoExam: false,
        beforeDisplayRes: true,
        notPassed: false,
        examens: [],
        examensRes: [],
        etudiant: [],
        notes: [],
    }),
    watch: {
        loader() {
            const l = this.loader;
            this[l] = !this[l];
            setTimeout(() => (this[l] = false), 3000);
            this.loader = null;
        },
    },
    created() {
        this.getExamens();
        this.getEtudiants();
        this.email = localStorage.getItem("email");
    },
    mounted() {
        console.log("mounted() called");
    },
    methods: {
        getExamens() {
            let page = "http://127.0.0.1:8000/api/examens";
            axios.get(page).then(({ data }) => {
                this.examensRes = data;
                let counter = 0;
                for (let i in data) {
                    this.examens = Object.values(data);
                    counter += 1;
                }
            });
        },
        getEtudiants() {
            let page = process.env.VUE_APP_ETUDIANTS_API;
            axios.get(page).then(({ data }) => {
                this.etudiants = data;
                this.etudiants.forEach((etudiant) => {
                    if (etudiant.email == this.email) {
                        this.idetudiant = etudiant.id;
                    }
                });
            });
        },
        getNotes() {
            let page = "http://127.0.0.1:8000/api/notes";
            axios.get(page).then(({ data }) => {
                this.notes = data;
                this.resExam = this.nomExam;
                this.resNote = "";
                this.notes.forEach((note) => {
                    if (
                        note.etudiant_id == this.idetudiant &&
                        note.examen_id == this.idexamen
                    ) {
                        this.resNote = note.valeur;
                    }
                    this.examensRes.forEach((exam) => {
                        if (exam.id == Number(this.idexamen)) {
                            this.resExam = exam.nom;
                            this.resDateExam = exam.date;
                            this.resDurExam = exam.duree;
                        }
                    });
                });

                if (this.resNote == "") {
                    this.notPassed = true;
                    this.beforeDisplayRes = false;
                    this.infoExam = false;
                } else {
                    this.notPassed = false;
                    this.beforeDisplayRes = false;
                    this.infoExam = true;
                }
            });
        },
    },
};
</script>

<style>
* {
    font-family: Poppins;
}
</style>
