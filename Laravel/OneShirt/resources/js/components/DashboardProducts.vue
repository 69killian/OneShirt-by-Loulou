<template>
    <section id="products" class="products">
      <h2>Gestion des Produits</h2>
      <table>
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
              <button @click="createProduct(product)">Créer</button>
              <button @click="editProduct(product)">Modifier</button>
              <button @click="deleteProduct(product)">Supprimer</button>
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
      };
    },
    methods: {
      fetchProducts() {
        axios.get('/api/products')
          .then(response => {
            this.products = response.data.map(product => {
              product.image = product.images && product.images.length > 0 ? product.images[0].image_base64 : '';
              return {
                ...product,
                description: product.description || 'Figurine représentant Luffy contre Kaido...',
                type: product.type || 'figurine',
                color: product.color || 'Violet',
                price: product.price || 0,
                stock_quantity: product.stock_quantity || 0,
                promotion: product.promotion || 'aucune',
                created_at: product.created_at || 'N/A'
              };
            });
          })
          .catch(error => {
            console.error('Erreur lors de la récupération des produits:', error);
          });
      },
      getProductImage(product) {
        return product.image || '/images/default.jpg';
      },
      createProduct(product) {
        // Logique pour créer un produit
        console.log('Créer produit:', product);
      },
      editProduct(product) {
        // Logique pour modifier un produit
        console.log('Modifier produit:', product);
      },
      deleteProduct(product) {
        // Logique pour supprimer un produit
        console.log('Supprimer produit:', product);
      },
    },
    mounted() {
      this.fetchProducts();
    }
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
 
    </style>