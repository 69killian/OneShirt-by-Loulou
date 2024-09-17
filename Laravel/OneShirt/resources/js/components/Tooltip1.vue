<template>
     <div class="tooltip-container">
                <p class="tooltip-target">Boutique</p>
                <div class="tooltip-content">
                    <h2 class="tooltip-heading">Boutique</h2>
                    <div class="tooltip-section">
                        <h3>T-shirt</h3>
                        <p>Découvrez notre gamme de T-shirt</p>
                    </div>
                    <div class="tooltip-section">
                        <h3>Figurines</h3>
                        <p>Les Meilleures figurines aux meilleurs prix !</p>
                    </div>
                    <div class="tooltip-section">
                        <router-link to="/catalog" style="color: black; text-decoration: none; font-size: 1.1em;">Catalogue</router-link>
                        <p>Visualisez tous vos produit préférés One Piece !</p>
                    </div>

                </div>
            </div>
  </template>
  
  <script>
import { RouterLink } from 'vue-router';

  export default {
    data() {
      return {
        visible: false
      };
    }
  };
  </script>
  
  <style scoped>
  .tooltip-container {
    position: relative;
    display: inline-block;
  }
  
  .tooltip-target {
    cursor: pointer;
  }
  
  .tooltip-content {
    visibility: hidden;
    width: 250px;
    background-color: #ffffff;
    color: rgb(166, 166, 166);
    font-weight: 300;
    text-align: left;
    padding: 40px 30px;
    border-radius: 10px;
    position: absolute;
    z-index: 1;
    top: 100%; /* Positionne le tooltip juste en dessous de l'élément cible */
    left: 0;
    opacity: 0;
    transition: opacity 0.3s;
    border: solid 1px rgb(197, 197, 197);
  }
  
  .tooltip-container:hover .tooltip-content {
    visibility: visible;
    opacity: 1;
  }
  
  .tooltip-heading {
    margin: 0;
    font-size: 1.2em;
    color: black;
    font-weight: 400;
    border-bottom: 1px solid #ddd;
    padding-bottom: 5px;
    margin-bottom: 20px;
  }
  
  .tooltip-section {
    margin-bottom: 10px;
  }
  
  .tooltip-section h3 {
    margin: 0;
    font-size: 1.1em;
    color: black;
    font-weight: 300;
    margin-top: 20px;
  }
  
  .tooltip-section p {
    margin: 5px 0;
  }
  </style>
  