<template>
    <nav>
        <v-card>
            <v-navigation-drawer permanent dark app class="blue darken-3 py-0">
                <v-list-item class="px-2">
                    <v-list-item-avatar>
                        <v-img src="@/assets/user.png"></v-img>
                    </v-list-item-avatar>
                    <v-list-item-title>{{ username }}</v-list-item-title>
                </v-list-item>

                <v-divider></v-divider>

                <v-list nav dense>
                    <v-list-item router to="/">
                        <v-list-item-action>
                            <v-icon>mdi-view-dashboard</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Dashboard</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item router to="/examens">
                        <v-list-item-action>
                            <v-icon>mdi mdi-book-plus</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title
                                >Création des examens</v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item router to="/contenuexamen">
                        <v-list-item-action>
                            <v-icon>mdi mdi-book-edit</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title
                                >Contenu des examens</v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>
                    <!-- <v-list-item router to="/questions">
                        <v-list-item-action>
                            <v-icon>mdi mdi-tooltip-question</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Questions</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item router to="/propositions">
                        <v-list-item-action>
                            <v-icon>mdi mdi-note-check</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Propositions</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item> -->

                    <v-list style="position: absolute; bottom: 0" nav dense>
                        <v-list-item router to="/auth">
                            <v-icon large @click="logout()"
                                >mdi mdi-logout-variant</v-icon
                            >
                        </v-list-item>
                    </v-list>
                </v-list>
            </v-navigation-drawer>
        </v-card>
    </nav>
</template>
<script>
export default {
    data() {
        return {
            items: [
                { title: "Home", icon: "mdi-home-city" },
                { title: "My Account", icon: "mdi-account" },
                { title: "Users", icon: "mdi-account-group-outline" },
            ],
            mini: true,
        };
    },
    computed: {
        username() {
            return localStorage.getItem("name");
        },
    },
    methods: {
        logout() {
            localStorage.clear();
        },
    },
};
</script>
