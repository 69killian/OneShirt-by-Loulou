import { createRouter, createWebHistory } from 'vue-router';
import Home from '../../views/Home.vue'; // Assurez-vous que le chemin est correct
import Catalog from '../../views/Catalog.vue';

const routes = [
  { path: '/', name: 'Home', component: Home }, // Route par défaut
  { path: '/catalog', name: 'Catalog', component: Catalog }, 
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

export default router;
