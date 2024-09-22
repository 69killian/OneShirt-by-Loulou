<template>
    <div class="main-contact">
      <h1>Inscris-toi</h1>
      <p class="description">Et rejoint l'équipage !</p>
  
      <form @submit.prevent="submitForm">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" id="username" v-model="formData.username" required placeholder="Nom d'utilisateur">
        
        <label for="firstname">Prénom</label>
        <input type="text" id="firstname" v-model="formData.firstname" required placeholder="Prénom">
        
        <label for="lastname">Nom</label>
        <input type="text" id="lastname" v-model="formData.lastname" required placeholder="Nom">
        
        <label for="email">Email</label>
        <input type="email" id="email" v-model="formData.email" required placeholder="Email">
        
        <label for="phone">Numéro de téléphone</label>
        <input type="tel" id="phone" v-model="formData.phone" required placeholder="Numéro de téléphone">
        
        <label for="birthdate">Date de naissance</label>
        <input type="date" id="birthdate" v-model="formData.birthdate" required>
        
        <label for="address">Adresse</label>
        <input type="text" id="address" v-model="formData.address" required placeholder="Adresse">
        
        <label for="postalcode">Adresse postale</label>
        <input type="text" id="postalcode" v-model="formData.postalcode" required placeholder="Adresse postale">
        
        <label for="password">Mot de passe</label>
        <input type="password" id="password" v-model="formData.password" required placeholder="Mot de passe">
        
        <button type="submit">Inscription</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        formData: {
          username: '',
          firstname: '',
          lastname: '',
          email: '',
          phone: '',
          birthdate: '',
          address: '',
          postalcode: '',
          password: ''
        }
      };
    },
    methods: {
      submitForm() {
        console.log(this.formData);
        // Ajouter la logique d'inscription ici (API, validation, etc.)
      }
    }
  };
  </script>
  
  <style scoped>
  h1 {
    font-size: 5em;
    margin-bottom: 0.5em;
    margin-top: 150px;
  }
  p.description {
    font-size: 1.5em;
    margin-bottom: 2em;
  }
  form {
    background-color: white;
    border-radius: 10px;
    border: solid 1px rgb(197, 197, 197);
    flex-direction: column;
    display: flex;
    padding: 50px 30px;
    margin-top: 100px;
  }
  label {
    display: block;
    margin-bottom: 0.5em;
    text-align: left;
  }
  input {
    margin-bottom: 1em;
    border: none;
    border-radius: 5px;
    border: 1px solid grey;
    padding: 10px;
    width: 250px;
    font-size: 18px;
    font-weight: 300;
    color: rgb(174, 174, 174);
  }
  button[type="submit"] {
    background-color: rgb(48, 48, 48);
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 7px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
  }
  button[type="submit"]:hover {
    background-color: rgb(31, 31, 31);
  }
  .main-contact {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
  }
  @media (max-width: 768px) {
    h1 {
      font-size: 3em;
      margin-top: 100px;
    }
    p.description {
      font-size: 1.2em;
      margin-bottom: 1.5em;
    }
    form {
      padding: 30px 20px;
      margin-top: 50px;
    }
    input {
      padding: 10px;
      width: 200px;
      font-size: 16px;
    }
    button {
      font-size: 14px;
      padding: 8px 12px;
    }
  }
  @media (max-width: 480px) {
    h1 {
      font-size: 2em;
      margin-top: 50px;
    }
    p.description {
      font-size: 1em;
      margin-bottom: 1em;
    }
    form {
      padding: 20px 15px;
      margin-top: 30px;
    }
    input {
      padding: 8px;
      width: 90%;
      font-size: 14px;
    }
    button {
      font-size: 12px;
      padding: 6px 10px;
    }
  }
  </style>
  