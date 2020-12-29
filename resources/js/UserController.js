import router from './route'
import axios from 'axios';

export default class UserController {
    static async login(email, password) {
        let response = await axios.post('/api/user/login', { email, password });
        let message = response.data.message;
        if(message === '') {
            await router.push('/');
            return "Zalogowano";
        }
        return Object.entries(message)[0][1][0];
    }

    static async register(name, email, password, password_confirmation) {
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
}
