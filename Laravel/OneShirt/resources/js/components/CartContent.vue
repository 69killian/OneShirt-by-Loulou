<template>
    <div class="container">
      <h1>Votre Panier</h1>
      
      <div class="cart-content">
        <div class="products-list">
          <!-- Product Item 1 -->
          <div class="product-item" id="product1">
            <img src="../../../public/images/Image.png" alt="Nom du Produit 1" class="product-image">
            <div class="product-details">
              <h2 class="product-name">Nom du Produit 1</h2>
              <p class="product-type">Type : <span id="productType1">T-shirt</span></p>
              <p class="product-color">Couleur : <span id="productColor1">Bleu</span></p>
              <p class="product-description">Description détaillée du produit 1. Cela inclut toutes les informations importantes que les clients doivent savoir.</p>
              <p class="product-price">Prix unitaire : <span id="productPrice1">29.99 €</span></p>
  
              <!-- Quantity Selector -->
              <div class="quantity-selector">
                <label for="quantity1">Quantité :</label>
                <input type="number" id="quantity1" name="quantity1" min="1" value="1" @change="updatePrice">
              </div>
            </div>
          </div>
  
          <!-- Product Item 2 -->
          <div class="product-item" id="product2">
            <img src="../../../public/images/Image.png" alt="Nom du Produit 2" class="product-image">
            <div class="product-details">
              <h2 class="product-name">Nom du Produit 2</h2>
              <p class="product-type">Type : <span id="productType2">Casquette</span></p>
              <p class="product-color">Couleur : <span id="productColor2">Rouge</span></p>
              <p class="product-description">Description détaillée du produit 2. Cela inclut toutes les informations importantes que les clients doivent savoir.</p>
              <p class="product-price">Prix unitaire : <span id="productPrice2">19.99 €</span></p>
  
              <!-- Quantity Selector -->
              <div class="quantity-selector">
                <label for="quantity2">Quantité :</label>
                <input type="number" id="quantity2" name="quantity2" min="1" value="1" @change="updatePrice">
              </div>
            </div>
          </div>
        </div>
  
        <!-- Order Summary -->
        <div class="order-summary">
          <h2>Résumé de la Commande</h2>
          <p>Prix total des produits : <span id="totalPrice">{{ totalPrice }} €</span></p>
          <p>Quantité totale : <span id="totalQuantity">{{ totalQuantity }}</span></p>
          <button id="checkoutButton">
            <button style="color: black; text-decoration: none;" id="checkoutButton" @click="proceedToPayment">
                Procéder au paiement
            </button>

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
export default {
  data() {
    return {
      totalPrice: '49.98',
      totalQuantity: 2,
      isLoggedIn: false // Change cela en fonction de ton état d'authentification
    };
  },
  methods: {
    updatePrice() {
      const quantity1 = parseInt(document.getElementById('quantity1').value);
      const price1 = parseFloat(document.getElementById('productPrice1').textContent.replace(' €', ''));
      const totalPrice1 = (quantity1 * price1).toFixed(2);
  
      const quantity2 = parseInt(document.getElementById('quantity2').value);
      const price2 = parseFloat(document.getElementById('productPrice2').textContent.replace(' €', ''));
      const totalPrice2 = (quantity2 * price2).toFixed(2);
  
      const totalQuantity = quantity1 + quantity2;
      const grandTotal = (parseFloat(totalPrice1) + parseFloat(totalPrice2)).toFixed(2);
  
      this.totalPrice = grandTotal;
      this.totalQuantity = totalQuantity;
    },
    proceedToPayment() {
      if (this.isLoggedIn) {
        this.$router.push('/paiementconnecte');
      } else {
        this.$router.push('/paiementvisiteur');
      }
    }
  }
}
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
    padding: 10px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 1.2em;
    cursor: pointer;
  }
  
  #checkoutButton:hover {
    background-color: #45a049;
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
  