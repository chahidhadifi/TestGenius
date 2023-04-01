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
                            <v-icon>mdi mdi-plus</v-icon> Ajouter une questions
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
                                            label="Examen"
                                            :items="idExamens"
                                            v-model="editedItem.examen_id"
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
                    :items="questions"
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
    name: "QuestionsList",
    data: () => ({
        examens: [],
        idExamens: [],
        color: "primary",
        message: "",
        search: "",
        dialog: false,
        snackbar: false,
        questions: [],
        editedIndex: -1,
        editedItem: {
            id: "",
            examen_id: "",
            libelle: "",
        },
        headers: [
            {
                text: "#",
                align: "start",
                sortable: false,
                value: "id",
            },
            { text: "Examen", value: "examen.nom" },
            { text: "Libelle", value: "libelle" },
            { text: "Action", value: "actions" },
        ],
    }),
    created() {
        this.getQuestions();
        this.getExamens();
    },
    mounted() {
        console.log("mounted() called");
    },
    computed: {
        formTitle() {
            return this.editedIndex === -1
                ? "Ajouter une question"
                : "Modifier une question";
        },
    },
    methods: {
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
        getQuestions() {
            var page = "http://127.0.0.1:8000/api/questions/";
            axios.get(page).then(({ data }) => {
                console.log(data);
                this.questions = data;
            });
        },
        save() {
            if (this.editedIndex > -1) {
                Object.assign(
                    this.questions[this.editedIndex],
                    this.editedItem
                );
                var editRecords =
                    "http://127.0.0.1:8000/api/questions/" + this.editedItem.id;
                axios.put(editRecords, this.editedItem).then(({ data }) => {
                    this.snackbar = true;
                    this.message = "La question a été modifiée avec succès";
                    this.color = "success";
                    this.dialog = false;
                    this.getQuestions();
                });
            } else {
                axios
                    .post(
                        "http://127.0.0.1:8000/api/questions/",
                        this.editedItem
                    )
                    .then(({ data }) => {
                        this.snackbar = true;
                        this.message = "La question a été ajoutée avec succès";
                        this.color = "success";
                        this.dialog = false;
                        this.getQuestions();
                    });
            }
            this.dialog = false;
        },
        editItem(item) {
            this.editedIndex = this.questions.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        deleteItem(item) {
            const index = this.questions.indexOf(item);
            this.questions.splice(index, 1);
            var url = `http://127.0.0.1:8000/api/questions/${item.id}`;
            axios.delete(url);
            this.snackbar = true;
            this.message = "La question a été supprimée avec succès";
            this.color = "error";
        },
    },
};
</script>
