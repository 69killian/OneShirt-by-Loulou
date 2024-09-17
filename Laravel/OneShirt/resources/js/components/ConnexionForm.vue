<template>
    <div class="main-contact">
      <h1>Connexion</h1>
      <p class="description">Fond d'écran One Piece</p>
  
      <form @submit.prevent="handleSubmit"> 
        <label for="name">Nom d'utilisateur ou Mail</label>
        <input type="text" id="name" name="name" v-model="name" required placeholder="Nom">
  
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" v-model="password" required placeholder="Mot de passe">
        
        <div>J'ai oublié mon mot de passe</div>
        <button type="submit">Connexion</button>
        <div>Nouveau dans l'équipage ?</div>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    name: 'ConnexionForm',
    data() {
      return {
        name: '',
        password: ''
      };
    },
    methods: {
      handleSubmit() {
        // Logique de connexion ici
        console.log('Nom:', this.name, 'Mot de passe:', this.password);
      }
    }
  };
  </script>
  
  <style>
    body {
        margin: 0;
        padding: none;
    }
  
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

form div {
    margin-top: 10px;
    margin-bottom: 10px;
}

label {
    display: block;
    margin-bottom: 0.5em;
    text-align: left;
}
input[type="text"],
input[type="password"],
textarea {
    margin-bottom: 1em;
    border: none;
    border-radius: 5px;
    border: 1px solid grey;
    padding: 10px 200px 10px 10px;
    width: 150px;
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
    font-size: 16px;
}
button[type="submit"]:hover {
    background-color: #218838;
    background-color: rgb(31, 31, 31);
}

.main-contact {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

/* Media Queries pour la Responsivité */
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

    input[type="text"],
    input[type="password"],
    input[type="email"],
    input[type="date"],
    input[type="tel"],
    textarea {
        padding: 10px;
        width: 200px;
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

    p.description {
        font-size: 1em;
        margin-bottom: 1em;
    }

    form {
        padding: 20px 15px;
        margin-top: 30px;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    input[type="date"],
    input[type="tel"],
    textarea {
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
  