<template>
    <v-container>
        <v-row no-gutters>
            <v-col cols="12" sm="6" md="5">
                <v-sheet>
                    <v-col cols="12" sm="13">
                        <v-select
                            :items="examensid"
                            label="Nom d'examen"
                            v-model="idexamen"
                            outlined
                        ></v-select>
                        <v-btn
                            depressed
                            color="primary"
                            style="margin-bottom: 30px"
                            @click="afficherExam"
                        >
                            Afficher l'examen
                        </v-btn>
                        <v-text-field
                            label="Question"
                            outlined
                            v-model="question.libelle"
                            hide-details
                        ></v-text-field>
                        <v-col cols="12" sm="20" class="pa-0">
                            <v-container>
                                <v-row>
                                    <v-col cols="12" sm="20" md="8">
                                        <v-sheet tile class="pa-2">
                                            <v-text-field
                                                dense
                                                label="Proposition"
                                                v-model="proposition.libelle"
                                            ></v-text-field>
                                        </v-sheet>
                                    </v-col>
                                    <v-col cols="6" md="4">
                                        <v-sheet class="pa-2" tile>
                                            <v-select
                                                :items="[0, 1]"
                                                v-model="
                                                    proposition.est_correcte
                                                "
                                                label="V/F"
                                                dense
                                            ></v-select>
                                        </v-sheet>
                                    </v-col>
                                </v-row>
                            </v-container>
                            <v-btn
                                depressed
                                color="primary"
                                class="ma-3"
                                @click="ajouterQuestion"
                            >
                                Ajouter
                            </v-btn>
                        </v-col>
                    </v-col>
                </v-sheet>
            </v-col>
            <v-spacer></v-spacer>
            <v-col cols="6" md="7">
                <v-card class="pa-2" outlined tile>
                    <!-- <v-simple-table>
                        <template v-slot:default>
                            <thead>
                                <tr>
                                    <th class="text-left">Question</th>
                                    <th class="text-left">Proposition</th>
                                    <th class="text-left">V/F</th>
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
                </v-card>
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
        question: {
            id: "",
            libelle: "",
            examen_id: "",
        },
        proposition: {
            id: "",
            libelle: "",
            est_correcte: "",
            questions_id: "",
        },
        propositions: [],
        questions: [],
        examensid: [],
        questionsid: [],
        headers: [
            {
                text: "Proposition",
                align: "start",
                value: "libelle",
                groupable: false,
            },
            { text: "Question", value: "question_id", align: "right" },
            { text: "V/F", value: "est_correcte", align: "right" },
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
        ajouterQuestion() {
            //
            this.question.examen_id = this.idexamen;
            axios
                .post("http://127.0.0.1:8000/api/questions/", this.question)
                .then(({ data }) => {});
            var page = "http://127.0.0.1:8000/api/questions/";
            axios.get(page).then(({ data }) => {
                this.proposition.questions_id = data[data.length - 1].id;
            });
            axios
                .post(
                    "http://127.0.0.1:8000/api/propositions/",
                    this.proposition
                )
                .then(({ data }) => {
                    this.afficherExam();
                });
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
        getExamens() {
            var page = "http://127.0.0.1:8000/api/examens/";
            axios.get(page).then(({ data }) => {
                data.forEach((examen) => {
                    this.examensid.push(examen.id);
                });
            });
        },
    },
};
</script>
