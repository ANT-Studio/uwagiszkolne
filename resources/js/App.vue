<template>
    <navbar></navbar>
    <router-view></router-view>

</template>

<script>
import Navbar from "./components/Navbar";
export default {
    components: {Navbar},
    mounted() {
        console.log("Component done.");
    },
};
</script>

<style lang="scss">
*{
    margin: 0;
    padding: 0;
}

body{
    background: black;
    color: white;
}
</style>
