<template>
    <section class="Products">
      <div v-for="(product, index) in products" :key="index" class="product-item">
        <img src="../../../public/images/Image.png" alt="">
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
          { text: 'text', price: '0€' },
          { text: 'text', price: '0€' },
          { text: 'text', price: '0€' },
          { text: 'text', price: '0€' }
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
  
/*Products Style */

.Products {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap; /* Permet aux cartes de se réorganiser si nécessaire */
    gap: 20px; /* Espacement entre les cartes */
    padding: 20px;
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

/* Appliquer l'animation aux éléments des produits */
.Products div {
    border: 1px solid rgb(236, 236, 236);
    padding: 20px;
    border-radius: 10px;
    opacity: 0; /* Opacité initiale */
    transform: translateY(20px); /* Position initiale */
    animation: fadeInUp 0.5s ease-out forwards; /* Propriétés de l'animation */
    flex: 1 1 300px; /* Flex-grow, flex-shrink, flex-basis: La carte occupe 300px par défaut */
    box-sizing: border-box; /* Inclure padding et border dans la taille totale */
    transition: flex-basis 0.3s ease; /* Animation de transition pour la taille */
}

.Products div img {
    width: 100%; /* L'image prend toute la largeur disponible de la carte */
    max-width: 100%; /* Largeur maximale initiale de l'image */
    height: auto; /* Hauteur automatique pour conserver le ratio */
    transition: max-width 0.3s ease; /* Transition pour la taille de l'image */
}

/* Délai d'animation pour chaque élément */
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

@media (min-width: 1916px) {
    .Products div {
        flex: 0 1 500px; /* Définit une largeur de base de 500px */
        max-width: 550px; /* Limite la largeur maximale à 550px */
        margin: 10px; /* Ajoute un espacement entre les divs */
    }

    .Products div img {
        width: 100%; /* L'image occupe toute la largeur du parent */
        height: auto; /* Maintient le ratio d'aspect de l'image */
        max-width: 550px; /* Assure que l'image ne dépasse pas la largeur du parent */
        transition: max-width 0.3s ease; /* Transition douce lors du redimensionnement */
    }
}


/* Styles pour les écrans moyens */
@media (max-width: 768px) {
    .Products div {
        flex: 1 1 200px; /* La carte occupe 200px par défaut sur les écrans moyens */
    }

    .Products div img {
        max-width: 150px; /* Réduit la taille maximale de l'image sur les écrans moyens */
    }
}

/* Styles pour les petits écrans */
@media (max-width: 480px) {
    .Products div {
        flex: 1 1 150px; /* La carte occupe 150px par défaut sur les petits écrans */
    }

    .Products div img {
        max-width: 100px; /* Réduit encore la taille maximale de l'image sur les petits écrans */
    }
}



  </style>
  