<template>
    <div class="component">
      <JoueurItem v-if="joueur" :joueur="joueur" />
    </div>
  </template>
  
  <script setup>
  import { defineProps, ref, onMounted } from 'vue';
  import axios from 'axios';
  import JoueurItem from '@/components/Joueur/Item.vue';
  
  const props = defineProps({
    id: {
      type: [Number, String],
      required: true,
    },
  });
  
  const joueur = ref(null);
  
  axios.get('http://localhost:8000/api/joueurs_equipes/' + props.id)
	.then((response) => {
		joueur.value = response.data
	})
	.catch((error) => {
		console.log(error)
	})
  </script>

  <style lang="scss">
  
  </style>
  