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
                            <v-icon>mdi mdi-plus</v-icon> Ajouter un étudiant
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
                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="editedItem.email"
                                            label="Email"
                                            type="email"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="editedItem.password"
                                            label="Mot de passe"
                                            type="password"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-select
                                            label="Filiere"
                                            :items="filieres"
                                            item-text="nom"
                                            item-value="id"
                                            v-model="editedItem.filiere_id"
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
                    :items="etudiants"
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
    name: "EtudiantsList",
    data: () => ({
        color: "primary",
        message: "",
        search: "",
        dialog: false,
        snackbar: false,
        filieres: [],
        idFilieres: [],
        etudiants: [],
        editedIndex: -1,
        editedItem: {
            id: "",
            nom: "",
            prenom: "",
            email: "",
            password: "",
            filiere_id: "",
        },
        headers: [
            {
                text: "#",
                align: "start",
                sortable: false,
                value: "id",
            },
            { text: "Nom", value: "nom" },
            { text: "Prénom", value: "prenom" },
            { text: "Email", value: "email" },
            { text: "password", value: "password" },
            { text: "Filiere", value: "filiere.nom" },
            { text: "Action", value: "actions" },
        ],
    }),
    created() {
        this.getEtudiants();
        //this.getFilieres();
    },
    mounted() {
        console.log("mounted() called");
        this.getFilieres();
    },
    computed: {
        formTitle() {
            return this.editedIndex === -1
                ? "Ajouter un étudiant"
                : "Modifier un étudiant";
        },
    },
    methods: {
        getFilieres() {
            var page = "http://127.0.0.1:8000/api/filieres/";
            axios.get(page).then(({ data }) => {
                console.log("filieres");
                console.log(data);
                this.filieres= data;
            });
        },
        getEtudiants() {
            var page = "http://127.0.0.1:8000/api/etudiants";
            axios.get(page).then(({ data }) => {
                console.log(data);
                this.etudiants = data;
            });
        },
        save() {
            if (this.editedIndex > -1) {
                Object.assign(
                    this.etudiants[this.editedIndex],
                    this.editedItem
                );
                var editRecords =
                    "http://127.0.0.1:8000/api/etudiants/" + this.editedItem.id;
                axios.put(editRecords, this.editedItem).then(({ data }) => {
                    this.snackbar = true;
                    this.message = "L'étudiant a été modifié avec succès";
                    this.color = "success";
                    this.dialog = false;
                    this.getEtudiants();
                });
            } else {
                axios
                    .post(
                        "http://127.0.0.1:8000/api/etudiants/",
                        this.editedItem
                    )
                    .then(({ data }) => {
                        this.snackbar = true;
                        this.message = "L'étudiant a été ajouté avec succès";
                        this.color = "success";
                        this.dialog = false;
                        this.getEtudiants();
                    });
            }
            this.dialog = false;
        },
        editItem(item) {
            this.editedIndex = this.Etudiants.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        deleteItem(item) {
            const index = this.Etudiants.indexOf(item);
            this.etudiants.splice(index, 1);
            var url = `http://127.0.0.1:8000/api/etudiants/${item.id}`;
            axios.delete(url);
            this.snackbar = true;
            this.message = "L'étudiant a été supprimé avec succès";
            this.color = "error";
        },
    },
};
</script>
