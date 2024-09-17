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
          <div v-for="product in products" :key="product.id">
            <img src="../../../public/images/Image.png" alt="" />
            <p>{{ product.name }}</p>
            <p>{{ product.price }}€</p>
          </div>
        </article>
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
          { id: 1, name: 'Nom produit', price: 0 },
          { id: 2, name: 'Text', price: 0 },
          { id: 3, name: 'Text', price: 0 },
          { id: 4, name: 'Text', price: 0 },
          { id: 5, name: 'Text', price: 0 },
          { id: 6, name: 'Text', price: 0 },
        ],
      };
    },
    computed: {
      formattedPrice() {
        return `$${this.price}`;
      }
    },
    methods: {
      updateQuantityValue() {
        // Méthode pour mettre à jour la valeur affichée en fonction du slider
        const quantityValue = document.getElementById('quantity-value');
        quantityValue.textContent = `$${this.price}`;
      }
    }
  };
  </script>
  
  <style scoped>
  /* Incluez ici les styles pour le composant MainCatalog.vue */
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
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.5s ease-out forwards;
    box-sizing: border-box;
    transition: transform 0.3s ease;
  }
  
  .Products div img {
    width: 100%;
    max-width: 100%;
    height: auto;
    transition: max-width 0.3s ease;
  }
  
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
  
  @media (min-width: 1916px) {
    .Products {
      grid-template-columns: repeat(3, minmax(400px, 1fr));
    }
  
    .Products div {
      max-width: 500px;
      padding: 30px;
    }
  
    .Products div img {
      max-width: 450px;
    }
  }
  
  @media (max-width: 768px) {
    .Products {
      grid-template-columns: repeat(2, 1fr);
    }
  
    .Products div img {
      max-width: 150px;
    }
  }
  
  @media (max-width: 480px) {
    .Products {
      grid-template-columns: 1fr;
    }
  
    .Products div img {
      max-width: 100px;
    }
  }
  </style>
  