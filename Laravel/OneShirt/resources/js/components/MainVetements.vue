<template>
  <div class="main-vetements">
    <h2>Nos Vêtements</h2>
    <div class="vetements-grid">
      <div class="vetement-card" v-for="vetement in vetements" :key="vetement.id">
        <router-link :to="`/produit/${vetement.id}`" class="vetement-link" style="text-decoration: none; color: black;">
          <img :src="vetement.images[0].image_base64" alt="Vêtement" v-if="vetement.images.length" />
          <h3>{{ vetement.name }}</h3>
          <p>{{ vetement.description }}</p>
          <div>
          <span v-if="vetement.promotion_id">
            <!-- Prix original barré -->
            <span class="original-price" style="text-decoration: line-through;">
              {{ vetement.price }}€
            </span>
            <!-- Prix réduit -->
            <span class="discounted-price">
              {{ calculateDiscountedPrice(vetement.price, vetement.promotion_id) }}€
            </span>
          </span>
          <span v-else>{{ vetement.price }}€ {{ vetement.promotion_id }}</span>
        </div>
        </router-link>
      </div>
    </div>
  </div>
</template>


<script>
import axios from 'axios';

export default {
  data() {
    return {
      vetements: [],
      promotions: [],
    };
  },
  created() {
    this.fetchVetements();
    this.fetchPromotions();
  },
  methods: {
    // Récupère les figurines
    async fetchVetements() {
      try {
        const response = await axios.get('/api/vetements');
        this.vetements = response.data;
        console.log("Vetements:", this.vetements);  // Vérifier les figurines récupérées
      } catch (error) {
        console.error('Erreur lors de la récupération des vetemetns:', error);
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
.main-vetements {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 100px;
}

.vetements-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  padding: 20px;
  margin-top: 70px;
}

.vetement-card {
  border: 1px solid rgb(236, 236, 236);
  padding: 20px;
  border-radius: 10px;
  opacity: 1; 
  transform: translateY(0);
  box-sizing: border-box;
  transition: transform 0.3s ease, box-shadow 0.3s ease; 
  cursor: pointer;
}

.vetement-card:hover {
  transform: scale(1.05); /* Agrandi la carte au survol */
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Ombre de la carte*/
  transition: transform 0.5s ease, box-shadow 0.5s ease; /* Transition de 0.5 seconde */
}

.vetement-card img {
  width: 100%;
  max-width: 100%;
  height: auto;
  transition: max-width 0.3s ease;
}

.vetement-type {
  font-weight: bold; /* Mettre le type en gras */
  margin-top: 10px; /* Espacement au-dessus du type */
}

@media (min-width: 1916px) {
  .vetements-grid {
    grid-template-columns: repeat(3, minmax(400px, 1fr));
  }

  .vetement-card {
    max-width: 500px;
    padding: 30px;
  }

  .vetement-card img {
    max-width: 450px;
  }
}

@media (max-width: 768px) {
  .vetements-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .vetement-card img {
    max-width: 150px;
  }
}

@media (max-width: 480px) {
  .vetements-grid {
    grid-template-columns: 1fr;
  }

  .vetement-card img {
    max-width: 100px;
  }
}
</style>
