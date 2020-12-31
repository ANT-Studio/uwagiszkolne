import router from './route'
import axios from 'axios';

export default class UserController {
    static async login(email, password) {
        await axios.get('/sanctum/csrf-cookie');
        let response = await axios.post('/api/user/login', { email, password });
        let message = response.data.message;
        if(message === '') {
            await router.push('/');
            return "Zalogowano";
        }
        return Object.entries(message)[0][1][0];
    }

    static async register(name, email, password, password_confirmation) {
        await axios.get('/sanctum/csrf-cookie');
        let response = await axios.post('/api/user/register', { name, email, password, password_confirmation });
        let message = response.data.message;
        if(message === '') {
            await router.push({ name: "Login" });
            return "Dodano Użytkownika";
        }
        return Object.entries(message)[0][1][0];
    }

    static async check() {
        try {
            let response = await axios.post("/api/user/check");
            return response.data.logged;
        }
        catch {
            return false;
        }
    }

    static async admin() {
        let response = await axios.post("/api/user/check");
        return response.data.admin;
    }

    static async getUser() {
        let response = await axios.get("/api/user");
        return response.data;
    }

    static async logout() {
        await axios.get('/sanctum/csrf-cookie');
        axios.post("/api/user/logout").then(async req => {
            if(req.data.message === "") {
                window.location.reload();
            }
        })
    }

    static async changePassword(passwords) {
        let response = await axios.post('/api/user/change-password', { password: passwords.newPassword, password_confirmation: passwords.passwordConfirmation, old_password: passwords.oldPassword });
        let message = response.data.message;
        if(message === '') return "Zmieniono hasło!";
        console.log(Object.entries(message)[0]);
        return Object.entries(message)[0][1][0];
    }

    static async changeNick(name) {
        let response = await axios.post('/api/user/change-nick', { name });
        let message = response.data.message;
        if(message === '') window.location.reload();
        console.log(Object.entries(message)[0]);
        return Object.entries(message)[0][1][0];
    }
}
