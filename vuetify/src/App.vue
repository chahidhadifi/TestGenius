<template>
    <v-app>
        <Navbar v-if="hideNavbar" :is="setNavbar" />
        <v-main class="ma-4">
            <router-view></router-view>
        </v-main>
    </v-app>
</template>

<script>
export default {
    name: "App",
    watch: {
        $route(to, from) {
            if (to.path === "/auth") {
                location.reload();
            }
        },
    },
    computed: {
        setNavbar() {
            let userRole = localStorage.getItem("role");
            if (userRole == "admin") {
                return () => import("@/components/NavbarAdmin.vue");
            } else if (userRole == "professeur") {
                return () => import("@/components/NavbarProfesseur.vue");
            } else {
                return () => import("@/components/NavbarEtudiant.vue");
            }
        },
        hideNavbar() {
            return this.$route.path != "/auth";
        },
    },
    components: {},
    methods: {},
    data: () => ({}),
};
</script>
