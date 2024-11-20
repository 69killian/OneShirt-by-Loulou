<template>
  <div class="main-payment">
    <!-- Formulaire de paiement, la soumission est gérée par 'submitPayment' -->
    <form @submit.prevent="submitPayment">
      
      <div class="form-content">
        <div class="payment-info">

          <!-- Affichage du logo Stripe -->
          <img src="../../../public/images/i43cmo34.bmp" alt="Stripe" style="height: 100px; object-fit: cover;">

          <!-- Affichage du montant total à payer -->
          <div class="amount">
            <p>Montant total : {{ totalPrice }} €</p>
          </div>

          <!-- Liste des produits dans le panier -->
          <div class="products-list">
            <h3>Produits dans votre panier :</h3>
            <ul>
              <!-- Boucle pour afficher chaque produit dans le panier -->
              <li v-for="(product, index) in products" :key="index">
                {{ product.quantity }} x {{ product.name }} -

                <!-- Affichage du prix, avec réduction si applicable -->
                <span v-if="product.promotion_id">
                  <!-- Prix original barré -->
                  <span class="original-price" style="text-decoration: line-through;">
                    {{ product.price }}€
                  </span>
                  <!-- Prix réduit -->
                  <span class="discounted-price">
                    {{ calculateDiscountedPrice(product.price, product.promotion_id) }}€
                  </span>
                </span>
                <!-- Prix sans promotion -->
                <span v-else>{{ product.price }}€ {{ product.promotion_id }}</span>
              </li>
            </ul>
          </div>

          <!-- Informations utilisateur (Nom, Email, Téléphone, Adresse) -->
          <div class="user-info">
            <p><strong>Nom:</strong> {{ user.first_name }} {{ user.last_name }}</p>
            <p><strong>Email:</strong> {{ user.email }}</p>
            <p><strong>Téléphone:</strong> {{ user.phone_number }}</p>
            <p><strong>Adresse:</strong> {{ user.address }}</p>
          </div>

          <!-- Champs pour les informations de carte bancaire -->
          <label for="card-number">Numéro de Carte</label>
          <div id="card-number"></div> <!-- Espace pour entrer le numéro de carte -->

          <label for="card-expiry">Date d'Expiration</label>
          <div id="card-expiry"></div> <!-- Espace pour entrer la date d'expiration -->

          <label for="card-cvc">CVC</label>
          <div id="card-cvc"></div> <!-- Espace pour entrer le code CVC -->

          <!-- Zone d'affichage des erreurs liées à la carte -->
          <div id="card-errors" role="alert"></div>
        </div>
      </div>

      <!-- Bouton de soumission pour procéder au paiement -->
      <div class="button-div-payment">
        <button type="submit">Procéder au Paiement</button>
      </div>
    </form>
  </div>
</template>


<script>
import { loadStripe } from '@stripe/stripe-js';
import axios from 'axios';

export default {
  name: 'PaymentConnectedForm',
  data() {
    return {
      stripe: null,
      elements: null,
      cardNumber: null,
      cardExpiry: null,
      cardCvc: null,
      totalPrice: null,
      user: {}, 
      products: [],
      promotions: [],
    };
  },
  created() {
    this.fetchPromotions();
  },
  async mounted() {
    try {
      // Initialisation Stripe
      this.stripe = await loadStripe('pk_test_51QKGeBB2WDE1V89YoLATB9ZjT5wXHhHYWTOq8BAtBPhro1B2Dl1HDFupfTEhg8RuVeYqm3VXfTXvh0uBudNmX62l00WcYyiZyt');
      this.elements = this.stripe.elements();

      // Crée chaque champ Stripe pour la carte
      this.cardNumber = this.elements.create('cardNumber');
      this.cardExpiry = this.elements.create('cardExpiry');
      this.cardCvc = this.elements.create('cardCvc');

      // Monte les champs dans le DOM
      this.cardNumber.mount('#card-number');
      this.cardExpiry.mount('#card-expiry');
      this.cardCvc.mount('#card-cvc');

      // Récupère le montant du panier et les informations utilisateur depuis le backend
      const { data } = await axios.post('/api/payment-intent', {
        currency: 'eur',  // Vous pouvez spécifier la devise ici
      });

      // Défini le montant total 
      this.totalPrice = data.total_amount;  // Affiche le montant total en euros
      this.user = data.user;  // Stocke les informations utilisateur
      this.products = data.products;

    } catch (error) {
      console.error("Erreur lors de l'initialisation de Stripe ou de la récupération du montant:", error);
      this.$router.push('/erreurpaiement');
    }
  },
  methods: {
    async submitPayment() {
  try {
    const { data } = await axios.post('/api/payment-intent', {
      amount: this.totalPrice * 100, 
      currency: 'eur',
    });

    const { client_secret } = data;

    const { error } = await this.stripe.confirmCardPayment(client_secret, {
      payment_method: { card: this.cardNumber },
    });

    if (error) {
      console.error("Erreur lors du paiement :", error);
      document.getElementById('card-errors').textContent = error.message;
    } else {
      await axios.post('/api/process-order'); 
      this.$router.push('/paiementreussi');
    }
  } catch (error) {
    console.error("Erreur lors de la requête de paiement :", error);
  }
},
    async fetchPromotions() {
      try {
        const response = await axios.get('/promotions');
        this.promotions = response.data;
        console.log("Promotions:", this.promotions);  // Vérifie que les promotions sont bien récupérées
      } catch (error) {
        console.error('Erreur lors de la récupération des promotions:', error);
      }
    },
    calculateDiscountedPrice(originalPrice, promotionId) {
    console.log("Promotion ID:", promotionId); // Vérifie si promotion_id est bien passé
    const promotion = this.promotions.find(promo => promo.id === promotionId);
    console.log("Promotion trouvée:", promotion); // Affiche la promotion trouvée
    
    if (promotion && promotion.discount_percentage) {
      const discount = (originalPrice * promotion.discount_percentage) / 100;
      console.log("Calcul du prix réduit:", originalPrice - discount);  // Vérifie le calcul du prix réduit
      return (originalPrice - discount).toFixed(2); // Retourne le prix réduit
    }
    return originalPrice; // Retourne le prix original si aucune promotion
    },
  },
};
</script>







<style scoped>
.main-payment {
  display: flex;
  align-items: center;
  justify-content: center;
}

form {
  background-color: white;
  padding: 100px 150px;
  margin-top: 100px;
  display: flex;
  flex-direction: column;
  gap: 30px;
  box-shadow: 0px 1px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
}

.form-content {
  display: flex;
  flex-direction: column;
}

.payment-info {
  flex: 1;
  display: flex;
  flex-direction: column;
}

#card-number, #card-expiry, #card-cvc {
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 15px;
}

#card-errors {
  color: red;
  font-size: 14px;
  margin-top: 10px;
}

button[type="submit"] {
  background-color: rgb(48, 48, 48);
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 7px;
  font-size: 16px;
  font-weight: 500;
  cursor: pointer;
  margin-top: 30px;
}

button[type="submit"]:hover {
  background-color: rgb(31, 31, 31);
}

.button-div-payment {
  display: flex;
  justify-content: center;
  margin-top: 30px;
}

@media (max-width: 768px) {
  form {
    padding: 30px 20px;
    margin-top: 50px;
  }
  button[type="submit"] {
    font-size: 14px;
    padding: 10px 15px;
  }
}

@media (max-width: 480px) {
  form {
    padding: 20px 15px;
    margin-top: 30px;
  }
  button[type="submit"] {
    font-size: 12px;
    padding: 8px 12px;
  }
}
</style>
