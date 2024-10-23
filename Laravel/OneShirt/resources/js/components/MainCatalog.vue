<template>
    <section class="main-catalog">
      <section class="todo-section">
        <!-- Filtres généraux -->
        <div class="todo-item" v-for="item in todoItems" :key="item.id">
          <input type="checkbox" :id="'todo' + item.id" />
          <label :for="'todo' + item.id">{{ item.label }}</label>
          <p>{{ item.description }}</p>
        </div>
  
        <!-- Filtre de prix -->
        <label for="price-slider">Prix :</label>
        <input 
          type="range" 
          id="price-slider" 
          name="price" 
          min="1" 
          max="1000" 
          v-model="price" 
          @input="updateQuantityValue"
        />
        <span id="quantity-value">{{ formattedPrice }}</span>
  
        <!-- Filtres de couleur -->
        <div class="todo-item" v-for="colorItem in colorItems" :key="colorItem.id">
          <p>{{ colorItem.type }}</p>
          <input 
            type="checkbox" 
            :id="'color' + colorItem.id" 
            v-model="selectedColors"
            :value="colorItem.label"
          />
          <label :for="'color' + colorItem.id">{{ colorItem.label }}</label>
        </div>
  
        <!-- Filtres de taille -->
        <div class="todo-item" v-for="sizeItem in sizeItems" :key="sizeItem.id">
          <p>{{ sizeItem.type }}</p>
          <input 
            type="checkbox" 
            :id="'size' + sizeItem.id" 
            v-model="selectedSizes"
            :value="sizeItem.label"
          />
          <label :for="'size' + sizeItem.id">{{ sizeItem.label }}</label>
        </div>
      </section>
  
      <!-- Section des produits -->
      <section>
        <article class="filters">
          <input class="recherche" type="text" placeholder="Rechercher" v-model="searchQuery" />
          <button @click="sortBy('new')">Nouveautés</button>
          <button @click="sortBy('priceAsc')">Prix croissants</button>
          <button @click="sortBy('priceDesc')">Prix décroissants</button>
          <button @click="sortBy('reviews')">Par Avis</button>
        </article>
        <article class="Products fade-in-up">
        <router-link
          v-for="product in paginatedProducts"
          :key="product.id"
          :to="{ name: 'product-page', params: { id: product.id } }" 
          class="product-card"
          style="text-decoration: none; color: black;"
        >
          <div>
            <img :src="getProductImage(product)" :alt="`Image de ${product.name}`" />
            <p>{{ product.name }}</p>
            <p>{{ product.price }}€</p>
            <p>Description: {{ product.description }}</p>
            <p>Avis: {{ product.reviews ? product.reviews.toFixed(1) : 'N/A' }} ★</p>
            <p>Taille: {{ product.size.join(', ') }}</p>
          </div>
        </router-link>

        </article>
  
        <!-- Contrôles de pagination -->
        <div class="pagination">
          <button @click="previousPage" :disabled="currentPage === 1">Précédent</button>
          <span>Page {{ currentPage }} sur {{ totalPages }}</span>
          <button @click="nextPage" :disabled="currentPage === totalPages">Suivant</button>
        </div>
      </section>
    </section>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        colorItems: [
          { id: 1, type: 'Color', label: 'Blanc' },
          { id: 2, type: 'Color', label: 'Noir' },
          { id: 3, type: 'Color', label: 'Bleu' },
          { id: 5, type: 'Color', label: 'Beige' },
          { id: 6, type: 'Color', label: 'Gris' },
          { id: 7, type: 'Color', label: 'Rose' },
        ],
        sizeItems: [
          { id: 1, type: 'Size', label: 'S' },
          { id: 2, type: 'Size', label: 'M' },
          { id: 3, type: 'Size', label: 'L' },
        ],
        selectedColors: [],
        selectedSizes: [],
        price: 1000,
        products: [],
        currentPage: 1,
        itemsPerPage: 6,
        searchQuery: '',
        sortKey: '',
      };
    },
    computed: {
      formattedPrice() {
        return `${this.price} €`;
      },
      totalPages() {
        return Math.ceil(this.filteredProducts.length / this.itemsPerPage);
      },
      filteredProducts() {
        let filtered = this.products;
  
        // Filtre par recherche
        if (this.searchQuery) {
          const query = this.searchQuery.toLowerCase();
          filtered = filtered.filter(product =>
            product.name.toLowerCase().includes(query) ||
            product.description.toLowerCase().includes(query)
          );
        }
  
        // Filtre par prix
        filtered = filtered.filter(product => product.price <= this.price);
  
        // Filtre par couleur
        if (this.selectedColors.length > 0) {
          filtered = filtered.filter(product => this.selectedColors.includes(product.color));
        }
  
        // Filtre par taille
        if (this.selectedSizes.length > 0) {
          filtered = filtered.filter(product => {
            return product.size.some(size => this.selectedSizes.includes(size));
          });
        }
  
        // Application du Tri
        if (this.sortKey === 'priceAsc') {
          filtered.sort((a, b) => a.price - b.price);
        } else if (this.sortKey === 'priceDesc') {
          filtered.sort((a, b) => b.price - a.price);
        } else if (this.sortKey === 'reviews') {
          filtered.sort((a, b) => (b.reviews || 0) - (a.reviews || 0));
        } else if (this.sortKey === 'new') {
          filtered.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
        }
  
        return filtered;
      },
      paginatedProducts() {
        const start = (this.currentPage - 1) * this.itemsPerPage;
        return this.filteredProducts.slice(start, start + this.itemsPerPage);
      }
    },
    methods: {
      updateQuantityValue() {},
      nextPage() {
        if (this.currentPage < this.totalPages) {
          this.currentPage++;
        }
      },
      previousPage() {
        if (this.currentPage > 1) {
          this.currentPage--;
        }
      },
      fetchProducts() {
        axios.get('/api/products')
          .then(response => {
            this.products = response.data.map(product => {
              product.image = product.images && product.images.length > 0 ? product.images[0].image_base64 : '';
              product.reviews = product.average_reviews;
              product.size = Array.isArray(product.size) && product.size.length > 0 ? product.size : ['N/A'];
              return product;
            });
          })
          .catch(error => {
            console.error('Erreur lors de la récupération des produits:', error);
          });
      },
      getProductImage(product) {
        return product.image || '/images/default.jpg';
      },
      sortBy(key) {
        this.sortKey = key;
        this.currentPage = 1;
      }
    },
    mounted() {
      this.fetchProducts();
    }
  };
  </script>
  
  <style scoped>
  .main-catalog {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: flex-start;
    margin-top: 100px;
    gap: 150px;
  }
  
  .todo-section {
    border: solid 1px rgb(197, 197, 197);
    padding: 40px 50px;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    align-items: start;
    gap: 20px;
    flex: 1;
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
    transform: translateY(20px);
    animation: fadeInUp 0.7s ease-out forwards;
    box-sizing: border-box;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  
  .Products div img {
    width: 100%;
    max-width: 100%;
    height: auto;
    transition: transform 0.3s ease;
  }
  
  .Products div:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
  }
  
  .Products div:hover img {
    transform: scale(1.1);
  }
  
  .product-card {
    color: black;
    text-decoration: none;
  }
  
  
  .pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    margin-bottom: 20px;
  }
  
  .pagination button {
    padding: 10px 20px;
    margin: 0 10px;
    cursor: pointer;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
  }
  
  .pagination button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
  }
  
  .recherche {
    width: 50%;
    padding: 10px;
  }

    @keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
    }

    .fade-in-up {
    animation: fadeInUp 0.7s ease-out forwards;
    }


  </style>
  