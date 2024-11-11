<template>
    <div class="dashboard">
        <DashboardSideBar :collapsed="sidebarCollapsed" @toggle="toggleSidebar" />
        <main class="main-content" :class="{ 'collapsed': sidebarCollapsed }">
            <DashboardBlog />
        </main>
    </div>
</template>

<script>
import DashboardSideBar from "@/components/DashboardSideBar.vue";
import DashboardBlog from '@/components/DashboardBlog.vue';

export default {
    components: {
        DashboardSideBar,
        DashboardBlog,
    },
    data() {
        return {
            sidebarCollapsed: false,
        };
    },
    methods: {
        toggleSidebar() {
            this.sidebarCollapsed = !this.sidebarCollapsed;
        },
    },
}
</script>

<style scoped>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    color: white;
}

.dashboard {
    display: flex;
    min-height: 100vh;
    font-family: Arial, sans-serif;
    background-color: #121212;
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
