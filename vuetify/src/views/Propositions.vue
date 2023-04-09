<template>
    <v-container>
        <v-snackbar v-model="snackbar" :color="color">
            {{ message }}
        </v-snackbar>
        <v-row>
            <v-col>
                <v-dialog v-model="dialog" max-width="500px">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            color="primary"
                            dark
                            class="mb-2"
                            v-bind="attrs"
                            v-on="on"
                        >
                            <v-icon>mdi mdi-plus</v-icon> Ajouter une
                            proposition
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">{{ formTitle }}</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12">
                                        <v-select
                                            label="Question"
                                            :items="idQuestions"
                                            v-model="editedItem.question_id"
                                            variant="underlined"
                                        ></v-select>
                                    </v-col>
                                    <!-- <v-col cols="12">
                                        <v-text-field
                                            v-model="editedItem.departement_id"
                                            label="Département"
                                        ></v-text-field>
                                    </v-col> -->
                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="editedItem.libelle"
                                            label="Libelle"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-select
                                            v-model="editedItem.est_correcte"
                                            label="correcte ou pas"
                                            :items="[
                                                '0 (pas correcte)',
                                                '1 (est correcte)',
                                            ]"
                                            variant="underlined"
                                        ></v-select>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="dialog = false"
                                >Annuler</v-btn
                            >
                            <v-btn color="blue darken-1" text @click="save"
                                >Sauvegarder</v-btn
                            >
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-col>
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
                    :items="propositions"
                    :search="search"
                    class="elevation-1"
                >
                    <template v-slot:no-data>
                        <v-progress-linear
                            color="blue"
                            indeterminate
                            reverse
                        ></v-progress-linear>
                    </template>
                    <template v-slot:[`item.actions`]="{ item }">
                        <v-icon
                            class="mr-2"
                            @click="editItem(item)"
                            color="green darken-2"
                        >
                            mdi mdi-pencil-box
                        </v-icon>
                        <v-icon
                            class="mr-2"
                            @click="deleteItem(item)"
                            color="red darken-2"
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
    name: "PropositionsList",
    data: () => ({
        questions: [],
        propositions: [],
        idQuestions: [],
        color: "primary",
        message: "",
        search: "",
        dialog: false,
        snackbar: false,
        propositions: [],
        editedIndex: -1,
        editedItem: {
            id: "",
            libelle: "",
            est_correcte: "",
            question_id: "",
        },
        headers: [
            {
                text: "#",
                align: "start",
                sortable: false,
                value: "id",
            },
            { text: "Libelle", value: "libelle" },
            { text: "Correct ou pas", value: "est_correcte" },
            { text: "Question", value: "question.libelle" },
            { text: "Action", value: "actions" },
        ],
    }),
    created() {
        this.getQuestions();
        this.getPropositions();
    },
    mounted() {
        console.log("mounted() called");
    },
    computed: {
        formTitle() {
            return this.editedIndex === -1
                ? "Ajouter une proposition"
                : "Modifier une proposition";
        },
    },
    methods: {
        getQuestions() {
            var page = "http://127.0.0.1:8000/api/questions";
            axios.get(page).then(({ data }) => {
                let counter = 0;
                for (let i in data) {
                    this.questions = Object.values(data);
                    this.idQuestions.push(this.questions[counter]?.id);
                    counter += 1;
                }
            });
        },
        getPropositions() {
            var page = "http://127.0.0.1:8000/api/propositions/";
            axios.get(page).then(({ data }) => {
                console.log(data);
                this.propositions = data;
            });
        },
        save() {
            if (this.editedIndex > -1) {
                Object.assign(
                    this.propositions[this.editedIndex],
                    this.editedItem
                );
                var editRecords =
                    "http://127.0.0.1:8000/api/propositions/" +
                    this.editedItem.id;
                axios.put(editRecords, this.editedItem).then(({ data }) => {
                    this.snackbar = true;
                    this.message = "La proposition a été modifiée avec succès";
                    this.color = "success";
                    this.dialog = false;
                    this.getPropositions();
                });
            } else {
                axios
                    .post(
                        "http://127.0.0.1:8000/api/propositions/",
                        this.editedItem
                    )
                    .then(({ data }) => {
                        this.snackbar = true;
                        this.message =
                            "La proposition a été ajoutée avec succès";
                        this.color = "success";
                        this.dialog = false;
                        this.getPropositions();
                    });
            }
            this.dialog = false;
        },
        editItem(item) {
            this.editedIndex = this.propositions.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        deleteItem(item) {
            const index = this.propositions.indexOf(item);
            this.propositions.splice(index, 1);
            var url = `http://127.0.0.1:8000/api/propositions/${item.id}`;
            axios.delete(url);
            this.snackbar = true;
            this.message = "La proposition a été supprimée avec succès";
            this.color = "error";
        },
    },
};
</script>
