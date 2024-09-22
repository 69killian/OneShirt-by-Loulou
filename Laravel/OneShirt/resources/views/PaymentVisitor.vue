<template>
    <div>
      <h1>Procéder au paiement</h1>
      <p class="description">Veuillez vérifier vos informations et compléter les informations de paiement.</p>
      <PaymentVisitorForm />
    </div>
  </template>
  
  <script>
  import PaymentVisitorForm from '@/components/PaymentVisitorForm.vue';
  
  export default {
    name: 'PaymentVisitor',
    components: {
      PaymentVisitorForm,
    },
  };
  </script>
  
  <style scoped>
  h1 {
    font-size: 5em;
    margin-bottom: 0.5em;
    margin-top: 150px;
    text-align: center;
  }
  
  p.description {
    font-size: 1.5em;
    margin-bottom: 2em;
    text-align: center;
  }
  
  @media (max-width: 768px) {
    h1 {
      font-size: 3em;
      margin-top: 100px;
    }
  
    p.description {
      font-size: 1.2em;
      margin-bottom: 1.5em;
      text-align: center;
    }
  }
  
  @media (max-width: 480px) {
    h1 {
      font-size: 2em;
      margin-top: 50px;
    }
  
    p.description {
      font-size: 1em;
      margin-bottom: 1em;
    }
  }
  </style>
  