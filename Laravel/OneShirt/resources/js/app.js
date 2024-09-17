import './bootstrap'; // Importe les styles globaux et configurations nécessaires
import '../css/app.css'; // Importe les styles CSS globaux
import { createApp } from 'vue';
import App from './App.vue'; // Le composant racine de ton application
import router from './router'; // Le routeur

const app = createApp(App);
app.use(router); // Utilisation du routeur
app.mount('#app'); // Montage de Vue.js sur l'élément HTML avec l'ID 'app'

