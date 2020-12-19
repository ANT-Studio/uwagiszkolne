<template>
    <div class="login">
        <h1>Logowanie</h1>
        <div class="message">
            Nie masz konta? <router-link :to="{ name: 'Register' }">Zarejestruj się!</router-link>
        </div>
        <form @submit.prevent="handleLogin" class="login-inputs">
            <input type="email" class="login-input" v-model="email" placeholder="Wpisz swój email...">
            <input type="password" class="login-input" v-model="password" placeholder="Wpisz swoje hasło...">
            <input type="submit" value="Zaloguj się"/>
        </form>
        <span>{{ message }}</span>
    </div>
</template>

<script>
import UserController from '../UserController'

export default {
    name: "Login",
    data() {
        return {
            email: "",
            password: "",
            message: ""
        }
    },
    methods: {
        async handleLogin() {
            if(this.email === '' || this.password === '') this.message = "Uzupełnij wszystkie pola!";
            else {
                this.message = "Ładowanie...";
                this.message = await UserController.login(this.email, this.password);
            }
        }
    }
}
</script>

<style lang="scss" scoped>
    .login {
        width: 30vw;

        .message {
            margin-bottom: 30px;
        }

        .login-inputs {
            display: flex;
            flex-direction: column;

            .login-input {
                background: #eee;
                border: none;
                outline: none;
                border-radius: 9px;
                margin-bottom: 20px;
                height: 20px;
                padding: 15px;

                &::placeholder {
                    color: #ccc;
                    font-weight: bold;
                }
            }

            input[type="submit"] {
                cursor: pointer;
                background: #FFD600;
                height: 50px;
                font-size: 1.2rem;
                color: black;
                font-weight: bold;
                width: 170px;
                margin: 30px 0;
                border-radius: 9px;
                outline: none;
                border: none;
            }
        }
    }
</style>
