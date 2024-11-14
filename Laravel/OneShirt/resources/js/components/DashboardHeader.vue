<template>
    <header>
        <h1>Tableau de Bord</h1>
        <div class="user-info" v-if="user">
            <span>Bienvenue, {{ user.username }}</span>
            <img class="profile-pic" :src="'data:image/png;base64,' + user.profile_picture" alt="Photo de profil">
        </div>
    </header>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      user: null // Pour stocker les informations de l'utilisateur
    };
  },
  mounted() {
    this.fetchUserInfo();
  },
  methods: {
    async fetchUserInfo() {
      try {
        const response = await axios.get('/api/profile');
        this.user = response.data;
      } catch (error) {
        console.error('Erreur lors de la récupération utilisateur', error);
      }
    },
  }
};
</script>

<style scoped>
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px; /* Ajustement des espacements */
    background-color: #242424; /* Couleur d'arrière-plan pour l'en-tête */
    border-bottom: 1px solid #545454; /* Bordure en bas de l'en-tête */
    height: 60px; /* Hauteur fixe pour l'en-tête */
    margin-top: -30px;
    margin-bottom: 30px;
}

header h1 {
    font-size: 24px;
    margin: 0; /* Éliminer les marges pour éviter les espacements inutiles */
}

.user-info {
    display: flex;
    align-items: center;
}

.user-info span {
    margin-right: 10px;
}

.profile-pic {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}
</style>
