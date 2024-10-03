<template>
    <div class="info-livraison">
      <div class="info-item">
        <p>📦Livraison suivie offerte</p>
        <p>Livraison en France entière</p>
      </div>
      <div class="info-item">
        <p>📞Service client français 6/7</p>
        <p>Une question ? contactez-nous</p>
      </div>
      <div class="info-item">
        <p>🔥100% satisfait ou remboursé</p>
        <p>Vous avez 14j pour vous décider</p>
      </div>
      <div class="info-item">
        <p>🔐Paiement 100% sécurisé</p>
        <p>MasterCard / Visa</p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'InfoLivraison',
  }
  </script>
  
  <style scoped>
  
  .info-livraison {
    display: flex;
    justify-content: space-between; /* Espace entre les items */
    flex-direction: row; /* Aligner les div en ligne */
    flex-wrap: wrap; /* Permettre le passage à la ligne si nécessaire */
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
  }
  
  .info-item {
    flex: 1 1 22%; /* Ajuste la largeur des items à 22% avec une marge pour qu'il y ait 4 div en ligne */
    margin: 10px; /* Espace entre les items */
    min-width: 200px; /* Largeur minimale pour que les items ne deviennent pas trop petits */
  }
  
  .info-item p {
    font-size: 1rem;
    line-height: 1.5;
    margin: 0;
    color: #333;
  }
  
  @media (max-width: 768px) {
    .info-livraison {
      flex-direction: column; /* Aligner les div en colonne sur petits écrans */
    }
  
    .info-item {
      width: 100%; /* Pleine largeur sur mobile */
    }
  }
  </style>
  