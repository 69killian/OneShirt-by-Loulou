<template>
  <section class="Blogs">
    <div class="blog-with-title">
      <div class="title-container">
    <div class="titre-section-blog">Articles de Blog</div>
    <div class="subheading-section-blog">Vous allez aimer</div>
  </div>
    <router-link to="/article" style="text-decoration: none; color: black;">
      <div class="blog-cards-container">
        <div
          v-for="(blog, index) in blogs"
          :key="index"
          class="blog-card"
          :class="{ animate: isAnimated(index) }"
          :style="{ animationDelay: `${(index + 1) * 0.1}s` }"
        >
          <img class="img-blog" :src="blog.image" alt="Blog Image" />
          <p class="blog-title-card">{{ blog.title }}</p>
          <p class="blog-description">{{ blog.description }}</p>
        </div>
      </div>
    </router-link>
    </div>
    <div class="see-more-button">
      <router-link to="/blog">
      <button>Plus de Blogs</button>
    </router-link>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      blogs: [
  {
    image: 'images/luffytete.png',
    title: 'Les secrets du One Piece révélé ?',
    description: 'Découvre les théories les plus folles sur le trésor légendaire que Roger a laissé derrière lui. Les indices dans le manga pourraient-ils enfin révéler la vérité ?'
  },
  {
    image: 'images/zoroonepiece.jpg',
    title: 'Luffy et son Gear 5 : Un nouveau pouvoir incroyable',
    description: 'Retour sur l’éveil de Luffy et son incroyable transformation. Que signifie vraiment le Gear 5 et quel impact aura-t-il sur l’histoire ?'
  },
  {
    image: 'images/luffy.webp',
    title: 'Les pirates les plus redoutables des mers',
    description: 'Des Yonkou aux Supernovae, plonge dans l’univers des pirates les plus puissants et découvre ce qui fait d’eux des légendes vivantes.'
  }
    ],
      scrollPosition: 0
    };
  },
  methods: {
    isAnimated(index) {
      const threshold = window.innerHeight * 0.75; // Ajuste le seuil selon tes besoins
      return this.scrollPosition > (index * 300 - threshold); // Ajuste le calcul du seuil
    },
    handleScroll() {
      this.scrollPosition = window.scrollY;
    }
  },
  mounted() {
    window.addEventListener('scroll', this.handleScroll);
    this.handleScroll(); // Vérifie l'état initial
  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll);
  }
};
</script>

<style scoped>
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

.title-container {
  background-color: #3C98EF; /* Applique la couleur de fond ici */
  padding: 20px; /* Pour ajouter de l'espace autour des titres */
  width: 100%; /* Pour s'assurer que ça prend toute la largeur */
  text-align: center; /* Centre le texte si besoin */
}


/* Styles par défaut des cartes de blog */
.blog-card {
  border: 1px solid #2a67a1;
  padding: 20px;
  border-radius: 10px;
  background-color: #2f77ba; /* Fond des cartes */
  opacity: 0; /* Opacité initiale pour l'animation */
  transform: translateY(20px); /* Position initiale */
  animation: fadeInUp 0.5s ease-out forwards; /* Animation fadeIn */
  flex: 1 1 300px;
  box-sizing: border-box;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
}

.blog-card:hover {
  transform: scale(1.05); /* Agrandir la carte au survol */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Ajouter une ombre */
    transition: transform 0.5s ease, box-shadow 0.5s ease; /* Transition de 1 seconde */
}

/* Styles pour les cartes de blog avec animation */
.blog-card.animate {
  animation: fadeInUp 0.5s ease-out forwards; /* Propriétés de l'animation */
}
.Blogs {
  position: relative; /* Nécessaire pour positionner les éléments à l'intérieur */
  display: flex;
  flex-direction: column; 
  align-items: center;
  gap: 150px;
  margin-top: 0px;
  margin-bottom: 150px;
  padding: 30px 0; /* Ajoute du padding pour le contenu */
  background-color: #3C98EF;
  overflow: hidden; /* Pour cacher les débordements éventuels */
}

.Blogs::before,
.Blogs::after {
  content: '';
  position: absolute;
  left: 0;
  right: 0;
  height: 30px; /* Ajuste la hauteur de l'ombre intérieure */
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), transparent); /* Ombre en haut */
}

.Blogs::before {
  top: 0; /* Positionne l'ombre en haut */
}

.Blogs::after {
  bottom: 0; /* Positionne l'ombre en bas */
  background: linear-gradient(to top, rgba(0, 0, 0, 0.1), transparent); /* Ombre en bas */
}


.blog-with-title {
  display: flex;
  flex-direction: column; 
  align-items: center;
}

.titre-section-blog {
  font-weight: 500;
  font-size: 25px;
  margin: 20px 0; /* Remplace les marges négatives par des marges positives */
}

.subheading-section-blog {
  font-weight: 300;
  font-size: 18px;
  margin: 20px 0; /* Remplace les marges négatives par des marges positives */
  color: black;
}


.blog-cards-container {
  display: flex;
  gap: 30px; /* Ajuste l'espace entre les cartes si nécessaire */
}

.blog-title-card {
  font-weight: 500;
  font-size: 25px;
}

.img-blog {
  height: 170px;
  width: 170px;
  object-fit: cover;
}

.blog-description {
  color: white;
  font-size: 20px;
  font-weight: 300;
}

.see-more-button button {
  background-color: rgb(48, 48, 48);
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 7px;
  font-size: 16px;
  font-weight: 500;
  cursor: pointer;
}

/* Styles pour les grands écrans */
@media (max-width: 1280px) {
  .Blogs {
    flex-direction: column;
    align-items: center;
  }

  .img-blog {
    max-width: 200px; /* Réduit encore la taille maximale de l'image sur les petits écrans */
  }
  .blog-description {
    font-size: 15px;
  }
}

/* Styles pour les écrans moyens */
@media (max-width: 768px) {
  .blog-card {
    flex: 1 1 200px; /* La carte occupe 200px par défaut sur les écrans moyens */
  }

  .img-blog {
    max-width: 100px; /* Réduit la taille maximale de l'image sur les écrans moyens */
    max-height: 100px;
  }
  .blog-description {
    font-size: 18px;
    width: 200px;
  }
}

/* Styles pour les petits écrans */
@media (max-width: 480px) {
  .Blogs {
    flex-direction: column;
    align-items: center;
  }

  .img-blog {
    max-width: 100px; /* Réduit encore la taille maximale de l'image sur les petits écrans */
  }
  .blog-description {
    font-size: 15px;
  }
}
</style>
