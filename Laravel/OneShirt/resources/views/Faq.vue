<template>
    <div>
      <Header />
      <div class="title-FAQ">
        <h1>Foire Aux Questions (FAQ)</h1>
      </div>
      <FaqComponent />
      <Footer />
    </div>
  </template>
  
  <script>
  import FaqComponent from '@/components/FaqComponent.vue';
  import Header from '@/components/Header.vue';
  import Footer from '@/components/Footer.vue';
  
  export default {
    components: {
      FaqComponent,
      Footer,
      Header,
    },
  };
  </script>
  
  <style scoped>
  .title-FAQ {
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    background-color: #d2d2d2; /* Mettre un fond d'écran One Piece */
    padding: 250px; 
    margin: 0px 0 0 0;
    text-align: center;
  }
  
  .title-FAQ h1 {
    font-size: 40px;
  }
  
  /* Pour les écrans de
  
  taille moyenne */ @media (max-width: 1024px) { .title-FAQ h1 { font-size: 30px; } .title-FAQ { padding: 40px; } }
  
  /* Pour les écrans de petite taille */ @media (max-width: 768px) { .title-FAQ h1 { font-size: 24px; } .title-FAQ { padding: 30px; } }
  
  /* Pour les très petits écrans */ @media (max-width: 480px) { .title-FAQ h1 { font-size: 20px; } .title-FAQ { padding: 20px; } } </style>