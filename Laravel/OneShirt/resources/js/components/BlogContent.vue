<template>
    <div>
      <div class="title-blogs">
        <h1>Blog</h1>
      </div>
  
      <section class="Blogs">
        <div class="blog-card animate">
          <img class="img-blog" src="../../../public/images/Image.png" alt="Blog Image">
          <p class="blog-title-card">Title</p>
          <p class="blog-description">Body text for whatever you’d like to <br> say. Add main takeaway points, <br> quotes, anecdotes, or even a very <br> very short story.</p>
        </div>
        <div class="blog-card animate">
          <img class="img-blog" src="../../../public/images/Image.png" alt="Blog Image">
          <p class="blog-title-card">Title</p>
          <p class="blog-description">Body text for whatever you’d like to <br> say. Add main takeaway points, <br> quotes, anecdotes, or even a very <br> very short story.</p>
        </div>
        <div class="blog-card animate">
          <img class="img-blog" src="../../../public/images/Image.png" alt="Blog Image">
          <p class="blog-title-card">Title</p>
          <p class="blog-description">Body text for whatever you’d like to <br> say. Add main takeaway points, <br> quotes, anecdotes, or even a very <br> very short story.</p>
        </div>
        <div class="blog-card animate">
          <img class="img-blog" src="../../../public/images/Image.png" alt="Blog Image">
          <p class="blog-title-card">Title</p>
          <p class="blog-description">Body text for whatever you’d like to <br> say. Add main takeaway points, <br> quotes, anecdotes, or even a very <br> very short story.</p>
        </div>
        <div class="blog-card animate">
          <img class="img-blog" src="../../../public/images/Image.png" alt="Blog Image">
          <p class="blog-title-card">Title</p>
          <p class="blog-description">Body text for whatever you’d like to <br> say. Add main takeaway points, <br> quotes, anecdotes, or even a very <br> very short story.</p>
        </div>
        <div class="blog-card animate">
          <img class="img-blog" src="../../../public/images/Image.png" alt="Blog Image">
          <p class="blog-title-card">Title</p>
          <p class="blog-description">Body text for whatever you’d like to <br> say. Add main takeaway points, <br> quotes, anecdotes, or even a very <br> very short story.</p>
        </div>
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
      text-align: center; /* Centre le texte pour les petits écrans */
  }
  
  /* Pour les écrans de taille moyenne */
  @media (max-width: 1024px) {
      .title-blogs {
          font-size: 30px;
          padding: 200px;
      }
  }
  
  /* Pour les écrans de taille petite */
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
      padding: 20px; /* Réduit le padding de manière uniforme */
      border-radius: 10px;
      box-sizing: border-box;
      opacity: 0; /* Opacité initiale */
      transform: translateY(20px); /* Position initiale */
      transition: opacity 0.5s ease, transform 0.5s ease; /* Transitions supplémentaires si nécessaire */
  }
  
  /* Styles pour les cartes de blog avec animation */
  .blog-card.animate {
      animation: fadeInUp 0.5s ease-out forwards; /* Propriétés de l'animation */
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
      gap: 20px; /* Espacement entre les cartes */
      margin-top: 150px;
      margin-bottom: 150px;
      padding: 0 10px; /* Ajoute un padding horizontal pour éviter que les cartes sortent du cadre */
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
  }
  
  .blog-description {
      color: rgb(103, 103, 103);
      font-size: 20px;
      font-weight: 300;
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
  