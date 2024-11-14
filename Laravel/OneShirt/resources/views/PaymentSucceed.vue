<template>
    <div>
      <PaymentSucceedComponent />
      <Newsletter style="display: none;"/>
      <Footer/>
    </div>
  </template>
  
  <script>
  import PaymentSucceedComponent from '@/components/PaymentSucceedComponent.vue';
  import Footer from '../js/components/Footer.vue';
  import Newsletter from '@/components/Newsletter.vue';
  
  export default {
    name: 'PaymentConnected',
    components: {
      PaymentSucceedComponent,
      Newsletter,
      Footer,
    },
  };
  </script>
  
  <style scoped>

  </style>
  