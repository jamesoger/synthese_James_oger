<template>
	<div class="component">
	  <JoueurList :joueursEquipes="joueurs_equipes" />
	</div>
  </template>
  
  <script setup>
  import { onBeforeMount, ref } from 'vue';
  import axios from 'axios';
  import JoueurList from '@/components/Joueur/List.vue';
  
  
  const joueurs_equipes = ref([]);
  
  onBeforeMount(async () => {
	try {
	  const response = await axios.get('http://localhost:8000/api/joueurs_equipes/');
	  joueurs_equipes.value = response.data;
	} catch (error) {
	  console.log(error);
	}
  });
  </script>
  
  <style lang="scss">
  </style>
  
  