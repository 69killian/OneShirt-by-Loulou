<template>
    <div class="profile-container">
      <h1>Mon Profil</h1>
  
      <!-- Bouton pour éditer le profil -->
      <button v-if="!isEditing" @click="editProfile" class="edit-button">Éditer le Profil</button>
  
      <!-- Vue du Profil -->
      <div v-if="!isEditing" class="profile-content" id="profileView">
        <!-- Photo de Profil -->
        <div class="profile-photo">
          <img
            :src="'data:image/png;base64,' + profile.profile_picture"
            alt="Photo de Profil"
          />
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
  
      <!-- Formulaire d'Édition du Profil -->
      <div v-if="isEditing" class="edit-form" id="editProfileForm">
        <h2>Modifier le Profil</h2>
        <form @submit.prevent="saveChanges">
          <!-- Photo de Profil -->
          <div class="form-group">
            <label for="profilePhoto">Photo de Profil :</label>
            <input type="file" id="profilePhoto" @change="onFileChange">
          </div>
  
          <!-- Informations Personnelles -->
          <div class="form-group">
            <label for="editFirstName">Prénom :</label>
            <input type="text" v-model="editableProfile.firstName" id="editFirstName">
          </div>
          <div class="form-group">
            <label for="editLastName">Nom :</label>
            <input type="text" v-model="editableProfile.lastName" id="editLastName">
          </div>
          <div class="form-group">
            <label for="editUsername">Nom d'utilisateur :</label>
            <input type="text" v-model="editableProfile.username" id="editUsername">
          </div>
          <div class="form-group">
            <label for="editAddress">Adresse :</label>
            <input type="text" v-model="editableProfile.address" id="editAddress">
          </div>
  
          <!-- Informations Complémentaires -->
          <div class="form-group">
            <label for="editPostalAddress">Adresse Postale :</label>
            <input type="text" v-model="editableProfile.postalAddress" id="editPostalAddress">
          </div>
          <div class="form-group">
            <label for="editBirthdate">Date de Naissance :</label>
            <input type="date" v-model="editableProfile.birthdate" id="editBirthdate">
          </div>
          <div class="form-group">
            <label for="editEmail">Email :</label>
            <input type="email" v-model="editableProfile.email" id="editEmail">
          </div>
          <div class="form-group">
            <label for="editPhone">Numéro de Téléphone :</label>
            <input type="tel" v-model="editableProfile.phone" id="editPhone">
          </div>
  
          <!-- Boutons pour sauvegarder ou annuler -->
          <button type="submit" id="saveChangesButton">Sauvegarder les Modifications</button>
          <button type="button" id="cancelEditButton" @click="cancelEdit">Annuler</button>
        </form>
      </div>
    </div>
  </template>
  
  <script>
import axios from 'axios'; // Assurez-vous d'installer axios avec npm

export default {
  data() {
    return {
      isEditing: false, // Détermine si on est en mode édition
      profile: {}, // Initialisation des données de profil
      editableProfile: {} // Utilisé pour stocker les modifications
    };
  },
  mounted() {
    // Appel API pour récupérer les données utilisateur
    this.fetchUserData();
  },
  methods: {
    async fetchUserData() {
      try {
        const response = await axios.get('/api/users');
        // Supposons que vous voulez le premier utilisateur
        this.profile = response.data[0]; // Assurez-vous de gérer les données selon vos besoins
        this.editableProfile = { ...this.profile }; // Cloner les données pour l'édition
      } catch (error) {
        console.error('Erreur lors de la récupération des données utilisateur', error);
      }
    },
    editProfile() {
      this.isEditing = true;
    },
    cancelEdit() {
      this.isEditing = false;
    },
    saveChanges() {
      // Logique pour sauvegarder les modifications
      this.profile = { ...this.editableProfile };
      this.isEditing = false;
    },
    onFileChange(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = e => {
          this.profile.photo = e.target.result;
        };
        reader.readAsDataURL(file);
      }
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
  