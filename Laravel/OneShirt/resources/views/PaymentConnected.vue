<template>
    <div>
      <h1>Procéder au paiement</h1>
      <p class="description">Veuillez vérifier vos informations et compléter les informations de paiement.</p>
      <PaymentConnectedForm />
    </div>
  </template>
  
  <script>
  import PaymentConnectedForm from '@/components/PaymentConnectedForm.vue';
  
  export default {
    name: 'PaymentConnected',
    components: {
      PaymentConnectedForm,
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
  