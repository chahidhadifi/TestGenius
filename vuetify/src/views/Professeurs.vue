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
                            <v-icon>mdi mdi-plus</v-icon> Ajouter un professeur
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
                                        <v-text-field
                                            v-model="editedItem.nom"
                                            label="Nom"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="editedItem.prenom"
                                            label="Prénom"
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
                    :items="professeurs"
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
    name: "ProfesseursList",
    data: () => ({
        color: "primary",
        message: "",
        search: "",
        dialog: false,
        snackbar: false,
        professeurs: [],
        editedIndex: -1,
        editedItem: {
            id: "",
            nom: "",
            prenom: "",
        },
        headers: [
            {
                text: "#",
                align: "start",
                sortable: false,
                value: "id",
            },
            { text: "Nom", value: "nom" },
            { text: "Prenom", value: "prenom" },
            { text: "Action", value: "actions" },
        ],
    }),
    created() {
        this.getProfesseurs();
    },
    mounted() {
        console.log("mounted() called");
    },
    computed: {
        formTitle() {
            return this.editedIndex === -1
                ? "Ajouter un professeur"
                : "Modifier un professeur";
        },
    },
    methods: {
        getProfesseurs() {
            var page =  process.env.VUE_APP_PROFESSEURS_API;
            axios.get(page).then(({ data }) => {
                console.log(data);
                this.professeurs = data;
            });
        },
        save() {
            if (this.editedIndex > -1) {
                Object.assign(
                    this.professeurs[this.editedIndex],
                    this.editedItem
                );
                var editRecords = `${process.env.VUE_APP_PROFESSEURS_API}/${this.editedItem.id}`;
                axios.put(editRecords, this.editedItem).then(({ data }) => {
                    this.snackbar = true;
                    this.message = "Le professeur a été modifié avec succès";
                    this.color = "success";
                    this.dialog = false;
                    this.getProfesseurs();
                });
            } else {
                axios
                    .post(
                        process.env.VUE_APP_PROFESSEURS_API,
                        this.editedItem
                    )
                    .then(({ data }) => {
                        console.log("add record");
                        console.log(data);
                        this.snackbar = true;
                        this.message = "Le professeur a été ajouté avec succès";
                        this.color = "success";
                        this.dialog = false;
                        this.getProfesseurs();
                    });
            }
            this.dialog = false;
        },
        editItem(item) {
            this.editedIndex = this.professeurs.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        deleteItem(item) {
            const index = this.professeurs.indexOf(item);
            this.professeurs.splice(index, 1);
            var url =  `${process.env.VUE_APP_PROFESSEURS_API}/${item.id}`;
            axios.delete(url);
            this.snackbar = true;
            this.message = "Le professeur a été supprimé avec succès";
            this.color = "error";
        },
    },
};
</script>
