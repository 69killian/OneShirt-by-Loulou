<template>
    <section id="overview" class="overview">
        <div class="card">
          <h3>Ventes du jour</h3>
          <p>€500</p>
        </div>
        <div class="card">
          <h3>Produits en stock</h3>
          <p>150</p>
        </div>
        <div class="card">
          <h3>Nouveaux clients</h3>
          <p>5</p>
        </div>
        <div class="card">
          <h3>Avis récents</h3>
          <p>3</p>
        </div>
      </section>
</template>
    
    <script>
    
    </script>
    
    <style>
    
  .overview {
    display: flex;
    gap: 20px;
  }
  
  .card {
    background-color: #242424;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 100%;
  }
  
  .card h3 {
    font-size: 18px;
    margin-bottom: 10px;
  }
    </style>