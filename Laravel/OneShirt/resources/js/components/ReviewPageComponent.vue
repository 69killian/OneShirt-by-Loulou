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
        <p class="review-title-card">Produit : {{ getProductById(review.product_id).name }}</p>
        <p class="review-title-card">Note : {{ review.rating }}/5</p>
        <div class="star-rating">
          <span v-for="star in getStarRating(review.rating)" :key="star" class="star">★</span>
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

  <!-- Review Submission Form -->
  <div class="main-review">
    <h1>Soumettez Votre Avis</h1>
    <p class="description">Nous apprécions vos retours. Partagez votre expérience avec nous !</p>

    <form @submit.prevent="submitReview">
      <label for="product">Produit</label>
      <select id="product" v-model="selectedProduct" required>
        <option value="">Sélectionnez un Produit</option>
        <option v-for="product in products" :key="product.id" :value="product.id">
          {{ product.id }} - {{ product.name }} 
        </option>
      </select>

      <label for="rating">Note</label>
      <select id="rating" v-model="selectedRating" required>
        <option value="">Sélectionnez une note</option>
        <option value="5">5</option>
        <option value="4">4</option>
        <option value="3">3</option>
        <option value="2">2</option>
        <option value="1">1</option>
      </select>

      <label for="message">Votre Avis</label>
      <textarea id="message" v-model="reviewComment" rows="4" required placeholder="Partagez votre expérience..."></textarea>
      <!-- Affichage du bouton en fonction de l'authentification -->
      <button v-if="isAuthenticated" type="submit">Soumettre votre Avis</button>
      <button v-else type="button" @click="redirectToLogin">Connectez-vous pour laisser un avis</button>
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
      products: [],
      scrollPosition: 0,
      isAuthenticated: false, // Initialise l'état d'authentification à faux
      currentUser: null,
      selectedProduct: null,
      selectedRating: null,
      reviewComment: "",
    };
  },
  methods: {
    getProductById(productId) {
    return this.products.find((product) => product.id === productId);
  },
    fetchReviews() {
      fetch("/reviews")
        .then((response) => response.json())
        .then((data) => {
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
          this.users = data;
        })
        .catch((error) => {
          console.error("Erreur lors de la récupération des utilisateurs:", error);
        });
    },
    fetchProducts() {
      fetch("/api/products")
        .then((response) => response.json())
        .then((data) => {
          this.products = data;
        })
        .catch((error) => {
          console.error("Erreur lors de la récupération des produits:", error);
        });
    },
    checkAuthentication() {
    fetch("/api/auth/check")
      .then((response) => response.json())
      .then((data) => {
        this.isAuthenticated = data.authenticated; 
        this.currentUser = data.user;
      })
      .catch((error) => {
        console.error("Erreur lors de la vérification de l'authentification:", error);
      });
  },
  submitReview() {
  if (!this.isAuthenticated) {
    alert("Vous devez être connecté pour soumettre un avis.");
    return;
  }
  
  const reviewData = {
    product_id: this.selectedProduct,
    user_id: this.currentUser.id,
    rating: this.selectedRating,
    comment: this.reviewComment,
  };

  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  fetch("/api/reviews/insert", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": csrfToken // Ajoutez cette ligne pour inclure le token CSRF
    },
    body: JSON.stringify(reviewData),
  })
  .then((response) => {
    if (!response.ok) {
      throw new Error("Erreur lors de l'envoi de l'avis.");
    }
    return response.json();
  })
  .then(() => {
    this.fetchReviews();
  })
  .catch((error) => {
    console.error("Erreur lors de l'envoi de l'avis:", error);
    alert("Erreur lors de l'envoi de votre avis");
  });
},

    redirectToLogin() {
      window.location.href = "/connexion"; // Redirige vers la page de connexion
    },
    getUserById(userId) {
      return this.users.find((user) => user.id === userId);
    },
    getStarRating(rating) {
      return Array.from({ length: rating }, (_, i) => i + 1);
    },
    isAnimated(index) {
      const threshold = window.innerHeight * 0.75;
      return this.scrollPosition > index * 300 - threshold;
    },
    checkVisibility() {
      this.scrollPosition = window.scrollY;
    },
  },
  mounted() {
    this.fetchReviews();
    this.fetchUsers();
    this.fetchProducts();
    this.checkAuthentication();
    window.addEventListener("scroll", this.checkVisibility);
    this.checkVisibility();
  },
  beforeDestroy() {
    window.removeEventListener("scroll", this.checkVisibility);
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
  
  /* Styles pour les étoiles */
  .star-rating {
    font-size: 20px;
    margin: 10px 0;
  }

  .star {
    color: orange;
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
  