<template>
    <div>
        <Header/>
      <MainVetements />
      <Newsletter/>
      <Footer/>
    </div>
  </template>
  
  <script>
  import Header from '@/components/Header.vue';
  import Footer from '@/components/Footer.vue';
  import Newsletter from '@/components/Newsletter.vue';
  import MainVetements from '@/components/MainVetements.vue';
  
  export default {
    components: {
      MainVetements,
      Newsletter,
      Footer,
      Header,
    }
  }
  </script>
  
  <style scoped>
  /* Ajouter des styles spécifiques pour la page d'article ici, si nécessaire */
  </style>
  