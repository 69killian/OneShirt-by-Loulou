<template>
    <div>
        <Header/>
      <CartContent />
      <Footer/>
    </div>
  </template>
  
  <script>
  import CartContent from '@/components/CartContent.vue';
  import Header from '@/components/Header.vue';
  import Footer from '@/components/Footer.vue';
  
  export default {
    components: {
      CartContent,
      Footer,
      Header,
    }
  }
  </script>
  