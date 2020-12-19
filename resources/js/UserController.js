import router from './route'
import axios from 'axios';

export default class UserController {
    static async login(email, password) {
        let response = await axios.post('/api/user/login', { email, password });
        let message = response.data.message;
        if(message === '') {
            localStorage.setItem('logged', 'true');
            localStorage.setItem('username', response.data.user.name);
            await router.push('/');
            return "Zalogowano";
        }
        return Object.entries(message)[0][1][0];
    }
}
