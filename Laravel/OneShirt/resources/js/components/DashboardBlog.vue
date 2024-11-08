<template>
  <section id="Blog" class="blog">
    <h2>Gestion des Articles de Blog</h2>
    
    <!-- Bouton pour afficher le formulaire de création -->
    <button @click="showCreateForm = !showCreateForm">
      {{ showCreateForm ? 'Annuler' : 'Créer un Article' }}
    </button>
    
    <!-- Formulaire de création d'article -->
    <div v-if="showCreateForm" class="create-article-form">
      <h3>Créer un Nouvel Article</h3>
      <form @submit.prevent="createArticle">
        <label for="title">Titre</label>
        <input type="text" v-model="newArticle.title" required placeholder="Titre de l'article"/>

        <label for="slug">Slug</label>
        <input type="text" v-model="newArticle.slug" required placeholder="Slug de l'article (même que le titre)"/>

        <label for="content">Contenu</label>
        <textarea v-model="newArticle.content" required placeholder="Contenu"></textarea>

        <label for="image">Image</label>
        <input type="file" @change="handleImageUpload" required />

        <label for="author_id">Auteur</label>
        <select v-model="newArticle.author_id" required>
          <option v-for="user in users" :key="user.id" :value="user.id">
            {{ user.username }}
          </option>
        </select>

        <button type="submit">Soumettre</button>
      </form>
    </div>

    <!-- Formulaire de modification d'article -->
    <div v-if="showEditForm" class="edit-article-form">
      <h3>Modifier l'Article</h3>
      <form @submit.prevent="updateArticle">
        <label for="title">Titre</label>
        <input type="text" v-model="currentArticle.title" required />

        <label for="slug">Slug</label>
        <input type="text" v-model="currentArticle.slug" required />

        <label for="content">Contenu</label>
        <textarea v-model="currentArticle.content" required></textarea>

        <label for="image">Image</label>
        <input type="file" @change="handleImageUpload" />

        <label for="author_id">Auteur</label>
        <select v-model="currentArticle.author_id" required>
          <option v-for="user in users" :key="user.id" :value="user.id">
            {{ user.username }}
          </option>
        </select>

        <button type="submit">Valider les modifications</button>
      </form>
    </div>
    
    <!-- Table des articles -->
    <table>
      <thead>
        <tr>
          <th>Titre</th>
          <th>Image</th>
          <th>Slug</th>
          <th>Contenu</th>
          <th>Auteur</th>
          <th>Photo de profil</th>
          <th>Date de création</th>
          <th>Actions disponibles</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="article in articles" :key="article.id">
          <td>{{ article.title }}</td>
          <td><img :src="'data:image/png;base64,' + article.image" alt="blog image" width="100"></td>
          <td>{{ article.slug }}</td>
          <td>{{ article.content.slice(0, 50) }}...</td>
          <td>{{ getUserById(article.author_id).username }}</td>
          <td><img class="profile_pic" :src="'data:image/png;base64,' + getUserById(article.author_id).profile_picture" alt="profile picture" width="50"></td>
          <td>{{ article.created_at.substr(0, 10) }}</td>
          <td>
            <button @click="openEditForm(article)">Modifier</button>
            <button @click="deleteArticle(article.id)">Supprimer</button>
          </td>
        </tr>
      </tbody>
    </table>
  </section>
</template>


<script>
import axios from "axios";

export default {
  data() {
    return {
      articles: [],
      users: [],
      showCreateForm: false,
      showEditForm: false, // Nouvelle variable pour contrôler l'affichage du formulaire de modification
      newArticle: {
        title: '',
        slug: '',
        content: '',
        image: '',
        author_id: null
      },
      currentArticle: {
        id: null,
        title: '',
        slug: '',
        content: '',
        image: '',
        author_id: null
      }
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
        this.assignAuthorsToArticles();
      } catch (error) {
        console.error("Erreur lors de la récupération des articles : ", error);
      }
    },
    async fetchUsers() {
      try {
        const response = await axios.get('/api/users');
        this.users = response.data;
      } catch (error) {
        console.error("Erreur lors de la récupération des utilisateurs : ", error);
      }
    },
    assignAuthorsToArticles() {
      this.articles.forEach((article) => {
        const author = this.users.find(user => user.id === article.author_id);
        article.author = author ? author : null;
      });
    },
    handleImageUpload(event) {
      const file = event.target.files[0];
      const reader = new FileReader();
      reader.onload = () => {
        this.newArticle.image = reader.result.split(',')[1]; // Convertir en Base64 et enlever le préfixe
      };
      reader.readAsDataURL(file);
    },
    async createArticle() {
      try {
        const response = await axios.post('/api/blog-articles/create', this.newArticle);
        this.articles.push(response.data);
        this.showCreateForm = false; // Ferme le formulaire après la création
        console.log("Article créé avec succès");
      } catch (error) {
        console.error("Erreur lors de la création de l'article :", error);
      }
    },
    openEditForm(article) {
      // Remplir l'article à modifier dans le formulaire
      this.currentArticle = { ...article };
      this.showEditForm = true; // Afficher le formulaire de modification
    },
    async updateArticle() {
      try {
        const response = await axios.put(`/api/blog-articles/update/${this.currentArticle.id}`, this.currentArticle);
        
        // Mettre à jour l'article dans le tableau
        const index = this.articles.findIndex(article => article.id === this.currentArticle.id);
        if (index !== -1) {
          this.articles[index] = response.data;
        }

        this.showEditForm = false; // Fermer le formulaire après l'édition
        console.log("Article mis à jour avec succès");
      } catch (error) {
        console.error("Erreur lors de la mise à jour de l'article :", error);
      }
    },
    async deleteArticle(id) {
      try {
        await axios.delete(`/api/blog-articles/delete/${id}`);
        this.articles = this.articles.filter(article => article.id !== id);
        console.log("Article supprimé avec succès");
      } catch (error) {
        console.error("Erreur lors de la suppression de l'article :", error);
      }
    },
    getUserById(id) {
      return this.users.find(user => user.id === id);
    }
  }
};
</script>




    
    <style>
    .blog {
    margin-top: 20px;
  }
  
  .blog h2 {
    margin-bottom: 10px;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
    border: none; /* Suppression de la bordure */
    border-radius: 8px; /* Arrondi des coins */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Ajout d'une ombre */
    overflow: hidden; /* Pour éviter que les coins arrondis soient coupés */
  }
  
  th, td {
    padding: 10px;
    text-align: left;
    background-color: #121212; /* Couleur de fond pour mieux voir les coins arrondis */
  }

  td {
    border-top: #545454 solid 1px;
  }
  
  th {
    font-weight: bold;
    background-color: #242424;
  }

  button {
    padding: 5px 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #0056b3;
  }

  .profile_pic {
    height: 50px;
    width: 50px;
    border-radius: 50px;
    object-fit: cover;
  }
    </style>