<template>
    <div class="comment-section">
      <h3>Commentaires</h3>
      <div v-if="comments.length" class="comments-list">
        <div v-for="comment in comments" :key="comment.id" class="comment">
          <p><strong>User ID:</strong> {{ comment.user_id }}</p>
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
        try {
          const response = await axios.get(`/api/article/${this.articleSlug}/comments`);
          this.comments = response.data; // Assurez-vous que `response.data` contient la liste des commentaires
        } catch (error) {
          console.error('Error fetching comments:', error);
        }
      }
    },
    mounted() {
      this.fetchComments(); // Appel de la méthode lors du montage du composant
    }
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
  </style>
  