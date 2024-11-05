<template>
    <header>
        <h1>Tableau de Bord</h1>
        <div class="user-info">
            <span>Bienvenue, (username)</span>
            <img src="" alt="Photo de profil" class="profile-pic">
        </div>
    </header>
</template>

<script>
</script>

<style scoped>
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px; /* Ajustement des espacements */
    background-color: #242424; /* Couleur d'arrière-plan pour l'en-tête */
    border-bottom: 1px solid #545454; /* Bordure en bas de l'en-tête */
    height: 60px; /* Hauteur fixe pour l'en-tête */
    margin-top: -30px;
    margin-bottom: 30px;
}

header h1 {
    font-size: 24px;
    margin: 0; /* Éliminer les marges pour éviter les espacements inutiles */
}

.user-info {
    display: flex;
    align-items: center;
}

.user-info span {
    margin-right: 10px;
}

.profile-pic {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}
</style>
