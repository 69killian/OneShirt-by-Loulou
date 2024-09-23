<template>
    <Header />
    <div class="contact-page">
      <ContactForm />
    </div>
    <Footer />
  </template>
  
  <script>
  import Header from '@/components/Header.vue';
  import ContactForm from '@/components/ContactForm.vue';
  import Footer from '@/components/Footer.vue';
  
  export default {
    name: 'Connexion',
    components: {
      ContactForm,
      Header,
      Footer,
    },
  };
  </script>
  
  <style scoped>

  .contact-page {
    background-color: grey;
    background-image: url(''); /* Remplace par l'URL de l'image de fond One Piece */
    background-size: contain;
    background-repeat: no-repeat;
    min-height: 100vh; /* Prend toute la hauteur de la page */
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  </style>
  