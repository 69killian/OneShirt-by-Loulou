<template>
    <div>
      <PaymentErrorComponent />
      <Footer/>
    </div>
  </template>
  
  <script>
  import PaymentErrorComponent from '@/components/PaymentErrorComponent.vue';
  import Footer from '../js/components/Footer.vue';
  
  export default {
    name: 'PaymentConnected',
    components: {
      PaymentErrorComponent,
      Footer,
    },
  };
  </script>
  
  <style scoped>

  </style>
  