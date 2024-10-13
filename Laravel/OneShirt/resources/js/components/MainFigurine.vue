<template>
    <div class="main-figurines">
      <h2>Nos Figurines</h2>
      <div class="figurines-grid">
        <div class="figurine-card" v-for="figurine in figurines" :key="figurine.id">
          <img :src="figurine.images[0].image_base64" alt="Figurine" v-if="figurine.images.length" />
          <h3>{{ figurine.name }}</h3>
          <p>{{ figurine.description }}</p>
          <p>{{ figurine.price }} €</p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        figurines: [],
      };
    },
    created() {
      this.fetchFigurines();
    },
    methods: {
      async fetchFigurines() {
        try {
          const response = await axios.get('/api/figurines');
          this.figurines = response.data;
        } catch (error) {
          console.error('Erreur lors de la récupération des figurines:', error);
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .main-figurines {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 100px;
  }
  
  .figurines-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    padding: 20px;
    margin-top: 70px;
  }
  
  .figurine-card {
    border: 1px solid rgb(236, 236, 236);
    padding: 20px;
    border-radius: 10px;
    opacity: 1; 
    transform: translateY(0);
    box-sizing: border-box;
    transition: transform 0.3s ease, box-shadow 0.3s ease; 
    cursor: pointer;
  }
  
  .figurine-card:hover {
    transform: scale(1.05); /* Agrandi la carte au survol */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Ombre de la carte*/
    transition: transform 0.5s ease, box-shadow 0.5s ease; /* Transition de 0.5 seconde */
  }
  
  .figurine-card img {
    width: 100%;
    max-width: 100%;
    height: auto;
    transition: max-width 0.3s ease;
  }
  
  @media (min-width: 1916px) {
    .figurines-grid {
      grid-template-columns: repeat(3, minmax(400px, 1fr));
    }
  
    .figurine-card {
      max-width: 500px;
      padding: 30px;
    }
  
    .figurine-card img {
      max-width: 450px;
    }
  }
  
  @media (max-width: 768px) {
    .figurines-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  
    .figurine-card img {
      max-width: 150px;
    }
  }
  
  @media (max-width: 480px) {
    .figurines-grid {
      grid-template-columns: 1fr;
    }
  
    .figurine-card img {
      max-width: 100px;
    }
  }
  </style>
  