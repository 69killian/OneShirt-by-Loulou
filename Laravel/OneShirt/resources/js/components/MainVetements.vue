<template>
  <section class="main-catalog">
    <!-- Section Products -->
    <section>
      <article class="Products">
        <router-link
          v-for="product in paginatedProducts"
          :key="product.id"
          :to="'/produit'"
          class="product-card"
          style="text-decoration: none; color: black;"
        >
          <div>
            <img :src="product.image || 'default-placeholder.jpg'" :alt="product.name" />
            <p>{{ product.name }}</p>
            <p>{{ product.price }}€</p>
          </div>
        </router-link>
      </article>

      <!-- Pagination Controls -->
      <article class="pagination">
        <button @click="prevPage" :disabled="currentPage === 1">Précédent</button>
        <span>Page {{ currentPage }} sur {{ totalPages }}</span>
        <button @click="nextPage" :disabled="currentPage === totalPages">Suivant</button>
      </article>
    </section>
  </section>
</template>

<script>
export default {
  data() {
    return {
      products: [
        { id: 1, name: 'T-Shirt Blanc Luffy mignon', price: 129.99, image: '/images/1.webp' },
        { id: 2, name: 'T-shirt Gear 5 Beige', price: 79.99, image: '/images/2.jpg' },
        { id: 3, name: 'T-shirt Gear 5 Noir', price: 224.99, image: '/images/3.jpg' },
        { id: 4, name: 'T-shirt Chapeau de Paille Noir', price: 159.99, image: '/images/4.jpg' },
        { id: 5, name: 'Hoodie Beige Luffy mignon', price: 55, image: '/images/5.jpg' },
        { id: 6, name: 'Hoodie Noir Luffy mignon', price: 87, image: '/images/6.jpg' },
        { id: 7, name: 'Hoodie Gris Luffy mignon', price: 129.99, image: '/images/7.jpg' },
        { id: 8, name: 'Hoodie Noir One Piece japon', price: 79.99, image: '/images/8.jpg' },
        { id: 9, name: 'Hoodie Rose One Piece japon', price: 224.99, image: '/images/9.jpg' },
        { id: 10, name: 'T-shirt Zoro complet', price: 159.99, image: '/images/10.webp' },
        { id: 11, name: 'T-shirt Sabo complet', price: 55, image: '/images/11.jpg' },
        { id: 12, name: 'T-shirt Nami complet', price: 87, image: '/images/12.jpg' },
      ],
      productsPerPage: 6,
      currentPage: 1,
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.products.length / this.productsPerPage);
    },
    paginatedProducts() {
    const start = (this.currentPage - 1) * this.productsPerPage;
    const end = start + this.productsPerPage;
    console.log(this.products.slice(start, end)); // Log pour vérifier les produits paginés
    return this.products.slice(start, end);
  },
  },
  methods: {
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
  },
};
</script>

<style scoped>
.main-catalog {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-top: 100px;
  gap: 150px;
}

.Products {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  padding: 20px;
  margin-top: 70px;
}

.Products div {
  border: 1px solid rgb(236, 236, 236);
  padding: 20px;
  border-radius: 10px;
  opacity: 1; /* l'opacité est à 1 pour que la carte soit visible */
  transform: translateY(0);
  box-sizing: border-box;
  transition: transform 0.3s ease, box-shadow 0.3s ease; /* Ajoute une transition pour l'ombre */
}

.Products div img {
  width: 100%;
  max-width: 100%;
  height: auto;
  transition: max-width 0.3s ease;
}

.product-card:hover div {
  transform: scale(1.05); /* Agrandir la carte au survol */
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Ajouter une ombre */
  transition: transform 0.5s ease, box-shadow 0.5s ease; /* Transition de 0.5 seconde */
}

.pagination {
  margin-top: 20px;
  display: flex;
  justify-content: center;
  gap: 10px;
}

.pagination button {
  padding: 10px 20px;
  background-color: #3C98EF;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-bottom: 50px;
}

.pagination button:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}

.pagination button:hover:not(:disabled) {
  background-color: #0056b3;
}

@media (max-width: 768px) {
  .Products {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 480px) {
  .Products {
    grid-template-columns: 1fr;
  }
}
</style>
