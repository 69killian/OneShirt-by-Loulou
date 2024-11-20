<template>
  <!-- Section d'aperçu avec des cartes d'informations -->
  <section id="overview" class="overview">
    
    <!-- Carte pour afficher les ventes du jour -->
    <div class="card">
      <h3>Ventes du jour</h3>
      <!-- Affichage du total des ventes du jour -->
      <p>{{ totalSales }} €</p>
    </div>
    
    <!-- Carte pour afficher le nombre de produits en stock -->
    <div class="card">
      <h3>Produits en stock</h3>
      <!-- Affichage du nombre total de produits en stock -->
      <p>{{ totalStock }}</p>
    </div>
    
    <!-- Carte pour afficher le nombre de nouveaux clients -->
    <div class="card">
      <h3>Nouveaux clients</h3>
      <!-- Affichage du nombre de nouveaux clients -->
      <p>{{ newClients }}</p>
    </div>
    
    <!-- Carte pour afficher le nombre d'avis récents -->
    <div class="card">
      <h3>Avis récents</h3>
      <!-- Affichage du nombre d'avis récents -->
      <p>{{ recentReviews }}</p>
    </div>
  </section>
</template>


<script>
import axios from 'axios';

export default {
  data() {
    return {
      totalSales: 0,
      totalStock: 0,
      newClients: 0,
      recentReviews: 0
    };
  },
  mounted() {
    this.fetchDashboardData();
  },
  methods: {
    async fetchDashboardData() {
      try {
        // Récupération des commandes
        const ordersResponse = await axios.get('/api/orders');
        const orders = ordersResponse.data;
        this.totalSales = this.calculateTotalSales(orders);

        // Récupération des produits
        const productsResponse = await axios.get('/api/products');
        const products = productsResponse.data;
        this.totalStock = this.calculateTotalStock(products);

        // Récupération des utilisateurs
        const usersResponse = await axios.get('/api/users');
        const users = usersResponse.data;
        this.newClients = this.calculateNewClients(users);

        // Récupération des avis
        const reviewsResponse = await axios.get('/reviews');
        const reviews = reviewsResponse.data;
        this.recentReviews = this.calculateRecentReviews(reviews);
      } catch (error) {
        console.error('Error fetching dashboard data:', error);
      }
    },

    calculateTotalSales(orders) {
      const today = new Date();
      const todayStart = new Date(today.setHours(0, 0, 0, 0)); // début de la journée
      const todayEnd = new Date(today.setHours(23, 59, 59, 999)); // fin de la journée

      // Filtre les commandes du jour
      const totalSalesAmount = orders
        .filter(order => {
          const orderDate = new Date(order.created_at);
          return orderDate >= todayStart && orderDate <= todayEnd;
        })
        .reduce((total, order) => total + parseFloat(order.total_amount || 0), 0); 

      // Retourne le montant total formaté
      return totalSalesAmount.toFixed(2); // Formate avec 2 décimales
    },

    calculateTotalStock(products) {
      return products.reduce((total, product) => total + product.stock_quantity, 0);
    },

    calculateNewClients(users) {
      const oneMonthAgo = new Date();
      oneMonthAgo.setMonth(oneMonthAgo.getMonth() - 1);
      return users.filter(user => new Date(user.created_at) >= oneMonthAgo).length;
    },

    calculateRecentReviews(reviews) {
      const oneMonthAgo = new Date();
      oneMonthAgo.setMonth(oneMonthAgo.getMonth() - 1);
      return reviews.filter(review => new Date(review.created_at) >= oneMonthAgo).length;
    }
  },
  computed: {
    formattedTotalSales() {
      // Formate le montant total avec le séparateur des milliers et la virgule comme séparateur décimal
      return this.totalSales.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ").replace('.', ',') + ' €';
    }
  }
};
</script>

    
    <style>
    
  .overview {
    display: flex;
    gap: 20px;
  }
  
  .card {
    background-color: #242424;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 100%;
  }
  
  .card h3 {
    font-size: 18px;
    margin-bottom: 10px;
  }
    </style>