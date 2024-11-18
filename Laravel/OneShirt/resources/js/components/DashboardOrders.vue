<template>
  <section id="orders" class="orders">
    <h2>Commandes</h2>
    <table>
      <thead>
        <tr>
          <th>ID Commande</th>
          <th>Client</th>
          <th>Montant Total</th>
          <th>Date</th>
          <th>Adresse de Livraison</th>
          <th>Méthode de paiement</th>
          <th>État</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in orders" :key="order.id">
          <td>{{ order.id }}</td>
          <td>{{ getUserName(order.user_id) }}</td>
          <td>{{ order.total_amount }} €</td>
          <td>{{ new Date(order.created_at).toLocaleDateString() }}</td>
          <td>{{ order.shipping_address }}</td>
          <td>{{ order.payment_method }}</td>
          <td>
            <button :class="['status', order.payment_status === 'paid' ? 'paid' : 'pending']">
              <i :class="order.payment_status === 'paid' ? 'fas fa-check-circle' : 'fas fa-hourglass-half'"></i>
              {{ order.payment_status === 'paid' ? 'Payée' : 'En attente' }}
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </section>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Orders',
  data() {
    return {
      orders: [],
      promotions: [],
      users: {} // Dictionnaire pour stocker les utilisateurs récupérés
    };
  },
  async created() {
    try {
      const response = await axios.get('/api/orders');
      this.orders = response.data;

      // Récupération des utilisateurs associés aux commandes
      await this.fetchUsers();
    } catch (error) {
      console.error("Erreur lors de la récupération des commandes :", error);
    };
    this.fetchPromotions();
  },
  methods: {
    // Méthode pour récupérer les informations d'un utilisateur par son ID
    async fetchUsers() {
      try {
        for (let order of this.orders) {
          if (!this.users[order.user_id]) { // Si l'utilisateur n'a pas encore été récupéré
            const response = await axios.get(`/api/users/${order.user_id}`);
            this.users[order.user_id] = response.data; // Ajoute l'utilisateur au dictionnaire
          }
        }
      } catch (error) {
        console.error("Erreur lors de la récupération des utilisateurs :", error);
      }
    },
    calculateDiscountedPrice(originalPrice, promotionId) {
    console.log("Promotion ID:", promotionId); // Vérifier si promotion_id est bien passé
    const promotion = this.promotions.find(promo => promo.id === promotionId);
    console.log("Promotion trouvée:", promotion); // Afficher la promotion trouvée
    if (promotion && promotion.discount_percentage) {
      const discount = (originalPrice * promotion.discount_percentage) / 100;
      console.log("Calcul du prix réduit:", originalPrice - discount);  // Vérifier le calcul du prix réduit
      return (originalPrice - discount).toFixed(2); // Retourne le prix réduit
    }
    return originalPrice; // Retourne le prix original si aucune promotion
    },
    async fetchPromotions() {
      try {
        const response = await axios.get('/promotions');
        this.promotions = response.data;
        console.log("Promotions:", this.promotions);  // Vérifier les promotions récupérées
      } catch (error) {
        console.error('Erreur lors de la récupération des promotions:', error);
      }
    },
    // Méthode pour obtenir le nom de l'utilisateur
    getUserName(userId) {
      const user = this.users[userId];
      return user ? `${user.first_name} ${user.last_name}` : 'Utilisateur non trouvé';
    }
  }
};
</script>


    
    <style>
     .orders {
    margin-top: 20px;
  }
  
  .orders h2 {
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

  /* Style de base pour les cellules d'état */
  .orders button.status {
    padding: 0px 0px; /* Réduire l'espace interne */
    font-size: 12px; /* Réduire la taille de la police */
    text-align: center;
    border-radius: 12px;
}

button.status i {
    margin-right: 5px; /* Espace entre l'icône et le texte */
  }

  button.status.paid i {
    margin-right: 5px; /* Espace entre l'icône et le texte */
    color: #004085;
  }

  button.status.preparation i {
    margin-right: 5px; /* Espace entre l'icône et le texte */
    color: #856404;
  }
  

  
  /* Style pour l'état "payée" */
  .orders button.status.paid {
    background-color: #cce5ff; /* Fond bleu clair */
    color: #004085;           /* Texte bleu foncé */
    border-radius: 20px;
    padding: 4px 5px;
  }
  
  /* Style pour l'état "en préparation" */
  .orders button.status.preparation {
    background-color: #ffe5cc; /* Fond orange clair */
    color: #856404;            /* Texte orange foncé */
    border-radius: 20px;
    padding: 4px 5px;
  }
  
  /* Style pour l'état "expédiée" */
  .orders button.status.shipped {
    background-color: #d4edda; /* Fond vert clair */
    color: #155724;            /* Texte vert foncé */
    border-radius: 20px;
    padding: 4px 5px;
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