import './bootstrap'; // Importe les styles globaux et configurations nécessaires
import '../css/app.css'; // Importe les styles CSS globaux
import { createApp } from 'vue';
import App from './App.vue'; // Le composant racine de ton application
import router from './router'; // Le routeur
import axios from 'axios';

const app = createApp(App);
app.use(router); // Utilisation du routeur
app.mount('#app'); // Montage de Vue.js sur l'élément HTML avec l'ID 'app'

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const csrfToken = document.querySelector('meta[name="csrf-token"]');
if (csrfToken) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken.getAttribute('content');
}


