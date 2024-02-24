<template>
  <div class="page-container">
    <div class="joueur-container">
      <div class="joueur_vue">
         <h2 class="nom">{{ joueur.prenom }} {{ joueur.nom }}</h2>   
        <hr>
       <p class="titre"> {{ joueur.equipe_nom }}</p>
        <p class="titre"> {{ joueur.equipe_ville }}</p>
        <img :src="`/img/joueurs/${joueur.id}/256x256.webp`" alt="">
        <p>{{ joueur.buts }} buts à son actif</p>
        <router-link :to="{ name: 'joueurs.edit', params: { id: joueur.id } }" class="bouton-modifier">✏️ Modifier</router-link>
        <router-link :to="{ name: 'joueurs.delete', params: { id: joueur.id } }" class="bouton-supprimer">&#x1f5d1;&#xfe0f;</router-link>
        <router-link :to="{ name: 'joueurs.index' }" class="bouton-retour">Retour</router-link>
      </div>
    </div>
    <router-link :to="{ name: 'joueurs.index' }" class="bouton-retour">Retour</router-link>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  joueur: {
    type: Object,
    required: true,
  },
});
</script>

<style lang="scss">
.page-container {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  background-image: url('/images/jules-marvin-eguilos-YrcfSDVli3Y-unsplash.jpg');
  background-size: cover;
}

.joueur-container {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-grow: 2;
}

.joueur_vue {
  border: 2px solid black;
  background-color: #6b6a638c;
  padding: 2em;
  width: 40%; 
  height: 600px;
  margin-top: 11rem; 
  text-align: center;

  p {
    color: white;
    font-size: 22px;
    margin: 0.5rem;
    
  }

  .nom{
    
    font-size: 43px;
    
  }

  .bouton-modifier,
  .bouton-supprimer,
  .bouton-retour {
    display: inline-block;
    padding: 0.5em 1em;
    margin: 0.5em;
    border: 2px solid #333;
    background-color: #f1f1f1;
    color: #333;
    text-decoration: none;
    border-radius: 4px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;

    &:hover {
      background-color: #333;
      color: #f1f1f1;
    }
  }
}

/* Votre style de pied de page */
</style>






  
