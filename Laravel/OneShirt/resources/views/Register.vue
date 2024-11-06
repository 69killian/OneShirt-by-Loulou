<template>
    <div>
        <Header/>
        <div class="register-page">
            <RegisterForm />
        </div>
        <Newsletter/>
      <Footer/>
    </div>
  </template>
  
  <script>
  import RegisterForm from '@/components/RegisterForm.vue';
  import Footer from '../js/components/Footer.vue';
  import Header from '../js/components/Header.vue';
  import Newsletter from "@/components/Newsletter.vue";
  
  export default {
    components: {
      RegisterForm,
      Newsletter,
      Footer,
      Header,
    }
  };
  </script>

  <style scoped>
    .register-page {
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
  