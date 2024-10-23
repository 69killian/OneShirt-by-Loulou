<template>
  <Header/>
  <section class="main-product-page-content">
    <!-- Image principale -->
    <div class="main-product-image" v-if="product.images && product.images.length > 0">
      <img :src="product.images[0].image_base64" :alt="`Image d'un produit`" />
    </div>

    <!-- Description et options du produit -->
    <article>
      <div class="product-desc">
        <p class="product-name-desc">{{ product.name }}</p>
        <p class="price-product-desc">{{ product.price }}€</p>
        <p class="type-of-product">{{ product.description }}</p>
      </div>

      <div class="product-options">
        <div class="selectors-flex">
          <div>
            <label for="size-selector">Tailles</label>
            <select id="size-selector" v-model="selectedSize" v-if="availableSizes.length > 0">
              <option value="" disabled selected>Choisir une taille</option> <!-- Option par défaut -->
              <option v-for="size in availableSizes" :key="size.id" :value="size.id">{{ getSizeLabel(size.size_id) }}</option>
            </select>
            <p v-else>Ce produit n'a pas de taille spécifique.</p> <!-- Message alternatif -->
          </div>
          <div>
            <label for="label-selector">Couleur</label>
            <select id="label-selector" v-model="product.color">
              <option>{{ product.color }}</option> <!-- Affiche uniquement la couleur du produit -->
            </select>
          </div>
        </div>
        <button class="add-to-cart-btn" @click="addToCart">Ajouter au panier</button>
      </div>

      <!-- Sections similaires à la FAQ -->
      <div class="product-details">
        <div class="faq-item" v-for="(detail, index) in productDetails" :key="index">
          <button class="faq-question" @click="toggleDetail(index)">{{ detail.title }}</button>
          <div
            class="faq-answer"
            :style="{ maxHeight: activeIndex === index ? answerHeights[index] : null, padding: activeIndex === index ? '15px 0' : '0' }"
            ref="answers"
          >
            <p>{{ detail.content }}</p>
          </div>
        </div>
      </div>
    </article>
  </section>
  <Reviews/>
  <Products/>
  <Newsletter/>
  <Footer/>
</template>

<script>
import Header from "@/components/Header.vue";
  import Footer from "@/components/Footer.vue";
  import Reviews from "@/components/Reviews.vue"
  import Products from "@/components/Products.vue";
  import Newsletter from "@/components/Newsletter.vue";
import axios from 'axios';

export default {
    components: {
      Header,
      Footer,
      Reviews,
      Products,
      Newsletter,
    },
  data() {
    return {
      product: {},
      sizes: [], // Tableau pour stocker les tailles
      selectedSize: null, // Pour garder la taille sélectionnée
      availableSizes: [], // Tailles disponibles pour ce produit
      activeIndex: null,
      answerHeights: [],
      productDetails: [
        { title: "Matière et entretien", content: "" },
        { title: "Détail du produit", content: "" },
        { title: "Taille et coupe", content: "" },
      ],
    };
  },
  mounted() {
    const productId = this.$route.params.id;
    this.fetchProduct(productId);
    this.fetchSizes(productId); 
    this.$nextTick(() => {
        this.answerHeights = Array.from(this.$refs.answers).map(el => `${el.scrollHeight}px`);
    });
},
  methods: {
    fetchProduct(productId) {
    axios.get(`/api/produit/${productId}`)
        .then(response => {
            this.product = response.data;

            // Mettez à jour les détails du produit après récupération
            this.productDetails[0].content = this.product.type;
            this.productDetails[1].content = this.product.description;
            this.productDetails[2].content = this.product.sizes.length > 0 ? 
                this.product.sizes.map(size => size.name).join(', ') : 
                'Aucune taille disponible';

            // Vérifie si les tailles disponibles correspondent au produit
            this.availableSizes = this.sizes.filter(size => 
                this.product.sizes.some(productSize => productSize.size_id === size.size_id && productSize.stock_quantity > 0)
            );
        })
        .catch(error => {
            console.error('Erreur lors de la récupération du produit:', error);
        });
    },
    fetchSizes(productId) {
    axios.get(`/api/tailles/${productId}`)
        .then(response => {
            this.sizes = response.data;

            // Met à jour availableSizes ici pour inclure les tailles disponibles après la récupération
            this.availableSizes = this.sizes.filter(size => size.stock_quantity > 0);
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des tailles:', error);
        });
    },
    addToCart() {
        alert("Produit ajouté au panier");
    },
    toggleDetail(index) {
        if (this.activeIndex === index) {
            this.activeIndex = null;
        } else {
            this.activeIndex = index;
        }
    },
    getSizeLabel(sizeId) {
        const sizeMap = {
            1: 'M', // Taille M
            2: 'L', // Taille L
            3: 'S'  // Taille S
        };
        return sizeMap[sizeId] || 'Taille inconnue'; // Retourne 'Taille inconnue' si l'ID n'est pas dans le mapping
    },
},
};
</script>





  
  <style scoped>
  
  .faq-item {
  margin-bottom: 10px; /* Augmenter l'espacement entre les items */
  padding-bottom: 15px; /* Augmenter le padding */
}

.faq-question {
  background-color: #f7f7f7;
  color: #333;
  font-size: 1.2em; /* Agrandir la taille de la police */
  padding: 10px; /* Augmenter le padding */
  width: 100%;
  text-align: left;
  border: 1px solid rgb(235, 235, 235);
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.1s ease;
}

.faq-answer {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease-out, padding 0.3s ease-out;
  padding: 0px;
  font-size: 1.2em; 
  color: #555;
  margin-left: 15px;
  margin-top: 10px; 
  margin-bottom: 10px;
}

/* Padding pour le contenu des réponses */
.faq-answer p {
  margin: -10px 10px; /* Espacement entre le texte */

}



  .main-product-page-content {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 50px;
    margin-top: 170px;
  }
  
  .product-images {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
  
  .product-images img {
    height: 70px;
    width: 70px;
  }
  
  .main-product-image img {
    height: 600px;
    width: 600px;
  }
  
  .product-desc {
    margin: 0px;
  }
  
  .product-name-desc {
    font-weight: bold;
    font-size: 25px;
  }
  
  .price-product-desc {
    font-weight: bold;
    font-size: 50px;
    margin: 0px;
  }
  
  .type-of-product {
    font-weight: 300;
    margin-bottom: 30px;
  }
  
  .product-options {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
  }
  
  .product-options label {
    margin-right: 10px;
  }
  
  .product-options select {
    margin-bottom: 15px;
    padding: 10px 152px 10px 10px;
    width: 100%;
    max-width: 300px;
    background-color: white;
    border: solid 1px rgb(197, 197, 197);
    border-radius: 7px;
    font-size: 16px;
  }
  
  .selectors-flex {
    display: flex;
    gap: 20px;
  }
  
  .add-to-cart-btn {
    background-color: rgb(48, 48, 48);
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 7px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
  }
  
  .add-to-cart-btn:hover {
    background-color: rgb(31, 31, 31);
  }
  
  .product-details {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
  }
  
  .product-details select {
    margin-bottom: 15px;
    padding: 10px 553px 10px 10px;
    width: 100%;
    max-width: 300px;
    background-color: white;
    border: solid 1px rgb(197, 197, 197);
    border-radius: 7px;
    font-size: 16px;
  }
  
  /* Media Queries */
  @media (max-width: 1200px) {
    .main-product-page-content {
      flex-direction: column;
      margin-top: 100px;
      gap: 30px;
    }
  
    .product-images img {
      height: 60px;
      width: 60px;
    }
  
    .main-product-image img {
      height: 400px;
      width: 400px;
    }
  
    .price-product-desc {
      font-size: 40px;
    }
  
    .product-name-desc {
      font-size: 20px;
    }
  }
  
  @media (max-width: 768px) {
    .main-product-page-content {
      margin-top: 50px;
    }
  
    .add-to-cart-btn {
      width: 100%;
      padding: 10px;
    }
  
    .product-images img {
      height: 50px;
      width: 50px;
    }
  
    .main-product-image img {
      height: 300px;
      width: 300px;
    }
  
    .price-product-desc {
      font-size: 35px;
    }
  
    .product-name-desc {
      font-size: 18px;
    }
  
    .type-of-product {
      font-size: 14px;
      margin-bottom: 20px;
    }
  }
  
  @media (max-width: 360px) {
    .main-product-page-content {
      margin-top: 30px;
    }
  
    .product-images img {
      height: 40px;
      width: 40px;
    }
  
    .main-product-image img {
      height: 250px;
      width: 250px;
    }
  
    .price-product-desc {
      font-size: 30px;
    }
  
    .product-name-desc {
      font-size: 16px;
    }
  
    .type-of-product {
      font-size: 12px;
      margin-bottom: 15px;
    }
  }
  </style>
  