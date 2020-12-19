<template>
    <Navbar />
    <div class="app">
        <router-view />
    </div>
</template>

<script>
import Navbar from "./components/Navbar";

export default {
    components: { Navbar }
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

        .app {
            padding: 0 40px;

            h1 {
                font-size: 3rem;
                font-weight: bold;
                margin: 50px 0;
            }

            a {
                text-decoration: none;
                color: #ff8c00;
            }
        }
    }
</style>
