<template>
    <section class="Reviews">
      <div class="review-with-title">
        <div class="title-section-review">Avis des clients</div>
        <div class="review-cards-container">
          <div
            v-for="(review, index) in reviews"
            :key="review.id"
            class="review-card"
            :class="{ animate: isAnimated(index) }"
          >
            <p class="review-title-card">Note : {{ review.rating }}/5</p>
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

      <!-- Review Submission Form -->
      <div class="main-review">
        <h1>Soumettez Votre Avis</h1>
        <p class="description">Nous apprécions vos retours. Partagez votre expérience avec nous !</p>
  
        <form>
          <label for="name">Nom</label>
          <input type="text" id="name" name="name" required placeholder="Votre Nom">
  
          <label for="surname">Prénom</label>
          <input type="text" id="surname" name="surname" required placeholder="Votre Prénom">
  
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required placeholder="Votre Email">
  
          <label for="product">Produit</label>
          <select id="product" name="product" required>
            <option value="">Sélectionnez un Produit</option>
            <option value="5">5 - produit</option>
            <option value="4">4 - produit</option>
            <option value="3">3 - produit</option>
            <option value="2">2 - produit</option>
            <option value="1">1 - produit</option>
          </select>
  
          <label for="rating">Note</label>
          <select id="rating" name="rating" required>
            <option value="">Sélectionnez une note</option>
            <option value="5">5 - Excellent</option>
            <option value="4">4 - Très bien</option>
            <option value="3">3 - Bien</option>
            <option value="2">2 - Moyen</option>
            <option value="1">1 - Mauvais</option>
          </select>
  
          <label for="message">Votre Avis</label>
          <textarea id="message" name="message" rows="4" required placeholder="Partagez votre expérience..."></textarea>
  
          <button type="submit">Soumettre votre Avis</button>
        </form>
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
  
  <style>
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

  .main-review {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
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
  