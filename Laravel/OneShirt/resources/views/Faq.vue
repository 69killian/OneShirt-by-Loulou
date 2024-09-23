<template>
    <div>
      <Header />
      <FaqComponent />
      <Newsletter/>
      <Footer />
    </div>
  </template>
  
  <script>
  import FaqComponent from '@/components/FaqComponent.vue';
  import Header from '@/components/Header.vue';
  import Footer from '@/components/Footer.vue';
  import Newsletter from '@/components/Newsletter.vue';
  
  export default {
    components: {
      FaqComponent,
      Footer,
      Header,
      Newsletter,
    },
  };
  </script>
  
  <style scoped>
  
  </style>
  