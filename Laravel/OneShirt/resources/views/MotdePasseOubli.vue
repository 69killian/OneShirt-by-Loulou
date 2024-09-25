<template>
    <div>
        <Header/>
      <MotdepasseoubliContent />
      <Footer/>
    </div>
  </template>
  
  <script>
  import Header from '@/components/Header.vue';
  import Footer from '@/components/Footer.vue';
  import MotdepasseoubliContent from '../js/components/motdepasseoubliContent.vue';
  
  export default {
    components: {
        MotdepasseoubliContent,
      Footer,
      Header,
    }
  }
  </script>
  
  <style scoped>
  /* Ajouter des styles spécifiques pour la page d'article ici, si nécessaire */
  </style>
  