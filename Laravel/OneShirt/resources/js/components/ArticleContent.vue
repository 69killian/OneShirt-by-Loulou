<template>
  <Header/>
  <div>


    <div v-if="!article">Chargement...</div>

    <!-- Main Picture Blog -->
    <div v-if="article">
  <div class="main-img-blog">
    <img :src="'data:image/png;base64,' + article.image" alt="main-image" />
  </div>
  <div class="outer-container">
    <div class="article-title">
      <h1>{{ article.title || 'Titre non disponible' }}</h1>
    </div>
    <div class="content-section">
      <div class="article-content">
        <p>{{ article.content || 'Contenu non disponible' }}</p>
      </div>
    </div>
  </div>
</div>

  <ArticleCommentComponent/>

    

        <!-- Blog Articles -->
    <section class="Blogs">
      <div class="blog-with-title">
        <div class="titre-section-blog">
          Articles de Blog
        </div>
        <div class="subheading-section-blog">
          Vous allez aimer
        </div>

        <!-- Itération sur les autres articles -->
              <router-link 
        v-for="(blog, index) in otherArticles.slice(0, 3)" 
        :key="index" 
        :to="`/article/${blog.slug}`" 
        class="blog-card animate"
        @click.native.prevent="navigateToArticle(blog.slug)" 
      >
        <img class="img-blog" :src="'data:image/png;base64,' + blog.image" alt="" />
        <p class="blog-title-card">{{ blog.title }}</p>
        <p class="blog-description">{{ blog.content.substring(0, 100) + '...' }}</p>
      </router-link>
      </div>
    </section>
  </div>
  <Newsletter/>
  <Footer/>
</template>

<script>
import axios from 'axios';
import Header from '@/components/Header.vue';
import Newsletter from './Newsletter.vue';
import Footer from '@/components/Footer.vue';
import ArticleCommentComponent from './ArticleCommentComponent.vue';

export default {
  components: {
    Footer,
    ArticleCommentComponent,
    Newsletter,
    Header,
  },
  name: 'ArticleContent',
  data() {
    return {
      article: null,
      otherArticles: [], // Tableau pour stocker les autres articles
    };
  },
  mounted() {
    this.fetchArticle();
    this.fetchOtherArticles(); // Appel de la méthode pour récupérer les autres articles
  },
  methods: {
    async fetchArticle() {
      const slug = this.$route.params.slug; // Récupère le slug de l'article depuis la route
      console.log('Article Slug:', slug); // Affiche le slug pour vérifier
      try {
        const response = await axios.get(`/api/blog-articles/${slug}`);
        console.log('Données de l\'article:', response.data); // Vérifie les données reçues
        this.article = response.data; // Stocke l'article récupéré dans la variable 'article'
        console.log('Article récupéré:', this.article); // Vérifie l'article
      } catch (error) {
        console.error('Erreur lors de la récupération de l\'article :', error);
        this.article = null; 
      }
    },
    async fetchOtherArticles() {
      try {
        const response = await axios.get('/api/blog-articles'); // Récupère tous les articles de blog
        this.otherArticles = response.data.filter(a => a.slug !== this.article.slug); // Filtre l'article courant
      } catch (error) {
        console.error('Erreur lors de la récupération des autres articles :', error);
        window.location.reload()
      }
    },
    navigateToArticle(slug) {
    this.$router.push(`/article/${slug}`); // Navigation vers l'article
    setTimeout(() => {
      window.location.reload(); // Recharge la page après un délai
    }, 100); // Délai pour permettre à Vue de terminer la navigation
  }
  },
}
</script>



<style scoped>
/* Title Blog */
.title-blog {
justify-content: center;
height: auto; 
font-size: 40px;
margin: 0; /* Supprime la marge externe */
background-color: #d2d2d2;
padding: 120px 0px;
text-align: center; /* Centre le texte pour les petits écrans */
}

.article-title h1 {
font-size: 2em;
color: #333;
text-align: center
}

.article-content {
    font-size: 1.3rem; 
    width: 900px;      
    line-height: 1.6;  
}


/* Pour les écrans de taille moyenne */
@media (max-width: 1024px) {
.title-blog {
  font-size: 30px;
  padding: 120px 0px; /* Ajuste le padding pour les écrans moyens */
}
}

/* Pour les écrans de taille petite */
@media (max-width: 768px) {
.title-blog {
  font-size: 24px;
  padding: 150px 0px; /* Ajuste le padding pour les petits écrans */
}
}

/* Pour les très petits écrans */
@media (max-width: 480px) {
.title-blog {
  font-size: 20px;
  padding: 100px 0px; /* Ajuste le padding pour les très petits écrans */
}
}

/* Conteneur de l'image du blog */
.main-img-blog {
display: flex;
align-items: center;
justify-content: center;
margin: 0; /* Supprime la marge externe */
padding: 0; /* Supprime le padding interne */
}

.main-img-blog img {
height: 450px;
width: 100%; /* Ajuste la largeur de l'image */
object-fit: cover; /* Ajuste l'image pour remplir le conteneur sans déformation */
}

/* Section de contenu */
.content-section {
display: flex;
align-items: center; /* Aligne l'image et le texte en haut */
justify-content: center;
flex-direction: column;
padding: 110px 500px 150px 500px;
gap: 30px; /* Espace entre l'image et le texte */
}

.image-container {
height: 300px; /* Hauteur fixe pour l'image */
}

.image-container img {
width: 700px;
height: 450px;
object-fit: cover; /* Ajuste l'image pour remplir le conteneur sans déformation */
border-radius: 10px; /* Coins arrondis pour l'image */
}

.text-content {
flex: 1; /* Prend le reste de l'espace disponible */
margin-top: 120px;
display: flex;
flex-direction: column;
justify-content: flex-start;
}

.text-content .header {
font-size: 2.5em;
margin-bottom: 10px;
}

.text-content .subheading {
font-size: 1.5em;
color: #666;
margin-bottom: 20px;
}

.text-content .text {
font-size: 1em;
height: 300px;
width: 700px;
color: #333;
line-height: 1.6;
}

/* Media Queries pour rendre responsive */
@media (max-width: 1200px) {
.content-section {
  padding: 60px 30px;
}
}

@media (max-width: 992px) {
.image-container {
  flex: 0 0 250px; /* Ajuster la taille de l'image */
  height: auto; /* Hauteur automatique pour l'image */
}

.text-content .header {
  font-size: 2.2em;
}

.text-content .subheading {
  font-size: 1.4em;
}

.text-content .text {
  font-size: 0.9em;
}
}

@media (max-width: 768px) {
.content-section {
  flex-direction: column;
  align-items: center;
  padding: 60px 20px;
}

.image-container {
  width: 100%;
  max-width: 100%;
}

.text-content {
  margin-top: 30px;
  text-align: center;
}

.text-content .header {
  font-size: 2em;
}

.text-content .subheading {
  font-size: 1.2em;
}

.text-content .text {
  font-size: 0.9em;
  width: auto; /* Permet au texte de s'adapter à la largeur disponible */
  padding: 0 10px; /* Ajouter un peu de padding pour les petits écrans */
}
}

/* Section des articles de blog */
.Blogs {
background-color: #f7f7f7;
padding: 40px 20px;
}

.blog-with-title {
display: flex;
flex-direction: column;
align-items: center;
}

.titre-section-blog {
font-size: 2.2em;
margin-bottom: 10px;
}

.subheading-section-blog {
font-size: 1.5em;
color: #666;
}

.blog-card {
background: #fff;
border-radius: 10px;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
overflow: hidden;
margin: 20px;
width: 300px;
transition: transform 0.3s ease-in-out;
}

.blog-card:hover {
transform: scale(1.05);
}

.img-blog {
width: 100%;
height: 200px;
object-fit: cover;
}

.blog-title-card {
font-size: 1.2em;
margin: 10px;
}

.blog-description {
font-size: 1em;
margin: 10px;
}

/* Section Like/Dislike Blog */
.like-blog {
display: flex;
flex-direction: column;
align-items: center;
padding: 20px;
}

.like-blog h1 {
font-size: 1.8em;
margin-bottom: 20px;
}

.like-blog button {
background: none;
border: 1px solid #ccc;
border-radius: 5px;
padding: 10px 20px;
margin: 5px;
cursor: pointer;
font-size: 1em;
}

.like-blog button:hover {
background-color: #f0f0f0;
}

.like-blog p {
font-size: 1.2em;
margin: 10px;
}

.like-blog span {
font-weight: bold;
}
</style>
