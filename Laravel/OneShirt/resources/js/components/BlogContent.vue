<template>
  <div>
    <!-- Titre de la section Blog -->
    <div class="title-blogs">
      <h1>Blog</h1>
    </div>

    <!-- Bouton pour créer un article -->
    <div class="create-article-btn">
      <button @click="showCreateForm = !showCreateForm">
        {{ showCreateForm ? 'Annuler' : 'Créer un article' }}
      </button>
    </div>

    <!-- Formulaire pour créer un article -->
    <div v-if="showCreateForm" class="create-article-form">
      <h2>Créer un nouvel article</h2>
      <form @submit.prevent="createArticle">
        <div class="form-group">
          <label for="title">Titre :</label>
          <input type="text" id="title" v-model="newArticle.title" required />
        </div>
        <div class="form-group">
          <label for="slug">Slug :</label>
          <input type="text" id="slug" v-model="newArticle.slug" required />
        </div>
        <div class="form-group">
          <label for="content">Contenu :</label>
          <textarea id="content" v-model="newArticle.content" required></textarea>
        </div>
        <div class="form-group">
          <label for="image">Image :</label>
          <input type="file" id="image" @change="handleImageUpload" />
        </div>
        <button type="submit">Créer l'article</button>
      </form>
    </div>

    <!-- Affichage des articles -->
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
      showCreateForm: false, // Afficher ou masquer le formulaire
      newArticle: {
        title: '',
        slug: '',
        content: '',
        image: null, // Image du nouvel article
        author_id: null, // ID de l'auteur connecté
      },
    };
  },
  mounted() {
    this.fetchArticles();
    this.fetchUsers();
    this.fetchCurrentUser(); // Récupérer l'utilisateur connecté
  },
  methods: {
    // Récupérer tous les articles du blog
    async fetchArticles() {
      try {
        const response = await axios.get('/api/blog-articles');
        this.articles = response.data;
      } catch (error) {
        console.error('Erreur lors de la récupération des articles :', error);
      }
    },
    // Récupérer tous les utilisateurs
    async fetchUsers() {
      try {
        const response = await axios.get('/api/users');
        this.users = response.data;
      } catch (error) {
        console.error('Erreur lors de la récupération des utilisateurs :', error);
      }
    },
    // Récupérer l'utilisateur actuellement connecté
    async fetchCurrentUser() {
      try {
        const response = await axios.get('/api/auth/check'); // Cette route renvoie l'utilisateur connecté
        if (response.data.user) {
          this.newArticle.author_id = response.data.user.id; // Associer l'utilisateur connecté à l'article
        }
      } catch (error) {
        console.error('Erreur lors de la récupération de l\'utilisateur connecté :', error);
      }
    },
    // Trouver un utilisateur par son ID
    getUserById(id) {
      return this.users.find(user => user.id === id);
    },
    // Gérer l'upload d'image
    handleImageUpload(event) {
      const file = event.target.files[0]; // Get the first selected file
      if (file) {
        this.newArticle.image = file; // On garde le fichier pour l'envoyer avec l'article
      }
    },
    // Créer un article
    async createArticle() {
      if (!this.newArticle.image) {
        alert('Veuillez ajouter une image pour l\'article');
        return;
      }

      try {
        const formData = new FormData();
        // Ajout des champs requis au FormData
        formData.append('title', this.newArticle.title);
        formData.append('slug', this.newArticle.slug);
        formData.append('content', this.newArticle.content);
        formData.append('author_id', this.newArticle.author_id); // Associer l'utilisateur

        // Si une image est présente, on l'ajoute au FormData
        formData.append('image', this.newArticle.image);

        const response = await axios.post('/api/blog-articles/create', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        });

        this.articles.push(response.data); // Ajouter l'article créé à la liste
        this.showCreateForm = false; // Fermer le formulaire après la création
        this.newArticle = { title: '', slug: '', content: '', image: null }; // Réinitialiser le formulaire
        console.log("Article créé avec succès");
        location.reload();
      } catch (error) {
        console.error("Erreur lors de la création de l'article :", error);
        location.reload();
      }
    },
  },
};
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


/* Styles du bouton Créer un article */
.create-article-btn {
  text-align: center;
  margin: 20px;
}

.create-article-btn button {
  background-color: #007bff;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.create-article-btn button:hover {
  background-color: #0056b3;
}

/* Styles du formulaire */
.create-article-form {
  background-color: #ffffff;
  padding: 20px;
  border-radius: 10px;
  margin: 20px;
}

.create-article-form .form-group {
  margin-bottom: 15px;
}

.create-article-form label {
  color: white;
  display: block;
  margin-bottom: 5px;
}

.create-article-form input,
.create-article-form textarea {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
  background-color: #ffffff;
  color: black;
}

.create-article-form button {
  background-color: #28a745;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.create-article-form button:hover {
  background-color: #218838;
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
