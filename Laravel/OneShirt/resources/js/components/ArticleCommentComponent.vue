<template>
    <div class="comment-section">
      <p>---------------------------------------------------------------------------------------</p>
      <h3>Commentaires :</h3>
  
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
      
      <!-- Formulaire de commentaire -->
      <label for="comment">Laissez un commentaire :</label>
      <textarea 
        id="comment" 
        v-model="comment" 
        placeholder="Entrez votre commentaire ici..." 
        rows="4"
        class="comment-input">
      </textarea>
      <button @click="submitComment" class="submit-button">Envoyer</button>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        comments: [],
        comment: '', 
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
  
          // Pour chaque commentaire, vérifiez si l'utilisateur est présent
          for (const comment of this.comments) {
            if (comment.user_id) {
              comment.user = await this.fetchUserById(comment.user_id);
            } else {
              comment.user = { username: 'Utilisateur inconnu', profile_picture: null };
            }
          }
        } catch (error) {
          console.error('Erreur lors de la récupération des commentaires:', error);
        }
      },
  
      async fetchUserById(userId) {
        try {
          const response = await axios.get(`/api/users/${userId}`);
          return response.data;
        } catch (error) {
          console.error(`Erreur lors de la récupération de l'utilisateur ${userId}:`, error);
          return null;
        }
      },
  
      async submitComment() {
        try {
            const response = await axios.post(`/api/article/${this.articleSlug}/comments`, {
            comment: this.comment,
            });
            this.comments.push(response.data);
            this.comment = '';
            window.location.reload();
        } catch (error) {
            console.error('Erreur lors de l\'envoi du commentaire:', error);
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
  
  .comment-input {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
  }
  
  .submit-button {
    background-color: #000;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    box-sizing: border-box;
  }
  
  .submit-button:hover {
    background-color: #333;
  }
  
  p {
    margin-top: 15px;
  }

  label {
    margin-top: 10px;
  }
  </style>
  