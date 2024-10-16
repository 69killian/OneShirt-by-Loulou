<template>
  <section class="Reviews">
    <div class="review-with-title">
      <div class="title-section-review">Avis des clients</div>
      <div class="review-cards-container">
        <div
          v-for="(review, index) in reviews"
          :key="index"
          class="review-card"
          :class="{ animate: isAnimated(index) }"
          :style="{ animationDelay: `${(index + 1) * 0.1}s` }"
        >
          <img class="review-img" :src="review.image" alt="stars" />
          <p class="review-title-card">{{ review.title }}</p>
          <p class="review-body">{{ review.body }}</p>
          <div class="avatar-review">
            <img class="avatar" :src="review.avatar" alt="" />
            <div class="reviewer-info">
              <p class="reviewer-name">{{ review.reviewerName }}</p>
              <p class="review-date">{{ review.date }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="see-more-button">
      <router-link to="/avis" style="color: white;"><button>Ton avis compte !</button></router-link>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      reviews: [
      {
          image: 'images/rv588m47.bmp',
          title: 'Super Lourd',
          body: 'Super site et supers produits pour une super Commu !',
          avatar: 'images/Logoloulou.jpg',
          reviewerName: 'Loulou',
          date: '20/09/2024'
        },
        {
          image: 'images/rv588m47.bmp',
          title: 'Test',
          body: "c'est juste un test",
          avatar: 'images/Avatar.png',
          reviewerName: 'Avatar test',
          date: '29/09/2024'
        },
        {
          image: 'images/rv588m47.bmp',
          title: 'Pas mal !',
          body: "Je n'avais pas vu un site One Piece de Blog aussi bien avant !",
          avatar: 'images/luffytete.png',
          reviewerName: 'Luffy54',
          date: '10/08/20204'
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

/* Styles des cartes de critique */
.review-card {
  border: 1px solid rgb(236, 236, 236);
  padding: 30px;
  padding-right: 150px;
  border-radius: 10px;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  opacity: 0; /* Opacité initiale */
  transform: translateY(20px); /* Position initiale */
  transition: opacity 0.5s ease, transform 0.5s ease; /* Transitions supplémentaires si nécessaire */
}

/* Styles pour les cartes de critique avec animation */
.review-card.animate {
  animation: fadeInUp 0.5s ease-out forwards; /* Propriétés de l'animation */
}

/* Styles de la section Reviews */
.Reviews {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 30px;
  margin-top: 200px;
  margin-bottom: 150px;
}

.review-with-title {
  text-align: center;
}

.review-cards-container {
  display: flex;
  flex-wrap: wrap;
  gap: 30px;
  justify-content: center;
}

.review-img {
  height: 35px;
  width: 130px;
  margin-left: -18px;
}

.title-section-review {
  font-weight: 500;
  font-size: 25px;
  margin-bottom: 100px;
  margin-top: -100px;
  height: 0;
  overflow: visible;
}

.review-title-card {
  font-weight: 500;
  font-size: 25px;
  margin-bottom: 2px; /* Réduit l'espacement entre le titre et le corps de la revue */
}

.review-body {
  color: rgb(103, 103, 103);
  font-size: 15px;
  font-weight: 300;
  margin: 0; /* Enlève les marges pour aligner le texte avec le titre */
  padding: 0; /* Enlève les espacements internes */
}

.avatar-review {
  display: flex;
  align-items: center; /* Alignement vertical entre avatar et les infos */
  gap: 10px; /* Espacement entre l'avatar et les textes */
  margin-top: 20px; /* Espacement entre le corps de la revue et l'info du reviewer */
}

.avatar {
  height: 45px;
  width: 45px;
}

.reviewer-info {
  display: flex;
  flex-direction: column; /* Alignement vertical des textes à droite de l'avatar */
  margin: 0; /* Enlever les marges pour un alignement précis */
}

.reviewer-name,
.review-date {
  margin: 0; /* Enlever les marges pour aligner le texte avec l'avatar */
  padding: 0; /* Enlever les espacements internes */
}

.reviewer-name {
  font-weight: 500;
  color: rgb(103, 103, 103);
}

.review-date {
  font-weight: 300;
  color: rgb(103, 103, 103);
}

.see-more-button {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 30px;
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
  .review-cards-container {
    flex-direction: column;
    align-items: center;
  }
  .review-card {
    flex: 1 1 200px; /* La carte occupe 200px par défaut sur les écrans moyens */
  }

  .avatar {
    max-width: 100px; /* Réduit la taille maximale de l'image sur les écrans moyens */
    max-height: 100px;
  }
  .review-body {
    font-size: 18px;
    width: 200px;
  }
}

/* Styles pour les petits écrans */
@media (max-width: 768px) {
  .review-cards-container {
    flex-direction: column;
    align-items: center;
  }
  .review-card {
    flex: 1 1 200px; /* La carte occupe 200px par défaut sur les écrans moyens */
  }

  .avatar {
    max-width: 100px; /* Réduit la taille maximale de l'image sur les écrans moyens */
    max-height: 100px;
  }
  .review-body {
    font-size: 18px;
    width: 200px;
  }
}

@media (max-width: 480px) {
  .review-cards-container {
    flex-direction: column;
    align-items: center;
  }

  .avatar {
    max-width: 100px; /* Réduit encore la taille maximale de l'image sur les petits écrans */
  }
  .review-body {
    font-size: 15px;
  }
}
</style>