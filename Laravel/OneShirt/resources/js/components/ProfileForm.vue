<template>
  <div class="profile-container">
    <h1>Mon Profil</h1>

    <!-- Bouton pour éditer le profil -->
    <button v-if="!isEditing" @click="editProfile" class="edit-button">Éditer le Profil</button>

    <!-- Vue du Profil -->
    <div v-if="!isEditing" class="profile-content" id="profileView">
      <!-- Photo de Profil -->
      <div class="profile-photo">
        <img v-if="profile.profile_picture" :src="profile.profile_picture" alt="Photo de Profil" />
      </div>
      <!-- Informations Utilisateur -->
      <div class="profile-details">
        <div class="profile-column">
          <h2>Informations Personnelles</h2>
          <div class="profile-item">
            <label for="firstName">Prénom :</label>
            <p id="firstName">{{ profile.first_name }}</p>
          </div>
          <div class="profile-item">
            <label for="lastName">Nom :</label>
            <p id="lastName">{{ profile.last_name }}</p>
          </div>
          <div class="profile-item">
            <label for="username">Nom d'utilisateur :</label>
            <p id="username">{{ profile.username }}</p>
          </div>
          <div class="profile-item">
            <label for="address">Adresse :</label>
            <p id="address">{{ profile.address }}</p>
          </div>
        </div>
        <div class="profile-column">
          <h2>Informations Complémentaires</h2>
          <div class="profile-item">
            <label for="postalAddress">Adresse Postale :</label>
            <p id="postalAddress">{{ profile.postal_address }}</p>
          </div>
          <div class="profile-item">
            <label for="birthdate">Date de Naissance :</label>
            <p id="birthdate">{{ profile.date_of_birth }}</p>
          </div>
          <div class="profile-item">
            <label for="email">Email :</label>
            <p id="email">{{ profile.email }}</p>
          </div>
          <div class="profile-item">
            <label for="phone">Numéro de Téléphone :</label>
            <p id="phone">{{ profile.phone_number }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Formulaire d'édition -->
    <div v-if="isEditing" class="edit-form">
      <h2>Modifier le Profil</h2>
      <form @submit.prevent="saveChanges">
        <div class="form-group">
          <label for="firstName">Prénom :</label>
          <input v-model="editableProfile.first_name" type="text" id="firstName" required />
        </div>
        <div class="form-group">
          <label for="lastName">Nom :</label>
          <input v-model="editableProfile.last_name" type="text" id="lastName" required />
        </div>
        <div class="form-group">
          <label for="username">Nom d'utilisateur :</label>
          <input v-model="editableProfile.username" type="text" id="username" required />
        </div>
        <div class="form-group">
          <label for="email">Email :</label>
          <input v-model="editableProfile.email" type="email" id="email" required />
        </div>
        <div class="form-group">
          <label for="address">Adresse :</label>
          <input v-model="editableProfile.address" type="text" id="address" />
        </div>
        <div class="form-group">
          <label for="postalAddress">Adresse Postale :</label>
          <input v-model="editableProfile.postal_address" type="text" id="postalAddress" />
        </div>
        <div class="form-group">
          <label for="phone">Numéro de Téléphone :</label>
          <input v-model="editableProfile.phone_number" type="text" id="phone" />
        </div>
        <div class="form-group">
          <label for="birthdate">Date de Naissance :</label>
          <input v-model="editableProfile.date_of_birth" type="date" id="birthdate" />
        </div>
        <div class="form-group">
          <label for="profile_picture">Photo de Profil :</label>
          <input type="file" @change="onFileChange" id="profile_picture" />
        </div>
        <button type="submit" id="saveChangesButton">Sauvegarder</button>
        <button type="button" id="cancelEditButton" @click="cancelEdit">Annuler</button>
      </form>
    </div>
  </div>
</template>


<script>
import axios from 'axios';

export default {
  data() {
    return {
      isEditing: false,
      profile: {}, // Informations du profil utilisateur
      editableProfile: {}
    };
  },
  mounted() {
    // Appel pour récupérer les données du profil utilisateur connecté
    this.fetchProfileData();
  },
  methods: {
  async fetchProfileData() {
    try {
      const response = await axios.get('/api/profile');
      this.profile = response.data;
      this.editableProfile = { ...this.profile }; // Cloner les données pour édition
    } catch (error) {
      console.error('Erreur lors de la récupération du profil', error);
    }
  },
  editProfile() {
    this.isEditing = true;
  },
  cancelEdit() {
    this.isEditing = false;
    this.editableProfile = { ...this.profile }; // Restauration des données originales
  },
  async saveChanges() {
    try {
      const formData = new FormData();
      formData.append('first_name', this.editableProfile.first_name);
      formData.append('last_name', this.editableProfile.last_name);
      formData.append('username', this.editableProfile.username);
      formData.append('email', this.editableProfile.email);
      formData.append('address', this.editableProfile.address);
      formData.append('postal_address', this.editableProfile.postal_address);
      formData.append('phone_number', this.editableProfile.phone_number);
      formData.append('date_of_birth', this.editableProfile.date_of_birth);

      // Si une nouvelle image est sélectionnée
      if (this.editableProfile.profile_picture) {
        formData.append('profile_picture', this.editableProfile.profile_picture);
      }

      const response = await axios.post('/api/update-profile', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });

      this.profile = response.data.user;
      this.isEditing = false;
    } catch (error) {
      console.error('Erreur lors de la mise à jour du profil', error);
    }
  },
  onFileChange(event) {
    const file = event.target.files[0];
    this.editableProfile.profile_picture = file;
}

  }
};
</script>


  
  <style scoped>

body {
        background-color: rgb(30, 30, 30);
        padding-top: 70px;
    }
  /* Styles du profil */
  .profile-container {
    width: 80%;
    max-width: 900px;
    margin: 40px auto;
    background-color: #1a1a1a; /* Fond sombre */
    color: #e0e0e0; /* Couleur du texte */
    padding: 100px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  }
  
  h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #ffffff; /* Couleur du titre */
    margin-top: 0px;
  }
  
  .edit-button {
    display: block;
    width: 200px;
    margin: 0 auto 20px;
    padding: 10px;
    font-size: 1em;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .edit-button:hover {
    background-color: #0056b3;
  }
  
  .profile-content {
    display: flex;
    gap: 20px;
  }
  
  .profile-photo {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .profile-photo img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #ddd;
  }
  
  .profile-details {
    flex: 2;
    display: flex;
    gap: 20px;
  }
  
  .profile-column {
    flex: 1;
  }
  
  .profile-item {
    margin-bottom: 15px;
  }
  
  .profile-item label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
    color: #ffffff; /* Couleur des labels */
  }
  
  .profile-item p {
    margin: 0;
    font-size: 1em;
    color: #b0bec5; /* Couleur des détails */
  }
  
  /* Styles du formulaire d'édition */
  .edit-form {
    background-color: #1e1e1e; /* Fond du formulaire d'édition */
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  }

  .edit-form form {
    background-color: #1e1e1e;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  .form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #ffffff; /* Couleur des labels */
  }
  
  .form-group input {
    width: 100%;
    padding: 8px;
    border: 1px solid #444; /* Bordure plus sombre */
    border-radius: 5px;
    background-color: #333; /* Fond des champs de formulaire */
    color: #e0e0e0; /* Couleur du texte */
  }
  
  #saveChangesButton, #cancelEditButton {
    padding: 10px 15px;
    margin-right: 10px;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  #cancelEditButton {
    background-color: #ff0000;
  }

  #cancelEditButton:hover {
    background-color: #b30000;
  }

  #saveChangesButton {
    background-color: #007bff;
  }
  
  #saveChangesButton:hover {
    background-color: #0056b3;
  }
  </style>
  