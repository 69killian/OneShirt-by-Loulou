<template>
    <div>
      <Header/>
      <BlogContent />
      <PaginationBlog/>
      <Newsletter/>
      <Footer/>
    </div>
  </template>
  
  <script>
  import Header from '@/components/Header.vue';
  import Footer from '@/components/Footer.vue';
  import BlogContent from '@/components/BlogContent.vue';
  import Newsletter from '@/components/Newsletter.vue';
  import PaginationBlog from '@/components/PaginationBlog.vue';
  
  
  export default {
    name: 'Catalog',
    components: {
      PaginationBlog,
      BlogContent,
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
  