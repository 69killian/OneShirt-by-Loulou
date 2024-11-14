<template>
  <section id="overview" class="overview">
    <div class="card">
      <h3>Ventes du jour</h3>
      <p>{{ totalSales }} €</p>
    </div>
    <div class="card">
      <h3>Produits en stock</h3>
      <p>{{ totalStock }}</p>
    </div>
    <div class="card">
      <h3>Nouveaux clients</h3>
      <p>{{ newClients }}</p>
    </div>
    <div class="card">
      <h3>Avis récents</h3>
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
        // Récupérer les commandes
        const ordersResponse = await axios.get('/api/orders');
        const orders = ordersResponse.data;
        this.totalSales = this.calculateTotalSales(orders);

        // Récupérer les produits
        const productsResponse = await axios.get('/api/products');
        const products = productsResponse.data;
        this.totalStock = this.calculateTotalStock(products);

        // Récupérer les utilisateurs
        const usersResponse = await axios.get('/api/users');
        const users = usersResponse.data;
        this.newClients = this.calculateNewClients(users);

        // Récupérer les avis
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

      // Filtrer les commandes du jour
      const totalSalesAmount = orders
        .filter(order => {
          const orderDate = new Date(order.created_at);
          return orderDate >= todayStart && orderDate <= todayEnd;
        })
        .reduce((total, order) => total + parseFloat(order.total_amount || 0), 0); // Assurez-vous que le total_amount est un nombre valide

      // Retourner le montant total formaté
      return totalSalesAmount.toFixed(2); // Formater avec 2 décimales
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
      // Formater le montant total avec le séparateur des milliers et la virgule comme séparateur décimal
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