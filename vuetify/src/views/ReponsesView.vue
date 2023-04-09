<template>
    <v-container>
        <v-snackbar v-model="snackbar" :color="color">
            {{ message }}
        </v-snackbar>
        <v-row>
            <v-col>
                <v-dialog v-model="dialog" max-width="500px">
                    <template v-slot:activator="{ on, attrs }"> </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">{{ formTitle }}</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="editedItem.nom"
                                            label="Nom"
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
                <!-- <v-data-table
                    :headers="headers"
                    :items="reponses"
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
                </v-data-table> -->
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
        /*this.getEtudiants();
        this.getQuestions();
        this.getPropositions();
        this.getNotes();*/
        //this.getDepartements();
    },
    mounted() {
        console.log("mounted() called");
        //this.getDepartements();
    },
    /*computed: {
        formTitle() {
            return this.editedIndex === -1
                ? "Ajouter une filiere"
                : "Modifier une filiere";
        },
    },*/
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
        /*save() {
            if (this.editedIndex > -1) {
                Object.assign(this.filieres[this.editedIndex], this.editedItem);
                var editRecords = `${process.env.VUE_APP_FILIERES_API}/${this.editedItem.id}`;
                axios.put(editRecords, this.editedItem).then(({ data }) => {
                    this.snackbar = true;
                    this.message = "La filiere a été modifiée avec succès";
                    this.color = "success";
                    this.dialog = false;
                    this.getFilieres();
                });
            } else {
                axios
                    .post( 
                        process.env.VUE_APP_FILIERES_API,
                        this.editedItem 
                     )
                    .then(({ data }) => {
                        this.snackbar = true;
                        this.message = "La filiere a été ajoutée avec succès";
                        this.color = "success";
                        this.dialog = false;
                        this.getFilieres();
                    });
            }
            this.dialog = false;
        },
        editItem(item) {
            this.editedIndex = this.filieres.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        deleteItem(item) {
            const index = this.filieres.indexOf(item);
            this.filieres.splice(index, 1);
            var url = `${process.env.VUE_APP_FILIERES_API}/${item.id}`;
            axios.delete(url);
            this.snackbar = true;
            this.message = "La filiere a été supprimée avec succès";
            this.color = "error";
        },*/
    },
};
</script>
