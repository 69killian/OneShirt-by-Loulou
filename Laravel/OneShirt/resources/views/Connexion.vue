<template>
    <Header />
    <div class="connexion-page">
      <ConnexionForm />
      <Newsletter/>
    </div>
    <Footer />
  </template>
  
  <script>
  import Header from '@/components/Header.vue';
  import ConnexionForm from '@/components/ConnexionForm.vue';
  import Footer from '@/components/Footer.vue';
  import Newsletter from '@/components/Newsletter.vue';
  
  export default {
    name: 'Connexion',
    components: {
      ConnexionForm,
      Newsletter,
      Header,
      Footer,
    },
  };
  </script>
  
  <style scoped>

  .connexion-page {
    background-color: grey;
    background-image: url(''); 
    background-size: contain;
    background-repeat: no-repeat;
    min-height: 100vh; /* Prend toute la hauteur de la page */
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  </style>
  