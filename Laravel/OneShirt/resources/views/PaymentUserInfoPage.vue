<template>
    <div>
      <h1>Procéder au paiement</h1>
      <p class="description">Veuillez vérifier vos informations</p>
      <PaymentUserInfo />
      <Newsletter style="display: none;"/>
    </div>
  </template>
  
  <script>
  import Newsletter from '@/components/Newsletter.vue';
import PaymentUserInfo from '@/components/PaymentUserInfo.vue';
  
  export default {
    name: 'PaymentConnected',
    components: {
      PaymentUserInfo,
      Newsletter,
    },
  };
  </script>
  
  <style scoped>
  h1 {
    text-align: center;
  }
  p {
    text-align: center;
  }
  </style>
  