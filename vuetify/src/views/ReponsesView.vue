<template>
    <v-container>
        <v-row>
            <v-col> </v-col>
            <v-col>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
            </v-col>
        </v-row>

        <v-row>
            <v-col cols="12">
                <v-data-table
                    :headers="headers"
                    :items="reponses"
                    item-key="libelle"
                    sort-by="libelle"
                    group-by="etudiant.nom"
                    :search="search"
                    class="elevation-1"
                >
                    <template v-slot:[`item.actions`]="{ item }">
                        <v-icon
                            class="mr-2"
                            @click="deleteItem(item)"
                            color="blue darken-2"
                        >
                            mdi mdi-delete
                        </v-icon>
                    </template>
                </v-data-table>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import axios from "axios";
export default {
    name: "NotesList",
    data: () => ({
        questions: [],
        idQuestions: [],
        propositions: [],
        idPropositions: [],
        etudiants: [],
        idEtudiants: [],
        color: "primary",
        message: "",
        search: "",
        dialog: false,
        snackbar: false,
        reponses: [],
        editedIndex: -1,
        editedItem: {
            id: "",
            question_id: "",
            proposition_id: "",
            etudiant_id: "",
        },
        headers: [
            { text: "Etudiant", value: "etudiant.nom" },
            { text: "Question", value: "question.libelle" },
            { text: "Proposition", value: "proposition.libelle" },
            { text: "Action", value: "actions" },
        ],
    }),
    created() {
        this.getReponses();
    },
    mounted() {
        console.log("mounted() called");
    },
    methods: {
        getReponses() {
            var page = "http://127.0.0.1:8000/api/reponses/";
            axios.get(page).then(({ data }) => {
                console.log(data);
                this.reponses = data;
            });
        },
        getEtudiants() {
            var page = "http://127.0.0.1:8000/api/etudiants/";
            axios.get(page).then(({ data }) => {
                console.log(data);
                this.etudiants = data;
            });
        },
        getQuestions() {
            var page = "http://127.0.0.1:8000/api/questions/";
            axios.get(page).then(({ data }) => {
                console.log(data);
                this.questions = data;
            });
        },
        getPropositions() {
            var page = "http://127.0.0.1:8000/api/propositions/";
            axios.get(page).then(({ data }) => {
                console.log(data);
                this.propositions = data;
            });
        },
    },
};
</script>
