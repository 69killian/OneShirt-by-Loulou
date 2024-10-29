<template>
  <div class="container">
    <h1>Votre Panier</h1>
    
    <div class="cart-content">
      <div class="products-list">
        <!-- Boucle pour afficher chaque produit dans le panier -->
        <div v-for="(product, index) in products" :key="product.id" class="product-item">
          <img :src="product.image || '../../../public/images/Image.png'" :alt="product.name" class="product-image">
          <div class="product-details">
            <h2 class="product-name">{{ product.name }}</h2>
            <p class="product-type">Type : <span>{{ product.type }}</span></p>
            <p class="product-color">Couleur : <span>{{ product.color }}</span></p>
            <p class="product-description">{{ product.description }}</p>
            <p class="product-price">Prix unitaire : <span>{{ product.price }} €</span></p>

            <!-- Sélecteur de quantité -->
            <div class="quantity-selector">
              <label :for="'quantity' + index">Quantité :</label>
              <input type="number" :id="'quantity' + index" v-model.number="product.quantity" min="1" @change="updatePrice">
            </div>
          </div>
        </div>
      </div>

      <!-- Résumé de la commande -->
      <div class="order-summary">
        <h2>Résumé de la Commande</h2>
        <p>Prix total des produits : <span>{{ totalPrice }} €</span></p>
        <p>Quantité totale : <span>{{ totalQuantity }}</span></p>
        <button @click="proceedToPayment" id="checkoutButton">
          Procéder au paiement
        </button>
        <div class="card-logos">
          <img src="../../../public/images/cprvfy9q.bmp" alt="Visa">
          <img src="../../../public/images/Mastercard-logo.svg.png" alt="MasterCard">
          <img src="../../../public/images/yxutmjlg.bmp" alt="American Express">
          <img src="../../../public/images/spkvt5uz.bmp" alt="CB">
          <img src="../../../public/images/i43cmo34.bmp" alt="Stripe">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [], // Liste de produits récupérés de l'API
      totalPrice: 0,
      totalQuantity: 0,
      isLoggedIn: false // Modifier selon l'état de connexion
    };
  },
  methods: {
    fetchProducts() {
      axios.get('/api/products')
        .then(response => {
          this.products = response.data.map(product => ({
            ...product,
            image: product.images && product.images.length > 0 ? product.images[0].image_base64 : '',
            quantity: 1 // Par défaut 1 pour chaque produit
          }));
          this.updatePrice(); // Mettre à jour le prix après récupération des produits
        })
        .catch(error => {
          console.error('Erreur lors de la récupération des produits:', error);
        });
    },
    updatePrice() {
      // Calcul des prix totaux
      this.totalPrice = this.products.reduce((acc, product) => acc + product.price * product.quantity, 0).toFixed(2);
      this.totalQuantity = this.products.reduce((acc, product) => acc + product.quantity, 0);
    },
    proceedToPayment() {
      if (this.isLoggedIn) {
        this.$router.push('/paiementconnecte');
      } else {
        this.$router.push('/paiementvisiteur');
      }
    }
  },
  mounted() {
    this.fetchProducts(); // Charger les produits lors du montage du composant
  }
};
</script>

  
  <style scoped>
  /* Styles pour le composant CartContent */
  .container {
    width: 90%;
    max-width: 1200px;
    margin: 20px auto;
    margin-top: 100px;
  }
  
  h1 {
    text-align: center;
    margin-bottom: 20px;
    text-shadow: none;
    color: black;
  }
  
  .cart-content {
    display: flex;
    gap: 20px;
  }
  
  .products-list {
    flex: 3;
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
  
  .product-item {
    display: flex;
    align-items: center;
    gap: 20px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 20px;
  }
  
  .product-image {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
  }
  
  .product-details {
    flex: 1;
  }
  
  .product-name {
    font-size: 1.5em;
  }
  
  .product-type, .product-color {
    font-size: 1.1em;
    margin: 5px 0;
  }
  
  .product-description {
    margin: 10px 0;
    color: #555;
  }
  
  .product-price {
    font-size: 1.2em;
    margin: 10px 0;
  }
  
  .quantity-selector {
    margin-top: 10px;
  }
  
  .quantity-selector input {
    width: 80px;
    text-align: center;
  }
  
  .order-summary {
    flex: 1;
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  #checkoutButton {
    width: 100%;
    padding: 5px;
    background-color: #8B3CEF;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 1.2em;
    cursor: pointer;
    transition: 0.1s;
  }
  
  #checkoutButton:hover {
    background-color: #562795;
  }
  
  .card-logos {
    display: flex;
    gap: 10px;
    margin-top: 10px;
  }
  
  .card-logos img {
    height: 30px;
  }
  </style>
  