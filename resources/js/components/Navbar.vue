<template>
    <div class="navbar">
        <div class="navbar-logo">
            <img src="../../static/img/logo.png" alt="Logo" />
        </div>
        <div class="navbar-separator" />
        <div class="navbar-links">
            <div v-for="link in links" class="navbar-link" :key="link.text">
                <router-link :to="link.to" active-class="navbar-link-active">
                    <font-awesome-icon :icon="link.icon" />
                    <span>{{ link.text }}</span>
                </router-link>
            </div>
            <div class="navbar-link">
                <font-awesome-icon icon="user" />
                <router-link v-if="logged" :to="{ name: 'Account' }" active-class="navbar-link-active">{{ username }}</router-link>
                <router-link v-else :to="{ name: 'Login' }" active-class="navbar-link-active">Zaloguj się</router-link>
            </div>
        </div>
    </div>
</template>

<script>
import { main } from '../navbarLinks';

export default {
    name: "Navbar",
    data() {
        return {
            links: main,
            logged: localStorage.getItem('logged') === 'true',
            username: localStorage.getItem('username'),
        }
    }
}
</script>

<style lang="scss" scoped>
    .navbar {

    }
</style>
