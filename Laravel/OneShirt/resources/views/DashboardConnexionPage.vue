<template>
            <DashboardConnexionForm style="padding-bottom: 200px;"/> 
            <Newsletter style="display: none;"/>
            <Footer/>       
</template>

<script>
import DashboardConnexionForm from "@/components/DashboardConnexionForm.vue";
import Footer from "@/components/Footer.vue";
import Newsletter from "@/components/Newsletter.vue";

export default {
    components: {
        DashboardConnexionForm,
        Newsletter,
        Footer,
    },
}
</script>

<style scoped>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    color: white;
    background-color: #121212;
}

.dashboard {
    display: flex;
    min-height: 100vh;
    font-family: Arial, sans-serif;
    padding-right: 50px;
}

.main-content {
    flex-grow: 1;
    padding: 20px;
    transition: margin-left 0.3s ease;
    margin-left: 250px; /* Valeur par défaut pour la sidebar ouverte */
    margin-top: 20px; /* Ajustement pour l'espacement sous l'en-tête */
}

/* Styles pour le contenu principal quand la sidebar est repliée */
.sidebar.collapsed + .main-content {
    margin-left: 50px; /* Ajuster la marge quand la sidebar est repliée */
}

.sidebar.collapsed {
    margin-left: 0; /* Aucune marge lorsque la sidebar est cachée */
}
</style>
