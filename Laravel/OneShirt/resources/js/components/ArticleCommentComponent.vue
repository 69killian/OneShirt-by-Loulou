<template>
    <div class="comment-section">
      <h3>Commentaires</h3>
      <div v-if="comments.length" class="comments-list">
        <div v-for="comment in comments" :key="comment.id" class="comment">
          <div class="comment-user">
            <img
              v-if="comment.user && comment.user.profile_picture"
              :src="'data:image/png;base64,' + comment.user.profile_picture"
              alt="Profile Picture"
              class="profile-picture"
            />
            <p><strong>{{ comment.user ? comment.user.username : 'Utilisateur inconnu' }}</strong></p>
          </div>
          <p><strong>Commentaire:</strong> {{ comment.comment }}</p>
          <p><strong>Date:</strong> {{ new Date(comment.created_at).toLocaleString() }}</p>
        </div>
      </div>
      <div v-else>
        <p>Aucun commentaire à afficher.</p>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        comments: [],
        userCache: {}, // Cache des utilisateurs pour éviter les requêtes multiples
      };
    },
    props: {
      articleSlug: {
        type: String,
        required: true,
      },
    },
    methods: {
      async fetchComments() {
        if (!this.articleSlug) {
          console.error("Le slug de l'article est manquant.");
          return;
        }
        try {
          const response = await axios.get(`/api/article/${this.articleSlug}/comments`);
          this.comments = response.data;
  
          // Pour chaque commentaire, récupère l'utilisateur associé
          for (const comment of this.comments) {
            if (!this.userCache[comment.user_id]) {
              await this.fetchUserById(comment.user_id, comment);
            } else {
              // Si l'utilisateur est déjà en cache, on l'utilise
              comment.user = this.userCache[comment.user_id];
            }
          }
        } catch (error) {
          console.error('Erreur lors de la récupération des commentaires:', error);
        }
      },
  
      // Méthode pour récupérer les informations utilisateur par ID
      async fetchUserById(userId, comment) {
        try {
          const response = await axios.get(`/api/users/${userId}`);
          const userData = response.data;
  
          this.userCache[userId] = userData;

          comment.user = userData;
        } catch (error) {
          console.error(`Erreur lors de la récupération de l'utilisateur ${userId}:`, error);
        }
      },
    },
    mounted() {
      this.fetchComments();
    },
  };
  </script>
  
  <style scoped>
  .comment-section {
    display: flex;
    flex-direction: column;
    width: 100%;
    max-width: 500px;
    margin: 0 auto;
    margin-bottom: 100px;
  }
  
  .comments-list {
    margin-top: 20px;
  }
  
  .comment {
    border-bottom: 1px solid #ccc;
    padding: 10px 0;
  }
  
  .comment-user {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  
  .profile-picture {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
  }
  </style>
  