<template>
    <div class="main-payment">
      <form @submit.prevent="submitPayment">
        <div class="form-content">
          <div class="client-info">
            <label for="first_name">Prénom</label>
            <input type="text" id="first_name" v-model="user.first_name" placeholder="Entrez votre prénom" required>
  
            <label for="last_name">Nom</label>
            <input type="text" id="last_name" v-model="user.last_name" placeholder="Entrez votre nom" required>
  
            <label for="email">Email</label>
            <input type="email" id="email" v-model="user.email" placeholder="Entrez votre email" required>
  
            <label for="phone">Numéro de téléphone</label>
            <input type="tel" id="phone_number" v-model="user.phone_number" placeholder="Entrez votre numéro" required>
  
            <label for="address">Adresse</label>
            <input type="text" id="address" v-model="user.address" placeholder="Entrez votre adresse" required>
  
            <label for="postal_code">Code Postal</label>
            <input type="text" id="postal_address" v-model="user.postal_address" placeholder="Entrez votre code postal" required>
          </div>
        </div>
  
        <div class="button-div-payment">
          <button type="submit" @click="submitPayment()">Procéder au Paiement</button>
        </div>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        user: {
          first_name: '',
          last_name: '',
          email: '',
          phone_number: '',
          address: '',
          postal_address: ''
        }
      };
    },
    mounted() {
      this.checkUserStatus();
    },
    methods: {
        async checkUserStatus() {
  try {
    const response = await axios.get('/api/auth/check');
    console.log(response.data); 
    if (response.data.authenticated) { 
      const userId = response.data.user.id; 
      this.getUserInfo(userId);
    } else {
      this.$router.push('/connexion');
    }
  } catch (error) {
    console.error("Erreur de connexion:", error);
  }
},
      async getUserInfo(userId) {
        try {
          const response = await axios.get(`/api/users/${userId}`);
          const user = response.data;
          this.user.first_name = user.first_name;
          this.user.last_name = user.last_name;
          this.user.email = user.email;
          this.user.phone_number = user.phone;
          this.user.address = user.address;
          this.user.postal_address = user.postal_code;
        } catch (error) {
          console.error("Erreur lors de la récupération des informations de l'utilisateur:", error);
        }
      },
      submitPayment() {
        this.$router.push('/paiementconnecté');
      }
    }
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
  