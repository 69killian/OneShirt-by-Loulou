<template>
  <div class="main-payment">
    <form @submit.prevent="submitPayment">
      <div class="form-content">
        <div class="payment-info">
          <img src="../../../public/images/i43cmo34.bmp" alt="Stripe" style="height: 100px;">

          <!-- Affichage du montant -->
          <div class="amount">
            <p>Montant total : {{ totalPrice }} €</p>
          </div>

          <!-- Affichage des informations utilisateur -->
          <div class="user-info">
            <p><strong>Nom:</strong> {{ user.first_name }} {{ user.last_name }}</p>
            <p><strong>Email:</strong> {{ user.email }}</p>
            <p><strong>Téléphone:</strong> {{ user.phone_number }}</p>
            <p><strong>Adresse:</strong> {{ user.address }}</p>
          </div>

          <!-- Champ pour le numéro de carte -->
          <label for="card-number">Numéro de Carte</label>
          <div id="card-number"></div>

          <!-- Champ pour la date d'expiration -->
          <label for="card-expiry">Date d'Expiration</label>
          <div id="card-expiry"></div>

          <!-- Champ pour le CVC -->
          <label for="card-cvc">CVC</label>
          <div id="card-cvc"></div>

          <div id="card-errors" role="alert"></div>
        </div>
      </div>

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
      user: {}  // Stocker les informations de l'utilisateur
    };
  },
  async mounted() {
    try {
      // Initialiser Stripe
      this.stripe = await loadStripe('pk_test_51QKGeBB2WDE1V89YoLATB9ZjT5wXHhHYWTOq8BAtBPhro1B2Dl1HDFupfTEhg8RuVeYqm3VXfTXvh0uBudNmX62l00WcYyiZyt');
      this.elements = this.stripe.elements();

      // Créer chaque champ Stripe pour la carte
      this.cardNumber = this.elements.create('cardNumber');
      this.cardExpiry = this.elements.create('cardExpiry');
      this.cardCvc = this.elements.create('cardCvc');

      // Monter les champs dans le DOM
      this.cardNumber.mount('#card-number');
      this.cardExpiry.mount('#card-expiry');
      this.cardCvc.mount('#card-cvc');

      // Récupérer le montant du panier et les informations utilisateur depuis le backend
      const { data } = await axios.post('/api/payment-intent', {
        currency: 'eur',  // Vous pouvez spécifier la devise ici
      });

      // Définir le montant total dans la donnée
      this.totalPrice = data.total_amount;  // Afficher le montant total en euros
      this.user = data.user;  // Stocker les informations utilisateur

    } catch (error) {
      console.error("Erreur lors de l'initialisation de Stripe ou de la récupération du montant:", error);
    }
  },
  methods: {
    async submitPayment() {
      try {
        // Créer un PaymentIntent sur le backend avec le montant total
        const { data } = await axios.post('/api/payment-intent', {
          amount: this.totalPrice * 100,  // Montant multiplié par 100 pour convertir en centimes
          currency: 'eur',
        });

        const { client_secret } = data;

        // Confirmer le paiement avec les informations de la carte
        const { error } = await this.stripe.confirmCardPayment(client_secret, {
          payment_method: {
            card: this.cardNumber,  // On passe le champ de la carte
          },
        });

        if (error) {
          console.error("Erreur lors du paiement :", error);
          document.getElementById('card-errors').textContent = error.message;
        } else {
          this.$router.push('/paiementreussi');
        }
      } catch (error) {
        console.error("Erreur lors de la requête de paiement :", error);
      }
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
