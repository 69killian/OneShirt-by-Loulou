<template>
  <section id="products" class="products">
    <h2>Gestion des Produits</h2>
    <button @click="showCreateForm">Créer un Produit</button>

    <!-- Formulaire de création ou de modification -->
    <div v-if="isCreating || isEditing" class="create-product-form">
      <h3>{{ isCreating ? 'Créer un nouveau produit' : 'Modifier le produit' }}</h3>
      <form @submit.prevent="isCreating ? confirmCreateProduct() : confirmEditProduct()">
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
          <input v-model="newProduct.price" type="text" id="price" required placeholder="Prix" MIN="0"/>
        </div>
        <div>
          <label for="stock_quantity">Stock:</label>
          <input v-model="newProduct.stock_quantity" type="number" id="stock_quantity" required placeholder="Quantité en Stock"/>
        </div>
        <div>
        <label for="promotion_id">Promotion:</label>
        <select v-model="newProduct.promotion_id" id="promotion_id">
          <option value="">Aucune promotion</option>
          <option v-for="promotion in promotions" :key="promotion.id" :value="promotion.id">
            {{ promotion.name }}
          </option>
        </select>
      </div>
        
        <!-- Champ pour télécharger l'image -->
        <div>
          <label for="product_image">Image du produit:</label>
          <input type="file" id="product_image" @change="onImageSelected" />
        </div>
        
        <div>
          <button type="submit">Confirmer {{ isCreating ? 'la création' : 'la modification' }}</button>
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
          <td>{{ getPromotionNameById(product.promotion_id) }}</td>
          <td>{{ product.created_at.substr(0, 10) || 'N/A' }}</td>
          <td>
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
      promotions: [],
      productTypes: [],
      newProduct: {
        name: '',
        description: '',
        type: '',
        color: '',
        price: 0,
        stock_quantity: 0,
        promotion_id: null,
        image: null,
      },
      isCreating: false,
      isEditing: false,
      currentProduct: null,
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
        this.productTypes = [...new Set(this.products.map((product) => product.type))];
      })
      .catch((error) => {
        console.error('Erreur lors de la récupération des produits:', error);
      });
  },
  fetchPromotions() {
  axios
    .get('/promotions')
    .then((response) => {
      this.promotions = response.data; // Stockage des promotions
    })
    .catch((error) => {
      console.error('Erreur lors de la récupération des promotions:', error);
    });
  },
  getProductImage(product) {
    return product.image || '/images/default.jpg';
  },
  getPromotionNameById(promotionId) {
  const promotion = this.promotions.find((promo) => promo.id === promotionId);
  return promotion ? promotion.name : 'Aucune promotion'; 
  },
  showCreateForm() {
    this.isCreating = true;
    this.isEditing = false;
    this.clearNewProduct();
  },
  showEditForm(product) {
    this.isCreating = false;
    this.isEditing = true;
    this.currentProduct = { ...product }; // Copie des données du produit
    this.newProduct = { ...product }; // Pré-remplissage du formulaire avec les données du produit
  },
  cancelCreate() {
    this.isCreating = false;
    this.isEditing = false;
    this.clearNewProduct();
  },
  confirmCreateProduct() {
    if (confirm('Voulez-vous vraiment créer ce produit ?')) {
      this.createProduct();
    }
  },
  confirmEditProduct() {
    if (confirm('Voulez-vous vraiment modifier ce produit ?')) {
      this.updateProduct();
    }
  },
  createProduct() {
      axios
        .post('/api/create/products', this.newProduct)
        .then((response) => {
          const createdProduct = response.data;

          // Si une image est sélectionnée, créer l'image pour le produit
          if (this.newProduct.image) {
            this.createImage(createdProduct.id);
            location.reload();
          } else {
            this.products.push(createdProduct);
            this.cancelCreate();
            location.reload();
          }
        })
        .catch((error) => {
          console.error('Erreur lors de la création du produit:', error);
          location.reload();
        });
    },
    createImage(productId) {
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const formData = new FormData();
      formData.append('image', this.newProduct.image);

      axios
        .post(`/api/create/product-image/${productId}`, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
            'X-CSRF-TOKEN': csrfToken,
          },
        })
        .then((response) => {
          console.log('Image créée avec succès:', response.data);
          this.fetchProducts(); // Met à jour la liste des produits
          this.cancelCreate();
          location.reload();
        })
        .catch((error) => {
          console.error('Erreur lors de la création de l\'image:', error);
          location.reload();
        });
    },
  updateImage() {
    // Récupère le token CSRF depuis la balise méta
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Prépare le FormData pour l'upload de l'image
    const formData = new FormData();
    formData.append('image', this.newProduct.image);

    // Envoie l'image
    axios
      .post(`/api/update/product-image/${this.currentProduct.id}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'X-CSRF-TOKEN': csrfToken, // Ajout du token CSRF
        },
      })
      .then((response) => {
        console.log('Image mise à jour avec succès:', response.data);
        this.fetchProducts(); // Met à jour la liste des produits après l'upload
        this.cancelCreate();
        location.reload();
      })
      .catch((error) => {
        console.error('Erreur lors de la mise à jour de l\'image:', error);
        location.reload();
      });
  },
  updateProduct() {
  // Met à jour le produit
  axios
    .post(`/api/update/products/${this.currentProduct.id}`, this.newProduct)
    .then((response) => {
      // Met à jour la liste des produits avec le produit mis à jour
      const index = this.products.findIndex((p) => p.id === this.currentProduct.id);
      this.products[index] = response.data;

      // Si une nouvelle image a été sélectionnée, mettre à jour l'image
      if (this.newProduct.image) {
        this.updateImage();
      } else {
        this.cancelCreate(); // Annule l'édition si pas d'image à mettre à jour
      }
    })
    .catch((error) => {
      console.error('Erreur lors de la mise à jour du produit:', error);
    });
},
  editProduct(product) {
    this.showEditForm(product);
  },
  deleteImage(imageId) {
    axios
      .delete(`/api/delete/product-image/${imageId}`)
      .then(() => {
        console.log('Image supprimée avec succès');
        this.fetchProducts(); // Met à jour la liste des produits après la suppression de l'image
        location.reload();
      })
      .catch((error) => {
        console.error('Erreur lors de la suppression de l\'image:', error);
        location.reload();
      });
  },
  deleteProduct(id) {
    const product = this.products.find((product) => product.id === id);
    if (product && product.image) {
      const imageId = product.image.id; // Assure-toi que l'ID de l'image est disponible dans le produit
      this.deleteImage(imageId); // Supprime d'abord l'image associée
    }
    
    axios
      .delete(`/api/delete/products/${id}`)
      .then(() => {
        this.products = this.products.filter((product) => product.id !== id);
        location.reload();
      })
      .catch((error) => {
        console.error('Erreur lors de la suppression du produit:', error);
        location.reload();
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
      image: null,
    };
  },
  onImageSelected(event) {
    const file = event.target.files[0];
    if (file) {
      this.newProduct.image = file;
    }
  },
},
  mounted() {
    this.fetchProducts();
    this.fetchPromotions(); // Récupération des promotions
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