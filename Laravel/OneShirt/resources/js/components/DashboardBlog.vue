<template>
    
    <section id="Blog" class="blog">
        <h2>Gestion des Articles de Blog</h2>
        <table>
          <thead>
            <tr>
              <th>Titre</th>
              <th>image</th>
              <th>Slug</th>
              <th>Contenu</th>
              <th>Auteur</th>
              <th>Photo de profil</th>
              <th>Date de création</th>
              <th>Actions disponibles</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>L'Assension de Monkey D Luffy : Analyse de son Pa...</td>
              <td><img src="" alt="blog image"></td>
              <td>l-assension-de-monkey-d-luffy-analyse-de-son-parco...</td>
              <td>Monkey D Luffy, Capitaine des Chapeaux de Paille...</td>
              <td>louolou</td>
              <td><img src="" alt="profile picture"></td>
              <td>2024-06-10</td>
              <td><button>Créer</button> <button>Modifier</button> <button>Supprimer</button></td>
            </tr>
          </tbody>
        </table>
      </section>
</template>
    
    <script>
    
    </script>
    
    <style>
    .blog {
    margin-top: 20px;
  }
  
  .blog h2 {
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
    </style>