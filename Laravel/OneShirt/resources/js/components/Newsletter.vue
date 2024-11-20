<template>
  <!-- Section principale pour la newsletter -->
  <section class="section-newsletter">

    <!-- Formulaire d'inscription à la newsletter -->
    <form class="form-subscription" action="">
      
      <!-- Label pour l'email -->
      <label class="email-label" for="email">Email</label>

      <!-- Champ de saisie pour l'adresse email -->
      <input 
        class="email-input" 
        type="text" 
        name="Email" 
        id="Email" 
        placeholder="Entrez votre adresse Mail" 
      />

      <!-- Bouton pour soumettre l'inscription à la newsletter -->
      <button class="email-submit-button" type="submit">S'inscrire à la newsletter</button>
    </form>

    <!-- Première section d'information pour l'abonnement -->
    <div class="Pros-subscription">
      <div>
        <!-- Titre de la section "Suis nous par mail" -->
        <p class="title-pros">Suis nous par mail</p>
      </div>
      <!-- Description de l'abonnement par mail -->
      <p>Reçois des mails de qualité sur One Piece:<br> News, Articles, Promos sur ton univers préféré</p>
    </div>

    <!-- Deuxième section d'information pour l'abonnement -->
    <div class="Pros-subscription">
      <div>
        <!-- Titre de la section "Fini les oublis" -->
        <p class="title-pros">Fini les oublis</p>
      </div>
      <!-- Description pour ne pas manquer les nouveautés -->
      <p>Ne rate plus aucune occasion sur les<br> nouveautés OneShirt !</p>
    </div>

  </section>
</template>

  
<script>
export default {
  // Cette méthode est appelée après que le composant soit monté dans le DOM
  mounted() {
    // Appel de handleScroll pour vérifier immédiatement si la section est visible
    this.handleScroll();
    
    // Ajout d'un écouteur d'événement de défilement pour déclencher handleScroll à chaque scroll
    window.addEventListener('scroll', this.handleScroll);
  },

  // Cette méthode est appelée avant que le composant soit détruit du DOM
  beforeDestroy() {
    // Retrait de l'écouteur d'événement de défilement avant la destruction du composant
    window.removeEventListener('scroll', this.handleScroll);
  },

  methods: {
    // Fonction de gestion du défilement
    handleScroll() {
      // Sélection de la section de la newsletter
      const sectionNewsletter = document.querySelector('.section-newsletter');
      
      // Vérification si la section est dans la fenêtre de visualisation
      if (this.isElementInViewport(sectionNewsletter)) {
        // Si la section est visible, ajout de la classe 'animate'
        sectionNewsletter.classList.add('animate');
      }
    },

    // Fonction pour vérifier si un élément est visible dans la fenêtre du navigateur
    isElementInViewport(el) {
      // Récupération des coordonnées de l'élément
      const rect = el.getBoundingClientRect();
      
      // Vérification si l'élément est visible dans la fenêtre
      return (
        rect.top < window.innerHeight &&
        rect.bottom > 0
      );
    }
  }
}
</script>

  
  <style scoped>
  @keyframes fadeInUp {
      from {
          opacity: 0;
          transform: translateY(20px);
      }
      to {
          opacity: 1;
          transform: translateY(0);
      }
  }
  
  /* Styles pour la section Newsletter avec animation */
  .section-newsletter.animate {
      opacity: 1; /* Assure que la section est complètement visible */
      transform: translateY(0); /* Réinitialise la position */
      animation: fadeInUp 0.5s ease-out forwards; /* Propriétés de l'animation */
  }
  .section-newsletter {
    display: flex;
    align-items: stretch; /* Alignement étiré pour égaliser les hauteurs */
    justify-content: space-between;
    margin-top: 0px;
    background-color: white;
    margin-bottom: 0px;
    opacity: 0; /* Opacité initiale */
    transform: translateY(20px); /* Position initiale */
    transition: opacity 0.5s ease, transform 0.5s ease; /* Transitions supplémentaires si nécessaire */
}

.form-subscription,
.Pros-subscription {
    width: 100%; /* Même largeur pour le formulaire et les cartes */
    display: flex;
    flex-direction: column;
    align-items: center;
    font-weight: 300;
    border: solid 1px rgb(197, 197, 197);
    border-radius: 5px;
    padding: 50px; /* Ajustement des marges et paddings pour uniformité */
    box-sizing: border-box; /* Pour inclure le padding dans la largeur totale */
    position: relative;
    flex-grow: 1; /* Assure que toutes les sections prennent la même hauteur */
    min-height: 100%; /* S'assurer que la section remplit toujours tout l'espace disponible */
}

.email-input {
    width: 100%; /* Remplir toute la largeur du conteneur */
    padding: 12px;
    border: solid 1px rgb(197, 197, 197);
    border-radius: 5px;
    margin-bottom: 30px;
    box-sizing: border-box; /* Inclure le padding dans la largeur totale */
}

.email-label {
    position: absolute;
    top: 25px; /* Ajustement de la position du label */
    left: 36px; /* Ajustement de la position du label */
}

.email-submit-button {
    background-color: rgb(48, 48, 48);
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 7px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    width: 100%; /* Assurer que le bouton occupe toute la largeur */
}

.Pros-subscription {
    justify-content: center; /* Centrer le contenu des cartes */
    position: relative;
    color: rgb(56, 56, 56);
    padding: 50px;
}

.Pros-subscription div {
    position: absolute;
    top: 0;
    left: 155px;
}

.title-pros {
    font-weight: 500;
    font-size: 30px;
    color: black;
}

/* Pour les grands écrans */
@media (min-width: 768px) {
    .section-newsletter {
        flex-direction: row; /* Disposition en ligne pour les grands écrans */
        justify-content: space-between;
    }

    .form-subscription, .Pros-subscription {
        width: 48%; /* Ajuster la largeur pour les écrans plus grands */
        margin: 0;
        padding: 50px;
        box-sizing: border-box; /* Assurer que le padding est pris en compte */
    }
}

/* Pour les petits écrans */
@media (max-width: 767px) {
    .form-subscription,
    .Pros-subscription {
        width: 100%; /* Utiliser toute la largeur disponible */
        margin: 0; /* Enlever les marges latérales */
        padding: 20px; /* Réduire le padding pour les petits écrans */
    }

    .email-label {
        position: static; /* Réinitialiser la position pour les petits écrans */
        margin-bottom: 10px; /* Ajouter un espace en bas du label */
    }

    .email-input {
        width: 100%; /* Assurer que l'input occupe toute la largeur du conteneur */
        margin-bottom: 20px; /* Réduire l'espace en bas de l'input */
    }

    .email-submit-button {
        width: 100%; /* Faire en sorte que le bouton prenne toute la largeur */
        padding: 12px; /* Ajuster le padding pour les petits écrans */
    }

    .title-pros {
        font-size: 24px; /* Réduire la taille de la police pour les petits écrans */
    }

    .Pros-subscription {
        position: static; /* Réinitialiser la position pour les petits écrans */
        padding: 20px; /* Réduire le padding pour les petits écrans */
    }
}

  </style>
  