<template>
    <nav>
        <v-card>
            <v-navigation-drawer permanent dark app class="blue darken-3 py-0">
                <v-list-item class="px-2">
                    <v-list-item-avatar>
                        <v-img
                            src="https://randomuser.me/api/portraits/men/85.jpg"
                        ></v-img>
                    </v-list-item-avatar>
                    <v-list-item-title>John Leider</v-list-item-title>
                </v-list-item>

                <v-divider></v-divider>

                <v-list nav dense>
                    <v-list-item router to="/dashboard">
                        <v-list-item-action>
                            <v-icon>mdi-view-dashboard</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Dashboard</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item router to="/examens">
                        <v-list-item-action>
                            <v-icon>mdi-pencil-box</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Examens</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item router to="/questions">
                        <v-list-item-action>
                            <v-icon>mdi-pencil-box</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Questions</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item router to="/propositions">
                        <v-list-item-action>
                            <v-icon>mdi-pencil-box</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Propositions</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <!--  <v-list-item router to="/filieres">
                        <v-list-item-action>
                            <v-icon>mdi mdi-home-group</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Filieres</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item router to="/matieres">
                        <v-list-item-action>
                            <v-icon>mdi mdi-book-open-page-variant</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Matieres</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item router to="/professeurs">
                        <v-list-item-action>
                            <v-icon>mdi mdi-human-male-board-poll</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Professeurs</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item router to="/etudiants">
                        <v-list-item-action>
                            <v-icon>mdi mdi-account-school</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Etudiants</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>-->
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
    methods: {
        logout() {
            localStorage.clear();
        },
    },
};
</script>
