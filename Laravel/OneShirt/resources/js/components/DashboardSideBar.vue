<template>
  <!-- Bouton hamburger pour déclencher l'ouverture/fermeture du menu -->
  <div class="hamburger" @click="$emit('toggle')">
    <i class="fas fa-bars"></i> <!-- Icône hamburger -->
  </div>

  <!-- Navigation latérale (sidebar) avec classe dynamique pour la gestion de l'état de la barre -->
  <nav :class="['sidebar', { collapsed }]">
    <h2>OneShirt</h2> <!-- Titre de la sidebar -->

    <!-- Liste des liens de navigation -->
    <ul>
      <!-- Lien vers le tableau de bord -->
      <li><router-link to="/dashboard"><i class="fas fa-chart-line"></i> <span>Tableau de Bord</span></router-link></li>
      
      <!-- Lien vers la section Produits -->
      <li><router-link to="/dashboard/products"><i class="fas fa-box"></i> <span>Produits</span></router-link></li>
      
      <!-- Lien vers la section Utilisateurs -->
      <li><router-link to="/dashboard/users"><i class="fas fa-users"></i> <span>Utilisateurs</span></router-link></li>
      
      <!-- Lien vers la section Blog -->
      <li><router-link to="/dashboard/blog"><i class="fas fa-blog"></i> <span>Blog</span></router-link></li>
      
      <!-- Lien vers la section Avis -->
      <li><router-link to="/dashboard/avis"><i class="fas fa-star"></i> <span>Avis</span></router-link></li>
      
      <!-- Lien vers la section Promotions -->
      <li><router-link to="/dashboard/promotions"><i class="fas fa-tags"></i> <span>Promotions</span></router-link></li>
      
      <!-- Lien vers la section Commandes -->
      <li><router-link to="/dashboard/orders"><i class="fas fa-receipt"></i> <span>Commandes</span></router-link></li>
      
      <!-- Bouton pour se déconnecter -->
      <li><button @click="handleLogout()"><i class="fas fa-chart-pie"></i> <span>Déconnexion</span></button></li>
    </ul>
  </nav>
</template>

  
  <script>
  export default {
    props: {
      collapsed: {
        type: Boolean,
        required: true
      }
    },
    methods: {
      async handleLogout() {
      try {
        await axios.post('/api/logout');
        localStorage.removeItem('user');
        this.isAuthenticated = false;
        this.totalQuantity = 0;
        this.$router.push('/');
      } catch (error) {
        console.error('Erreur lors de la déconnexion', error);
      }
    },
    }
  }
  </script>
  
  
  <style scoped>

  
  /* Styles pour le bouton hamburger */
  .hamburger {
    font-size: 24px;
    color: #fff;
    cursor: pointer;
    padding: 15px;
    position: absolute;
    top: 11px;
    left: 15px;
    z-index: 1000;
  }
  
  /* Styles de la sidebar */
  /* Styles de la sidebar */
.sidebar {
    background-color: #242424;
    color: #fff;
    width: 250px;
    padding-top: 6px; /* Si vous souhaitez garder un espacement en haut */
    border-right: 1px solid #545454;
    transition: transform 0.3s ease;
    transform: translateX(0);
    height: 100vh;
    position: fixed;
    top: 0; /* S'assurer que la sidebar est en haut */
}

  
  /* Styles pour la sidebar repliée */
  .sidebar.collapsed {
    transform: translateX(-100%);
  }
  
  /* Styles pour les éléments de la sidebar */
  .sidebar h2 {
    text-align: center;
    margin-bottom: 20px;
  }
  
  /* Masquer le texte des éléments quand replié */
  .sidebar.collapsed ul li a span {
    display: none;
  }
  
  /* Styles pour chaque élément de la liste */
  .sidebar ul {
    list-style: none;
    padding-left: 0;
  }
  
  .sidebar ul li {
    display: flex;
    align-items: center;
    justify-content: start;
    padding: 15px 10px;
    border-top: 1px solid #545454;
    transition: background-color 0.3s ease;
  }
  
  /* Style des liens */
  .sidebar ul li a {
    color: #fff;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  
  /* Effet de survol */
  .sidebar ul li:hover {
    background-color: #1a1a1a;
  }
  
  /* Couleur de l'icône */
  .sidebar ul li a i {
    font-size: 18px;
  }

  
/* Media Queries pour rendre la sidebar responsive */
@media (max-width: 768px) { /* Ajustez cette valeur selon vos besoins */
    .sidebar {
        width: 200px; /* Réduire la largeur pour les petits écrans */
    }
    
    .hamburger {
        font-size: 20px; /* Ajustez la taille de l'icône hamburger */
    }
}

@media (max-width: 480px) { /* Pour les très petits écrans */
    .sidebar {
        width: 100%; /* Pleine largeur sur les petits écrans */
        padding-top: 15px; /* Ajustez le padding */
    }
    
    .sidebar.collapsed {
        transform: translateX(-100%); /* Sidebar toujours cachée */
    }
    
    .hamburger {
        top: 5px; /* Ajustez la position */
    }
}
  </style>
  