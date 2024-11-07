<template>
  <section id="products" class="products">
    <h2>Gestion des Produits</h2>

    <!-- Affichage du formulaire de création -->
    <div v-if="isCreating" class="create-product-form">
      <h3>Créer un nouveau produit</h3>
      <form @submit.prevent="confirmCreateProduct">
        <div>
          <label for="name">Nom:</label>
          <input v-model="newProduct.name" type="text" id="name" required placeholder="Nom du Produit"/>
        </div>
        <div>
          <label for="description">Description:</label>
          <input v-model="newProduct.description" type="text" id="description" placeholder="Description" />
        </div>
        <div>
          <label for="type">Type:</label>
          <!-- Utilisation du selecteur pour afficher les types de produits -->
          <select v-model="newProduct.type" id="type" required>
            <option value="">Sélectionnez un type</option>
            <option v-for="type in productTypes" :key="type" :value="type">{{ type }}</option>
          </select>
        </div>
        <div>
          <label for="color">Couleur:</label>
          <input v-model="newProduct.color" type="text" id="color" placeholder="Couleur du Produit"/>
        </div>
        <div>
          <label for="price">Prix:</label>
          <input v-model="newProduct.price" type="number" id="price" required placeholder="Prix" />
        </div>
        <div>
          <label for="stock_quantity">Stock:</label>
          <input v-model="newProduct.stock_quantity" type="number" id="stock_quantity" required placeholder="Quantité en Stock"/>
        </div>
        <div>
          <label for="promotion">Promotion:</label>
          <input v-model="newProduct.promotion_id" type="text" id="promotion" placeholder="Promotion"/>
        </div>
        <div>
          <button type="submit">Confirmer la création</button>
          <button @click="cancelCreate">Annuler</button>
        </div>
      </form>
    </div>

    <!-- Table des produits -->
    <table v-else>
      <thead>
        <tr>
          <th>Nom</th>
          <th>Image</th>
          <th>Description</th>
          <th>Type</th>
          <th>Couleur</th>
          <th>Prix</th>
          <th>Stock</th>
          <th>Promotions</th>
          <th>Date de création</th>
          <th>Actions disponibles</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" :key="product.id">
          <td>{{ product.name }}</td>
          <td>
            <img class="img-crud" :src="getProductImage(product)" :alt="`Image de ${product.name}`" />
          </td>
          <td>{{ product.description || 'Description non disponible' }}</td>
          <td>{{ product.type || 'N/A' }}</td>
          <td>{{ product.color || 'N/A' }}</td>
          <td>{{ product.price ? `${product.price}€` : 'N/A' }}</td>
          <td>{{ product.stock_quantity || 'N/A' }}</td>
          <td>{{ product.promotion || 'aucune' }}</td>
          <td>{{ product.created_at.substr(0, 10) || 'N/A' }}</td>
          <td>
            <button @click="showCreateForm">Créer</button>
            <button @click="editProduct(product)">Modifier</button>
            <button @click="deleteProduct(product.id)">Supprimer</button>
          </td>
        </tr>
      </tbody>
    </table>
  </section>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],
      productTypes: [], // Tableau pour stocker les types uniques de produits
      newProduct: {
        name: '',
        description: '',
        type: '',
        color: '',
        price: 0,
        stock_quantity: 0,
        promotion_id: null,
      },
      isCreating: false, // Afficher ou masquer le formulaire de création
    };
  },
  methods: {
    fetchProducts() {
      axios
        .get('/api/products')
        .then((response) => {
          this.products = response.data.map((product) => ({
            ...product,
            image: product.images && product.images.length > 0 ? product.images[0].image_base64 : '',
          }));

          // Extraire les types uniques de produits
          this.productTypes = [...new Set(this.products.map((product) => product.type))];
        })
        .catch((error) => {
          console.error('Erreur lors de la récupération des produits:', error);
        });
    },
    getProductImage(product) {
      return product.image || '/images/default.jpg';
    },
    showCreateForm() {
      this.isCreating = true; // Affiche le formulaire de création
    },
    cancelCreate() {
      this.isCreating = false; // Masque le formulaire de création
      this.clearNewProduct(); // Réinitialise les champs du formulaire
    },
    confirmCreateProduct() {
      if (confirm('Voulez-vous vraiment créer ce produit ?')) {
        this.createProduct();
      }
    },
    createProduct() {
      axios
        .post('/api/create/products', this.newProduct)
        .then((response) => {
          this.products.push(response.data); // Ajoute le nouveau produit à la liste
          console.log('Produit créé avec succès:', response.data);
          this.cancelCreate(); // Masque le formulaire et réinitialise les champs
        })
        .catch((error) => {
          console.error('Erreur lors de la création du produit:', error);
        });
    },
    editProduct(product) {
      axios
        .put(`/api/update/products/${product.id}`, product)
        .then((response) => {
          const index = this.products.findIndex((p) => p.id === product.id);
          this.products[index] = response.data;
          console.log('Produit mis à jour avec succès:', response.data);
        })
        .catch((error) => {
          console.error('Erreur lors de la mise à jour du produit:', error);
        });
    },
    deleteProduct(id) {
      axios
        .delete(`/api/delete/products/${id}`)
        .then(() => {
          this.products = this.products.filter((product) => product.id !== id);
          console.log('Produit supprimé avec succès:', id);
        })
        .catch((error) => {
          console.error('Erreur lors de la suppression du produit:', error);
        });
    },
    clearNewProduct() {
      this.newProduct = {
        name: '',
        description: '',
        type: '',
        color: '',
        price: 0,
        stock_quantity: 0,
        promotion_id: null,
      };
    },
  },
  mounted() {
    this.fetchProducts(); // Récupérer les produits au montage du composant
  },
};
</script>

    
    <style>
     .products {
    margin-top: 20px;
  }
  
  .products h2 {
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

  .img-crud {
    height: 50px;
    width: 50px;
    object-fit: cover;
  }


  .products {
  margin-top: 20px;
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

button[type="button"] {
  background-color: #6c757d;
}

button[type="button"]:hover {
  background-color: #5a6268;
}


/* Formulaire de création produit */
.create-product-form {
    background-color: #242424;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    margin-bottom: 20px;
  }

  .create-product-form h3 {
    color: #fff;
    margin-bottom: 15px;
  }

  .create-product-form div {
    margin-bottom: 10px;
  }

  .create-product-form label {
    color: #ddd;
    display: block;
    margin-bottom: 5px;
  }

  .create-product-form input {
    width: 100%;
    padding: 8px;
    background-color: #333;
    border: 1px solid #545454;
    border-radius: 4px;
    color: #fff;
  }



  .create-product-form input::placeholder {
    color: #888;
  }

  .create-product-form button {
    margin-top: 10px;
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
  }

  .create-product-form button:hover {
    background-color: #0056b3;
  }

  .create-product-form button[type="button"] {
    background-color: #6c757d;
  }

  .create-product-form button[type="button"]:hover {
    background-color: #5a6268;
  }
 
    </style>