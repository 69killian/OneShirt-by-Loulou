<template>
    <div>
        <Footer/>
      <NouveauMotdepasseForm />
        <Header/>
    </div>
  </template>
  
  <script>
  import NouveauMotdepasseForm from '@/components/NouveauMotdepasseForm.vue';
  import Header from '@/components/Header.vue';
  import Footer from '@/components/Footer.vue';
  
  export default {
    components: {
      NouveauMotdepasseForm,
      Header,
      Footer,
    }
  };
  </script>
  