<template>
    <div class="title-FAQ">
        <h1>Foire Aux Questions (FAQ)</h1>
      </div>
    <div class="faq-section">
      <h1>Toutes les questions fréquemment posées</h1>
      <p class="description">D’autres questions ? N’hésitez pas, contactez moi</p>
      <button class="faq-section-button">
        <router-link to="/contact" style=" text-decoration: none; color: white;">Contact</router-link>
      </button>
  
      <div class="faq-item" v-for="(faq, index) in faqs" :key="index">
        <button class="faq-question" @click="toggleFaq(index)">{{ faq.question }}</button>
        <div
          class="faq-answer"
          :style="{ maxHeight: activeIndex === index ? answerHeights[index] : null, padding: activeIndex === index ? '15px 0' : '0' }"
          ref="answers"
        >
          <p>{{ faq.answer }}</p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        faqs: [
          { question: "Quel est le délai de livraison pour les produits ?", answer: "Le délai de livraison est généralement de 3 à 5 jours ouvrables, en fonction de votre emplacement." },
          { question: "Comment puis-je suivre ma commande ?", answer: "Une fois votre commande expédiée, vous recevrez un email avec un lien de suivi." },
          { question: "Puis-je retourner un produit ?", answer: "Oui, vous pouvez retourner un produit dans les 30 jours suivant sa réception." },
          { question: "Quels sont les modes de paiement acceptés ?", answer: "Nous acceptons les cartes de crédit, PayPal, et les virements bancaires." },
          { question: "Comment puis-je contacter le support client ?", answer: "Vous pouvez nous contacter via le formulaire de contact ou par téléphone au +33 1 23 45 67 89." },
        ],
        activeIndex: null,
        answerHeights: [],
      };
    },
    mounted() {
      // Calcul de la hauteur maximale des réponses une fois que le DOM est prêt
      this.$nextTick(() => {
        this.answerHeights = Array.from(this.$refs.answers).map(el => `${el.scrollHeight}px`);
      });
    },
    methods: {
      toggleFaq(index) {
        if (this.activeIndex === index) {
          this.activeIndex = null;
        } else {
          this.activeIndex = index;
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .title-FAQ {
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    background-image: url('../../../public/images/zoroonepiece.jpg'); /* Met ton image ici */
    background-size: cover;
    background-position: center;
    padding: 250px; 
    margin: 0;
  }
  
  .title-FAQ h1 {
    font-size: 40px;
    color: white;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8); /* Ajout d'un effet d'ombre pour le texte */
  }
  
  /* Media Queries */
  @media (max-width: 1024px) {
    .title-FAQ h1 {
      font-size: 30px;
    }
    .title-FAQ {
      padding: 40px;
    }
  }
  
  @media (max-width: 768px) {
    .title-FAQ h1 {
      font-size: 24px;
    }
    .title-FAQ {
      padding: 30px;
    }
  }
  
  @media (max-width: 480px) {
    .title-FAQ h1 {
      font-size: 20px;
    }
    .title-FAQ {
      padding: 20px;
    }
  }
  .faq-section {
    max-width: 800px;
    margin: 150px auto;
    padding: 50px 20px;
  }
  
  .faq-section h1 {
    font-size: 3em;
    margin-bottom: 20px;
    text-align: center;
  }
  
  .faq-section .description {
    font-size: 1.2em;
    margin-bottom: 30px;
    text-align: center;
  }
  
  .faq-item {
    margin-bottom: 15px;
    padding-bottom: 10px;
  }
  
  .faq-question {
    background-color: #f7f7f7;
    color: #333;
    font-size: 1.2em;
    padding: 15px;
    width: 100%;
    text-align: left;
    border: 1px solid rgb(235, 235, 235);
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.1s ease;
  }
  
  .faq-question:hover {
    background-color: #ededed;
  }
  
  .faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-out, padding 0.3s ease-out;
    padding: 0;
    font-size: 1.1em;
    color: #555;
    margin-left: 15px;
  }
  
  .faq-section-button {
    display: block;
    margin: 0 auto 30px auto;
    background-color: #333;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 1.2em;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  .faq-section-button:hover {
    background-color: #555;
  }
  </style>
  