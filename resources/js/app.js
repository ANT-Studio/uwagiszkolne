import { createApp } from 'vue';
import App from './App.vue';
import router from './route';

import { library } from '@fortawesome/fontawesome-svg-core'
import { faHome, faPlusCircle, faListOl, faUser } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faHome, faPlusCircle, faListOl, faUser);

const app = createApp(App);
app.use(router);
app.component('font-awesome-icon', FontAwesomeIcon);
app.mount("#app");
