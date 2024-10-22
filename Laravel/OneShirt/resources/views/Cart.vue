<template>
    <div>
        <Header/>
      <CartContent />
      <Newsletter/>
      <Footer/>
    </div>
  </template>
  
  <script>
  import CartContent from '@/components/CartContent.vue';
  import Header from '@/components/Header.vue';
  import Footer from '@/components/Footer.vue';
import Newsletter from '@/components/Newsletter.vue';
  
  export default {
    components: {
      CartContent,
      Newsletter,
      Footer,
      Header,
    }
  }
  </script>

  