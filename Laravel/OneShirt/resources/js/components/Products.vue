<template>
  <section class="Products">
    <div v-for="(product, index) in products" :key="index" class="product-item">
      <img src="../../../public/images/Image.png" alt="Product Images">
      <p>{{ product.text }}</p>
      <p>{{ product.price }}</p>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      products: [
        { text: 'Produit 1', price: '20€' },
        { text: 'Produit 2', price: '25€' },
        { text: 'Produit 3', price: '30€' },
        { text: 'Produit 4', price: '35€' }
      ]
    }
  },
  mounted() {
    this.animateProducts();
  },
  methods: {
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
/* Background et style général */
.Products {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  gap: 20px;
  padding: 20px;
  background-color: #3C98EF; /* Couleur de fond */
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
