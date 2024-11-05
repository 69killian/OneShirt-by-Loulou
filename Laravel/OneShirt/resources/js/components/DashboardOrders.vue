<template>
    <section id="orders" class="orders">
        <h2>Commandes</h2>
        <table>
          <thead>
            <tr>
              <th>ID Commande</th>
              <th>Client</th>
              <th>Total</th>
              <th>Date</th>
              <th>État</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>#1023</td>
              <td>Jean Dupont</td>
              <td>€45</td>
              <td>01/11/2024</td>
              <td><button class="status shipped">Expédiée</button></td>
            </tr>
            <tr>
              <td>#1024</td>
              <td>Julia Test</td>
              <td>€64</td>
              <td>01/11/2024</td>
              <td><button class="status preparation"><i class="fas fa-spinner fa-spin"></i> En préparation</button></td>
            </tr>
            <tr>
              <td>#1025</td>
              <td>Marc Tovaro</td>
              <td>€432</td>
              <td>01/11/2024</td>
              <td><button class="status paid"><i class="fas fa-check-circle"></i> Payée</button></td>
            </tr>
          </tbody>          
        </table>
      </section>
</template>
    
    <script>
    
    </script>
    
    <style>
     .orders {
    margin-top: 20px;
  }
  
  .orders h2 {
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

  /* Style de base pour les cellules d'état */
  .orders button.status {
    padding: 0px 0px; /* Réduire l'espace interne */
    font-size: 12px; /* Réduire la taille de la police */
    text-align: center;
    border-radius: 12px;
}

button.status i {
    margin-right: 5px; /* Espace entre l'icône et le texte */
  }

  button.status.paid i {
    margin-right: 5px; /* Espace entre l'icône et le texte */
    color: #004085;
  }

  button.status.preparation i {
    margin-right: 5px; /* Espace entre l'icône et le texte */
    color: #856404;
  }
  

  
  /* Style pour l'état "payée" */
  .orders button.status.paid {
    background-color: #cce5ff; /* Fond bleu clair */
    color: #004085;           /* Texte bleu foncé */
    border-radius: 20px;
    padding: 4px 5px;
  }
  
  /* Style pour l'état "en préparation" */
  .orders button.status.preparation {
    background-color: #ffe5cc; /* Fond orange clair */
    color: #856404;            /* Texte orange foncé */
    border-radius: 20px;
    padding: 4px 5px;
  }
  
  /* Style pour l'état "expédiée" */
  .orders button.status.shipped {
    background-color: #d4edda; /* Fond vert clair */
    color: #155724;            /* Texte vert foncé */
    border-radius: 20px;
    padding: 4px 5px;
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