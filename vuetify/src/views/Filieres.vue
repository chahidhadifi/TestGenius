<!-- <template>
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
                                                        <v-col cols="12">
                                                            <v-text-field
                                                                label="Nom"
                                                                v-model="
                                                                    departement.nom
                                                                "
                                                                required
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
                                                >
                                                    Close
                                                </v-btn>
                                                <v-btn
                                                    color="blue darken-1"
                                                    text
                                                    @click="
                                                        saveData();
                                                        dialog = false;
                                                    "
                                                >
                                                    Save
                                                </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                </v-row>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <!-- <v-text-field
                                    v-model="search"
                                    append-icon="mdi-magnify"
                                    label="Search"
                                    single-line
                                    hide-details
                                ></v-text-field> -->
                            </v-col>
                        </v-row>
                        <br />
                        <v-simple-table>
                            <template v-slot:default>
                                <thead>
                                    <tr>
                                        <th class="text-left">#</th>
                                        <th class="text-left">Nom</th>
                                        <th class="text-left">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="departement in result"
                                        :key="departement.id"
                                    >
                                        <td>{{ departement.id }}</td>
                                        <td>{{ departement.nom }}</td>
                                        <td>
                                            <!-- <v-btn
                                                variant="flat"
                                                color="secondary"
                                                @click="edit(departement)"
                                            >
                                                Modifier
                                            </v-btn> -->
                                            <v-dialog
                                                v-model="dialogm"
                                                persistent
                                                max-width="600px"
                                            >
                                                <template
                                                    v-slot:activator="{
                                                        on,
                                                        attrs,
                                                    }"
                                                >
                                                    <v-btn
                                                        style="
                                                            margin-top: 9px;
                                                            margin-left: 10px;
                                                            margin-right: 10px;
                                                        "
                                                        color="blue"
                                                        dark
                                                        class="mb-2"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        ><v-icon left
                                                            >mdi mdi-pen</v-icon
                                                        >
                                                        Modifier
                                                    </v-btn>
                                                </template>
                                                <v-card>
                                                    <v-card-title>
                                                        <span class="text-h5"
                                                            >Département</span
                                                        >
                                                    </v-card-title>
                                                    <v-card-text>
                                                        <v-container>
                                                            <v-row>
                                                                <v-col
                                                                    cols="12"
                                                                >
                                                                    <v-text-field
                                                                        label="Nom"
                                                                        v-model="
                                                                            departement.nom
                                                                        "
                                                                        required
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
                                                            @click="
                                                                dialogm = false
                                                            "
                                                        >
                                                            Close
                                                        </v-btn>
                                                        <v-btn
                                                            color="blue darken-1"
                                                            text
                                                            @click="
                                                                edit(
                                                                    departement
                                                                );
                                                                dialogm = false;
                                                            "
                                                        >
                                                            Save
                                                        </v-btn>
                                                    </v-card-actions>
                                                </v-card>
                                            </v-dialog>
                                            <v-btn
                                                variant="flat"
                                                color="error"
                                                @click="remove(departement)"
                                            >
                                                <v-icon>mdi mdi-delete</v-icon>
                                                Supprimer
                                            </v-btn>
                                        </td>
                                    </tr>
                                </tbody>
                            </template>
                        </v-simple-table>
                    </template>
                </v-container>
            </v-app>
        </v-flex>
    </v-layout>
</template>
 -->
