<template>
  <section class="main-product-page-content">
    <!-- Image principale -->
    <div class="main-product-image">
      <img src="../../../public/images/Image.png" alt="image" />
    </div>

    <!-- Description et options du produit -->
    <article>
      <div class="product-desc">
        <p class="product-name-desc">{{ productName }}</p>
        <p class="price-product-desc">{{ productPrice }}€</p>
        <p class="type-of-product">{{ productType }}</p>
      </div>

      <div class="product-options">
        <div class="selectors-flex">
          <div>
            <label for="size-selector">Tailles</label>
            <select id="size-selector">
              <option v-for="size in sizes" :key="size">{{ size }}</option>
            </select>
          </div>
          <div>
            <label for="label-selector">Label</label>
            <select id="label-selector">
              <option v-for="label in labels" :key="label">{{ label }}</option>
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
</template>

<script>
export default {
  data() {
    return {
      productName: "Produit nom",
      productPrice: 50,
      productType: "type de produit",
      sizes: ["S", "M", "L", "XL"],
      labels: ["Label 1", "Label 2", "Label 3"],
      activeIndex: null,
      answerHeights: [],
      productDetails: [
        { title: "Matière et entretien", content: "Polyester, Laine, etc." },
        { title: "Détail du produit", content: "Ce produit est fabriqué à partir de matériaux de haute qualité." },
        { title: "Taille et coupe", content: "Ce produit est disponible en tailles standard et ample." },
      ],
    };
  },
  mounted() {
    this.$nextTick(() => {
      this.answerHeights = Array.from(this.$refs.answers).map(el => `${el.scrollHeight}px`);
    });
  },
  methods: {
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
  },
};
</script>

  
  <style scoped>
  
/* Styles similaires à la FAQ */
.faq-item {
  margin-bottom: 15px;
  padding-bottom: 10px;
}

.faq-question {
  background-color: #f7f7f7;
  color: #333;
  font-size: 1.2em;
  padding: 15px;
  width: 100%;
  text-align: left;
  border: 1px solid rgb(235, 235, 235);
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.1s ease;
}

.faq-question:hover {
  background-color: #ededed;
}

.faq-answer {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease-out, padding 0.3s ease-out;
  padding: 0;
  font-size: 1.1em;
  color: #555;
  margin-left: 15px;
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
  