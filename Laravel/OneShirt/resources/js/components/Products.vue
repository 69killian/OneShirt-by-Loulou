<template>
  <section class="Products">
    <div class="title-products">
      Embarquez pour une aventure épique avec la boutique OneShirt !
    </div>
    <div class="subheading-products">
      Accompagnez l’équipage du chapeau de paille à retrouvez le mythique trésor que tous les pirates recherchent : le One Piece ! 
    </div>
    <div v-for="(product, index) in limitedProducts" :key="product.id" class="product-item">
      <img :src="product.images[0]?.image_base64" alt="Product Images">
      <p>{{ product.name }}</p>
      <p>{{ product.price }}€</p>
    </div>
    <div style="margin-top: 20px; color: white;">
      ____________________________________________________________
    </div>
    <div class="subheading-products" style="margin-top: 30px;">
      La boutique OneShirt propose un excellent choix de figurines One Piece, de T-Shirts et objets de collection. <br>Que vous soyez un fan du manga ou à la recherche d’un cadeau unique, ces figurines ne manqueront pas de vous étonner ! Découvrez-les maintenant !
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      products: []
    }
  },
  computed: {
    limitedProducts() {
      // Limiter à 4 produits
      return this.products.slice(0, 4);
    }
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await fetch('/api/figurines');
        const data = await response.json();
        this.products = data;
        this.animateProducts();
      } catch (error) {
        console.error("Erreur lors de la récupération des figurines :", error);
      }
    },
    animateProducts() {
      const products = this.$el.querySelectorAll('.product-item');
      products.forEach((product, index) => {
        setTimeout(() => {
          product.style.opacity = '1';
          product.style.transform = 'translateY(0)';
        }, 100 * index);
      });
    }
  }
}
</script>

<style scoped>

.title-products {
  font-size: 40px;
  color: white;
  text-align: center;
}

.subheading-products {
  font-size: 20px;
  color: white;
  text-align: center;
  margin-bottom: 40px;
}


/* Background et style général */
.Products {
  position: relative; /* Nécessaire pour positionner les éléments à l'intérieur */
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  gap: 20px;
  padding: 60px 30px; /* Ajoute du padding pour le contenu */
  background-color: #3C98EF; /* Couleur de fond */
  overflow: hidden; /* Pour cacher les débordements éventuels */
}

.Products::before,
.Products::after {
  content: '';
  position: absolute;
  left: 0;
  right: 0;
  height: 30px; /* Ajuste la hauteur de l'ombre intérieure */
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), transparent); /* Ombre en haut */
}

.Products::before {
  top: 0; /* Positionne l'ombre en haut */
}

.Products::after {
  bottom: 0; /* Positionne l'ombre en bas */
  background: linear-gradient(to top, rgba(0, 0, 0, 0.1), transparent); /* Ombre en bas */
}

/* Animation d'apparition */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Styles des produits */
.product-item {
  border: 1px solid #2a67a1;
  padding: 20px;
  border-radius: 10px;
  background-color: #2f77ba; /* Fond des cartes */
  opacity: 0; /* Opacité initiale pour l'animation */
  transform: translateY(20px); /* Position initiale */
  animation: fadeInUp 0.5s ease-out forwards; /* Animation fadeIn */
  flex: 1 1 300px;
  box-sizing: border-box;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
}

.product-item:hover {
  transform: scale(1.05); /* Agrandir la carte au survol */
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Ajouter une ombre */
  transition: transform 0.5s ease, box-shadow 0.5s ease; /* Transition de 1 seconde */
}

.product-item img {
  width: 100%;
  height: auto;
  max-width: 300px;
  transition: max-width 0.3s ease;
}

.product-item p {
  font-size: 1.2em;
  margin: 10px 0;
  color: #ffffff;
}

.product-item p:first-of-type {
  font-weight: bold;
  color: white; /* Couleur du texte des titres des produits */
}

/* Animation décalée pour chaque produit */
.Products div:nth-child(1) {
  animation-delay: 0.1s;
}
.Products div:nth-child(2) {
  animation-delay: 0.2s;
}
.Products div:nth-child(3) {
  animation-delay: 0.3s;
}
.Products div:nth-child(4) {
  animation-delay: 0.4s;
}

/* Grands écrans */
@media (min-width: 1916px) {
  .product-item {
    flex: 0 1 500px;
    max-width: 550px;
    margin: 10px;
  }
  .product-item img {
    max-width: 550px;
  }
}

/* Écrans moyens */
@media (max-width: 768px) {
  .product-item {
    flex: 1 1 200px;
  }
  .product-item img {
    max-width: 150px;
  }
}

/* Petits écrans */
@media (max-width: 480px) {
  .product-item {
    flex: 1 1 150px;
  }
  .product-item img {
    max-width: 100px;
  }
}
</style>
