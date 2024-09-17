<template>
    <div>
      <Header />
      <BannerTop />
      <Products />
      <BannerBottom />
      <Blogs />
      <Reviews />
      <LoulouChannel />
      <Newsletter />
      <Footer />
      <VisitCounter />
    </div>
  </template>
  
  <script>
  import Header from '@/components/Header.vue';
  import BannerTop from '@/components/BannerTop.vue';
  import Products from '@/components/Products.vue';
  import BannerBottom from '@/components/BannerBottom.vue';
  import Blogs from '@/components/Blogs.vue';
  import Reviews from '@/components/Reviews.vue';
  import LoulouChannel from '@/components/LoulouChannel.vue';
  import Newsletter from '@/components/Newsletter.vue';
  import Footer from '@/components/Footer.vue';
  import VisitCounter from '@/components/VisitCounter.vue';
  
  export default {
    components: {
      Header,
      BannerTop,
      Products,
      BannerBottom,
      Blogs,
      Reviews,
      LoulouChannel,
      Newsletter,
      Footer,
      VisitCounter,
    }
  }
  </script>
  
  <style>
  body {
    font-family: "Roboto", sans-serif;
    font-weight: 400;
    font-style: normal;
  }
  </style>
  