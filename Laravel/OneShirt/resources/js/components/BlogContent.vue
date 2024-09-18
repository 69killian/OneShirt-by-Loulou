<template>
    <div>
      <div class="title-blogs">
        <h1>Blog</h1>
      </div>
  
      <section class="Blogs">
        <router-link to="/article" class="blog-card animate">
          <img class="img-blog" src="../../../public/images/Image.png" alt="Blog Image">
          <p class="blog-title-card">Title</p>
          <p class="blog-description">Body text for whatever you’d like to <br> say. Add main takeaway points, <br> quotes, anecdotes, or even a very <br> very short story.</p>
        </router-link>
        <!-- Répéter pour chaque carte de blog -->
        <router-link to="/article" class="blog-card animate">
          <img class="img-blog" src="../../../public/images/Image.png" alt="Blog Image">
          <p class="blog-title-card">Title</p>
          <p class="blog-description">Body text for whatever you’d like to <br> say. Add main takeaway points, <br> quotes, anecdotes, or even a very <br> very short story.</p>
        </router-link>
        <router-link to="/article" class="blog-card animate">
          <img class="img-blog" src="../../../public/images/Image.png" alt="Blog Image">
          <p class="blog-title-card">Title</p>
          <p class="blog-description">Body text for whatever you’d like to <br> say. Add main takeaway points, <br> quotes, anecdotes, or even a very <br> very short story.</p>
        </router-link>
        <router-link to="/article" class="blog-card animate">
          <img class="img-blog" src="../../../public/images/Image.png" alt="Blog Image">
          <p class="blog-title-card">Title</p>
          <p class="blog-description">Body text for whatever you’d like to <br> say. Add main takeaway points, <br> quotes, anecdotes, or even a very <br> very short story.</p>
        </router-link>
        <router-link to="/article" class="blog-card animate">
          <img class="img-blog" src="../../../public/images/Image.png" alt="Blog Image">
          <p class="blog-title-card">Title</p>
          <p class="blog-description">Body text for whatever you’d like to <br> say. Add main takeaway points, <br> quotes, anecdotes, or even a very <br> very short story.</p>
        </router-link>
        <router-link to="/article" class="blog-card animate">
          <img class="img-blog" src="../../../public/images/Image.png" alt="Blog Image">
          <p class="blog-title-card">Title</p>
          <p class="blog-description">Body text for whatever you’d like to <br> say. Add main takeaway points, <br> quotes, anecdotes, or even a very <br> very short story.</p>
        </router-link>
        <!-- ... -->
      </section>
    </div>
  </template>
  
  <script>
  export default {
    name: 'BlogContent'
  }
  </script>
  
  <style scoped>
  .title-blogs {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    font-size: 30px;
    margin: 70px 0 0 0;
    background-color: #d2d2d2;
    padding: 150px;
    text-align: center;
  }
  
  /* Pour les écrans de taille moyenne */
  @media (max-width: 1024px) {
    .title-blogs {
      font-size: 30px;
      padding: 200px;
    }
  }
  
  /* Pour les écrans de petite taille */
  @media (max-width: 768px) {
    .title-blogs {
      font-size: 24px;
      padding: 150px;
    }
  }
  
  /* Pour les très petits écrans */
  @media (max-width: 480px) {
    .title-blogs {
      font-size: 20px;
      padding: 100px;
    }
  }
  
  /* Styles par défaut des cartes de blog */
  .blog-card {
    border: 1px solid rgb(236, 236, 236);
    padding: 20px;
    border-radius: 10px;
    box-sizing: border-box;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.5s ease, transform 0.5s ease, box-shadow 0.3s ease;
    text-decoration: none; /* Enlève la décoration du lien */
  }
  
  /* Styles pour les cartes de blog avec animation */
  .blog-card.animate {
    animation: fadeInUp 0.5s ease-out forwards;
  }
  
  /* Délai d'animation pour chaque élément de blog */
  .blog-card:nth-child(1) {
    animation-delay: 0.1s;
  }
  .blog-card:nth-child(2) {
    animation-delay: 0.2s;
  }
  .blog-card:nth-child(3) {
    animation-delay: 0.3s;
  }
  .blog-card:nth-child(4) {
    animation-delay: 0.4s;
  }
  .blog-card:nth-child(5) {
    animation-delay: 0.5s;
  }
  .blog-card:nth-child(6) {
    animation-delay: 0.6s;
  }
  
  /* Styles de la section Blog */
  .Blogs {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 150px;
    margin-bottom: 150px;
    padding: 0 10px;
  }
  
  /* Styles pour les images de blog */
  .img-blog {
    height: 170px;
    width: 170px;
  }
  
  /* Styles pour les titres et descriptions */
  .blog-title-card {
    font-weight: 500;
    font-size: 25px;
    color: black;
  }
  
  .blog-description {
    color: rgb(103, 103, 103);
    font-size: 20px;
    font-weight: 300;
  }
  
  /* Animation de survol des cartes */
  .blog-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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
  </style>
  