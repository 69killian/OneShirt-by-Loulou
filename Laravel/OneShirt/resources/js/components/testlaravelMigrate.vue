<template>
    <div>
        <h1>Liste des Produits</h1>
        <ul>
            <li v-for="product in products" :key="product.id">
                <h2>{{ product.name }}</h2>
                <p>{{ product.description }}</p>
                <p>Type: {{ product.type }}</p>
                <p>Couleur: {{ product.color }}</p>
                <p>Prix: {{ product.price }} €</p>
                <div v-if="product.images && product.images.length > 0">
                    <!-- Affiche les images des produits -->
                    <img 
                        v-for="image in product.images" 
                        :key="image.id" 
                        :src="image.image_base64" 
                        :alt="`Image de ${product.name}`" 
                        class="product-image"
                    />
                </div>
            </li>
        </ul>
        <div v-if="errorMessage" class="error">
            {{ errorMessage }}
        </div>
    </div>
</template>


<script>
import axios from 'axios';

export default {
    data() {
        return {
            products: [],
            errorMessage: ''
        };
    },
    mounted() {
        this.fetchProducts();
    },
    methods: {
        async fetchProducts() {
            try {
                const response = await axios.get('/api/products');
                this.products = response.data; // Les images sont déjà incluses dans les données
            } catch (error) {
                console.error('Erreur lors de la récupération des produits:', error);
                this.errorMessage = 'Erreur lors de la récupération des produits. Veuillez réessayer plus tard.';
            }
        },
    }
}
</script>


<style scoped>
.product-image {
    width: 150px; /* Ajuste selon tes besoins */
    height: auto;
    margin-right: 10px;
}
.error {
    color: red;
    font-weight: bold;
}
</style>
