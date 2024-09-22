<template>
    <div>
        <Header/>
      <ProfileForm />
      <Footer/>
    </div>
  </template>
  
  <script>
  import ProfileForm from "@/components/ProfileForm.vue";
  import Header from "../js/components/Header.vue";
  import Footer from "../js/components/Footer.vue";
  
  export default {
    components: {
      ProfileForm,
      Header,
      Footer,
    }
  };
  </script>
  