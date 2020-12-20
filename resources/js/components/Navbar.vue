<template>
    <div class="navbar">
        <router-link to="/">
            <div class="navbar-logo">
                <img src="../../static/img/logo.png" alt="Logo" />
            </div>
        </router-link>
        <div class="navbar-separator" />
        <div class="navbar-links">
            <div v-for="link in links" class="navbar-link" :key="link.text">
                <router-link :to="link.to" active-class="navbar-link-active">
                    <font-awesome-icon :icon="link.icon" />
                    <span>{{ link.text }}</span>
                </router-link>
            </div>
            <div class="navbar-link">
                <router-link v-if="logged" :to="{ name: 'Account' }" active-class="navbar-link-active">
                    <font-awesome-icon icon="user" />
                    <span>{{ username }}</span>
                </router-link>
                <router-link v-else :to="{ name: 'Login' }" active-class="navbar-link-active">
                    <font-awesome-icon icon="user" />
                    <span>Zaloguj się</span>
                </router-link>
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
            position: relative;
            padding-left: 50px;

            a {
                color: black;
                text-decoration: none;
                font-size: 1.1rem;
            }

            span {
                margin-left: 20px;
            }
        }

        .navbar-link-active {
            &:after {
                content: '';
                position: absolute;
                top: 30px;
                bottom: 0;
                left: 50px;
                right: 0;
                height: 4px;
                width: calc(100% - 50px);
                background-color: #fdd500;
            }
        }
    }
}

@media only screen and (max-width: 970px){
    .navbar {
        flex-direction: column;
        text-align: center;

        .navbar-links {
            flex-direction: column;
            margin-top: 30px;

            .navbar-link {
                padding-left: 0 !important;
                margin-top: 25px;
            }

            .navbar-link-active {
                &:after {
                    left: 20px;
                    width: calc(100% - 40px);
                }
            }
        }
    }
}
</style>
