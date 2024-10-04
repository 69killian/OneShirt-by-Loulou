<template>
    <div>
      <div class="title-blogs">
        <h1>Blog</h1>
      </div>
  
      <section class="Blogs">
        <!-- Carte 1 : Luffy -->
        <router-link to="/article" class="blog-card animate">
          <img class="img-blog" src="../../../public/images/luffytete.png" alt="Luffy Image">
          <p class="blog-title-card">Luffy et l'aventure de Wano</p>
          <p class="blog-description">Plongez dans les moments clés de l'arc de Wano et explorez la croissance de Luffy en tant que capitaine.</p>
        </router-link>
  
        <!-- Carte 2 : Zoro -->
        <router-link to="/article" class="blog-card animate">
          <img class="img-blog" src="../../../public/images/zoroonepiece.jpg" alt="Zoro Image">
          <p class="blog-title-card">Zoro et l'honneur des samouraïs</p>
          <p class="blog-description">Découvrez le lien spécial entre Zoro et les samouraïs de Wano, ainsi que sa quête pour devenir le meilleur épéiste.</p>
        </router-link>
  
        <!-- Carte 3 : Nami -->
        <router-link to="/article" class="blog-card animate">
          <img class="img-blog" src="../../../public/images/luffy.webp" alt="Nami Image">
          <p class="blog-title-card">Nami et la maîtrise des éléments</p>
          <p class="blog-description">Un regard sur les techniques de navigation et les pouvoirs météorologiques de Nami qui font d'elle un atout inestimable.</p>
        </router-link>
  
        <!-- Carte 4 : Sanji -->
        <router-link to="/article" class="blog-card animate">
          <img class="img-blog" src="../../../public/images/robin.webp" alt="Sanji Image">
          <p class="blog-title-card">Sanji et l'art du combat</p>
          <p class="blog-description">Explorez le mélange unique de cuisine et de combat qui fait de Sanji un membre incontournable de l'équipage.</p>
        </router-link>
  
        <!-- Carte 5 : Chopper -->
        <router-link to="/article" class="blog-card animate">
          <img class="img-blog" src="../../../public/images/equipage.webp" alt="Chopper Image">
          <p class="blog-title-card">Chopper, le docteur des miracles</p>
          <p class="blog-description">Découvrez comment Chopper a sauvé l'équipage à maintes reprises grâce à ses compétences médicales inégalées.</p>
        </router-link>
  
        <!-- Carte 6 : Robin -->
        <router-link to="/article" class="blog-card animate">
          <img class="img-blog" src="../../../public/images/eausunnyonepiecefond.jpg" alt="Robin Image">
          <p class="blog-title-card">Robin et l'histoire perdue</p>
          <p class="blog-description">Robin, archéologue de l'équipage, à la recherche de la vérité derrière le Siècle Oublié et le trésor ultime.</p>
        </router-link>
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
  background-image: url('../../../public/images/eausunnyonepiecefond.jpg'); /* Remplace avec l'URL de ton image */
  background-size: cover; /* L'image couvre toute la surface */
  background-position: center; /* Centre l'image */
  padding: 150px;
  text-align: center;
  color: white; /* Pour garantir que le texte reste lisible */
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

  .blog-subtitle-card {
  font-weight: 400;
  font-size: 18px;
  color: #f0f0f0; /* Ou toute autre couleur qui correspond à ton thème */
  margin-top: 5px;
}

  
  /* Styles par défaut des cartes de blog */
  .blog-card {
    border: 1px solid rgb(56, 56, 56);
    padding: 20px;
    border-radius: 10px;
    box-sizing: border-box;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.5s ease, transform 0.5s ease, box-shadow 0.3s ease;
    text-decoration: none; /* Enlève la décoration du lien */
    background-color: rgb(30, 30, 30);
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
    padding: 150px 10px;
    background-color: rgb(25, 25, 25);
  }
  
  /* Styles pour les images de blog */
  .img-blog {
    height: 170px;
    width: 170px;
    object-fit: cover;
  }
  
  /* Styles pour les titres et descriptions */
  .blog-title-card {
    font-weight: 500;
    font-size: 25px;
    color: white;
  }
  
  .blog-description {
    color: rgb(103, 103, 103);
    font-size: 20px;
    font-weight: 300;
  }
  
  /* Animation de survol des cartes */
  .blog-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 4px 8px rgba(152, 152, 152, 0.2);
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
  