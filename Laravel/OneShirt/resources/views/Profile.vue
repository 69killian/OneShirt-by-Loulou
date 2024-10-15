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

  <style>
    body {
        background-color: rgb(30, 30, 30);
        padding-top: 70px;
    }
</style>
  