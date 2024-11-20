<template>
  <div class="container">
    <!-- Titre principal de la page du panier -->
    <h1>Votre Panier</h1>

    <div class="cart-content">
      <!-- Liste des produits dans le panier -->
      <div class="products-list">
        <!-- Boucle sur chaque produit du panier -->
        <div v-for="(product, index) in products" :key="product.id" class="product-item">
          <!-- Affichage de l'image du produit -->
          <img :src="product.images[0]?.image_base64" alt="Image du produit" class="product-image">

          <div class="product-details">
            <!-- Nom du produit -->
            <h2 class="product-name">{{ product.name }}</h2>
            <!-- Type et couleur du produit -->
            <p class="product-type">Type : <span>{{ product.type }}</span></p>
            <p class="product-color">Couleur : <span>{{ product.color }}</span></p>
            <p class="product-description">{{ product.description }}</p>

            <!-- Affichage du prix avec promotion si présente -->
            <span v-if="product.promotion_id">
              <!-- Prix original barré si une promotion est appliquée -->
              <p class="original-price" style="text-decoration: line-through;">
                {{ product.price }}€
              </p>
              <!-- Prix réduit avec la promotion -->
              <p class="discounted-price">
                {{ calculateDiscountedPrice(product.price, product.promotion_id) }}€
              </p>
            </span>
            <p v-else>{{ product.price }}€</p>

            <!-- Sélecteur de quantité pour chaque produit -->
            <div class="quantity-selector">
              <label :for="'quantity' + index">Quantité :</label>
              <input 
                type="number" 
                :id="'quantity' + index" 
                v-model.number="product.quantity" 
                min="0" 
                @change="updateQuantity(product)"  
              />
            </div>
          </div>
          <!-- Bouton pour supprimer le produit du panier -->
          <p class="delete-button" @click="removeCartItem(product.id)">🗑</p>
        </div>
      </div>

      <!-- Résumé de la commande -->
      <div class="order-summary">
        <h2>Résumé de la Commande</h2>
        <!-- Affichage du prix total et de la quantité totale -->
        <p>Prix total des produits : <span>{{ totalPrice }} €</span></p>
        <p>Quantité totale : <span>{{ totalQuantity }}</span></p>

        <!-- Bouton pour procéder au paiement -->
        <button @click="proceedToPayment" id="checkoutButton">
          Procéder au paiement
        </button>

        <!-- Logotypes des cartes de paiement -->
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

// Définition du token CSRF pour sécuriser les requêtes axios
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

export default {
  data() {
    return {
      products: [],  // Liste des produits dans le panier
      promotions: [],  // Liste des promotions disponibles
      totalPrice: 0,  // Prix total du panier
      totalQuantity: 0,  // Quantité totale des produits dans le panier
      isLoggedIn: false,  // Statut de connexion de l'utilisateur
    };
  },

  methods: {
    // Mise à jour de la quantité d'un produit dans le panier
    async updateQuantity(product) {
      if (product.quantity === 0) {
        this.confirmAndRemoveItem(product); // Si la quantité est 0, confirmer la suppression
        return;
      }

      try {
        await axios.put(`/api/cart/items/${product.id}`, { quantity: product.quantity });
        this.updatePrice(); // Mettre à jour le prix total
      } catch (error) {
        console.error("Erreur lors de la mise à jour de la quantité :", error);
      }
    },

    // Suppression d'un article du panier
    async removeCartItem(productId) {
      try {
        await axios.delete(`/api/cart/items/${productId}`);
        // Filtre les produits supprimés du panier
        this.products = this.products.filter(product => product.id !== productId);
        this.updatePrice(); // Mettre à jour le prix et la quantité
      } catch (error) {
        console.error("Erreur lors de la suppression de l'article du panier :", error);
      }
    },

    // Confirme et supprime un article du panier si la quantité est 0
    confirmAndRemoveItem(product) {
      if (confirm("Voulez-vous supprimer cet article de votre panier ?")) {
        this.removeCartItem(product.id);
      } else {
        product.quantity = 1; // Réinitialise la quantité à 1 si l'utilisateur annule
      }
    },

    // Vérification de l'authentification de l'utilisateur
    async checkAuthentication() {
      try {
        const response = await axios.get('/api/check');
        this.isLoggedIn = response.data.authenticated;

        if (this.isLoggedIn) {
          this.fetchCartItems(); // Récupérer les articles du panier si l'utilisateur est connecté
        } else {
          this.products = []; // Aucune donnée de panier pour un visiteur
        }
      } catch (error) {
        console.error("Erreur lors de la vérification de l'authentification :", error);
      }
    },

    // Récupération des articles du panier
    async fetchCartItems() {
      try {
        const response = await axios.get('/api/cart');
        const cartItems = response.data.items;

        // Récupération des produits avec leurs informations
        const productIds = cartItems.map(item => item.product.id);
        const productsResponse = await axios.get(`/api/products/`, { params: { ids: productIds } });

        // Combine les informations des produits avec la quantité dans le panier
        this.products = cartItems.map(item => {
          const product = productsResponse.data.find(prod => prod.id === item.product.id);
          return { ...product, quantity: item.quantity };
        });

        this.updatePrice(); // Mettre à jour le prix total et la quantité
      } catch (error) {
        console.error("Erreur lors de la récupération des produits du panier :", error);
      }
    },

    // Mise à jour du prix total et de la quantité du panier
    updatePrice() {
      this.totalPrice = this.products.reduce((acc, product) => {
        if (product.promotion_id) {
          // Si une promotion est appliquée, calculer le prix réduit
          const discountedPrice = this.calculateDiscountedPrice(product.price, product.promotion_id);
          return acc + (discountedPrice * product.quantity);
        } else {
          // Si aucune promotion, utiliser le prix original
          return acc + (product.price * product.quantity);
        }
      }, 0).toFixed(2); // Formate le prix à 2 décimales

      // Calcule la quantité totale des produits
      this.totalQuantity = this.products.reduce((acc, product) => acc + product.quantity, 0);
    },

    // Redirige l'utilisateur vers la page de paiement ou de connexion
    proceedToPayment() {
      this.$router.push(this.isLoggedIn ? '/paymentuserinfo' : '/connexion');
    },

    // Calcule le prix réduit d'un produit avec une promotion
    calculateDiscountedPrice(originalPrice, promotionId) {
      console.log("Promotion ID:", promotionId); // Vérification de l'ID de la promotion
      const promotion = this.promotions.find(promo => promo.id === promotionId);
      console.log("Promotion trouvée:", promotion); // Vérification de la promotion trouvée

      if (promotion && promotion.discount_percentage) {
        const discount = (originalPrice * promotion.discount_percentage) / 100;
        console.log("Calcul du prix réduit:", originalPrice - discount);  // Vérification du calcul
        return (originalPrice - discount).toFixed(2); // Retourne le prix réduit
      }

      return originalPrice; // Retourne le prix original si aucune promotion
    },

    // Récupération des promotions disponibles
    async fetchPromotions() {
      try {
        const response = await axios.get('/promotions');
        this.promotions = response.data;
        console.log("Promotions:", this.promotions);  // Vérification des promotions récupérées
      } catch (error) {
        console.error('Erreur lors de la récupération des promotions:', error);
      }
    },
  },

  // Appelr les méthodes au montage du composant
  mounted() {
    this.checkAuthentication();
    this.fetchPromotions();
  },
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

  .delete-button {
    font-size: 30px;
    cursor: pointer;
    margin-right: 30px;
    transition: 0.2s;
  }

  .delete-button:hover {
    color: gray;
  }
  </style>
  