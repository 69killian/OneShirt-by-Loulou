<template>
  <section id="Blog" class="blog">
    <h2>Gestion des Articles de Blog</h2>
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
          <td>{{ article.content.slice(0, 50) }}...</td> <!-- Affichage d'une partie du contenu -->
          <td>{{ getUserById(article.author_id).username }}</td> <!-- Affichage du nom de l'auteur -->
          <td><img class="profile_pic" :src="'data:image/png;base64,' + getUserById(article.author_id).profile_picture" alt="profile picture" width="50"></td> <!-- Affichage de la photo de profil de l'auteur -->
          <td>{{ article.created_at.substr(0, 10) }}</td>
          <td>
            <button @click="createArticle(article.id)">Créer</button>
            <button @click="editArticle(article.id)">Modifier</button>
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
      articles: [], // Liste pour stocker les articles récupérés
      users: [], // Liste pour stocker les utilisateurs récupérés
    };
  },
  mounted() {
    this.fetchArticles(); // Appel à la fonction pour récupérer les articles au montage du composant
    this.fetchUsers(); // Appel à la fonction pour récupérer les utilisateurs
  },
  methods: {
    // Récupérer les articles de blog via l'API
    async fetchArticles() {
      try {
        const response = await axios.get('/api/blog-articles');
        this.articles = response.data; // Stocker les articles dans la variable `articles`
        this.assignAuthorsToArticles(); // Assigner les auteurs après avoir récupéré les articles
      } catch (error) {
        console.error("Erreur lors de la récupération des articles : ", error);
      }
    },

    // Récupérer tous les utilisateurs via l'API
    async fetchUsers() {
      try {
        const response = await axios.get('/api/users');
        this.users = response.data; // Stocker les utilisateurs dans la variable `users`
      } catch (error) {
        console.error("Erreur lors de la récupération des utilisateurs : ", error);
      }
    },

    // Assigner les auteurs aux articles après avoir récupéré les articles et les utilisateurs
    assignAuthorsToArticles() {
      this.articles.forEach((article) => {
        const author = this.users.find(user => user.id === article.author_id); // Chercher l'utilisateur par ID
        article.author = author ? author : null; // Si l'utilisateur est trouvé, on l'assigne à l'article
      });
    },

    // Méthodes pour les actions des boutons (à implémenter)
    createArticle(id) {
      console.log("Créer l'article avec l'ID:", id);
    },
    editArticle(id) {
      console.log("Modifier l'article avec l'ID:", id);
    },
    deleteArticle(id) {
      console.log("Supprimer l'article avec l'ID:", id);
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
    </style>