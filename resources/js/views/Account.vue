<template>
    <div class="account">
        <h1>Witaj, {{ user.name }} <span @click="handleLogout" class="logout">(Wyloguj się)</span></h1>
        <div class="settings">
            <h2>Ustawienia</h2>
            <br><br>
            <h3>Zmień hasło</h3>
            <br>
            <form @submit.prevent="handlePasswordChange" class="setting">
                <input type="password" class="input" placeholder="Wpisz swoje hasło..." v-model="passwords.oldPassword" />
                <input type="password" class="input" placeholder="Wpisz nowe hasło..." v-model="passwords.newPassword" />
                <input type="password" class="input" placeholder="Powtórz nowe hasło..." v-model="passwords.passwordConfirmation" />
                <input type="submit" value="Zmień hasło" />
            </form>
            <span class="message">{{ passwords.message }}</span>
            <br><br><br>
            <h3>Zmień nick</h3>
            <br>
            <form @submit.prevent="handleNickChange" class="setting">
                <input type="text" class="input" placeholder="Wpisz nowy nick..." v-model="nick.nick" />
                <input type="submit" value="Zmień nick" />
            </form>
            {{ nick.message }}
        </div>
        <div class="notes-container">
            <h2>Twoje uwagi</h2>
            <br>
            <div class="notes">
                <Note v-for="note in notes" :key="note.content" :note="note" :admin="true" @reloadNotes="fetchNotes" />
            </div>
        </div>
    </div>
</template>

<script>
import UserController from '../UserController';
import NotesController from '../NotesController';
import Note from '../components/Note';

export default {
    name: "Account",
    components: {
        Note
    },
    data() {
        return {
            user: { name: "" },
            notes: [],
            passwords: {
                oldPassword: "",
                newPassword: "",
                passwordConfirmation: "",
                message: ""
            },
            nick: {
                nick: "",
                message: ""
            }
        }
    },
    methods: {
        async fetchNotes() {
            this.notes = await NotesController.fetchUserNotes();
            this.notes.forEach(note => note.liked = true);
        },
        async handleLogout() {
            await UserController.logout();
        },
        async handlePasswordChange() {
            this.passwords.message = "Ładowanie...";
            this.passwords.message = await UserController.changePassword(this.passwords);
        },
        async handleNickChange() {
            this.nick.message = "Ładowanie...";
            this.nick.message = await UserController.changeNick(this.nick.nick);
        }
    },
    async mounted() {
        this.user = await UserController.getUser();
        await this.fetchNotes();
    }
}
</script>

<style lang="scss" scoped>
    .account {
        margin-bottom: 50px;

        .logout {
            color: #e3342f;
            cursor: pointer;
            font-size: 1.5rem;
        }

        .settings {
            width: 30vw;
            margin-bottom: 50px;

            .setting {
                display: flex;
                flex-direction: column;

                .input {
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

        .notes-container {
            .notes {
                display: flex;
                flex-wrap: wrap;
                gap: 30px;
            }
        }
    }

    @media only screen and (max-width: 970px) {
        .settings {
            width: 70vw !important;
        }
    }
</style>
