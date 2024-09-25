<template>
  <div class="main-contact">
    <h1>Récupération de ton Mot de Passe</h1>

    <form @submit.prevent="handlePasswordReset"> 
      <label for="email">Fournis ton adresse e-mail</label>
      <input 
        type="email" 
        id="email" 
        name="email" 
        v-model="email" 
        required 
        placeholder="Adresse e-mail"
      />

      <button type="submit">Envoyer le lien de réinitialisation</button>
      <router-link to="/inscription" style="margin-top: 10px;">Nouveau dans l'équipage ?</router-link>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: ''
    };
  },
  methods: {
    handlePasswordReset() {
      // Logique de réinitialisation du mot de passe (par exemple via une API)
      console.log('Réinitialisation demandée pour :', this.email);
      // Appel à l'API de récupération de mot de passe à ajouter ici
    }
  }
};
</script>

<style scoped>
body {
  margin: 0;
  padding: 0;
}

h1 {
  font-size: 5em;
  margin-bottom: 0.5em;
  margin-top: 150px;
  color: white;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
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

input[type="email"] {
  margin-bottom: 1em;
  border: none;
  border-radius: 5px;
  border: 1px solid grey;
  padding: 10px;
  width: 100%;
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
  background-image: url('../../../public/images/equipage.webp'); 
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  min-height: 100vh;
  padding-bottom: 70px;
}

/* Media Queries pour la Responsivité */
@media (max-width: 768px) {
  h1 {
    font-size: 3em;
    margin-top: 100px;
  }

  form {
    padding: 30px 20px;
    margin-top: 50px;
  }

  input[type="email"] {
    padding: 10px;
    width: 100%;
    font-size: 16px;
  }

  button[type="submit"] {
    font-size: 14px;
    padding: 8px 12px;
  }
}

@media (max-width: 480px) {
  h1 {
    font-size: 2em;
    margin-top: 150px;
  }

  form {
    padding: 20px 15px;
    margin-top: 30px;
  }

  input[type="email"] {
    padding: 8px;
    width: 90%;
    font-size: 14px;
  }

  button[type="submit"] {
    font-size: 12px;
    padding: 6px 10px;
  }
}
</style>
