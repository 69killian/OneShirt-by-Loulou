<template>
    
    <section id="Promo" class="promo">
        <h2>Gestion des Promotions</h2>
        <table>
          <thead>
            <tr>
              <th>Nom</th>
              <th>Description</th>
              <th>Pourcentage de réduction</th>
              <th>Début de l'opération</th>
              <th>Fin de l'opération</th>
              <th>Date de création</th>
              <th>Actions disponibles</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>BIENVENUE10</td>
              <td>Offre de Bienvenue à -10% sur tout le catalogue av...</td>
              <td>10%</td>
              <td>0000-00-00</td>
              <td>0000-00-00</td>
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
       .promo {
    margin-top: 20px;
  }
  
  .promo h2 {
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