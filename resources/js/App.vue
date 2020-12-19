<template>
    <navbar></navbar>
    <router-view></router-view>

</template>

<script>
import Navbar from "./components/Navbar";
export default {
    components: { Navbar },
    mounted() {

    }
};
</script>

<style lang="scss">
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap');

    * {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Open Sans', sans-serif;
    }
</style>
