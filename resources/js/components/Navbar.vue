<template>
    <div class="title">Laravel 8 + Vue 3 + Vue Router 4</div>
    <div class="navbar">
        <router-link to="/" class="link">Go to the main</router-link>
        <router-link to="/page" class="link">Go to the Side Page</router-link>
    </div>
</template>

<script>
export default {
    name: "Navbar"
}
</script>

<style lang="scss" scoped>
    .title{
        font-size: 3rem;
        color: white;
        width: fit-content;
        margin: 50px auto;
        font-weight: bolder;
    }
    .navbar{
        margin: auto;
        display: flex;
        font-size: 1.8rem;
        text-align: center;
        width: fit-content;
        .link{
            margin: 20px;
        }
        a{
            text-decoration: none;
            color: white;
        }

    }
</style>
