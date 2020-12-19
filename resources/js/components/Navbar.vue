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
                <router-link v-if="logged" :to="{ name: 'Account' }" active-class="navbar-link-active"><span>{{ username }}</span></router-link>
                <router-link v-else :to="{ name: 'Login' }" active-class="navbar-link-active"><span>Zaloguj się</span></router-link>
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
    display: flex;
    padding: 40px;
    align-items: center;

    .navbar-logo {
        width: 200px;

        img {
            width: 100%;
        }
    }

    .navbar-separator {
        flex: 1;
    }

    .navbar-links {
        display: flex;

        .navbar-link {
            padding-left: 50px;

            a{
                color: black;
                text-decoration: none;
                font-size: 1.1rem;
            }

            span {
                margin-left: 20px;
            }


        }

        .navbar-link-active{
            color: orange!important;
            font-weight: bold;
        }

    }
}

@media only screen and (max-width: 970px){
    .navbar{
        flex-direction: column;
        text-align: center;

        .navbar-links{
            flex-direction: column;
            margin-top: 30px;

            .navbar-link{
                margin-top: 15px;
            }
        }
    }
}
</style>
