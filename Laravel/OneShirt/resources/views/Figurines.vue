<template>
    <div>
        <Header/>
      <MainFigurine />
      <Newsletter/>
      <Footer/>
    </div>
  </template>
  
  <script>
  import Header from '@/components/Header.vue';
  import Footer from '@/components/Footer.vue';
  import MainFigurine from '@/components/MainFigurine.vue';
  import Newsletter from '@/components/Newsletter.vue';
  
  export default {
    components: {
      MainFigurine,
      Newsletter,
      Footer,
      Header,
    }
  }
  </script>
  
  <style scoped>
  /* Ajouter des styles spécifiques pour la page d'article ici, si nécessaire */
  </style>
  