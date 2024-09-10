<template>
    

     <!-- Loulou Channel -->

     <section class="section-loulou">
        <div>
            <p class="title-section-loulou">Chaine de Loulou</p>
            <p class="subheading-section-loulou">CEO de OneShirt</p>
        </div>
        <div class="Channel-loulou">
            <div class="avatar-review">
            <img class="avatar" src="../../../public/images/Avatar.png" alt="Chaine de loulou logo">
            <div class="reviewer-info">
                <p class="reviewer-name">Reviewer Name</p>
                <p class="review-date">Date</p>
            </div>
        </div>
        <div class="subscribe-button">
            <button>S'Abonner</button>
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
    background-color: rgb(197, 197, 197);
    display: flex;
    justify-content: space-around;
    padding-top: 100px;
    padding-bottom: 100px;
    margin-bottom: 0px;
}

.subscribe-button {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 30px;
}

.subscribe-button button {
    background-color: #d91010; 
    color: white; 
    font-size: 16px; 
    font-weight: bold; 
    padding: 10px 20px; 
    border: 1px solid rgb(161, 0, 0); 
    border-radius: 10px; 
    cursor: pointer; 
    transition: background-color 0.3s ease;
}

.subscribe-button button:hover {
    background-color: #cc0000;
}

.title-section-loulou {
    font-weight: 500;
    font-size: 35px;
    height: 0; 
    overflow: visible; 
}

.subheading-section-loulou {
    color: rgb(137, 137, 137);
    font-size: 25px;
    font-weight: 300;
    margin: 0; /* Enlève les marges pour aligner le texte avec le titre */
    padding: 0; /* Enlève les espacements internes */
}




  </style>
  