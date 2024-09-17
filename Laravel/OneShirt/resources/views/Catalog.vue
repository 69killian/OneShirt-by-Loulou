<template>
    <div>
      <Header/>
      <MainCatalog />
      <Pagination/>
      <Newsletter/>
      <Footer/>
    </div>
  </template>
  
  <script>
  import Header from '@/components/Header.vue';
  import MainCatalog from '@/components/MainCatalog.vue';
  import Newsletter from '@/components/Newsletter.vue';
  import Footer from '@/components/Footer.vue';
  import Pagination from '@/components/Pagination.vue';
  
  
  export default {
    name: 'Catalog',
    components: {
      MainCatalog,
      Pagination,
      Header,
      Newsletter,
      Footer,
    }
  };
  </script>
  
  <style scoped>
  h1 {
    text-align: center;
    margin-top: 50px;
    font-size: 36px;
    color: #333;
  }
  </style>
  