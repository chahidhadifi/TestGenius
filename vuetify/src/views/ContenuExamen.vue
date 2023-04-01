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
                        <v-select
                            :items="examens"
                            label="Nom d'examen"
                            v-model="idexamen"
                            outlined
                            item-text="nom"
                            item-value="id"
                        ></v-select>
                        <v-btn
                            depressed
                            color="primary"
                            style="margin-bottom: 60px; margin-top: -10px"
                            @click="afficherExam"
                        >
                            <v-icon style="margin-right: 5px"
                                >mdi mdi-eye</v-icon
                            >
                            Afficher l'examen
                        </v-btn>
                        <v-col cols="12" sm="20" class="pa-0">
                            <v-container>
                                <v-row>
                                    <h2 style="margin-bottom: 9px">
                                        <v-icon large color="primary">
                                            mdi mdi-comment-question
                                        </v-icon>
                                        Entrez la question et les réponses
                                    </h2>
                                    <v-col cols="12" sm="13">
                                        <v-sheet tile style="margin: -10px">
                                            <v-text-field
                                                label="Question"
                                                v-model="question.libelle"
                                                outlined
                                            ></v-text-field>
                                        </v-sheet>
                                    </v-col>
                                    <v-col
                                        cols="12"
                                        sm="20"
                                        md="8"
                                        style="margin-top: -30px"
                                    >
                                        <v-sheet tile class="pa-2">
                                            <v-text-field
                                                dense
                                                label="Proposition"
                                                v-model="
                                                    question.proposition[0]
                                                        .libelle
                                                "
                                            ></v-text-field>
                                        </v-sheet>
                                    </v-col>
                                    <v-col
                                        cols="6"
                                        md="4"
                                        style="margin-top: -30px"
                                    >
                                        <v-sheet class="pa-2" tile>
                                            <v-select
                                                :items="[0, 1]"
                                                v-model="
                                                    question.proposition[0]
                                                        .est_correcte
                                                "
                                                label="Vrai-Faux"
                                                dense
                                            ></v-select>
                                        </v-sheet>
                                    </v-col>
                                    <v-col
                                        cols="12"
                                        sm="20"
                                        md="8"
                                        style="margin-top: -40px"
                                    >
                                        <v-sheet tile class="pa-2">
                                            <v-text-field
                                                dense
                                                label="Proposition"
                                                v-model="
                                                    question.proposition[1]
                                                        .libelle
                                                "
                                            ></v-text-field>
                                        </v-sheet>
                                    </v-col>
                                    <v-col
                                        cols="6"
                                        md="4"
                                        style="margin-top: -40px"
                                    >
                                        <v-sheet class="pa-2" tile>
                                            <v-select
                                                :items="[0, 1]"
                                                v-model="
                                                    question.proposition[1]
                                                        .est_correcte
                                                "
                                                label="Vrai-Faux"
                                                dense
                                            ></v-select>
                                        </v-sheet> </v-col
                                    ><v-col
                                        cols="12"
                                        sm="20"
                                        md="8"
                                        style="margin-top: -40px"
                                    >
                                        <v-sheet tile class="pa-2">
                                            <v-text-field
                                                dense
                                                label="Proposition"
                                                v-model="
                                                    question.proposition[2]
                                                        .libelle
                                                "
                                            ></v-text-field>
                                        </v-sheet>
                                    </v-col>
                                    <v-col
                                        cols="6"
                                        md="4"
                                        style="margin-top: -40px"
                                    >
                                        <v-sheet class="pa-2" tile>
                                            <v-select
                                                :items="[0, 1]"
                                                v-model="
                                                    question.proposition[2]
                                                        .est_correcte
                                                "
                                                label="Vrai-Faux"
                                                dense
                                            ></v-select>
                                        </v-sheet> </v-col
                                    ><v-col
                                        cols="12"
                                        sm="20"
                                        md="8"
                                        style="margin-top: -40px"
                                    >
                                        <v-sheet tile class="pa-2">
                                            <v-text-field
                                                dense
                                                label="Proposition"
                                                v-model="
                                                    question.proposition[3]
                                                        .libelle
                                                "
                                            ></v-text-field>
                                        </v-sheet>
                                    </v-col>
                                    <v-col
                                        cols="6"
                                        md="4"
                                        style="margin-top: -40px"
                                    >
                                        <v-sheet class="pa-2" tile>
                                            <v-select
                                                :items="[0, 1]"
                                                v-model="
                                                    question.proposition[3]
                                                        .est_correcte
                                                "
                                                label="Vrai-Faux"
                                                dense
                                            ></v-select>
                                        </v-sheet>
                                    </v-col>
                                </v-row>
                            </v-container>
                            <v-btn
                                depressed
                                color="primary"
                                style="margin-top: -10px"
                                @click="ajouterQuestion"
                            >
                                <v-icon>mdi mdi-plus</v-icon>
                                Ajouter
                            </v-btn>
                        </v-col>
                    </v-col>
                </v-sheet>
            </v-col>
            <v-spacer></v-spacer>
            <v-col cols="6" md="7">
                <v-sheet class="pa-2">
                    <!-- <v-simple-table>
                        <template v-slot:default>
                            <thead>
                                <tr>
                                    <th class="text-left">Question</th>
                                    <th class="text-left">Proposition</th>
                                    <th class="text-left">Vrai/Faux</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="proposition in propositions"
                                    :key="proposition.questions_id"
                                >
                                    <td>
                                        {{ proposition.question_id }}
                                    </td>
                                    <td>
                                        {{ proposition.libelle }}
                                    </td>
                                    <td>
                                        {{ proposition.est_correcte }}
                                    </td>
                                </tr>
                            </tbody>
                        </template>
                    </v-simple-table> -->
                    <v-data-table
                        :headers="headers"
                        :items="propositions"
                        item-key="libelle"
                        sort-by="libelle"
                        group-by="question_id"
                        class="elevation-1"
                        show-group-by
                    ></v-data-table>
                </v-sheet>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import axios from "axios";
export default {
    name: "ContenuExamenList",
    data: () => ({
        idexamen: "",
        idquestion: "",
        question: {
            id: "",
            libelle: "",
            examen_id: "",
            proposition: [
                {
                    id: "",
                    libelle: "",
                    est_correcte: "",
                    question_id: "",
                },
                {
                    id: "",
                    libelle: "",
                    est_correcte: "",
                    question_id: "",
                },
                {
                    id: "",
                    libelle: "",
                    est_correcte: "",
                    question_id: "",
                },
                {
                    id: "",
                    libelle: "",
                    est_correcte: "",
                    question_id: "",
                },
            ],
        },
        propositions: [],
        questions: [],
        examens: [],
        questionsid: [],
        headers: [
            {
                text: "Proposition",
                align: "start",
                value: "libelle",
                groupable: false,
            },
            { text: "Question", value: "question_id", align: "right" },
            { text: "Vrai/Faux", value: "est_correcte", align: "right" },
        ],
    }),
    created() {
        this.getExamens();
    },
    mounted() {
        console.log("mounted() called");
    },
    methods: {
        afficherExam() {
            this.questions = [];
            this.getQuestions();
            this.propositions = [];
            this.getPropositions();
        },
        getQuestions() {
            var page = "http://127.0.0.1:8000/api/questions/";
            axios.get(page).then(({ data }) => {
                data.forEach((question) => {
                    if (this.idexamen == question.examen_id) {
                        this.questions.push(question);
                    }
                });
            });
        },
        getPropositions() {
            var page = "http://127.0.0.1:8000/api/propositions/";
            axios.get(page).then(({ data }) => {
                data.forEach((proposition) => {
                    if (proposition.est_correcte == 1) {
                        proposition.est_correcte = "Vrai";
                    } else if (proposition.est_correcte == 0) {
                        proposition.est_correcte = "Faux";
                    }
                });
                this.questions.forEach((question) => {
                    data.forEach((proposition) => {
                        if (proposition.question_id == question.id) {
                            this.propositions.push(proposition);
                        }
                    });
                });
            });
        },
        ajouterQuestion() {
            this.question.examen_id = this.idexamen;
            this.question.proposition.forEach((prop) => {
                prop.question_id = this.idquestion;
            });
            axios
                .post("http://127.0.0.1:8000/api/questions/", this.question)
                .then(({ data }) => {
                    this.question.libelle = "";
                    this.question.proposition.forEach((prop) => {
                        prop.libelle = "";
                        prop.est_correcte = "";
                    });
                    this.afficherExam();
                });
        },
        /*getExamens() {
            var page = "http://127.0.0.1:8000/api/examens/";
            axios.get(page).then(({ data }) => {
                data.forEach((examen) => {
                    this.examensid.push(examen.id);
                });
            });
        },*/
        getExamens() {
            var page = "http://127.0.0.1:8000/api/examens";
            axios.get(page).then(({ data }) => {
                let counter = 0;
                for (let i in data) {
                    this.examens = Object.values(data);
                    this.idExamens.push(this.examens[counter]?.id);
                    counter += 1;
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
