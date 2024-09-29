<template>
    <section class="main-catalog">
      <!-- Section Todo (Filter & Selections) -->
      <section class="todo-section">
        <div class="todo-item" v-for="item in todoItems" :key="item.id">
          <input type="checkbox" :id="'todo' + item.id" />
          <label :for="'todo' + item.id">{{ item.label }}</label>
          <p>{{ item.description }}</p>
        </div>
  
        <label for="price-slider">Prix :</label>
        <input 
          type="range" 
          id="price-slider" 
          name="price" 
          min="1" 
          max="100" 
          v-model="price" 
          @input="updateQuantityValue"
        />
        <span id="quantity-value">{{ formattedPrice }}</span>
  
        <div class="todo-item" v-for="colorItem in colorItems" :key="colorItem.id">
          <p>{{ colorItem.type }}</p>
          <input type="checkbox" :id="'color' + colorItem.id" />
          <label :for="'color' + colorItem.id">{{ colorItem.label }}</label>
        </div>
  
        <div class="todo-item" v-for="sizeItem in sizeItems" :key="sizeItem.id">
          <p>{{ sizeItem.type }}</p>
          <input type="checkbox" :id="'size' + sizeItem.id" />
          <label :for="'size' + sizeItem.id">{{ sizeItem.label }}</label>
        </div>
      </section>
  
      <!-- Section Products -->
      <section>
        <article class="filters">
          <input class="recherche" type="text" placeholder="Rechercher" />
          <button>Nouveautés</button>
          <button>Prix croissants</button>
          <button>Prix décroissants</button>
          <button>Par Avis</button>
        </article>
        <article class="Products">
  <router-link
    v-for="product in paginatedProducts"
    :key="product.id"
    :to="'/produit/' + product.id" 
    class="product-card"
    style="text-decoration: none; color: black;"
  >
    <div>
      <img :src="product.image" alt="" />
      <p>{{ product.name }}</p>
      <p>{{ product.price }}€</p>
      <p>Description: {{ product.description }}</p> <!-- Afficher la description -->
      <p>Avis: {{ product.reviews }} ★</p> <!-- Afficher les avis -->
      <p>Taille: {{ product.size }}</p> <!-- Afficher la taille -->
    </div>
  </router-link>
</article>

  
        <!-- Pagination Controls -->
        <div class="pagination">
          <button @click="previousPage" :disabled="currentPage === 1">Précédent</button>
          <span>Page {{ currentPage }} sur {{ totalPages }}</span>
          <button @click="nextPage" :disabled="currentPage === totalPages">Suivant</button>
        </div>
      </section>
    </section>
  </template>
  
  <script>
  export default {
    data() {
      return {
        todoItems: [
          { id: 1, label: 'Label', description: 'Description' },
          { id: 2, label: 'Label', description: 'Description' },
          { id: 3, label: 'Label', description: 'Description' },
        ],
        colorItems: [
          { id: 1, type: 'Color', label: 'Label' },
          { id: 2, type: 'Color', label: 'Label' },
          { id: 3, type: 'Color', label: 'Label' },
        ],
        sizeItems: [
          { id: 1, type: 'Size', label: 'Label' },
          { id: 2, type: 'Size', label: 'Label' },
          { id: 3, type: 'Size', label: 'Label' },
        ],
        price: 1,
        products: [
  {
    id: 1,
    name: 'T-Shirt Blanc Luffy mignon',
    price: 129.99,
    image: '/images/1.webp',
    description: 'Un T-shirt blanc avec un design de Luffy.',
    reviews: 4.5,
    productType: 'T-shirt',
    color: 'Blanc',
    size: 'M'
  },
  {
    id: 2,
    name: 'T-shirt Gear 5 Beige',
    price: 79.99,
    image: '/images/2.jpg',
    description: 'T-shirt beige représentant Luffy Gear 5.',
    reviews: 4.7,
    productType: 'T-shirt',
    color: 'Beige',
    size: 'L'
  },
  {
    id: 3,
    name: 'T-shirt Gear 5 Noir',
    price: 224.99,
    image: '/images/3.jpg',
    description: 'T-shirt noir avec un design unique de Gear 5.',
    reviews: 4.8,
    productType: 'T-shirt',
    color: 'Noir',
    size: 'S'
  },
  {
    id: 4,
    name: 'T-shirt Chapeau de Paille Noir',
    price: 159.99,
    image: '/images/4.jpg',
    description: 'T-shirt noir avec le chapeau de paille de Luffy.',
    reviews: 4.6,
    productType: 'T-shirt',
    color: 'Noir',
    size: 'M'
  },
  {
    id: 5,
    name: 'Hoodie Beige Luffy mignon',
    price: 55,
    image: '/images/5.jpg',
    description: 'Un hoodie beige doux avec Luffy.',
    reviews: 4.5,
    productType: 'Hoodie',
    color: 'Beige',
    size: 'L'
  },
  {
    id: 6,
    name: 'Hoodie Noir Luffy mignon',
    price: 87,
    image: '/images/6.jpg',
    description: 'Hoodie noir avec design de Luffy.',
    reviews: 4.7,
    productType: 'Hoodie',
    color: 'Noir',
    size: 'S'
  },
  {
    id: 7,
    name: 'Hoodie Gris Luffy mignon',
    price: 129.99,
    image: '/images/7.jpg',
    description: 'Hoodie gris avec un adorable design de Luffy.',
    reviews: 4.6,
    productType: 'Hoodie',
    color: 'Gris',
    size: 'M'
  },
  {
    id: 8,
    name: 'Hoodie Noir One Piece japon',
    price: 79.99,
    image: '/images/8.jpg',
    description: 'Hoodie noir avec le logo One Piece.',
    reviews: 4.8,
    productType: 'Hoodie',
    color: 'Noir',
    size: 'L'
  },
  {
    id: 9,
    name: 'Hoodie Rose One Piece japon',
    price: 224.99,
    image: '/images/9.jpg',
    description: 'Hoodie rose avec design One Piece.',
    reviews: 4.9,
    productType: 'Hoodie',
    color: 'Rose',
    size: 'S'
  },
  {
    id: 10,
    name: 'T-shirt Zoro complet',
    price: 159.99,
    image: '/images/10.webp',
    description: 'T-shirt complet de Zoro avec son design emblématique.',
    reviews: 4.5,
    productType: 'T-shirt',
    color: 'Vert',
    size: 'M'
  },
  {
    id: 11,
    name: 'T-shirt Sabo complet',
    price: 55,
    image: '/images/11.jpg',
    description: 'T-shirt de Sabo avec son design unique.',
    reviews: 4.7,
    productType: 'T-shirt',
    color: 'Jaune',
    size: 'L'
  },
  {
    id: 12,
    name: 'T-shirt Nami complet',
    price: 87,
    image: '/images/12.jpg',
    description: 'T-shirt de Nami avec son design iconique.',
    reviews: 4.6,
    productType: 'T-shirt',
    color: 'Orange',
    size: 'S'
  },
  {
    id: 13,
    name: 'Luffy vs Kaido Onigashima',
    price: 129.99,
    image: '/images/luffyvskaido.webp',
    description: 'T-shirt représentant la bataille entre Luffy et Kaido.',
    reviews: 4.8,
    productType: 'T-shirt',
    color: 'Multicolore',
    size: 'M'
  },
  {
    id: 14,
    name: 'Luffy Gear 4',
    price: 79.99,
    image: '/images/luffygear4.webp',
    description: 'T-shirt illustrant Luffy en Gear 4.',
    reviews: 4.7,
    productType: 'T-shirt',
    color: 'Noir',
    size: 'L'
  },
  {
    id: 15,
    name: 'Luffy Haki Onigashima',
    price: 224.99,
    image: '/images/luffyhakionigashima.webp',
    description: 'T-shirt de Luffy en Haki sur Onigashima.',
    reviews: 4.9,
    productType: 'T-shirt',
    color: 'Bleu',
    size: 'S'
  },
  {
    id: 16,
    name: 'Zoro Haki Santoryu',
    price: 159.99,
    image: '/images/zorosantoryuhaki.webp',
    description: 'T-shirt de Zoro avec son Haki Santoryu.',
    reviews: 4.8,
    productType: 'T-shirt',
    color: 'Vert',
    size: 'M'
  },
  {
    id: 17,
    name: 'Luffy Gear 5',
    price: 55,
    image: '/images/lffygear5.webp',
    description: 'T-shirt de Luffy en Gear 5.',
    reviews: 4.5,
    productType: 'T-shirt',
    color: 'Blanc',
    size: 'L'
  },
  {
    id: 18,
    name: 'Zoro Arc Wano',
    price: 87,
    image: '/images/zoroarcwano.webp',
    description: 'T-shirt de Zoro pendant l’Arc Wano.',
    reviews: 4.6,
    productType: 'T-shirt',
    color: 'Vert',
    size: 'S'
  }
],

        currentPage: 1,
        itemsPerPage: 6,
      };
    },
    computed: {
      formattedPrice() {
        return `$${this.price}`;
      },
      totalPages() {
        return Math.ceil(this.products.length / this.itemsPerPage);
      },
      paginatedProducts() {
        const start = (this.currentPage - 1) * this.itemsPerPage;
        return this.products.slice(start, start + this.itemsPerPage);
      }
    },
    methods: {
      updateQuantityValue() {
        const quantityValue = document.getElementById('quantity-value');
        quantityValue.textContent = `$${this.price}`;
      },
      nextPage() {
        if (this.currentPage < this.totalPages) {
          this.currentPage++;
        }
      },
      previousPage() {
        if (this.currentPage > 1) {
          this.currentPage--;
        }
      }
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
    transition: transform 0.3s ease;
  }
  
  .Products div img {
    width: 100%;
    max-width: 100%;
    height: auto;
    transition: max-width 0.3s ease;
  }
  
  .Products div:hover {
    transform: scale(1.05);
  }
  
  .pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
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
  </style>
  