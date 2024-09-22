<template>
    <div class="main-payment">
      <form @submit.prevent="submitPayment">
        <div class="form-content">
          <div class="client-info">
            <label for="firstname">Prénom</label>
            <input type="text" id="firstname" name="firstname" required placeholder="Prénom" :value="clientInfo.firstname" readonly>
  
            <label for="lastname">Nom</label>
            <input type="text" id="lastname" name="lastname" required placeholder="Nom" :value="clientInfo.lastname" readonly>
  
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="Email" :value="clientInfo.email" readonly>
  
            <label for="phone">Numéro de téléphone</label>
            <input type="tel" id="phone" name="phone" required placeholder="Numéro de téléphone" :value="clientInfo.phone" readonly>
  
            <label for="address">Adresse</label>
            <input type="text" id="address" name="address" required placeholder="Adresse" :value="clientInfo.address" readonly>
  
            <label for="postalcode">Code Postal</label>
            <input type="text" id="postalcode" name="postalcode" required placeholder="Code Postal" :value="clientInfo.postalcode" readonly>
          </div>
  
          <div class="payment-info">
            <div class="card-logos">
              <img src="../../../public/images/cprvfy9q.bmp" alt="Visa">
              <img src="../../../public/images/Mastercard-logo.svg.png" alt="MasterCard">
              <img src="../../../public/images/yxutmjlg.bmp" alt="American Express">
              <img src="../../../public/images/spkvt5uz.bmp" alt="CB">
              <img src="../../../public/images/i43cmo34.bmp" alt="Stripe">
            </div>
  
            <label for="creditcard">Numéro de Carte Bancaire</label>
            <input type="text" id="creditcard" name="creditcard" required placeholder="1234 5678 9012 3456" v-model="paymentInfo.creditcard">
  
            <label for="expiration">Date d'Expiration</label>
            <input type="text" id="expiration" name="expiration" required placeholder="MM/AA" v-model="paymentInfo.expiration">
  
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" required placeholder="123" v-model="paymentInfo.cvv">
  
            <label for="promo">CODE PROMO</label>
            <input type="text" id="promo" name="promo" placeholder="Si applicable" v-model="paymentInfo.promo">
          </div>
        </div>
  
        <div class="button-div-payment">
          <button type="submit">Procéder au Paiement</button>
        </div>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    name: 'PaymentConnectedForm',
    data() {
      return {
        clientInfo: {
          firstname: 'John',
          lastname: 'Doe',
          email: 'john.doe@example.com',
          phone: '+33 6 12 34 56 78',
          address: '123 Rue Exemple',
          postalcode: '75001',
        },
        paymentInfo: {
          creditcard: '',
          expiration: '',
          cvv: '',
          promo: '',
        },
      };
    },
    methods: {
      submitPayment() {
        // Logique pour traiter le paiement
        console.log('Payment Submitted:', this.paymentInfo);
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
    flex-direction: row;
    gap: 30px;
  }
  
  .client-info, .payment-info {
    flex: 1;
    display: flex;
    flex-direction: column;
  }
  
  .card-logos {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
  }
  
  .card-logos img {
    height: 30px;
    object-fit: contain;
  }
  
  label {
    display: block;
    margin-bottom: 0.5em;
    text-align: left;
  }
  
  input[type="text"], input[type="email"], input[type="tel"], textarea {
    margin-bottom: 1.5em;
    padding: 12px 100px 12px 12px;
    border: none;
    border-radius: 5px;
    border: 1px solid grey;
    width: 100%;
    font-size: 18px;
    font-weight: 300;
    color: rgb(174, 174, 174);
    box-sizing: border-box;
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
    .form-content {
      flex-direction: column;
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
  