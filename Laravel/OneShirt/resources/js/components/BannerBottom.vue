<template>
  <section class="banner-wrapper">
    <div class="banner" v-for="(banner, index) in banners" :key="index" :class="{ 'fade': index !== currentBannerIndex }" :style="bannerStyles(index)">
      <div class="banner-content">
        
        <h1 v-if="index === 0" class="banner-title">
          OneShirt : Votre destination ultime pour One Piece
        </h1>
        <p v-if="index === 0" class="banner-description">
          OneShirt est votre destination ultime pour plonger dans l'univers fascinant de One Piece. 
          Créée par Loulou pour les véritables fans, notre boutique est entièrement dédiée à cette série emblématique. 
        </p>
        <p class="banner-description">
          Nous vous proposons une vaste sélection de produits qui raviront tous les passionnés de l'univers de Luffy et de ses amis, 
          notamment des figurines incroyables et des vêtements stylés inspirés de One Piece. 
        </p>
        <img v-if="index === 0" src="../../../public/images/ONSHIRT NOIR 11.png" alt="Logo OneShirt" class="banner-logo" />
        <p class="banner-description">
          Découvrez également notre <router-link to="/blog" class="banner-link">blog One Piece</router-link> pour des analyses, des nouvelles et des discussions passionnantes.
        </p>
        <p class="banner-description">
          Consultez nos <router-link to="/figurines" class="banner-link">figurines</router-link> et <router-link to="/vetements" class="banner-link">vêtements</router-link> pour compléter votre collection !
        </p>
      </div>
    </div>

    <button class="arrow left" v-if="canGoLeft" @click="previousBanner">←</button>
    <button class="arrow right" v-if="canGoRight" @click="nextBanner">→</button>
  </section>
</template>

<script>
export default {
  data() {
    return {
      banners: [
        { message: 'Message d\'accueil + CTA 1' }, // La première bannière n'a pas de titre ni de bouton
        { message: 'Message d\'accueil + CTA 2' }
      ],
      currentBannerIndex: 0,
    }
  },
  computed: {
    canGoLeft() {
      return this.currentBannerIndex > 0;
    },
    canGoRight() {
      return this.currentBannerIndex < this.banners.length - 1;
    }
  },
  methods: {
    nextBanner() {
      if (this.canGoRight) {
        this.animateBannerChange(this.currentBannerIndex + 1);
      }
    },
    previousBanner() {
      if (this.canGoLeft) {
        this.animateBannerChange(this.currentBannerIndex - 1);
      }
    },
    animateBannerChange(newIndex) {
      const currentBanner = this.$el.querySelectorAll('.banner')[this.currentBannerIndex];
      currentBanner.style.opacity = 0;

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
      }, 1000);
    },
    bannerStyles(index) {
      const direction = (index < this.currentBannerIndex) ? -20 : 20;
      return {
        transform: `translateX(${index === this.currentBannerIndex ? 0 : direction}px)`,
        transition: 'transform 0.5s ease-in-out, opacity 0.5s ease-in-out',
      };
    }
  }
}
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
  justify-content: center; /* Centrer le contenu verticalement */
  align-items: center;
  background: rgb(255, 255, 255);
  opacity: 1;
  visibility: visible; /* Visible uniquement pour la bannière active */
  pointer-events: auto; /* Permettre les interactions uniquement sur la bannière active */
  transition: opacity 0.5s ease-in-out, visibility 0.5s ease-in-out;
}

.banner.fade {
  opacity: 0;
  visibility: hidden; /* Masquer totalement les éléments non visibles */
  pointer-events: none; /* Désactiver les interactions sur les bannières non visibles */
}

.banner-content {
  text-align: center; /* Centrer le contenu */
  padding: 20px; /* Ajouter de l'espace autour du contenu */
  max-width: 800px; /* Limiter la largeur du contenu pour un meilleur rendu */
}

.banner-logo {
  width: 200px; /* Ajustez la taille du logo selon vos besoins */
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
