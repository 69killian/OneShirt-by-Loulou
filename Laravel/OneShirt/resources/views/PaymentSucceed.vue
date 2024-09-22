<template>
    <div>
      <PaymentSucceedComponent />
      <Footer/>
    </div>
  </template>
  
  <script>
  import PaymentSucceedComponent from '@/components/PaymentSucceedComponent.vue';
  import Footer from '../js/components/Footer.vue';
  
  export default {
    name: 'PaymentConnected',
    components: {
      PaymentSucceedComponent,
      Footer,
    },
  };
  </script>
  
  <style scoped>

  </style>
  