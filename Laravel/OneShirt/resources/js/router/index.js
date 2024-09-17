import { createRouter, createWebHistory } from 'vue-router';
import Home from '../../views/Home.vue';
import Catalog from '../../views/Catalog.vue';
import Connexion from '../../views/Connexion.vue';
import Contact from '../../views/Contact.vue';

const routes = [
  { path: '/', name: 'Home', component: Home }, 
  { path: '/catalog', name: 'Catalog', component: Catalog }, 
  { path: '/connexion', name: 'Connexion', component: Connexion},
  { path: '/contact', name: 'Contact', component: Contact},
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

export default router;
