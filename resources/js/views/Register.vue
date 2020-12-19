<template>
    <div class="register">
        <h1>Rejestracja</h1>
        <div class="message">
            Masz już konto? <router-link :to="{ name: 'Login' }">Zaloguj się!</router-link>
        </div>
        <form @submit.prevent="handleRegister" class="register-inputs">
            <input type="email" class="register-input" v-model="email" placeholder="Wpisz swój email...">
            <input type="password" class="register-input" v-model="password" placeholder="Wpisz swoje hasło...">
            <input type="password" class="register-input" v-model="passwordConfirmation" placeholder="Wpisz ponownie swoje hasło...">
            <input type="submit" value="Zarejestruj się"/>
        </form>
        <span>{{ message }}</span>
    </div>
</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            email: "",
            password: "",
            passwordConfirmation: "",
            message: ""
        }
    },
    methods: {
        handleRegister() {

        }
    }
}
</script>

<style lang="scss" scoped>
    .register {
        width: 30vw;

        .message {
            margin-bottom: 30px;
        }

        .register-inputs {
            display: flex;
            flex-direction: column;

            .register-input {
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
