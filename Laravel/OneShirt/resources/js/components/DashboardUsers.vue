<template>
    
    <section id="Users" class="users">
        <h2>Gestion des Utilisateurs</h2>
        <table>
          <thead>
            <tr>
              <th>Prénom</th>
              <th>Nom</th>
              <th>Rôle</th>
              <th>Photo de profil</th>
              <th>Pseudo</th>
              <th>E-mail</th>
              <th>Mot de passe Haché</th>
              <th>Numéro de téléphone</th>
              <th>Date de Naissance</th>
              <th>Adresse</th>
              <th>Date de création</th>
              <th>Actions disponibles</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Logan</td>
              <td>Derseher</td>
              <td>admin</td>
              <td><img src="" alt="profile picture"></td>
              <td>louolou</td>
              <td>martykillian7@gmail.com</td>
              <td>ceceiestuntest1234**/*/</td>
              <td>06.24.49.91.65</td>
              <td>2003-07-03</td>
              <td>28 Rue Emile Bender</td>
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
        .users {
    margin-top: 20px;
  }
  
  .users h2 {
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