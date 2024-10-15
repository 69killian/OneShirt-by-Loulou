<template>
  <div>
  <div class="title-container">
    <div class="titre-section-blog">Nos Articles</div>
    <div class="subheading-section-blog">Vous allez aimer</div>
  </div>
    <section class="Blogs">
      <router-link
        v-for="article in articles.slice(0, 3)"
        :key="article.id"
        to="/article"
        class="blog-card animate"
      >
        <img
          class="img-blog"
          :src="'data:image/png;base64,' + article.image"
          alt="Blog Image"
        />
        <p class="blog-title-card">{{ article.title }}</p>
        <p class="blog-description">{{ article.content.substring(0, 100) + '...' }}</p>

        <!-- Affichage des informations de l'utilisateur correspondant -->
        <section class="user-info" v-if="getUserById(article.author_id)">
          <img
            class="avatar"
            :src="'data:image/png;base64,' + getUserById(article.author_id).profile_picture"
            alt="User Image"
          />
          <p style="color: white;">{{ getUserById(article.author_id).username }}</p>
        </section>
      </router-link>
    </section>

    <div class="see-more-button">
      <router-link to="/avis" style="color: white;"><button>Ton avis compte !</button></router-link>
    </div>
    
  </div>
</template>

<script>
export default {
  name: 'BlogContent',
  data() {
    return {
      articles: [],
      users: [],
    };
  },
  mounted() {
    this.fetchArticles();
    this.fetchUsers();
  },
  methods: {
    async fetchArticles() {
      try {
        const response = await axios.get('/api/blog-articles');
        this.articles = response.data;
      } catch (error) {
        console.error('Erreur lors de la récupération des articles :', error);
      }
    },
    async fetchUsers() {
      try {
        const response = await axios.get('/api/users');
        this.users = response.data;
      } catch (error) {
        console.error('Erreur lors de la récupération des utilisateurs :', error);
      }
    },
    getUserById(id) {
      return this.users.find(user => user.id === id);
    }
  }
}
</script>




<style scoped>

.title-container {
  display: flex;
  flex-direction: column;
  text-align: center;
  align-items: center;
  justify-content: center;
  background-color: #3C98EF;
  padding-top: 30px;
}

.titre-section-blog {
  font-size: 50px;
}

.subheading-section-blog {
  font-size: 20px;
}

.see-more-button {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #3C98EF;
  padding-bottom: 70px;
}

.see-more-button button {
  background-color: rgb(48, 48, 48);
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 7px;
  font-size: 16px;
  font-weight: 500;
  cursor: pointer;
}

.avatar {
height: 45px;
width: 45px;
border-radius: 100px;
object-fit: cover;
}

.user-info {
  display: flex;
  gap: 20px;
}


/* Pour les écrans de taille moyenne */
@media (max-width: 1024px) {
  .title-blogs {
    font-size: 30px;
    padding: 200px;
  }
}

/* Pour les écrans de petite taille */
@media (max-width: 768px) {
  .title-blogs {
    font-size: 24px;
    padding: 150px;
  }
}

/* Pour les très petits écrans */
@media (max-width: 480px) {
  .title-blogs {
    font-size: 20px;
    padding: 100px;
  }
}

.blog-subtitle-card {
font-weight: 400;
font-size: 18px;
color: #ffffff; 
margin-top: 5px;
}


/* Styles par défaut des cartes de blog */
.blog-card {
  border: 1px solid #2a67a1;
  padding: 20px;
  border-radius: 10px;
  box-sizing: border-box;
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.5s ease, transform 0.5s ease, box-shadow 0.3s ease;
  text-decoration: none; /* Enlève la décoration du lien */
  background-color: #2f77ba;
}

/* Styles pour les cartes de blog avec animation */
.blog-card.animate {
  animation: fadeInUp 0.5s ease-out forwards;
}

/* Délai d'animation pour chaque élément de blog */
.blog-card:nth-child(1) {
  animation-delay: 0.1s;
}
.blog-card:nth-child(2) {
  animation-delay: 0.2s;
}
.blog-card:nth-child(3) {
  animation-delay: 0.3s;
}
.blog-card:nth-child(4) {
  animation-delay: 0.4s;
}
.blog-card:nth-child(5) {
  animation-delay: 0.5s;
}
.blog-card:nth-child(6) {
  animation-delay: 0.6s;
}

/* Styles de la section Blog */
.Blogs {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  padding: 70px 10px;
  background-color: #3C98EF;
}

/* Styles pour les images de blog */
.img-blog {
  height: 170px;
  width: 170px;
  object-fit: cover;
}

/* Styles pour les titres et descriptions */
.blog-title-card {
  font-weight: 500;
  font-size: 25px;
  color: black
}

.blog-description {
  color: rgb(255, 255, 255);
  font-size: 20px;
  font-weight: 300;
}

/* Animation de survol des cartes */
.blog-card:hover {
  transform: scale(1.05); /* Agrandi la carte au survol */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Ajoute une ombre */
    transition: transform 0.5s ease, box-shadow 0.5s ease; /* Transition de 1 seconde */
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
