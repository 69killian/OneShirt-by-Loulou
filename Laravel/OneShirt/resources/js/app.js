import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue'; // Chemin correct si le fichier est dans components/
import router from './router/index.js';  // Import du routeur

const app = createApp(App);
app.use(router);  // Utilisation du routeur
app.mount('#app');  // Montage de Vue.js sur l'élément HTML avec l'ID 'app'

