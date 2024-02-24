<template>
	<div class="component">
	  <MatchList :matchs="matchs" :villes="villes" :equipes="equipes" :dates="dates" />
	</div>
  </template>
  
  <script setup>
  import { onBeforeMount, ref } from 'vue';
  import axios from 'axios';
  import MatchList from '@/components/Match/List.vue';
  
  const matchs = ref([]);
  const villes = ref([]);
  const equipes = ref([]);
  const dates = ref([]);
  
  onBeforeMount(async () => {
	const response = await axios('http://localhost:8000/api/matchs_equipes');
	matchs.value = response.data;
	villes.value = [...new Set(response.data.map(match => match.ville))];
	equipes.value = [...new Set(response.data.map(match => match.equipe_gagnante_nom))];
	dates.value = [...new Set(response.data.map(match => match.date))];
  });
  </script>
  
  

<style lang="scss">
</style>