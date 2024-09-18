import { createRouter, createWebHistory } from 'vue-router';
import Home from '../../views/Home.vue';
import Catalog from '../../views/Catalog.vue';
import Connexion from '../../views/Connexion.vue';
import Contact from '../../views/Contact.vue';
import Blog from '../../views/Blog.vue';
import Cart from '../../views/Cart.vue';
import ProductPage from '../../views/ProductPage.vue';

const routes = [
  { path: '/', name: 'Home', component: Home }, 
  { path: '/catalogue', name: 'Catalog', component: Catalog }, 
  { path: '/connexion', name: 'Connexion', component: Connexion},
  { path: '/contact', name: 'Contact', component: Contact},
  { path: '/blog', name: 'Blog', component: Blog},
  { path: '/panier', name: 'Cart', component: Cart},
  { path: '/produit', name: 'ProductPage', component: ProductPage},
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

export default router;
