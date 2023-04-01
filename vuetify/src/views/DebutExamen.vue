<!-- <template>
    <v-container>
        <v-row no-gutters>
            <v-col cols="12" sm="6" md="2">
                <v-card class="pa-2" outlined tile> time </v-card>
            </v-col>
            <v-col cols="6" md="10">
                <v-card class="pa-2" outlined tile> questions </v-card>
            </v-col>
        </v-row>
    </v-container>
</template> -->
<!-- debut exam -->
<template>
    <v-container>
        <v-card class="mx-auto mt-16 pa-6" max-width="700">
            <v-chip
                class="ma-2"
                color="primary"
                text-color="white"
                style="font-weight: bold"
            >
                <v-avatar left>
                    <v-icon>mdi mdi-clock</v-icon>
                </v-avatar>
                00:25:23
            </v-chip>
            <v-card-subtitle>
                <h2 style="line-height: 1.3">
                    Quel événement utilisez-vous pour exécuter quelque chose une
                    fois le chargement du page est terminé?
                </h2>
            </v-card-subtitle>
            <v-card-actions style="margin-top: -20px">
                <v-radio-group>
                    <v-radio label="onfinished" value="qdf"></v-radio>
                    <v-radio label="onload" value="easy"></v-radio>
                    <v-radio label="onunload" value="medium"></v-radio>
                    <v-radio label="oncomplete" value="hard"></v-radio>
                </v-radio-group>
            </v-card-actions>
            <v-btn depressed color="primary"> Suivant </v-btn>
        </v-card>
        <!-- <v-row>
            <v-card class="pa-2 ma-2" max-width="344">
                <v-card-text>
                    <div>Programmation Réseaux</div>
                    <p
                        class="text-h4 text--primary"
                        style="font-weight: 500; margin-top: 10px"
                    >
                        JavaScript
                    </p>
                    <p style="margin-top: -15px">Pr. TOUFIK Fouad</p>
                    <div style="margin-top: 3px">
                        <v-chip
                            color="primary"
                            text-color="white"
                            style="font-weight: bold"
                        >
                            <v-avatar left>
                                <v-icon>mdi mdi-calendar-today</v-icon>
                            </v-avatar>
                            2023-02-02
                        </v-chip>
                        <v-chip
                            class="ma-2"
                            color="primary"
                            text-color="white"
                            style="font-weight: bold"
                        >
                            <v-avatar left>
                                <v-icon>mdi mdi-clock</v-icon>
                            </v-avatar>
                            02:00:00
                        </v-chip>
                    </div>
                </v-card-text>

                <v-card-actions>
                    <v-btn
                        text
                        color="primary accent-4"
                        style="margin-top: -17px"
                    >
                        Commencer
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-row> -->
    </v-container>
</template>

<style>
.rounded-card {
    border-radius: 5px;
}
</style>
