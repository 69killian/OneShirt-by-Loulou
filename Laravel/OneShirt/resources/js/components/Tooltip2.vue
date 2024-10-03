<template>
     <!-- Tooltip About -->
     <div class="tooltip-container-about">
                <p class="tooltip-target-about">À Propos</p>
                <div class="tooltip-content-about">
                    <h2 class="tooltip-heading-about">À Propos</h2>
                    <div class="tooltip-section-about">
                        <router-link to="/faq" style="color: white; text-decoration: none; font-size: 1.1em;">FAQ</router-link>
                        <p>Je réponds à toutes vos questions !</p>
                    </div>
                    <div class="tooltip-section-about">
                        <router-link to="/avis" style="color: white; text-decoration: none; font-size: 1.1em;">Avis vérifiés</router-link>
                        <p>Tous les avis du site</p>
                    </div>
                    <div class="tooltip-section-about">
                    <!-- Redirection conditionnelle -->
                    <p @click="redirectToProfileOrLogin" style="color: white; cursor: pointer; font-size: 1.1em;">Mon profil</p>
                    <p>Accédez à votre profil ou connectez-vous</p>
                </div>
                </div>
            </div>
  </template>

  <script>
  export default {
    data() {
      return {
        isConnected: true // Simule si l'utilisateur est connecté ou non
      };
    },
    methods: {
      redirectToProfileOrLogin() {
        if (this.isConnected) {
          this.$router.push('/profil'); // Redirige vers la page profil si connecté
        } else {
          this.$router.push('/connexion'); // Redirige vers la page de connexion sinon
        }
      }
    }
  };
  </script>

  <style scoped>



/** Tooltip À Propos **/
.tooltip-container-about {
    position: relative;
    display: inline-block;
}

.tooltip-target-about {
    cursor: pointer;
}

.tooltip-content-about {
    visibility: hidden;
    width: 250px;
    background-color: #36175e;
    color: rgb(166, 166, 166);
    font-weight: 300;
    text-align: left;
    padding: 40px 30px;
    border-radius: 10px;
    position: absolute;
    z-index: 1;
    top: 100%; /* Positionne le tooltip juste en dessous de l'élément cible */
    left: -85px;
    opacity: 0;
    transition: opacity 0.3s;
    border: solid 1px rgb(197, 197, 197);
}

.tooltip-container-about:hover .tooltip-content-about {
    visibility: visible;
    opacity: 1;
}

.tooltip-heading-about {
    margin: 0;
    font-size: 1.2em;
    color: white;
    font-weight: 400; /* Augmente la graisse de la police pour le heading */
    border-bottom: 1px solid #ddd; /* Ajoute une ligne sous le heading */
    padding-bottom: 5px;
    margin-bottom: 20px;
}

.tooltip-section-about {
    margin-bottom: 10px;
}

.tooltip-section-about h3 {
    margin: 0;
    font-size: 1.1em;
    color: black;
    font-weight: 300;
    margin-top: 20px;
}

.tooltip-section-about p {
    margin: 5px 0;
}

  </style>
  