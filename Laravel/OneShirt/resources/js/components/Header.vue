<template>
  <header id="header">
    <div class="header-left-hand">
      <router-link to="/">
        <img src="../../../public/images/logosansfondcouleuroneshirt.png" class="logo" alt="Logo OneShirt">
      </router-link>
      <input class="recherche" type="text" placeholder="Rechercher">
    </div>
    <div class="header-right-hand">
      <Tooltip1/>
      <Tooltip2/>
      <router-link to="/blog" style="text-decoration: none; color: black;">Blog</router-link>
      <router-link to="/contact" style="text-decoration: none; color: black;">Contact</router-link>
      <button v-if="!isAuthenticated" @click="goToLogin">
        <router-link to="/connexion" style="text-decoration: none; color: #a35dff;">Connexion</router-link>
      </button>
      <button v-else @click="handleLogout">
        Déconnexion
      </button>
      <button>
        <router-link to="/panier" style="text-decoration: none; color: #a35dff;">Panier 0</router-link>
      </button>
    </div>
  </header>
</template>

<script>
import Tooltip1 from './Tooltip1.vue'
import Tooltip2 from './Tooltip2.vue'
import axios from 'axios';

export default {
  components: {
    Tooltip1, Tooltip2
  },
  data() {
    return {
      isAuthenticated: false
    };
  },
  mounted() {
    // Vérifie si l'utilisateur est authentifié au chargement du composant
    this.checkAuth();
  },
  methods: {
    checkAuth() {
      // Vérifie l'état d'authentification (il faudra peut-être ajuster cela selon ta logique)
      this.isAuthenticated = !!localStorage.getItem('user'); // Supposant que tu stockes l'utilisateur dans le localStorage après la connexion
    },
    async handleLogout() {
      try {
        await axios.post('/api/logout');
        localStorage.removeItem('user'); // Supprimer l'utilisateur du localStorage
        this.isAuthenticated = false; // Met à jour l'état d'authentification
        this.$router.push('/'); // Redirection vers la page d'accueil
      } catch (error) {
        console.error('Erreur lors de la déconnexion', error);
      }
    },
    goToLogin() {
      this.$router.push('/connexion'); // Redirection vers la page de connexion
    }
  }
}
</script>



<style scoped>
header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #8B3CEF;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 70px;
    padding: 0 20px;
    z-index: 1000;
}


.header-left-hand {
    display: flex;
    align-items: center;
    gap: 20px;
}

.header-right-hand {
    display: flex;
    align-items: center;
    gap: 20px;
}

.recherche {
    border: 1px solid #692bb4;
    padding: 10px;
    width: 500px;
    max-width: 500px;
    border-radius: 100px;
    color: white;
    background-color: #36175e;
    transition: width 0.3s ease;
    margin: 0 auto; /* Permet de centrer la barre de recherche */
}

.logo {
    height: 150px;
    width: auto;
    margin-top: 10px;
}

.header-middle {
    display: flex;
    flex-grow: 1;
    justify-content: center; /* Centrer la recherche */
    padding: 0 20px;
}

header button {
  background-color: #36175e;
  padding: 10px 15px;
  border: none;
  border-radius: 7px;
  font-size: 16px;
  font-weight: 500;
  cursor: pointer;
}

@media (max-width: 768px) {
    .recherche {
        max-width: 300px;
    }

    .logo {
        height: 40px;
    }
}

@media (max-width: 480px) {
    .recherche {
        max-width: 200px;
    }

    .logo {
        height: 30px;
    }

    .header-right-hand {
        gap: 10px;
    }

    header {
        flex-direction: column;
        height: auto;
        align-items: flex-start;
    }

    .header-left-hand, .header-right-hand {
        width: 100%;
    }

    .header-right-hand {
        order: 2;
        justify-content: flex-start;
        margin-top: 10px;
    }

    .header-left-hand {
        order: 1;
    }
}

</style>
