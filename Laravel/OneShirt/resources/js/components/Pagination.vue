<template>
    <section class="pagination">
      <img class="left-arrow-icon" src="../../../public/images/Icon.png" alt="Previous" />
      <div>Précédemment</div>
      <button>1</button>
      <button>2</button>
      <button>3</button>
      <button>...</button>
      <button>67</button>
      <button>68</button>
      <div>Suivant</div>
      <img class="right-arrow-icon" src="../../../public/images/Icon.png" alt="Next" />
    </section>
  </template>
  
  <script>
  export default {
    name: 'Pagination'
  };
  </script>
  
  <style scoped>
  /* Incluez ici les styles pour le composant Pagination.vue */
  .pagination {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    padding-left: 380px;
    margin-top: 50px;
    margin-bottom: 50px;
  }
  
  .left-arrow-icon {
    transform: rotate(180deg);
    height: 10px;
  }
  
  .right-arrow-icon {
    height: 10px;
  }
  
  @media (max-width: 768px) {
    .pagination {
      padding-left: 0;
      gap: 15px;
      margin-top: 30px;
      margin-bottom: 30px;
    }
  
    .left-arrow-icon, .right-arrow-icon {
      height: 8px;
    }
  }
  
  @media (max-width: 480px) {
    .pagination {
      flex-direction: column;
      padding-left: 0;
      gap: 10px;
      margin-top: 20px;
      margin-bottom: 20px;
    }
  
    .left-arrow-icon, .right-arrow-icon {
      height: 6px;
    }
  }
  </style>
  