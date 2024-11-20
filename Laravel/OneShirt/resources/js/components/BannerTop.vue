<template>
  <section class="banner-wrapper">
    <!-- Boucle sur chaque bannière et affiche-les -->
    <div
      v-for="(banner, index) in banners"
      :key="index"
      :class="['banner', `banner${index + 1}`]" 
      @click="redirectToFigurines(index)" 
      @mouseover="handleMouseOver" 
      @mouseleave="handleMouseLeave"
    >
      <!-- Vous pouvez ajouter des contenus à l'intérieur des divs, comme des images ou des textes -->
    </div>
  </section>
</template>


<script>
export default {
  data() {
    return {
      banners: [
        { title: 'Titre 1' },
        { title: 'Titre 2' },
        { title: 'Titre 3' }
      ],
      currentBannerIndex: 0,
      animationInterval: null,
    };
  },
  mounted() {
    this.demarrerAnimationBanniere();
  },
  methods: {
    // Démarre l'animation des bannières
    demarrerAnimationBanniere() {
      const bannières = this.$el.querySelectorAll('.banner');
      const délai = 3000;
      const duréeAnimation = 1000;

      const animer = () => {
        bannières.forEach((bannière, i) => {
          bannière.style.transition = `transform ${duréeAnimation}ms ease-in-out`;
          bannière.style.transform = `translateX(${(i - this.currentBannerIndex) * 100}%)`;
        });

        this.currentBannerIndex = (this.currentBannerIndex + 1) % bannières.length;
      };

      animer();
      this.animationInterval = setInterval(animer, délai);
    },

    // Arrête l'animation au survol
    pauseAnimation() {
      clearInterval(this.animationInterval);
    },

    // Relance l'animation après le survol
    resumeAnimation() {
      this.demarrerAnimationBanniere();
    },

    // Gère l'événement du survol (zoom avant)
    handleMouseOver(event) {
      this.pauseAnimation();
      this.zoomIn(event);
    },

    // Gère l'événement de sortie du survol (zoom arrière)
    handleMouseLeave(event) {
      this.resumeAnimation();
      this.zoomOut(event);
    },

    // Redirige vers les figurines ou vêtements
    redirectToFigurines(index) {
      if (index === 2) {
        this.$router.push('/vetements');
      } else {
        this.$router.push('/figurines');
      }
    },

    // Zoom avant
    zoomIn(event) {
      event.target.style.transform = 'scale(1.2)'; // Zoom avant
      event.target.style.transition = 'transform 0.5s ease'; // Transition
    },

    // Zoom arrière
    zoomOut(event) {
      event.target.style.transform = 'scale(1)'; // Zoom arrière
      event.target.style.transition = 'transform 0.5s ease'; // Transition
    },
  },
};
</script>


<style scoped>
/* Style général */
section {
  margin-top: 69px;
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
  justify-content: center;
  align-items: center;
  background-color: #ccc;
  cursor: pointer;
}

/* Ajoute les images de fond pour chaque bannière */
.banner1 {
  background-image: url('/images/banniere1-2.png');
  background-size: cover;
  background-position: center;
}

.banner2 {
  background-image: url('/images/banniere2-2.png');
  background-size: cover;
  background-position: center;
}

.banner3 {
  background-image: url('/images/banniere3.png');
  background-size: cover;
  background-position: center;
}
</style>
