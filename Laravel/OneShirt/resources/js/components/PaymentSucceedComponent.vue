<template>
  <div class="error-container">
    <div class="title-success">
      <h1>Félicitations Pirate !</h1>
      <p class="description">Ta commande sera enregistrée et tu seras redirigé vers la page d'accueil.</p>
    </div>
  </div>
</template>

  <script>
export default {
  mounted() {

    // Rediriger vers la page d'accueil après un délai de 3 secondes
    setTimeout(() => {
      this.$router.push('/');
    }, 5000);
  },
  methods: {
  
  }
}
</script>

  
  <style scoped>
  body {
    font-family: "Roboto", sans-serif;
    font-weight: 400;
    font-style: normal;
    background-image: url(''); /* Remplacez par l'URL de l'image de fond One Piece */
    background-color: rgb(243, 243, 243);
    background-size: contain;
    background-repeat: no-repeat;
    color: black;
    text-align: center;
    margin: 0;
  }
  
  .error-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh; /* Prend toute la hauteur de la fenêtre */
  }
  
  .title-success {
    margin-top: 20px;
  }
  
  .description {
    font-size: 1.2em;
    margin-top: 10px;
    text-align: center;
  }
  </style>
  