<template>
  <!-- Section principale pour afficher les vêtements -->
  <div class="main-vetements">

    <!-- Titre de la section -->
    <h2>Nos Vêtements</h2>

    <!-- Grille des vêtements -->
    <div class="vetements-grid">

      <!-- Carte pour chaque vêtement, lien vers la page produit spécifique -->
      <div class="vetement-card" v-for="vetement in vetements" :key="vetement.id">

        <!-- Lien vers la page du produit -->
        <router-link :to="`/produit/${vetement.id}`" class="vetement-link" style="text-decoration: none; color: black;">
          
          <!-- Affichage de l'image du vêtement si elle existe -->
          <img :src="vetement.images[0].image_base64" alt="Vêtement" v-if="vetement.images.length" />

          <!-- Nom du vêtement -->
          <h3>{{ vetement.name }}</h3>

          <!-- Description du vêtement -->
          <p>{{ vetement.description }}</p>

          <!-- Section affichant le prix avec ou sans promotion -->
          <div>
            <span v-if="vetement.promotion_id">
              <!-- Affichage du prix original barré si une promotion est appliquée -->
              <span class="original-price" style="text-decoration: line-through;">
                {{ vetement.price }}€
              </span>
              <!-- Affichage du prix réduit -->
              <span class="discounted-price">
                {{ calculateDiscountedPrice(vetement.price, vetement.promotion_id) }}€
              </span>
            </span>
            <!-- Affichage du prix sans promotion -->
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
        console.log("Vetements:", this.vetements);  // Vérifie les figurines récupérées
      } catch (error) {
        console.error('Erreur lors de la récupération des vetemetns:', error);
      }
    },
    
    // Récupère les promotions
    async fetchPromotions() {
      try {
        const response = await axios.get('/promotions');
        this.promotions = response.data;
        console.log("Promotions:", this.promotions);  // Vérifie les promotions récupérées
      } catch (error) {
        console.error('Erreur lors de la récupération des promotions:', error);
      }
    },
    
    // Calcul du prix réduit
    calculateDiscountedPrice(originalPrice, promotionId) {
    console.log("Promotion ID:", promotionId); // Vérifie si promotion_id est bien passé
    const promotion = this.promotions.find(promo => promo.id === promotionId);
    console.log("Promotion trouvée:", promotion); // Affiche la promotion trouvée
    if (promotion && promotion.discount_percentage) {
      const discount = (originalPrice * promotion.discount_percentage) / 100;
      console.log("Calcul du prix réduit:", originalPrice - discount);  // Vérifie le calcul du prix réduit
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
