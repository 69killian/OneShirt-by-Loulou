<template>
  <div class="main-figurines">
    <h2>Nos Figurines</h2>
    <div class="figurines-grid">
      <router-link
        class="figurine-card"
        v-for="figurine in figurines"
        :key="figurine.id"
        :to="{ name: 'ProductPage', params: { id: figurine.id } }"
        style="color: black; text-decoration: none;"
      >
        <img :src="figurine.images[0].image_base64" alt="Figurine" v-if="figurine.images.length" />
        <h3>{{ figurine.name }}</h3>
        <p>{{ figurine.description }}</p>
        
        <div>
          <span v-if="figurine.promotion_id">
            <!-- Prix original barré -->
            <span class="original-price" style="text-decoration: line-through;">
              {{ figurine.price }}€
            </span>
            <!-- Prix réduit -->
            <span class="discounted-price">
              {{ calculateDiscountedPrice(figurine.price, figurine.promotion_id) }}€
            </span>
          </span>
          <span v-else>{{ figurine.price }}€ {{ figurine.promotion_id }}</span>
        </div>
        
      </router-link>
    </div>
  </div>
</template>



<script>
import axios from 'axios';

export default {
  data() {
    return {
      figurines: [],
      promotions: [],
    };
  },
  created() {
    this.fetchFigurines();
    this.fetchPromotions();
  },
  methods: {
    // Récupère les figurines
    async fetchFigurines() {
      try {
        const response = await axios.get('/api/figurines');
        this.figurines = response.data;
        console.log("Figurines:", this.figurines);  // Vérifier les figurines récupérées
      } catch (error) {
        console.error('Erreur lors de la récupération des figurines:', error);
      }
    },
    
    // Récupère les promotions
    async fetchPromotions() {
      try {
        const response = await axios.get('/promotions');
        this.promotions = response.data;
        console.log("Promotions:", this.promotions);  // Vérifier les promotions récupérées
      } catch (error) {
        console.error('Erreur lors de la récupération des promotions:', error);
      }
    },
    
    // Calcul du prix réduit
    calculateDiscountedPrice(originalPrice, promotionId) {
    console.log("Promotion ID:", promotionId); // Vérifier si promotion_id est bien passé
    const promotion = this.promotions.find(promo => promo.id === promotionId);
    console.log("Promotion trouvée:", promotion); // Afficher la promotion trouvée
    if (promotion && promotion.discount_percentage) {
      const discount = (originalPrice * promotion.discount_percentage) / 100;
      console.log("Calcul du prix réduit:", originalPrice - discount);  // Vérifier le calcul du prix réduit
      return (originalPrice - discount).toFixed(2); // Retourne le prix réduit
    }
    return originalPrice; // Retourne le prix original si aucune promotion
  }
  },
};
</script>


  
  <style scoped>
   .original-price {
  text-decoration: line-through;
  color: gray;
  margin-right: 5px;
}

.discounted-price {
  color: green;
  font-weight: bold;
}
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
  