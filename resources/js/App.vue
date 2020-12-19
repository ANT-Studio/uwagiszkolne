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
    * {
        margin: 0;
        padding: 0;
    }
</style>
