<template>
    <div class="main-contact">
        <h1>Connexion</h1>
        
        <form @submit.prevent="handleSubmit">
            <label for="name">Nom d'utilisateur ou Mail</label>
            <input type="text" id="name" v-model="name" required placeholder="Nom">
        
            <label for="password">Mot de passe</label>
            <input type="password" id="password" v-model="password" required placeholder="Mot de passe">
            
            <router-link to="/recuperation" style="margin-bottom: 10px; text-decoration: none;">J'ai oublié mon mot de passe</router-link>
            <button type="submit">Connexion</button>
            <router-link to="/inscription" style="margin-top: 10px; text-decoration: none;">Nouveau dans l'équipage ?</router-link>
        </form>
        
        <p v-if="errorMessage" style="color: red">{{ errorMessage }}</p>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'ConnexionForm',
    data() {
        return {
            name: '',
            password: '',
            errorMessage: null
        };
    },
    methods: {
        async handleSubmit() {
            try {
                const response = await axios.post('/api/login', {
                    name: this.name,
                    password: this.password
                });

                // Si la connexion réussit, stocke l'utilisateur dans le localStorage
                localStorage.setItem('user', JSON.stringify(response.data.user));
                
                console.log('Connexion réussie', response.data);
                this.$router.push('/'); // Redirection vers la page d'accueil

            } catch (error) {
                if (error.response && error.response.status === 401) {
                    this.errorMessage = 'Les informations de connexion sont incorrectes.';
                } else {
                    this.errorMessage = 'Une erreur s\'est produite.';
                }
            }
        }
    }
};
</script>

<style>
/* Style pour le formulaire comme tu l'as déjà défini */
</style>

  
  
  <style scoped>
  .main-contact {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  background-image: url('../../../public/images/luffytete.png');
  background-size: cover; /* L'image couvre toute la surface */
  background-position: center; /* Centre l'image */
  background-repeat: no-repeat; /* Évite de répéter l'image */
  min-height: 100vh; /* S'assure que l'image couvre toute la hauteur de la vue */
  padding: 20px;
}



h1 {
    font-size: 5em;
    margin-bottom: 0.5em;
    margin-top: 150px;
    color: white;
}
p.description {
    font-size: 1.5em;
    margin-bottom: 2em;
    color: white;
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
input[type="text"],
input[type="email"],
textarea {
    margin-bottom: 1em;
    border: none;
    border-radius: 5px;
    border: 1px solid grey;
    padding: 10px 10px 10px 10px;
    width: 290px;
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
  