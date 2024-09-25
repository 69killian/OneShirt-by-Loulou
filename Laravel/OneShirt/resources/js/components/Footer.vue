<template>
    <section class="footer">
      <div class="footer-logos">
        <div class="footer-oneshirt-logo">
          <img src="../../../public/images/ONSHIRT NOIR 11.png" alt="Logo OneShirt" />
        </div>
        <img src="../../../public/images/X Logo.png" alt="X" />
        <img src="../../../public/images/Logo Instagram.png" alt="Instagram" />
        <img src="../../../public/images/Logo YouTube.png" alt="Youtube" />
        <img src="../../../public/images/LinkedIn.png" alt="Linkedin" />
      </div>
  
      <div class="footer-usecases">
        <div class="bold-footer"><p>Administration</p></div>
        <p>CroVex Admin</p>
        <p>Statistiques</p>
        <router-link to="/profil" style="text-decoration: none; color: white;">Mon Profil</router-link>
        <p>Promo</p>
        <p>Fiche Technique</p>
        <p>Discord</p>
        <router-link to="/contact" style="text-decoration: none; color: white;">Team collaboration</router-link>
      </div>
  
      <div class="footer-explore">
        <div class="bold-footer"><p>Explorer</p></div>
        <router-link to="/" style="text-decoration: none; color: white;">Accueil</router-link>
        <router-link to="/catalogue" style="text-decoration: none; color: white;">Catalogue</router-link>
        <router-link to="/connexion" style="text-decoration: none; color: white;">Connexion</router-link>
        <router-link to="/inscription" style="text-decoration: none; color: white;">Inscription</router-link>
        <router-link to="/blog" style="text-decoration: none; color: white;">Blog</router-link>
        <router-link to="/panier" style="text-decoration: none; color: white;">Panier</router-link>
        <router-link to="/faq" style="text-decoration: none; color: white;">Faq</router-link>
      </div>
  
      <div class="footer-ressources">
        <div class="bold-footer"><p>Ressources</p></div>
        <router-link to="/avis" style="text-decoration: none; color: white;">Avis</router-link>
        <a target="_blank" href="https://www.youtube.com/@LoulouLeZouzou" style="text-decoration: none; color: white;">Chaine de Loulou</a>
        <a target="_blank" href="https://www.crunchyroll.com/fr/series/GRMG8ZQZR/one-piece?srsltid=AfmBOop2EGWehl0Lw8r5stIPKQz8XdScsG3_f6-jHR43QrkdUzMoEn7A" style="text-decoration: none; color: white;">One Piece</a>
        <router-link to="/contact" style="text-decoration: none; color: white;">Support</router-link>
        <p>Developpeurs</p>
        <a target="_blank" href="https://fr.wikipedia.org/wiki/One_Piece" style="text-decoration: none; color: white;">Librairie de Ressources</a>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    name: 'Footer',
    mounted() {
      const footer = this.$el;
  
      // Fonction pour vérifier si un élément est visible dans la fenêtre
      const isElementInViewport = (el) => {
        const rect = el.getBoundingClientRect();
        return (
          rect.top < window.innerHeight &&
          rect.bottom > 0
        );
      };
  
      // Fonction pour ajouter les classes d'animation aux éléments visibles
      const handleScroll = () => {
        if (isElementInViewport(footer)) {
          footer.classList.add('animate');
        }
      };
  
      // Écoute l'événement de défilement
      window.addEventListener('scroll', handleScroll);
  
      // Appel initial pour vérifier l'élément au chargement de la page
      handleScroll();
    }
  };
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
  
  /** Styles du footer **/
  .footer {
    display: flex;
    justify-content: space-between;
    padding: 150px 400px 150px 50px;
    font-size: 18px;
    opacity: 0; /* Opacité initiale */
    transform: translateY(20px); /* Position initiale */
    transition: opacity 0.5s ease, transform 0.5s ease; /* Transitions supplémentaires si nécessaire */
    background-color: #3C98EF;
  }
  
  /** Styles pour le footer avec animation **/
  .footer.animate {
    opacity: 1; /* Assure que la section est complètement visible */
    transform: translateY(0); /* Réinitialise la position */
    animation: fadeInUp 0.5s ease-out forwards; /* Propriétés de l'animation */
  }
  .footer p,
.footer a {
  display: block; /* Pour que les router-link se comportent comme des <p> */
  font-weight: 300;
  color: white;
  cursor: pointer;
  transition: 0.1s;
  margin-bottom: 30px;
  text-decoration: none; /* Supprimer les soulignements des liens */
}

.footer p:hover,
.footer a:hover {
  color: rgb(236, 236, 236);
}

.bold-footer p {
  font-weight: bold;
  margin-bottom: 30px;
  color: white;
  pointer-events: none;
}

  
  .footer-oneshirt-logo img {
    height: 50px;
    width: 150px;
    object-fit: cover;
    margin-left: -18px;
  }
  
  /* Pour les petits écrans */
  @media (max-width: 767px) {
    .footer {
      flex-direction: column; /* Empiler les colonnes verticalement */
      align-items: center;
      padding: 20px; /* Ajuster le padding pour les petits écrans */
      font-size: 16px; /* Réduire la taille de la police pour plus d'espace */
    }
  
    .footer-logos {
      margin-bottom: 20px; /* Espacement sous les logos pour séparer des autres sections */
    }
  
    .footer-usecases, .footer-explore, .footer-ressources {
      margin: 0; /* Supprimer les marges latérales */
      text-align: center; /* Centrer le texte pour les petits écrans */
    }
  
    .bold-footer p {
      font-size: 18px; /* Réduire la taille du titre pour les petits écrans */
      margin-bottom: 10px; /* Réduire l'espace sous le titre */
    }
  
    .footer p {
      font-size: 14px; /* Réduire la taille de la police des éléments */
      margin: 5px 0; /* Ajouter un espace vertical entre les éléments */
    }
  }
  </style>
  