<template>
    <div>
        <Header/>
      <ReviewPageComponent />
      <Footer/>
    </div>
  </template>
  
  <script>
  import ReviewPageComponent from '@/components/ReviewPageComponent.vue';
  import Footer from '@/components/Footer.vue';
  import Header from '@/components/Header.vue';
  
  export default {
    components: {
      ReviewPageComponent,
      Footer,
      Header,
    },
    mounted() {
      this.$nextTick(() => {
        this.addAnimationClass();
      });
    },
    methods: {
      addAnimationClass() {
        const reviewCards = document.querySelectorAll('.review-card');
        reviewCards.forEach((card, index) => {
          card.classList.add('animate');
        });
  
        const mainReview = document.querySelector('.main-review');
        if (mainReview) {
          mainReview.classList.add('animate');
        }
      }
    }
  };
  </script>
  
  <style scoped>
  /* Inclure ici les styles globaux spécifiques à cette page si nécessaire */
  </style>