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
        <div class="bold-footer"><p>Use Cases</p></div>
        <p>UI design</p>
        <p>UX design</p>
        <p>Wireframing</p>
        <p>Diagramming</p>
        <p>Brainstorming</p>
        <p>Online whiteboard</p>
        <p>Team collaboration</p>
      </div>
  
      <div class="footer-explore">
        <div class="bold-footer"><p>Explore</p></div>
        <p>Design</p>
        <p>Prototyping</p>
        <p>Development feature</p>
        <p>Design systems</p>
        <p>Collaboration Features</p>
        <p>Design process</p>
        <p>FigJam</p>
      </div>
  
      <div class="footer-ressources">
        <div class="bold-footer"><p>Ressources</p></div>
        <p>Blog</p>
        <p>Best practices</p>
        <p>Colors</p>
        <p>Color wheel</p>
        <p>Support</p>
        <p>Developpers</p>
        <p>Ressource library</p>
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
  }
  
  /** Styles pour le footer avec animation **/
  .footer.animate {
    opacity: 1; /* Assure que la section est complètement visible */
    transform: translateY(0); /* Réinitialise la position */
    animation: fadeInUp 0.5s ease-out forwards; /* Propriétés de l'animation */
  }
  
  .footer p {
    font-weight: 300;
    color: rgb(116, 116, 116);
    cursor: pointer;
    transition: 0.1s;
    margin-bottom: 30px;
  }
  
  .footer p:hover {
    color: rgb(165, 165, 165);
  }
  
  .bold-footer p {
    font-weight: bold;
    margin-bottom: 30px;
    color: rgb(56, 56, 56);
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
  