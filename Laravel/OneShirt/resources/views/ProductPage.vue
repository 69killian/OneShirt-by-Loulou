<template>
    <div>
        <Header/>
      <ProductPageComponent/>
      <Reviews/>
      <div class="title-Products-Bottom">Tu aimera aussi :</div>
      <Products/>
      <Footer/>
    </div>
  </template>
  
  <script>
  import Header from "@/components/Header.vue";
  import Footer from "@/components/Footer.vue";
  import ProductPageComponent from "@/components/ProductPageComponent.vue";
  import Reviews from "@/components/Reviews.vue"
  import Products from "@/components/Products.vue";
  
  export default {
    components: {
      ProductPageComponent,
      Header,
      Footer,
      Reviews,
      Products,
    },
  };
  </script>
  
  <style scoped>
  .title-Products-Bottom {
    font-weight: 500;
    font-size: 25px;
    margin-bottom: 100px;
    margin-top: -100px;
    height: 0;
    overflow: visible;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 50px;
  }
  </style>
  