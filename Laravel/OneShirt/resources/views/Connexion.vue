<template>
    <Header />
    <div class="connexion-page">
      <ConnexionForm />
    </div>
    <!-- Footer placé en dehors de .connexion-page -->
    <Footer />
  </template>
  
  <script>
  import Header from '@/components/Header.vue';
  import ConnexionForm from '@/components/ConnexionForm.vue';
  import Footer from '@/components/Footer.vue';
  
  export default {
    name: 'Connexion',
    components: {
      ConnexionForm,
      Header,
      Footer,
    },
  };
  </script>
  
  <style scoped>

  .connexion-page {
    background-color: grey;
    background-image: url(''); /* Remplace par l'URL de l'image de fond One Piece */
    background-size: contain;
    background-repeat: no-repeat;
    min-height: 100vh; /* Prend toute la hauteur de la page */
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding-bottom: 150px;
  }
  </style>
  