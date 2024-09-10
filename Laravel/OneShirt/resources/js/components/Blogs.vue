<template>
  <section class="Blogs">
    <div class="blog-with-title">
      <div class="titre-section-blog">Articles de Blog</div>
      <div class="subheading-section-blog">Vous allez aimer</div>
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
    </div>
    <div class="see-more-button">
      <button>Plus de Blogs</button>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      blogs: [
        {
          image: 'images/Image.png',
          title: 'Title 1',
          description: 'Body text for whatever you’d like to say. Add main takeaway points, quotes, anecdotes, or even a very very short story.'
        },
        {
          image: 'images/Image.png',
          title: 'Title 2',
          description: 'Body text for whatever you’d like to say. Add main takeaway points, quotes, anecdotes, or even a very very short story.'
        },
        {
          image: 'images/Image.png',
          title: 'Title 3',
          description: 'Body text for whatever you’d like to say. Add main takeaway points, quotes, anecdotes, or even a very very short story.'
        },
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

/* Styles par défaut des cartes de blog */
.blog-card {
  border: 1px solid rgb(236, 236, 236);
  padding: 30px;
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

/* Styles de la section Blog */
.Blogs {
  display: flex;
  flex-direction: column; 
  align-items: center;
  gap: 150px;
  margin-top: 150px;
  margin-bottom: 150px;
}

.blog-with-title {
  display: flex;
  flex-direction: column; 
  align-items: center;
}

.titre-section-blog {
  font-weight: 500;
  font-size: 25px;
  margin-bottom: 100px; 
  margin-top: -100px;
}

.subheading-section-blog {
  font-weight: 300;
  font-size: 18px;
  margin-bottom: 70px; 
  margin-top: -70px;
  color: rgb(103, 103, 103);
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
}

.blog-description {
  color: rgb(103, 103, 103);
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
