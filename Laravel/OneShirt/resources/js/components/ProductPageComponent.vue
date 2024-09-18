<template>
    <section class="main-product-page-content">
      <article>
        <div class="product-images">
          <img src="../../../public/images/Image.png" alt="image" v-for="n in 4" :key="n" />
        </div>
      </article>
  
      <div class="main-product-image">
        <img src="../../../public/images/Image.png" alt="image" />
      </div>
  
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
  
        <div class="product-details">
          <select id="material">
            <option value="Matière et entretien">Matière et entretien</option>
            <option v-for="material in materials" :key="material">{{ material }}</option>
          </select>
  
          <select id="product-details">
            <option value="Détail du produit">Détail du produit</option>
            <option v-for="detail in productDetails" :key="detail">{{ detail }}</option>
          </select>
  
          <select id="size-fit">
            <option value="Taille et coupe">Taille et coupe</option>
            <option v-for="fit in sizeFits" :key="fit">{{ fit }}</option>
          </select>
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
        materials: ["Polyester", "Laine"],
        productDetails: ["Détail 2", "Détail 3"],
        sizeFits: ["Standard", "Ample"],
      };
    },
    methods: {
      addToCart() {
        // Logique pour ajouter au panier
        alert("Produit ajouté au panier");
      },
    },
  };
  </script>
  
  <style scoped>
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
  