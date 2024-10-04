<template>
    <div>
  
      <!-- Main Picture Blog -->
      <div class="main-img-blog">
        <img src="../../../public/images/zoroonepiece.jpg" alt="main-image">
      </div>
  
      <!-- Section with Image, Header, Subheading, and Text -->
      <div class="outer-container">
        <div class="article-title">
        <h1>L'Ascension de Monkey D. Luffy : Analyse de son Parcours depuis East Blue jusqu'à Wano</h1>
      </div>
        <div class="content-section">
            
            <div class="article-content">
        <p>
          Monkey D. Luffy, capitaine des Chapeaux de Paille et aspirant au titre de Roi des Pirates, est sans doute l'un des personnages les plus emblématiques de l'animation japonaise. Depuis le début de <em>One Piece</em> dans la mer d'East Blue, Luffy a évolué non seulement en termes de puissance physique, mais aussi en tant que leader. Lorsqu'il quitte son village natal, il n'est qu'un jeune homme naïf mais déterminé, prêt à risquer sa vie pour atteindre ses objectifs.
        </p>

        <p>
          Luffy est caractérisé par son fruit du démon, le Gomu Gomu no Mi, qui lui confère la capacité d'étendre son corps comme du caoutchouc. Au départ, ce pouvoir semble limité par rapport à ceux des autres utilisateurs de fruits du démon. Cependant, avec le temps, Luffy développe des techniques de combat créatives, comme le Gear Second, Third, et plus tard, le Gear Fourth, qui lui permettent de rivaliser avec certains des combattants les plus redoutables du monde.
        </p>

        <p>
          L'ascension de Luffy est aussi marquée par ses rencontres avec de puissants alliés et ennemis. Son amitié avec des figures comme Zoro, Sanji, Nami, et le reste de son équipage est cruciale pour son développement. Ensemble, ils surmontent d'innombrables défis, que ce soit contre l'armée de Baroque Works d'Alabasta, les redoutables amiraux de la Marine, ou les membres des Quatre Empereurs comme Big Mom et Kaido.
        </p>

        <p>
          Wano, en particulier, marque un tournant décisif dans le parcours de Luffy. Son combat contre Kaido, l'un des plus redoutés des Empereurs des mers, représente un défi titanesque. C'est à Wano que Luffy apprend véritablement à maîtriser son Haki et à repousser ses limites physiques et mentales. Wano est également l'endroit où il est désigné comme l'un des principaux acteurs dans la guerre finale entre les pirates et le gouvernement mondial. Au-delà des combats, Luffy incarne des valeurs d’amitié, de loyauté, et d’indépendance, ce qui le rend particulièrement inspirant.
        </p>

        <p>
          En analysant le parcours de Luffy, il est évident que son développement personnel est intrinsèquement lié à celui de son équipage. Chaque membre des Chapeaux de Paille apporte une compétence unique et une perspective différente, enrichissant ainsi l'équipe et permettant à Luffy de devenir un leader plus complet et empathique. Leur cohésion face à l'adversité et leur capacité à surmonter des obstacles apparemment insurmontables sont des témoignages de la force de leur amitié et de leur détermination commune.
        </p>

        <p>
          De plus, les épreuves que Luffy traverse dans Wano et ailleurs renforcent son caractère. Son insatiable désir de liberté et son refus de se plier aux injustices font de lui un symbole de résistance contre l'oppression. Ces qualités attirent non seulement des alliés mais inspirent également des générations de fans à croire en la puissance de la volonté et de l'amitié.
        </p>

        <p>
          En conclusion, l'ascension de Monkey D. Luffy dans <em>One Piece</em> est une saga de croissance personnelle, de leadership et de persévérance. De ses débuts modestes à East Blue jusqu'à ses combats titanesques à Wano, Luffy incarne l'esprit indomptable des pirates et la quête incessante de liberté. Son parcours est non seulement captivant mais également profondément inspirant, faisant de lui un personnage emblématique et aimant dans l'univers de l'animation et du manga.
        </p>
      </div>
        </div>
      </div>
  
      
  
      <!-- Blog Articles -->
      <section class="Blogs">
        <div class="blog-with-title">
          <div class="titre-section-blog">
            Articles de Blog
          </div>
          <div class="subheading-section-blog">
            Vous allez aimer
          </div>
          <div class="blog-card animate">
            <img class="img-blog" src="../../../public/images/Image.png" alt="">
            <p class="blog-title-card">Title</p>
            <p class="blog-description">Body text for whatever you’d like to say. Add main takeaway points, quotes, anecdotes, or even a very very short story.</p>
          </div>
          <div class="blog-card animate">
            <img class="img-blog" src="../../../public/images/Image.png" alt="">
            <p class="blog-title-card">Title</p>
            <p class="blog-description">Body text for whatever you’d like to say. Add main takeaway points, quotes, anecdotes, or even a very very short story.</p>
          </div>
          <div class="blog-card animate">
            <img class="img-blog" src="../../../public/images/Image.png" alt="">
            <p class="blog-title-card">Title</p>
            <p class="blog-description">Body text for whatever you’d like to say. Add main takeaway points, quotes, anecdotes, or even a very very short story.</p>
          </div>
        </div>
      </section>
  
      <!-- Like Blog -->
      <div class="like-blog">
        <h1>Soutenez mon contenu avec un Like ou un Dislike !</h1>
        <form id="likeForm">
          <button type="button" id="likeButton">👍 Like</button>
          <button type="button" id="dislikeButton">👎 Dislike</button>
        </form>
        <p id="likeCount">Nombre de likes : <span>0</span></p>
        <p id="dislikeCount">Nombre de dislikes : <span>0</span></p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    mounted() {
      this.addLikeDislikeEventListeners();
    },
    methods: {
      addLikeDislikeEventListeners() {
        document.getElementById('likeButton').addEventListener('click', function() {
          let likeCount = document.getElementById('likeCount').getElementsByTagName('span')[0];
          let currentCount = parseInt(likeCount.textContent);
          likeCount.textContent = currentCount + 1;
        });
  
        document.getElementById('dislikeButton').addEventListener('click', function() {
          let dislikeCount = document.getElementById('dislikeCount').getElementsByTagName('span')[0];
          let currentCount = parseInt(dislikeCount.textContent);
          dislikeCount.textContent = currentCount + 1;
        });
      }
    }
  }
  </script>
  
  
<style scoped>
/* Title Blog */
.title-blog {
  justify-content: center;
  height: auto; /* Ajuste la hauteur en fonction du contenu */
  font-size: 40px;
  margin: 0; /* Supprime la marge externe */
  background-color: #d2d2d2;
  padding: 120px 0px;
  text-align: center; /* Centre le texte pour les petits écrans */
}

.article-title h1 {
  font-size: 2em;
  color: #333;
}

/* Pour les écrans de taille moyenne */
@media (max-width: 1024px) {
  .title-blog {
    font-size: 30px;
    padding: 120px 0px; /* Ajuste le padding pour les écrans moyens */
  }
}

/* Pour les écrans de taille petite */
@media (max-width: 768px) {
  .title-blog {
    font-size: 24px;
    padding: 150px 0px; /* Ajuste le padding pour les petits écrans */
  }
}

/* Pour les très petits écrans */
@media (max-width: 480px) {
  .title-blog {
    font-size: 20px;
    padding: 100px 0px; /* Ajuste le padding pour les très petits écrans */
  }
}

/* Conteneur de l'image du blog */
.main-img-blog {
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0; /* Supprime la marge externe */
  padding: 0; /* Supprime le padding interne */
}

.main-img-blog img {
  height: 450px;
  width: 100%; /* Ajuste la largeur de l'image */
  object-fit: cover; /* Ajuste l'image pour remplir le conteneur sans déformation */
}

/* Section de contenu */
.content-section {
  display: flex;
  align-items: center; /* Aligne l'image et le texte en haut */
  justify-content: center;
  flex-direction: column;
  padding: 110px 500px 150px 500px;
  gap: 30px; /* Espace entre l'image et le texte */
}

.image-container {
  height: 300px; /* Hauteur fixe pour l'image */
}

.image-container img {
  width: 700px;
  height: 450px;
  object-fit: cover; /* Ajuste l'image pour remplir le conteneur sans déformation */
  border-radius: 10px; /* Coins arrondis pour l'image */
}

.text-content {
  flex: 1; /* Prend le reste de l'espace disponible */
  margin-top: 120px;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
}

.text-content .header {
  font-size: 2.5em;
  margin-bottom: 10px;
}

.text-content .subheading {
  font-size: 1.5em;
  color: #666;
  margin-bottom: 20px;
}

.text-content .text {
  font-size: 1em;
  height: 300px;
  width: 700px;
  color: #333;
  line-height: 1.6;
}

/* Media Queries pour rendre responsive */
@media (max-width: 1200px) {
  .content-section {
    padding: 60px 30px;
  }
}

@media (max-width: 992px) {
  .image-container {
    flex: 0 0 250px; /* Ajuster la taille de l'image */
    height: auto; /* Hauteur automatique pour l'image */
  }

  .text-content .header {
    font-size: 2.2em;
  }

  .text-content .subheading {
    font-size: 1.4em;
  }

  .text-content .text {
    font-size: 0.9em;
  }
}

@media (max-width: 768px) {
  .content-section {
    flex-direction: column;
    align-items: center;
    padding: 60px 20px;
  }

  .image-container {
    width: 100%;
    max-width: 100%;
  }

  .text-content {
    margin-top: 30px;
    text-align: center;
  }

  .text-content .header {
    font-size: 2em;
  }

  .text-content .subheading {
    font-size: 1.2em;
  }

  .text-content .text {
    font-size: 0.9em;
    width: auto; /* Permet au texte de s'adapter à la largeur disponible */
    padding: 0 10px; /* Ajouter un peu de padding pour les petits écrans */
  }
}

/* Section des articles de blog */
.Blogs {
  background-color: #f7f7f7;
  padding: 40px 20px;
}

.blog-with-title {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.titre-section-blog {
  font-size: 2.2em;
  margin-bottom: 10px;
}

.subheading-section-blog {
  font-size: 1.5em;
  color: #666;
}

.blog-card {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  margin: 20px;
  width: 300px;
  transition: transform 0.3s ease-in-out;
}

.blog-card:hover {
  transform: scale(1.05);
}

.img-blog {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.blog-title-card {
  font-size: 1.2em;
  margin: 10px;
}

.blog-description {
  font-size: 1em;
  margin: 10px;
}

/* Section Like/Dislike Blog */
.like-blog {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
}

.like-blog h1 {
  font-size: 1.8em;
  margin-bottom: 20px;
}

.like-blog button {
  background: none;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px 20px;
  margin: 5px;
  cursor: pointer;
  font-size: 1em;
}

.like-blog button:hover {
  background-color: #f0f0f0;
}

.like-blog p {
  font-size: 1.2em;
  margin: 10px;
}

.like-blog span {
  font-weight: bold;
}
</style>
  