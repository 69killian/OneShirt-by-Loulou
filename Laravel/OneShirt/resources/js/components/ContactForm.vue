<template>
    <div class="main-contact">
      <!-- Titre principal du formulaire de contact -->
      <h1>Contactez-Moi</h1>
  
      <!-- Description expliquant le formulaire -->
      <p class="description">
        N'hésitez pas à me laisser un message. Je vous répondrai dans les plus
        brefs délais !
      </p>
  
      <!-- Formulaire de contact -->
      <form @submit.prevent="submitForm">
        
        <!-- Champ pour le nom -->
        <label for="name">Nom</label>
        <input type="text" id="name" v-model="name" required placeholder="Nom" />
  
        <!-- Champ pour le prénom -->
        <label for="surname">Prénom</label>
        <input type="text" id="surname" v-model="surname" required placeholder="Prénom" />
    
        <!-- Champ pour l'email -->
        <label for="email">Email</label>
        <input type="email" id="email" v-model="email" required placeholder="Email" />
    
        <!-- Champ pour le message -->
        <label for="message">Message</label>
        <textarea id="message" v-model="message" rows="4" required placeholder="Ton Message"></textarea>
    
        <!-- Bouton pour soumettre le formulaire -->
        <button type="submit">Soumettre ta Demande</button>
      </form>
    </div>
  </template>
  
  
  <script>
  export default {
    name: "ContactForm",
    
    data() {
      return {
        name: "",
        surname: "",
        email: "",
        message: ""
      };
    },
  
    methods: {
      // Méthode pour soumettre le formulaire de contact
      async submitForm() {
        try {
          // Récupère le token CSRF pour la sécurité
          const csrfToken = this.getCsrfToken();
  
          // Prépare et envoie les données du formulaire via fetch
          const response = await this.sendEmail(csrfToken);
  
          // Si la réponse est OK, affiche un message de succès et réinitialise le formulaire
          if (response.ok) {
            const result = await response.json();
            alert(result.message);
            this.resetForm();
          } else {
            throw new Error("Erreur lors de l'envoi du message");
          }
          
        } catch (error) {
          // Gère les erreurs en affichant un message d'erreur
          alert("Une erreur est survenue lors de l'envoi du message : " + error.message);
        }
      },
  
      // Récupère le token CSRF depuis la page
      getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      },
  
      // Envoie les données du formulaire via une requête POST
      async sendEmail(csrfToken) {
        return fetch("/api/send-email", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
          },
          body: JSON.stringify({
            name: this.name,
            surname: this.surname,
            email: this.email,
            message: this.message
          })
        });
      },
  
      // Réinitialise les champs du formulaire après un envoi réussi
      resetForm() {
        this.name = "";
        this.surname = "";
        this.email = "";
        this.message = "";
      }
    }
  };
  </script>
  
  
  
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
  