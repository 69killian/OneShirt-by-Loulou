<template>
  <section class="Reviews">
    <div class="review-with-title">
      <div class="title-section-review">Avis des clients</div>
      <div class="review-cards-container">
        <div
          v-for="(review, index) in reviews.slice(0, 3)"
          :key="review.id"
          class="review-card"
          :class="{ animate: isAnimated(index) }"
        >
          <div class="star-rating">
            <span v-for="star in getStarRating(review.rating)" :key="star" class="star">⭐</span>
          </div>
          <p class="review-body">{{ review.comment }}</p>
          <div class="review-info">
            <p class="review-date">Date : {{ review.created_at.substring(0, 10) }}</p>
          </div>
          <!-- Utilisateurs par Identifiants -->
          <section class="user-info" v-if="getUserById(review.user_id)">
            <img
              class="avatar"
              :src="'data:image/png;base64,' + getUserById(review.user_id).profile_picture"
              alt="User Image"
            />
            <p style="color: black;">{{ getUserById(review.user_id).username }}</p>
          </section>
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
      reviews: [],
      users: [],
      scrollPosition: 0,
    };
  },
  methods: {
    fetchReviews() {
      fetch("/reviews")
        .then((response) => response.json())
        .then((data) => {
          console.log("Données des avis récupérées:", data);
          this.reviews = data;
        })
        .catch((error) => {
          console.error("Erreur lors de la récupération des avis:", error);
        });
    },
    fetchUsers() {
      fetch("/api/users")
        .then((response) => response.json())
        .then((data) => {
          console.log("Données des utilisateurs récupérées:", data); // Vérifiez que les utilisateurs sont chargés
          this.users = data;
        })
        .catch((error) => {
          console.error("Erreur lors de la récupération des utilisateurs:", error);
        });
    },
    getUserById(userId) {
      return this.users.find(user => user.id === userId); // Recherche de l'utilisateur
    },
    getStarRating(rating) {
      return Array.from({ length: rating }, (_, i) => i + 1); // Crée un tableau d'étoiles en fonction de la note
    },
    isAnimated(index) {
      const threshold = window.innerHeight * 0.75;
      return this.scrollPosition > (index * 300 - threshold);
    },
    checkVisibility() {
      this.scrollPosition = window.scrollY;
    },
  },
  mounted() {
    this.fetchReviews();
    this.fetchUsers(); // Assurez-vous que cette méthode est appelée
    window.addEventListener('scroll', this.checkVisibility);
    this.checkVisibility();
  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.checkVisibility);
  },
};
</script>

<style scoped>
/* Animation fade up */
@keyframes fadeUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
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

/* Classe pour l'animation */
.animate {
  animation: fadeUp 0.6s ease-out forwards;
}

.avatar {
  height: 45px;
  width: 45px;
  border-radius: 100px;
  object-fit: cover;
}

/* Styles des cartes */
.review-card {
  border: 1px solid rgb(236, 236, 236);
  padding: 30px;
  padding-right: 150px;
  border-radius: 10px;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

/* Styles généraux */
.Reviews {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 30px;
  margin-top: 200px;
  margin-bottom: 150px;
}

/* Autres styles */
.review-with-title {
  text-align: center;
}

.review-cards-container {
  display: flex;
  flex-wrap: wrap;
  gap: 30px;
  justify-content: center;
}

.title-section-review {
  font-weight: 500;
  font-size: 25px;
  margin-bottom: 100px;
  margin-top: -100px;
}

.review-title-card {
  font-weight: 500;
  font-size: 25px;
}

.review-body {
  color: rgb(103, 103, 103);
  font-size: 15px;
  font-weight: 300;
  width: 350px;
}

.review-info {
  display: flex;
  flex-direction: column;
}

.user-info {
  display: flex;
  align-items: center;
  gap: 20px;
}

.review-date {
  font-weight: 300;
  color: rgb(103, 103, 103);
}


/* Styles pour les étoiles */
.star-rating {
  font-size: 20px;
  margin: 10px 0;
}

/* Responsive styles */
@media (max-width: 1280px) {
  .review-card {
    flex: 1 1 200px;
  }
  .review-body {
    font-size: 18px;
    width: 200px;
  }
}

@media (max-width: 768px) {
  .review-card {
    flex: 1 1 200px;
  }
  .review-body {
    font-size: 18px;
    width: 200px;
  }
}

@media (max-width: 480px) {
  .review-body {
    font-size: 15px;
  }
}
</style>
