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
                {{ time }}
            </v-chip>
            <v-card-subtitle>
                <h2 style="line-height: 1.3">
                    {{ this.propositions[this.a].question.libelle }}
                </h2>
            </v-card-subtitle>
            <v-card-actions style="margin-top: -20px">
                <v-radio-group v-model="radios">
                    <v-radio
                        :label="`${this.propositions[this.a].libelle}`"
                        :value="`${this.propositions[this.a].id}`"
                    ></v-radio>
                    <v-radio
                        :label="`${this.propositions[this.b].libelle}`"
                        :value="`${this.propositions[this.b].id}`"
                        >sfdsdf</v-radio
                    >
                    <v-radio
                        :label="`${this.propositions[this.c].libelle}`"
                        :value="`${this.propositions[this.c].id}`"
                    ></v-radio>
                    <v-radio
                        :label="`${this.propositions[this.d].libelle}`"
                        :value="`${this.propositions[this.d].id}`"
                    ></v-radio>
                </v-radio-group>
            </v-card-actions>
            <v-btn depressed color="primary" @click="suivant"> Suivant </v-btn>
        </v-card>
    </v-container>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            time: "00:00:00",
            id: this.$route.params.id,
            dureeExam: "",
            a: 0,
            b: 1,
            c: 2,
            d: 3,
            radios: "",
            reponse: {
                etudiant_id: "",
                question_id: "",
                proposition_id: "",
            },
            propositions: [],
            selected: [],
        };
    },
    created() {
        this.countdown();
        this.getPropositions();
    },
    mounted() {
        console.log("mounted() called");
    },
    methods: {
        getPropositions() {
            let page = "http://127.0.0.1:8000/api/propositions/";
            axios.get(page).then(({ data }) => {
                data.forEach((proposition) => {
                    if (proposition.question.examen_id == this.id) {
                        this.propositions.push(proposition);
                    }
                });
            });
        },
        // toMinutes(hms) {
        //     // let hms = "01:30:00";
        //     let timeSplit = hms.split(":");
        //     let minutes = +timeSplit[0] * 60 + +timeSplit[1];
        //     // let minutes = timeSplit[0] * 60 + timeSplit[1];
        //     return minutes;
        // },
        suivant() {
            this.reponse.proposition_id = this.radios;
            this.reponse.question_id = this.propositions[this.a].question.id;
            this.reponse.etudiant_id = localStorage.getItem("id");
            axios
                .post("http://127.0.0.1:8000/api/reponses/", this.reponse)
                .then(({ data }) => {
                    this.radios = "";
                });
            this.a += 4;
            this.b += 4;
            this.c += 4;
            this.d += 4;
        },
        addMinutes(date, minutes) {
            date.setMinutes(date.getMinutes() + minutes);
            return date;
        },
        countdown() {
            let dureeExam = localStorage.getItem("duree");
            let timeSplit = dureeExam.split(":");
            let minutes = +timeSplit[0] * 60 + +timeSplit[1];
            const time = this.addMinutes(new Date(), minutes);
            const endTime = new Date(time).getTime();
            const timer = setInterval(() => {
                const now = new Date().getTime();
                const distance = endTime - now;
                const hours = Math.floor(
                    (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
                );
                const minutes = Math.floor(
                    (distance % (1000 * 60 * 60)) / (1000 * 60)
                );
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                this.time = `${hours.toString().padStart(2, "0")}:${minutes
                    .toString()
                    .padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;

                if (distance < 0) {
                    clearInterval(timer);
                    this.time = "00:00:00";
                    this.$router.push("/start");
                }
            }, 1000);
        },
    },
};
</script>
