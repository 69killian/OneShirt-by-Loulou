<template>
    <section class="main-catalog">
      <!-- Section Products -->
      <section>
        
        <article class="Products">
          <router-link
            v-for="product in products"
            :key="product.id"
            :to="'/produit'"
            class="product-card"
            style="text-decoration: none; color: black;"
          >
            <div>
              <img :src="product.image" :alt="product.name" />
              <p>{{ product.name }}</p>
              <p>{{ product.price }}€</p>
            </div>
          </router-link>
        </article>
      </section>
    </section>
  </template>
  
  <script>
  export default {
    data() {
      return {
        products: [
  { id: 1, name: 'Luffy vs Kaido Onigashima', price: 129.99, image: '/images/luffyvskaido.webp' },
  { id: 2, name: 'Luffy Gear 4', price: 79.99, image: '/images/luffygear4.webp' },
  { id: 3, name: 'Luffy Haki Onigashima', price: 224.99, image: '/images/luffyhakionigashima.webp' },
  { id: 4, name: 'Zoro Haki Santoryu', price: 159.99, image: '/images/zorosantoryuhaki.webp' },
  { id: 5, name: 'Luffy Gear 5', price: 55, image: '/images/lffygear5.webp' },
  { id: 6, name: 'Zoro Arc Wano', price: 87, image: '/images/zoroarcwano.webp' },
],

      };
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
  
  .product-card:hover div {
    transform: scale(1.05); /* Agrandir la carte au survol */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Ajouter une ombre */
    transition: transform 0.5s ease, box-shadow 0.5s ease; /* Transition de 1 seconde */
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
  