<template>
    <section class="banner-wrapper">
      <div class="banner" v-for="(banner, index) in banners" :key="index">
        <div>
          <p>{{ banner.title }}</p>
          <p>{{ banner.message }}</p>
        </div>
        <button>{{ banner.button }}</button>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    data() {
      return {
        banners: [
          { title: 'Titre 1', message: 'Message d\'accueil + CTA 1', button: 'Bouton 1' },
          { title: 'Titre 2 ', message: 'Message d\'accueil + CTA 2', button: 'Bouton 2' },
          { title: 'Titre 2', message: 'Message d\'accueil + CTA 2', button: 'Bouton 2' }
        ]
      }
    },
    mounted() {
      this.startTopBannerAnimation();
    },
    methods: {
      startTopBannerAnimation() {
        const topBanners = this.$el.querySelectorAll('.banner');
        const delay = 3000;
        const animationDuration = 1000;
        
        let currentBannerIndex = 0;
  
        function animate() {
          topBanners.forEach(banner => {
            banner.style.transition = `transform ${animationDuration}ms ease-in-out`;
          });
  
          topBanners.forEach((banner, i) => {
            banner.style.transform = `translateX(${(i - currentBannerIndex) * 100}%)`;
          });
  
          const nextBannerIndex = (currentBannerIndex + 1) % topBanners.length;
  
          setTimeout(() => {
            topBanners.forEach((banner, i) => {
              banner.style.transform = `translateX(${(i - nextBannerIndex) * 100}%)`;
            });
  
            currentBannerIndex = nextBannerIndex;
  
            setTimeout(animate, delay);
          }, animationDuration);
        }
  
        animate();
      }
    }
  }
  </script>
  
  <style scoped>
  

/* Banner top Style */

section {
    margin-top: 69px; 
}

.banner1 {
    background-color: grey;
    position: fixed;
    left: 0;
    height: 300px;
    display: flex;
    flex-direction: column; 
    justify-content: center; 
    align-items: center; 
}

.banner1 div {
    text-align: center;
    margin-bottom: 20px; 
}

.banner1 button {
    margin-top: 10px; 
}

/* Style for Banner transitions */
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
    justify-content: center;
    align-items: center;
    background-color: grey;
    transition: opacity 1s ease-in-out, transform 1s ease-in-out;
}

.banner button {
  background-color: rgb(48, 48, 48);
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 7px;
  font-size: 16px;
  font-weight: 500;
  cursor: pointer;
}



.banner1 { background-color: grey; }
.banner2 { background-color: blue; }
.banner3 { background-color: green; }






  </style>
  