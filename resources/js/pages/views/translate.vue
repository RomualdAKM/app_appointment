<template>
    <div class="language-selector">
      <div class="select-container">
        <select id="language" v-model="selectedLanguage" @change="changeLocale">
          <option value="esp">Espagnol</option>
          <option value="en">English</option>
        </select>
        <img v-if="selectedLanguage === 'esp'" src="/drapeau-espagne.png" alt="French Flag">
        <img v-else src="/drapeau-english.png" alt="English Flag">
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'; 
  import { useLocation } from '../store/pinia';
  
  const selectedLanguage = ref('esp')
  const getLang = useLocation()
  const changeLocale = () => {
    getLang.useLang = selectedLanguage.value;
  };
  
  </script>
  
  <style scoped>
  .language-selector {
    position: fixed;
    bottom: 0;
    left: 0;
    display: flex;
    font-size: 11px;
    background-color: transparent;
    padding: 10px;
    z-index: 9999; /* Assurez-vous que le composant reste au-dessus du reste de la page */
  }
  
  .select-container {
    display: flex;
    align-items: center;
  }
  
  /* Style pour le select */
  #language {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 5px 10px;
    background-color: rgba(255, 255, 255, 0.8); 
    outline: none;
    margin-right: 2px;
  }
  
  /* Style pour les options du select */
  #language option {
    background-color: transparent;
    color: #333;
  }
  
  /* Style pour les images */
  img {
    max-width: 25px;
    margin-left: 2px;
  }
  
  /* Ajoutez ici vos styles spécifiques si nécessaire */
  </style>
  