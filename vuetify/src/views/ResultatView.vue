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
                            <v-icon>mdi mdi-plus</v-icon> Donner une note
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">{{ formTitle }}</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-select
                                            label="Examen"
                                            :items="examens"
                                            item-text="nom"
                                            item-value="id"
                                            v-model="editedItem.examen_id"
                                            variant="underlined"
                                    ></v-select>
                                    <v-select
                                            label="Etudiant"
                                            :items="etudiants"
                                            item-text="nom"
                                            item-value="id"
                                            v-model="editedItem.etudiant_id"
                                            variant="underlined"
                                    ></v-select>
                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="editedItem.valeur"
                                            label="Note"
                                        ></v-text-field>
                                    </v-col>
                                    <!-- <v-col cols="12">
                                        <v-text-field
                                            v-model="editedItem.email"
                                            label="Email"
                                        ></v-text-field>
                                    </v-col> -->
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
                    :items="notes"
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
    name: "NotesList",
    data: () => ({
        examens: [],
        idExamens: [],
        etudiants: [],
        idEtudiants: [],
        color: "primary",
        message: "",
        search: "",
        dialog: false,
        snackbar: false,
        notes: [],
        editedIndex: -1,
        editedItem: {
            id:"",
            examen_id: "",
            etudiant_id: "",
            valeur: "",
        },
        headers: [
            {
                text: "#",
                align: "start",
                sortable: false,
                value: "id",
            },
            { text: "Examen", value: "examen.nom" },
            { text: "Etudiant", value: "etudiant.nom" },
            { text: "Note", value: "valeur" },
            { text: "Action", value: "actions" },
        ],
    }),
    created() {
        this.getNotes();
        this.getExamens();
        this.getEtudiants();
    },
    mounted() {
        console.log("mounted() called");
      
    },
    computed: {
        formTitle() {
            return this.editedIndex === -1
                ? "Ajouter un département"
                : "Modifier un département";
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
        getNotes() {
            var page = "http://127.0.0.1:8000/api/notes/";
            axios.get(page).then(({ data }) => {
                console.log(data);
                this.notes = data;
            });
        },
        getEtudiants() {
            var page = process.env.VUE_APP_ETUDIANTS_API;
            axios.get(page).then(({ data }) => {
                console.log(data);
                this.etudiants = data;
            });
        },
        save() {
            if (this.editedIndex > -1) {
                Object.assign(
                    this.notes[this.editedIndex],
                    this.editedItem
                );
                var editRecords = `${process.env.VUE_APP_NOTES_API}/${this.editedItem.id}`;
                axios.put(editRecords, this.editedItem).then(({ data }) => {
                    this.snackbar = true;
                    this.message = "La note a été modifié avec succès";
                    this.color = "success";
                    this.dialog = false;
                    this.getNotes();
                });
            } else {
                axios
                    .post(
                        process.env.VUE_APP_NOTES_API,
                        this.editedItem
                    )
                    .then(({ data }) => {
                        this.snackbar = true;
                        this.message =
                            "La note a été ajouté avec succès";
                        this.color = "success";
                        this.dialog = false;
                        this.getNotes();
                    });
            }
            this.dialog = false;
        },
        editItem(item) {
            this.editedIndex = this.notes.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        deleteItem(item) {
            const index = this.notes.indexOf(item);
            this.notes.splice(index, 1);
            var url =  `${process.env.VUE_APP_NOTES_API}/${item.id}`;
            axios.delete(url);
            this.snackbar = true;
            this.message = "La note a été supprimé avec succès";
            this.color = "error";
        },
    },
};
</script>