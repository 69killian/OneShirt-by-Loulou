import { createRouter, createWebHistory } from 'vue-router';
import Home from '../../views/Home.vue';
import ArticleContent from '../components/ArticleContent.vue';
import ProductPageComponent from '../components/ProductPageComponent.vue';
import Catalog from '../../views/Catalog.vue';
import Connexion from '../../views/Connexion.vue';
import Contact from '../../views/Contact.vue';
import Blog from '../../views/Blog.vue';
import Cart from '../../views/Cart.vue';
import ProductPage from '../../views/ProductPage.vue';
import Faq from '../../views/Faq.vue';
import Article from '../../views/Article.vue';
import ReviewPage from '../../views/ReviewPage.vue';
import Register from '../../views/Register.vue';
import Profile from '../../views/Profile.vue';
import PaymentConnected from '../../views/PaymentConnected.vue';
import PaymentVisitor from '../../views/PaymentVisitor.vue';
import PaymentError from '../../views/PaymentError.vue';
import PaymentSucceed from '../../views/PaymentSucceed.vue';
import MotdePasseOubli from '../../views/MotdePasseOubli.vue';
import NouveauMotdePasse from '../../views/NouveauMotdePasse.vue';
import Figurines from '../../views/Figurines.vue';
import Vetements from '../../views/Vetements.vue';

const routes = [
  { path: '/', name: 'Home', component: Home }, 
  { path: '/article/:slug', component: ArticleContent },
  { path: '/produit/:id', name: 'product-page', component: ProductPageComponent },
  { path: '/catalogue', name: 'Catalog', component: Catalog }, 
  { path: '/connexion', name: 'Connexion', component: Connexion},
  { path: '/contact', name: 'Contact', component: Contact},
  { path: '/blog', name: 'Blog', component: Blog},
  { path: '/panier', name: 'Cart', component: Cart},
  { path: '/produit', name: 'ProductPage', component: ProductPage},
  { path: '/faq', name: 'Faq', component: Faq},
  { path: '/article', name: 'Article', component: Article},
  { path: '/avis', name: 'ReviewPage', component: ReviewPage},
  { path: '/inscription', name: 'Register', component: Register},
  { path: '/profil', name: 'Profile', component: Profile},
  { path: '/paiementconnecté', name: 'PaymentConnected', component: PaymentConnected},
  { path: '/paiementvisiteur', name: 'PaymentVisitor', component: PaymentVisitor},
  { path: '/erreurpaiement', name: 'PaymentError', component: PaymentError},
  { path: '/paiementreussi', name: 'PaymentSucceed', component: PaymentSucceed},
  { path: '/recuperation', name: 'MotdePasseOubli', component: MotdePasseOubli},
  { path: '/changementdemotdepasse', name: 'NouveauMotdePasse', component: NouveauMotdePasse},
  { path: '/figurines', name: 'Figurines', component: Figurines},
  { path: '/vetements', name: 'Vetements', component: Vetements},
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

export default router;
