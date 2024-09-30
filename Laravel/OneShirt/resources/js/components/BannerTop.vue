<template>
  <section class="banner-wrapper">
    <div 
      :class="['banner', 'banner' + (index + 1)]" 
      v-for="(banner, index) in banners" 
      :key="index"
      @click="redirectToFigurines(index)"
      @mouseover="pauseAnimation; zoomIn($event)"
      @mouseleave="resumeAnimation; zoomOut($event)"
    >
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
    this.startTopBannerAnimation();
  },
  methods: {
    startTopBannerAnimation() {
      const topBanners = this.$el.querySelectorAll('.banner');
      const delay = 3000;
      const animationDuration = 1000;

      const animate = () => {
        topBanners.forEach((banner, i) => {
          banner.style.transition = `transform ${animationDuration}ms ease-in-out`;
          banner.style.transform = `translateX(${(i - this.currentBannerIndex) * 100}%)`;
        });

        this.currentBannerIndex = (this.currentBannerIndex + 1) % topBanners.length;
      };

      animate();
      this.animationInterval = setInterval(animate, delay);
    },
    pauseAnimation() {
      clearInterval(this.animationInterval); // Arrête le défilement
    },
    resumeAnimation() {
      this.startTopBannerAnimation(); // Relance le défilement
    },
    redirectToFigurines(index) {
      // Vérifie si l'index est 2 pour rediriger vers /vetements
      if (index === 2) {
        this.$router.push('/vetements');
      } else {
        this.$router.push('/figurines');
      }
    },
    zoomIn(event) {
      event.target.style.transform = 'scale(1.2)'; // Zoom in
      event.target.style.transition = 'transform 0.5s ease'; // Transition
    },
    zoomOut(event) {
      event.target.style.transform = 'scale(1)'; // Zoom out
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
