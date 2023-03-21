<template>
    <v-app>
        <Navbar v-if="hideNavbar" />
        <v-content class="ma-4">
            <router-view></router-view>
        </v-content>
    </v-app>
</template>

<script>
import Navbar from "@/components/Navbar";
//import Footer from '@/components/Footer'
export default {
    name: "App",

    computed: {
        hideNavbar() {
            return this.$route.path != "/auth";
        },
    },

    components: {
        Navbar,
        //Footer
    },

    data: () => ({
        //
    }),
};
</script>
