<template>
  <section id="Users" class="users">
    <h2>Gestion des Utilisateurs</h2>
    <table>
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
            <button>Créer</button>
            <button>Modifier</button>
            <button>Supprimer</button>
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
      users: [], // Tableau pour stocker les utilisateurs récupérés
    };
  },
  mounted() {
    this.fetchUsers();
  },
  methods: {
    async fetchUsers() {
      try {
        const response = await axios.get('/api/users'); // Appel à l'API
        this.users = response.data; // Assigner les données des utilisateurs
      } catch (error) {
        console.error("Erreur lors de la récupération des utilisateurs:", error);
      }
    },
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
    </style>