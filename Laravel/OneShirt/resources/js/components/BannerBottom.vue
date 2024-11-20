<template>
  <section class="banner-wrapper">
    <!-- Itération sur les bannières -->
    <div
      v-for="(banner, index) in banners"
      :key="index"
      class="banner"
      :class="{ 'fade': index !== currentBannerIndex }"
      :style="bannerStyles(index)" 
    >
      <div class="banner-content">
        <!-- Contenu spécifique à la première bannière -->
        <h1 v-if="index === 0" class="banner-title">
          OneShirt : Votre destination ultime pour One Piece
        </h1>
        <p v-if="index === 0" class="banner-description">
          OneShirt est votre destination ultime pour plonger dans l'univers fascinant de One Piece. 
          Créée par Loulou pour les véritables fans, notre boutique est entièrement dédiée à cette série emblématique. 
        </p>
        <!-- Description générale pour chaque bannière -->
        <p class="banner-description">
          Nous vous proposons une vaste sélection de produits qui raviront tous les passionnés de l'univers de Luffy et de ses amis, 
          notamment des figurines incroyables et des vêtements stylés inspirés de One Piece. 
        </p>
        <!-- Logo affiché uniquement sur la première bannière -->
        <img
          v-if="index === 0"
          src="../../../public/images/ONSHIRT NOIR 11.png"
          alt="Logo OneShirt"
          class="banner-logo"
        />
        <!-- Liens vers le blog et les produits -->
        <p class="banner-description">
          Découvrez également notre <router-link to="/blog" class="banner-link">blog One Piece</router-link> pour des analyses, des nouvelles et des discussions passionnantes.
        </p>
        <p class="banner-description">
          Consultez nos <router-link to="/figurines" class="banner-link">figurines</router-link> et <router-link to="/vetements" class="banner-link">vêtements</router-link> pour compléter votre collection !
        </p>
      </div>
    </div>

    <!-- Boutons de navigation pour changer de bannière -->
    <button class="arrow left" v-if="canGoLeft" @click="previousBanner">←</button>
    <button class="arrow right" v-if="canGoRight" @click="nextBanner">→</button>
  </section>
</template>


<script>
export default {
  data() {
    return {
      // Contenu des bannières
      banners: [
        { message: 'Message d\'accueil + CTA 1' },
        { message: 'Message d\'accueil + CTA 2' }
      ],
      currentBannerIndex: 0, // Index de la bannière actuelle
    };
  },

  computed: {
    // Vérifie si l'on peut aller à la bannière précédente
    canGoLeft() {
      return this.currentBannerIndex > 0;
    },

    // Vérifie si l'on peut aller à la bannière suivante
    canGoRight() {
      return this.currentBannerIndex < this.banners.length - 1;
    }
  },

  methods: {
    // Passe à la bannière suivante si possible
    nextBanner() {
      if (this.canGoRight) {
        this.animateBannerChange(this.currentBannerIndex + 1);
      }
    },

    // Passe à la bannière précédente si possible
    previousBanner() {
      if (this.canGoLeft) {
        this.animateBannerChange(this.currentBannerIndex - 1);
      }
    },

    /**
     * Gère l'animation de changement de bannière avec une transition de fondu et de déplacement.
     * @param {number} newIndex - L'index de la nouvelle bannière à afficher
     */
    animateBannerChange(newIndex) {
      const currentBanner = this.$el.querySelectorAll('.banner')[this.currentBannerIndex];
      currentBanner.style.opacity = 0;

      // Après une pause pour l'animation, on change de bannière
      setTimeout(() => {
        this.currentBannerIndex = newIndex;
        this.$nextTick(() => {
          this.$el.querySelectorAll('.banner').forEach((banner, index) => {
            if (index === this.currentBannerIndex) {
              banner.style.opacity = 1;
              banner.style.transform = 'translateX(0)';
            }
          });
        });
      }, 1000); // Délai de 1 seconde pour l'animation
    },

    /**
     * Retourne les styles de transformation pour chaque bannière en fonction de son index.
     * @param {number} index - L'index de la bannière
     * @returns {object} Les styles CSS à appliquer
     */
    bannerStyles(index) {
      const direction = (index < this.currentBannerIndex) ? -20 : 20;
      return {
        transform: `translateX(${index === this.currentBannerIndex ? 0 : direction}px)`,
        transition: 'transform 0.5s ease-in-out, opacity 0.5s ease-in-out',
      };
    }
  }
};
</script>



<style scoped>
/* Styles de bannière */

section {
  margin-top: 0px;
  margin-left: 0px;
}

.banner-wrapper {
  position: relative;
  overflow: hidden;
  width: 100vw;
  height: 300px;
}

.banner {
  position: absolute;
  width: 100vw;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center; /* Centre le contenu verticalement */
  align-items: center;
  background: rgb(255, 255, 255);
  opacity: 1;
  visibility: visible; /* Visible uniquement pour la bannière active */
  pointer-events: auto; /* Permet les interactions uniquement sur la bannière active */
  transition: opacity 0.5s ease-in-out, visibility 0.5s ease-in-out;
}

.banner.fade {
  opacity: 0;
  visibility: hidden; /* Masque totalement les éléments non visibles */
  pointer-events: none; /* Désactive les interactions sur les bannières non visibles */
}

.banner-content {
  text-align: center; /* Centre le contenu */
  padding: 20px; /* Ajoute de l'espace autour du contenu */
  max-width: 800px; /* Limite la largeur du contenu pour un meilleur rendu */
}

.banner-logo {
  width: 200px; 
  height: 40px;
  object-fit: cover;
  margin-top: -10px;
}

.banner-title {
  font-size: 2rem; /* Réduit la taille du titre à 2rem */
  font-weight: bold;
  margin-bottom: 20px; /* Espace sous le titre */
  color: black; /* Couleur noire pour le titre */
  text-shadow: none;
  cursor: default; /* Curseur normal pour le texte non-cliquable */
}

.banner-description {
  font-size: 1.2rem; /* Taille du texte */
  line-height: 1.5; /* Hauteur de ligne pour plus de lisibilité */
  margin-bottom: 15px; /* Espace entre les paragraphes */
  cursor: default; /* Curseur normal pour le texte non-cliquable */
}

/* Liens cliquables avec curseur pointer */
.banner-link {
  color: blue;
  text-decoration: none;
  cursor: pointer; /* Curseur pointer pour les liens */
}

.banner-link:hover {
  text-decoration: underline;
}

/* Curseur pointer pour les boutons */
.banner button {
  background-color: rgb(48, 48, 48);
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 7px;
  font-size: 16px;
  font-weight: 500;
  cursor: pointer; /* Le curseur pointer est uniquement sur les boutons */
}

/* Flèches de navigation */
.arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  padding: 10px;
  cursor: pointer;
  font-size: 18px;
  z-index: 10;
}

.arrow.left {
  left: 10px;
}

.arrow.right {
  right: 10px;
}


</style>
