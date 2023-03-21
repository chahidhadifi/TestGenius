<template>
    <v-layout row>
        <v-flex>
            <v-app style="background-color: white" class="ma-n4">
                <v-container>
                    <template>
                        <v-row style="margin-top: 20px">
                            <v-col cols="12" sm="6">
                                <v-row>
                                    <v-dialog
                                        v-model="dialog"
                                        persistent
                                        max-width="600px"
                                    >
                                        <template
                                            v-slot:activator="{ on, attrs }"
                                        >
                                            <v-btn
                                                style="
                                                    margin-top: 12px;
                                                    margin-left: 10px;
                                                "
                                                color="success"
                                                dark
                                                class="mb-2"
                                                v-bind="attrs"
                                                v-on="on"
                                                ><v-icon left>add</v-icon>
                                                Ajouter un département
                                            </v-btn>
                                        </template>
                                        <v-card>
                                            <v-card-title>
                                                <span class="text-h5"
                                                    >User Profile</span
                                                >
                                            </v-card-title>
                                            <v-card-text>
                                                <v-container>
                                                    <v-row>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="4"
                                                        >
                                                            <v-text-field
                                                                label="Legal first name*"
                                                                required
                                                            ></v-text-field>
                                                        </v-col>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="4"
                                                        >
                                                            <v-text-field
                                                                label="Legal middle name"
                                                                hint="example of helper text only on focus"
                                                            ></v-text-field>
                                                        </v-col>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="4"
                                                        >
                                                            <v-text-field
                                                                label="Legal last name*"
                                                                hint="example of persistent helper text"
                                                                persistent-hint
                                                                required
                                                            ></v-text-field>
                                                        </v-col>
                                                        <v-col cols="12">
                                                            <v-text-field
                                                                label="Email*"
                                                                required
                                                            ></v-text-field>
                                                        </v-col>
                                                        <v-col cols="12">
                                                            <v-text-field
                                                                label="Password*"
                                                                type="password"
                                                                required
                                                            ></v-text-field>
                                                        </v-col>
                                                        <v-col cols="12" sm="6">
                                                            <v-select
                                                                :items="[
                                                                    '0-17',
                                                                    '18-29',
                                                                    '30-54',
                                                                    '54+',
                                                                ]"
                                                                label="Age*"
                                                                required
                                                            ></v-select>
                                                        </v-col>
                                                        <v-col cols="12" sm="6">
                                                            <v-autocomplete
                                                                :items="[
                                                                    'Skiing',
                                                                    'Ice hockey',
                                                                    'Soccer',
                                                                    'Basketball',
                                                                    'Hockey',
                                                                    'Reading',
                                                                    'Writing',
                                                                    'Coding',
                                                                    'Basejump',
                                                                ]"
                                                                label="Interests"
                                                                multiple
                                                            ></v-autocomplete>
                                                        </v-col>
                                                    </v-row>
                                                </v-container>
                                                <small
                                                    >*indicates required
                                                    field</small
                                                >
                                            </v-card-text>
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn
                                                    color="blue darken-1"
                                                    text
                                                    @click="dialog = false"
                                                >
                                                    Close
                                                </v-btn>
                                                <v-btn
                                                    color="blue darken-1"
                                                    text
                                                    @click="dialog = false"
                                                >
                                                    Save
                                                </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                </v-row>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-text-field
                                    v-model="search"
                                    append-icon="mdi-magnify"
                                    label="Search"
                                    single-line
                                    hide-details
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <br />
                        <v-data-table
                            :headers="headers"
                            :items="desserts"
                            :search="search"
                        ></v-data-table>
                    </template>
                </v-container>
            </v-app>
        </v-flex>
    </v-layout>
</template>

<script>
export default {
    data() {
        return {
            dialog: false,
            search: "",
            headers: [
                {
                    text: "Dessert (100g serving)",
                    align: "start",
                    sortable: false,
                    value: "name",
                },
                { text: "Calories", value: "calories" },
                { text: "Fat (g)", value: "fat" },
                { text: "Carbs (g)", value: "carbs" },
                { text: "Protein (g)", value: "protein" },
                { text: "Iron (%)", value: "iron" },
            ],
            desserts: [
                {
                    name: "Frozen Yogurt",
                    calories: 159,
                    fat: 6.0,
                    carbs: 24,
                    protein: 4.0,
                    iron: 1,
                },
                {
                    name: "Ice cream sandwich",
                    calories: 237,
                    fat: 9.0,
                    carbs: 37,
                    protein: 4.3,
                    iron: 1,
                },
                {
                    name: "Eclair",
                    calories: 262,
                    fat: 16.0,
                    carbs: 23,
                    protein: 6.0,
                    iron: 7,
                },
                {
                    name: "Cupcake",
                    calories: 305,
                    fat: 3.7,
                    carbs: 67,
                    protein: 4.3,
                    iron: 8,
                },
                {
                    name: "Gingerbread",
                    calories: 356,
                    fat: 16.0,
                    carbs: 49,
                    protein: 3.9,
                    iron: 16,
                },
                {
                    name: "Jelly bean",
                    calories: 375,
                    fat: 0.0,
                    carbs: 94,
                    protein: 0.0,
                    iron: 0,
                },
                {
                    name: "Lollipop",
                    calories: 392,
                    fat: 0.2,
                    carbs: 98,
                    protein: 0,
                    iron: 2,
                },
                {
                    name: "Honeycomb",
                    calories: 408,
                    fat: 3.2,
                    carbs: 87,
                    protein: 6.5,
                    iron: 45,
                },
                {
                    name: "Donut",
                    calories: 452,
                    fat: 25.0,
                    carbs: 51,
                    protein: 4.9,
                    iron: 22,
                },
                {
                    name: "KitKat",
                    calories: 518,
                    fat: 26.0,
                    carbs: 65,
                    protein: 7,
                    iron: 6,
                },
            ],
        };
    },
};
</script>
