<template>
  <section id="Users" class="users">
    <h2>Gestion des Utilisateurs</h2>

    <button @click="showForm('create')" v-if="!isFormVisible">Créer un utilisateur</button>

    <div v-if="isFormVisible" class="user-form">
      <h3>{{ isEditMode ? 'Modifier Utilisateur' : 'Créer un Utilisateur' }}</h3>
      <form @submit.prevent="submitForm">
        <input v-model="form.first_name" placeholder="Prénom" required />
        <input v-model="form.last_name" placeholder="Nom" required />
        <input v-model="form.role" placeholder="Rôle" required />
        <input type="file" @change="onFileChange" />
        <input v-model="form.username" placeholder="Pseudo" required />
        <input v-model="form.email" placeholder="E-mail" type="email" required />
        <input v-model="form.phone_number" placeholder="Téléphone" />
        <input v-model="form.birth_date" placeholder="Date de naissance" type="date" />
        <input v-model="form.address" placeholder="Adresse" />
        <input v-model="form.password" placeholder="Mot de passe" type="password" v-if="!isEditMode" required />

        <button type="submit">{{ isEditMode ? 'Mettre à jour' : 'Créer' }}</button>
        <button type="button" @click="cancelForm">Annuler</button>
      </form>
    </div>

    <table v-if="!isFormVisible" class="user-table">
      <thead>
        <tr>
          <th>Prénom</th>
          <th>Nom</th>
          <th>Rôle</th>
          <th>Photo de profil</th>
          <th>Pseudo</th>
          <th>E-mail</th>
          <th>Mot de passe Haché</th>
          <th>Numéro de téléphone</th>
          <th>Date de Naissance</th>
          <th>Adresse</th>
          <th>Date de création</th>
          <th>Actions disponibles</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td>{{ user.first_name }}</td>
          <td>{{ user.last_name }}</td>
          <td>{{ user.role }}</td>
          <td><img class="profile_picture" :src="'data:image/png;base64,' + user.profile_picture" alt="profile picture" /></td>
          <td>{{ user.username }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.hashed_password }}</td>
          <td>{{ user.phone_number }}</td>
          <td>{{ user.birth_date }}</td>
          <td>{{ user.address }}</td>
          <td>{{ user.created_at }}</td>
          <td>
            <button @click="editUser(user)">Modifier</button>
            <button @click="deleteUser(user.id)">Supprimer</button>
          </td>
        </tr>
      </tbody>
    </table>
  </section>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      users: [],
      form: {
        first_name: '',
        last_name: '',
        role: '',
        profile_picture: null,
        username: '',
        email: '',
        phone_number: '',
        birth_date: '',
        address: '',
        password: ''
      },
      isEditMode: false,
      isFormVisible: false,
      editUserId: null,
    };
  },
  mounted() {
    this.fetchUsers();
  },
  methods: {
    async fetchUsers() {
      try {
        const response = await axios.get('/api/users');
        this.users = response.data;
      } catch (error) {
        console.error("Erreur lors de la récupération des utilisateurs:", error);
      }
    },
    async submitForm() {
      try {
        const formData = new FormData();
        console.log("Formulaire:", this.form); // Debug - Afficher le contenu du formulaire

        // Ajout des données du formulaire à FormData
        for (let key in this.form) {
          if (this.form[key] !== null && this.form[key] !== '') {
            formData.append(key, this.form[key]);
          }
        }

        // Si on est en mode édition, on ne passe pas le mot de passe si il est vide
        if (this.isEditMode && !this.form.password) {
          formData.delete('password');
          console.log("Mot de passe supprimé pour l'édition"); // Debug
        }

        // Envoi de la requête API pour créer ou mettre à jour l'utilisateur
        if (this.isEditMode) {
          console.log("Mise à jour de l'utilisateur", this.editUserId); // Debug
          await axios.put(`/api/update/users/${this.editUserId}`, formData);
          alert('Utilisateur mis à jour');
        } else {
          console.log("Création de l'utilisateur"); // Debug
          await axios.post('/api/create/users', formData);
          alert('Utilisateur créé');
        }

        // Rafraîchissement des utilisateurs et réinitialisation du formulaire
        this.fetchUsers();
        this.cancelForm();
      } catch (error) {
        console.error("Erreur lors de la soumission du formulaire:", error);
        alert("Une erreur est survenue. Veuillez réessayer plus tard.");
      }
    },
    showForm(mode) {
      this.isFormVisible = true;
      this.isEditMode = mode === 'edit';
    },
    editUser(user) {
      this.showForm('edit');
      this.editUserId = user.id;
      this.form = { ...user, password: '' }; // On évite de pré-remplir le mot de passe
    },
    async deleteUser(id) {
      try {
        await axios.delete(`/api/delete/users/${id}`);
        alert('Utilisateur supprimé');
        this.fetchUsers();
      } catch (error) {
        console.error("Erreur lors de la suppression de l'utilisateur:", error);
      }
    },
    cancelForm() {
      this.isFormVisible = false;
      this.isEditMode = false;
      this.resetForm();
    },
    resetForm() {
      this.form = {
        first_name: '',
        last_name: '',
        role: '',
        profile_picture: null,
        username: '',
        email: '',
        phone_number: '',
        birth_date: '',
        address: '',
        password: ''
      };
      this.editUserId = null;
    },
    onFileChange(event) {
      this.form.profile_picture = event.target.files[0];
    }
  },
};
</script>



    
    <style>
        .users {
    margin-top: 20px;
  }
  
  .users h2 {
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

  .profile_picture {
    height: 50px;
    width: 50px;
    border-radius: 50px;
    object-fit: cover;
  }

  .user-form {
  background-color: #f9f9f9;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  transition: opacity 0.3s ease;
}

form button[type="submit"], form button[type="button"] {
  width: auto;
  align-self: flex-start;
  margin-top: 10px;
}

input {
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
  margin-top: 10px;
}
    </style>