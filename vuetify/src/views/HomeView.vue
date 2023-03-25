<template>
    <v-container>
        <v-snackbar v-model="snackbar" :color="color">
            {{ message }}
        </v-snackbar>
        <v-row align="center" justify="center">
            <v-col cols="12" sm="10">
                <v-card class="elevation-6 mt-10">
                    <v-window v-model="step">
                        <v-window-item :value="1">
                            <v-row>
                                <v-col cols="12" md="6">
                                    <v-card-text class="mt-12">
                                        <h4 class="text-center">
                                            Login in to Your Account
                                        </h4>
                                        <h6 class="text-center grey--text">
                                            Log in to your account so you can
                                            continue builiding <br />and editing
                                            your onboarding flows
                                        </h6>
                                        <v-row align="center" justify="center">
                                            <v-col cols="12" sm="8">
                                                <v-form
                                                    @submit.prevent="
                                                        submitHandler
                                                    "
                                                    ref="form"
                                                >
                                                    <v-card-text>
                                                        <v-text-field
                                                            v-model="email"
                                                            :rules="emailRules"
                                                            type="email"
                                                            label="Email"
                                                            prepend-inner-icon="mdi-email"
                                                            required
                                                        />

                                                        <v-text-field
                                                            v-model="password"
                                                            :rules="
                                                                passwordRules
                                                            "
                                                            :type="
                                                                passwordShow
                                                                    ? 'text'
                                                                    : 'password'
                                                            "
                                                            label="Password"
                                                            placeholder="Password"
                                                            required
                                                            prepend-inner-icon="mdi-key"
                                                            :append-icon="
                                                                passwordShow
                                                                    ? 'mdi-eye'
                                                                    : 'mdi-eye-off'
                                                            "
                                                            @click:append="
                                                                passwordShow =
                                                                    !passwordShow
                                                            "
                                                        />
                                                    </v-card-text>
                                                    <v-btn
                                                        color="blue"
                                                        type="submit"
                                                        dark
                                                        block
                                                        tile
                                                        @click="login"
                                                        >Log in</v-btn
                                                    >
                                                </v-form>
                                            </v-col>
                                        </v-row>
                                    </v-card-text>
                                </v-col>
                                <v-col
                                    cols="12"
                                    md="6"
                                    class="blue rounded-bl-xl"
                                >
                                    <div
                                        style="
                                            text-align: center;
                                            padding: 180px 0;
                                        "
                                    >
                                        <v-card-text class="white--text">
                                            <h3 class="text-center">
                                                Don't Have an Account Yet?
                                            </h3>
                                            <h6 class="text-center">
                                                Let's get you all set up so you
                                                can start creating your your
                                                first<br />
                                                onboarding experience
                                            </h6>
                                        </v-card-text>
                                        <div class="text-center">
                                            <v-btn
                                                tile
                                                outlined
                                                dark
                                                @click="step++"
                                                >SIGN UP</v-btn
                                            >
                                        </div>
                                    </div>
                                </v-col>
                            </v-row>
                        </v-window-item>
                        <v-window-item :value="2">
                            <v-row>
                                <v-col
                                    cols="12"
                                    md="6"
                                    class="blue rounded-br-xl"
                                >
                                    <div
                                        style="
                                            text-align: center;
                                            padding: 180px 0;
                                        "
                                    >
                                        <v-card-text class="white--text">
                                            <h3 class="text-center">
                                                Alredy Signed up?
                                            </h3>
                                            <h6 class="text-center">
                                                Log in to your account so you
                                                can continue building and<br />
                                                editing your onboarding flows
                                            </h6>
                                        </v-card-text>
                                        <div class="text-center">
                                            <v-btn
                                                tile
                                                outlined
                                                dark
                                                @click="step--"
                                                >Log in</v-btn
                                            >
                                        </div>
                                    </div>
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-card-text class="mt-12">
                                        <h4 class="text-center">
                                            Sign Up for an Account
                                        </h4>
                                        <h6 class="text-center grey--text">
                                            Let's get you all set up so you can
                                            start creatin your <br />
                                            first onboarding experiance
                                        </h6>
                                        <v-row align="center" justify="center">
                                            <v-col cols="12" sm="8">
                                                <v-form
                                                    @submit.prevent="
                                                        registerUser
                                                    "
                                                    ref="form"
                                                >
                                                    <v-card-text>
                                                        <v-text-field
                                                            v-model="namereg"
                                                            label="Name"
                                                            prepend-inner-icon="mdi-account"
                                                            type="text"
                                                            required
                                                        ></v-text-field>
                                                        <v-select
                                                            v-model="rolereg"
                                                            label="Select"
                                                            :items="[
                                                                'etudiant',
                                                                'professeur',
                                                            ]"
                                                            variant="underlined"
                                                        ></v-select>
                                                        <v-text-field
                                                            v-model="emailreg"
                                                            :rules="emailRules"
                                                            type="email"
                                                            label="Email"
                                                            prepend-inner-icon="mdi-email"
                                                            required
                                                        />
                                                        <v-text-field
                                                            v-model="
                                                                passwordreg
                                                            "
                                                            :rules="
                                                                passwordRules
                                                            "
                                                            :type="
                                                                passwordShow
                                                                    ? 'text'
                                                                    : 'password'
                                                            "
                                                            label="Password"
                                                            placeholder="Password"
                                                            required
                                                            prepend-inner-icon="mdi-key"
                                                            :append-icon="
                                                                passwordShow
                                                                    ? 'mdi-eye'
                                                                    : 'mdi-eye-off'
                                                            "
                                                            @click:append="
                                                                passwordShow =
                                                                    !passwordShow
                                                            "
                                                        />
                                                    </v-card-text>
                                                    <v-btn
                                                        color="blue"
                                                        type="submit"
                                                        dark
                                                        block
                                                        tile
                                                        @click="registerUser"
                                                        >Sign up</v-btn
                                                    >
                                                </v-form>
                                            </v-col>
                                        </v-row>
                                    </v-card-text>
                                </v-col>
                            </v-row>
                        </v-window-item>
                    </v-window>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            step: 1,
            props: {
                source: String,
            },
            color: "",
            message: "",
            loading: false,
            snackbar: false,
            passwordShow: false,
            namereg: "",
            rolereg: "",
            emailreg: "",
            passwordreg: "",
            email: "",
            password: "",
            emailRules: [
                (v) => !!v || "E-mail is required",
                (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
            ],
            password: "",
            passwordRules: [
                (v) => !!v || "Password is required",
                (v) =>
                    (v && v.length >= 6) ||
                    "Password must be 6  characters or more!",
            ],
        };
    },
    methods: {
        submitHandler() {
            if (this.$refs.form.validate()) {
                this.loading = true;
                setTimeout(() => {
                    this.loading = false;
                    this.snackbar = true;
                }, 3000);
            }
        },
        login() {
            let bodyFormData = new FormData();
            bodyFormData.set("email", this.email);
            bodyFormData.set("password", this.password);
            axios({
                method: "post",
                url: "http://127.0.0.1:8000/api/login",
                data: bodyFormData,
                config: { headers: { "Content-Type": "multipart/form-data" } },
            })
                .then((response) => {
                    localStorage.setItem("token", response.data.token);
                    const role = response.data.role;
                    switch (role) {
                        case "admin":
                            this.$router.push("/departements");
                            break;
                        case "etudiant":
                            this.$router.push("/departements");
                            break;
                        case "professeur":
                            this.$router.push("/professeurs");
                            break;
                        default:
                            console.error("Rôle d'utilisateur invalide !");
                    }
                })
                .catch((error) => {
                    this.snackbar = true;
                    this.message = "Erreur d'authentification";
                    this.color = "error";
                });
        },
        registerUser() {
            let bodyFormData = new FormData();
            bodyFormData.set("name", this.namereg);
            bodyFormData.set("role", this.rolereg);
            bodyFormData.set("email", this.emailreg);
            bodyFormData.set("password", this.passwordreg);
            axios({
                method: "post",
                url: "http://127.0.0.1:8000/api/register",
                data: bodyFormData,
                config: { headers: { "Content-Type": "multipart/form-data" } },
            })
                .then((response) => {
                    window.location.reload();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style scoped>
.v-application .rounded-bl-xl {
    border-bottom-left-radius: 300px !important;
}
.v-application .rounded-br-xl {
    border-bottom-right-radius: 300px !important;
}
</style>
