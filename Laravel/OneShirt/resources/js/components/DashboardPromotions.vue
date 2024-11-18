<template>
  <section id="Promo" class="promo">
    <h2>Gestion des Promotions</h2>
    <!-- Formulaire de création -->
    <button @click="openCreateModal">Créer une Promotion</button>

    <!-- Table des promotions -->
    <table>
      <thead>
        <tr>
          <th>Nom</th>
          <th>Description</th>
          <th>Pourcentage de réduction</th>
          <th>Début de l'opération</th>
          <th>Fin de l'opération</th>
          <th>Actions disponibles</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="promotion in promotions" :key="promotion.id">
          <td>{{ promotion.name }}</td>
          <td>{{ promotion.description }}</td>
          <td>{{ promotion.discount_percentage }}%</td>
          <td>{{ promotion.start_date }}</td>
          <td>{{ promotion.end_date }}</td>
          <td>
            <button @click="openEditModal(promotion)">Modifier</button>
            <button @click="openDeleteModal(promotion)">Supprimer</button>
          </td>
        </tr>
      </tbody>
    </table>

    

    <div v-if="showModal">
      <form @submit.prevent="submitForm">
        <h3>{{ isEditing ? 'Modifier' : 'Créer' }} une Promotion</h3>
        <label for="name" style="color: black;">Nom :</label>
        <input type="text" v-model="form.name" placeholder="Nom" required />
        <label for="Description" style="color: black; margin-bottom: 20px;">Description :</label>
        <textarea v-model="form.description" placeholder="Description"></textarea>
        <label for="discount" style="color: black;">Discount Percentage :</label>
        <input
          type="number"
          v-model="form.discount_percentage"
          placeholder="Pourcentage de réduction"
          required
        />
        <label for="start_date" style="color: black; margin-top: 20px;">Début de l'opération :</label>
        <input type="date" v-model="form.start_date" placeholder="Date de début" required />
        <label for="end_date" style="color: black; margin-top: 20px;">Fin de l'opération :</label>
        <input type="date" v-model="form.end_date" placeholder="Date de fin" required />
        <button type="submit">{{ isEditing ? 'Modifier' : 'Créer' }}</button>
        <button type="button" @click="closeModal">Annuler</button>
      </form>
    </div>

    <!-- Confirmation pour la suppression -->
    <div v-if="showDeleteModal">
      <p>Êtes-vous sûr de vouloir supprimer cette promotion ?</p>
      <button @click="deletePromotion">Oui</button>
      <button @click="closeDeleteModal">Non</button>
    </div>
  </section>
</template>


<script>
import axios from "axios";

export default {
  name: "PromotionManager",
  data() {
    return {
      promotions: [],
      showModal: false,
      showDeleteModal: false,
      isEditing: false,
      form: {
        id: null,
        name: "",
        description: "",
        discount_percentage: 0,
        start_date: "",
        end_date: "",
      },
      promotionToDelete: null,
    };
  },
  mounted() {
    this.getPromotions();
  },
  methods: {
    async getPromotions() {
      try {
        const response = await axios.get("/promotions");
        this.promotions = response.data;
      } catch (error) {
        console.error("Erreur lors de la récupération des promotions :", error);
      }
    },
    openCreateModal() {
      this.isEditing = false;
      this.resetForm();
      this.showModal = true;
    },
    openEditModal(promotion) {
      this.isEditing = true;
      this.form = { ...promotion };
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
      this.resetForm();
    },
    resetForm() {
      this.form = {
        id: null,
        name: "",
        description: "",
        discount_percentage: 0,
        start_date: "",
        end_date: "",
      };
    },
    async submitForm() {
      try {
        if (this.isEditing) {
          await axios.put(`/promotions/update/${this.form.id}`, this.form); // Route mise à jour
        } else {
          await axios.post("/promotions/store", this.form); // Route mise à jour
        }
        this.getPromotions();
        this.closeModal();
      } catch (error) {
        console.error("Erreur lors de l'envoi du formulaire :", error);
      }
    },
    openDeleteModal(promotion) {
      this.promotionToDelete = promotion;
      this.showDeleteModal = true;
    },
    closeDeleteModal() {
      this.showDeleteModal = false;
      this.promotionToDelete = null;
    },
    async deletePromotion() {
      try {
        await axios.delete(`/promotions/delete/${this.promotionToDelete.id}`); // Route mise à jour
        this.getPromotions();
        this.closeDeleteModal();
      } catch (error) {
        console.error("Erreur lors de la suppression :", error);
      }
    },
  },
};
</script>


    
    <style>
       .promo {
    margin-top: 20px;
  }
  
  .promo h2 {
    margin-bottom: 10px;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
    border: none; /* Suppression de la bordure */
    border-radius: 8px; /* Arrondi des coins */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Ajout d'une ombre */
    overflow: hidden; /* Pour éviter que les coins arrondis soient coupés */
  }
  
  th, td {
    padding: 10px;
    text-align: left;
    background-color: #121212; /* Couleur de fond pour mieux voir les coins arrondis */
  }

  td {
    border-top: #545454 solid 1px;
  }
  
  th {
    font-weight: bold;
    background-color: #242424;
  }

  button {
    padding: 5px 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #0056b3;
  }

  div[role="dialog"] {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: white;
  padding: 20px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}
    </style>