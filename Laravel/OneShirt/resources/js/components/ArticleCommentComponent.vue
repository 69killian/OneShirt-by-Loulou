<template>
    <div class="comment-section">
      <label for="comment">Laissez un commentaire :</label>
      <textarea 
        id="comment" 
        v-model="comment" 
        placeholder="Entrez votre commentaire ici..." 
        rows="4"
        class="comment-input">
      </textarea>
      <button @click="submitComment" class="submit-button">Envoyer</button>
    </div>
  </template>
  
  <script>
  
  </script>
  
  <style scoped>
  .comment-section {
    display: flex;
    flex-direction: column;
    width: 100%;
    max-width: 500px;
    margin: 0 auto;
    margin-bottom: 100px;
  }
  
  .comment-input {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
  }
  
  .submit-button {
    background-color: #000; 
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    width: 100%; 
    box-sizing: border-box;
  }
  
  .submit-button:hover {
    background-color: #333;
  }
  
  p {
    margin-top: 15px;
    font-weight: bold;
  }
  </style>
  