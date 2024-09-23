<template>
    

     <!-- Loulou Channel -->

     <section class="section-loulou">
        <div>
            <p class="title-section-loulou">Chaine de Loulou</p>
            <p class="subheading-section-loulou">CEO de OneShirt</p>
        </div>
        <div class="Channel-loulou">
            <div class="avatar-review">
            <img class="avatar" src="../../../public/images/logoloulou.jpg" alt="Chaine de loulou logo">
            <div class="reviewer-info">
                <p class="channel-name">Loulou</p>
            </div>
        </div>
        <div class="subscribe-button">
    <div class="button">
        <img src="../../../public/images/ytbsansfond.png" alt="youtubelogo">
        <div class="title-subscribe">S'Abonner</div>
    </div>
</div>
    </div>
        <div>
            <p class="title-section-loulou">Plus de OnePiece</p>
            <p class="subheading-section-loulou">Abonne Toi !</p>
        </div>
    </section>
  </template>
  
  <script>
  export default {
  }
  </script>
  
  <style scoped>
  
/** Loulou channel section **/

.section-loulou {
    position: relative; /* Nécessaire pour positionner les éléments à l'intérieur */
    background-color: rgb(30, 30, 30);
    display: flex;
    justify-content: space-around;
    padding-top: 100px;
    padding-bottom: 100px;
    margin-bottom: 0px;
    overflow: hidden; /* Pour cacher les débordements éventuels */
}

.section-loulou::before,
.section-loulou::after {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    height: 30px; /* Ajuste la hauteur de l'ombre intérieure */
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), transparent); /* Ombre en haut */
}

.section-loulou::before {
    top: 0; /* Positionne l'ombre en haut */
}

.section-loulou::after {
    bottom: 0; /* Positionne l'ombre en bas */
    background: linear-gradient(to top, rgba(0, 0, 0, 0.3), transparent); /* Ombre en bas */
}


.subscribe-button {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 30px;
}

.subscribe-button img {
    height: 15px;
    width: 50px;
    margin-left: -30px;
    margin-right: -30px;
    object-fit: cover; /* Cette propriété fonctionne si l'image a des dimensions définies */
    margin-right: 10px; /* Un petit espace entre l'image et le texte */
}

.subscribe-button .button {
    background-color: #d91010; 
    color: white; 
    font-size: 16px; 
    font-weight: bold; 
    padding: 10px 20px; 
    border: 1px solid rgb(161, 0, 0); 
    border-radius: 10px; 
    cursor: pointer; 
    transition: background-color 0.3s ease;
    display: flex;
    align-items: center;
}

.title-subscribe {
    margin-left: -15px;
}

.subscribe-button .button:hover {
    background-color: #cc0000;
}

.title-section-loulou {
    font-weight: 500;
    font-size: 35px;
    height: 0; 
    overflow: visible; 
    color: white;
}

.subheading-section-loulou {
    color: rgb(137, 137, 137);
    font-size: 25px;
    font-weight: 300;
    margin: 0; /* Enlève les marges pour aligner le texte avec le titre */
    padding: 0; /* Enlève les espacements internes */
}

.avatar {
    height: 50px;
    height: 50px;
    border-radius: 100px;
}


.channel-name {
    color: white;
}

.Channel-loulou {
    display: flex;
    align-items: center;
    flex-direction: column;
}

  </style>
  