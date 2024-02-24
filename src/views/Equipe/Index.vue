<template>
  <div class="component">
    <EquipeList :equipes="equipes" :matchsEquipes="matchsEquipes" :joueursEquipes="joueursEquipes"
      :selectedTeam="selectedTeam" :getMatchesJoues="getMatchesJoues" :getMatchesGagnes="getMatchesGagnes"
      :isMatchWon="isMatchWon" :showTeamStats="showTeamStats" :getTeamMatches="getTeamMatches"
      :getTeamPlayers="getTeamPlayers" />
  </div>
  
</template>
  
<script setup>

import { onBeforeMount, ref } from 'vue'
import axios from 'axios'
import EquipeList from '@/components/Equipe/List.vue'

const selectedTeam = ref(null)

const equipes = ref([])
const matchsEquipes = ref([])
const joueursEquipes = ref([])


// Fonction pour récupérer les matchs joués par une équipe
const getMatchesJoues = (equipeId) => {
  return matchsEquipes.value.filter(match => match.equipe_id_1 === equipeId || match.equipe_id_2 === equipeId).length
}

// Fonction pour récupérer les matchs gagnés par une équipe
const getMatchesGagnes = (equipeId) => {
  return matchsEquipes.value.filter(match => (match.equipe_id_1 === equipeId || match.equipe_id_2 === equipeId) && match.equipe_gagnante_id === equipeId).length
}
const isMatchWon = (match, equipeId) => {
  return match.equipe_gagnante_id === equipeId
}

const showTeamStats = (equipe) => {
  selectedTeam.value = equipe
}

const getTeamMatches = (equipeId) => {
  return matchsEquipes.value.filter(match => match.equipe_id_1 === equipeId || match.equipe_id_2 === equipeId)
}

const getTeamPlayers = (equipeId) => {
  return joueursEquipes.value.filter(joueur => joueur.equipe_id === equipeId)
}

onBeforeMount(async () => {
  try {
    const equipesResponse = await axios.get('http://localhost:8000/api/equipes')
    equipes.value = equipesResponse.data

    const matchsEquipesResponse = await axios.get('http://localhost:8000/api/matchs_equipes')
    matchsEquipes.value = matchsEquipesResponse.data

    const joueursEquipesResponse = await axios.get('http://localhost:8000/api/joueurs_equipes/')
    joueursEquipes.value = joueursEquipesResponse.data
  } catch (error) {
    console.log(error)
  }
})
</script>
  
<style lang="scss"></style>
  
  