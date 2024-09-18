<template>
    <div>
        <Header/>
      <ArticleContent />
      <Footer/>
    </div>
  </template>
  
  <script>
  import ArticleContent from '@/components/ArticleContent.vue';
  import Header from '@/components/Header.vue';
  import Footer from '@/components/Footer.vue';
  
  export default {
    components: {
      ArticleContent,
      Footer,
      Header,
    }
  }
  </script>
  
  <style scoped>
  /* Ajouter des styles spécifiques pour la page d'article ici, si nécessaire */
  </style>
  