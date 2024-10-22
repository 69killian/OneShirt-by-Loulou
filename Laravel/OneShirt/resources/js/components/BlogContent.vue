<template>
  <div>
    <div class="title-blogs">
      <h1>Blog</h1>
    </div>

    <section class="Blogs">
      <router-link
      v-for="article in articles"
      :key="article.id"
      :to="`/article/${article.slug}`"
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
.title-blogs {
display: flex;
align-items: center;
justify-content: center;
height: 100%;
font-size: 30px;
margin: 70px 0 0 0;
background-image: url('../../../public/images/eausunnyonepiecefond.jpg'); 
background-size: cover; /* L'image couvre toute la surface */
background-position: center;
padding: 150px;
text-align: center;
color: white;
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
color: #f0f0f0; 
margin-top: 5px;
}


/* Styles par défaut des cartes de blog */
.blog-card {
  border: 1px solid rgb(56, 56, 56);
  padding: 20px;
  border-radius: 10px;
  box-sizing: border-box;
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.5s ease, transform 0.5s ease, box-shadow 0.3s ease;
  text-decoration: none; 
  background-color: rgb(30, 30, 30);
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
  padding: 150px 10px;
  background-color: rgb(25, 25, 25);
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
  color: white;
}

.blog-description {
  color: rgb(103, 103, 103);
  font-size: 20px;
  font-weight: 300;
}

/* Animation de survol des cartes */
.blog-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 4px 8px rgba(152, 152, 152, 0.2);
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
