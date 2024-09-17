import { createRouter, createWebHistory } from 'vue-router';
import Home from '../../views/Home.vue';
import Catalog from '../../views/Catalog.vue';
import Connexion from '../../views/Connexion.vue';

const routes = [
  { path: '/', name: 'Home', component: Home }, 
  { path: '/catalog', name: 'Catalog', component: Catalog }, 
  { path: '/connexion', name: 'Connexion', component: Connexion},
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

export default router;
