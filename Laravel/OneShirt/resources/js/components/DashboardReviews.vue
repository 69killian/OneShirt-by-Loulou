<template>
  <section id="Avis" class="avis">
    <h2>Gestion des Avis</h2>
    <table>
      <thead>
        <tr>
          <th>Produit</th>
          <th>Note</th>
          <th>Commentaire</th>
          <th>Utilisateur</th>
          <th>Photo de profil</th>
          <th>Date de création</th>
          <th>Actions disponibles</th>
        </tr>
      </thead>
      <tbody>
        <!-- Affichage des avis -->
        <tr v-for="review in reviews" :key="review.id">
          <td>{{ getProductById(review.product_id).name }}</td>
          <td>{{ review.rating }}</td>
          <td>{{ review.comment }}</td>
          <td>{{ getUserById(review.user_id).username || 'Utilisateur introuvable' }}</td>
          <td><img class="profile-pic" :src="'data:image/png;base64,' + getUserById(review.user_id).profile_picture" alt="Profile image" /></td>
          <td>{{ review.created_at.substr(0,10) }}</td>
          <td>
            <button @click="editReview(review.id)">Modifier</button>
            <button @click="deleteReview(review.id)">Supprimer</button>
          </td>
        </tr>
      </tbody>
    </table>
  </section>
</template>

<script>
export default {
  data() {
    return {
      reviews: [], // Liste des avis
      users: [],   // Liste des utilisateurs
      products: [], // Liste des produits
    };
  },
  methods: {
    // Méthode pour récupérer les avis
    fetchReviews() {
      fetch("/reviews")
        .then((response) => response.json())
        .then((data) => {
          this.reviews = data;
        })
        .catch((error) => {
          console.error("Erreur lors de la récupération des avis:", error);
        });
    },

    // Méthode pour récupérer les produits
    fetchProducts() {
      fetch("/api/products")
        .then((response) => response.json())
        .then((data) => {
          this.products = data;
        })
        .catch((error) => {
          console.error("Erreur lors de la récupération des produits:", error);
        });
    },

    // Méthode pour récupérer les utilisateurs
    fetchUsers() {
      fetch("/api/users")
        .then((response) => response.json())
        .then((data) => {
          this.users = data;
        })
        .catch((error) => {
          console.error("Erreur lors de la récupération des utilisateurs:", error);
        });
    },

    // Méthode pour obtenir un utilisateur par son ID
    getUserById(userId) {
      return this.users.find(user => user.id === userId);
    },

    // Méthode pour obtenir un produit par son ID
    getProductById(productId) {
      return this.products.find(product => product.id === productId);
    },

    // Méthodes pour modifier et supprimer un avis
    editReview(reviewId) {
      // Logique pour modifier un avis
      console.log('Modifier l\'avis', reviewId);
    },

    deleteReview(reviewId) {
      // Logique pour supprimer un avis
      console.log('Supprimer l\'avis', reviewId);
    },
  },

  created() {
    this.fetchReviews();
    this.fetchUsers();
    this.fetchProducts();
  },
};
</script>
    
    <style>
    .avis {
    margin-top: 20px;
  }
  
  .avis h2 {
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

  .profile-pic {
    height: 50px;
    width: 50px;
    object-fit: cover;
    border-radius: 50px;
  }
    </style>