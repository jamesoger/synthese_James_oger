<template>
  <div class="match-list-container" :class="{ wait: MatchsFiltre.length === 0 }">
    <div class="filters">
      <label for="ville">Ville :</label>
      <select id="ville" v-model="selectedVille">
        <option value="">Toutes les villes</option>
        <option v-for="ville in villes" :key="ville">{{ ville }}</option>
      </select>

      <label for="equipeGagnante">Équipe gagnante :</label>
      <select id="equipeGagnante" v-model="selectedEquipeGagnante">
        <option value="">Toutes les équipes</option>
        <option v-for="equipe in equipes" :key="equipe">{{ equipe }}</option>
      </select>

      <label for="selectedDate">Date :</label>
      <select id="selectedDate" v-model="selectedDate">
        <option value="">Toutes les dates</option>
        <option v-for="date in dates" :key="date">{{ date }}</option>
      </select>
    </div>
    <div class="match-list">
      <table class="match" border="1">
        <thead>
          <tr>
            <th>Numéro du match</th>
            <th>Date</th>
            <th>Ville</th>
            <th>Équipe 1</th>
            <th>Équipe 2</th>
            <th>Équipe gagnante</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="match in MatchsFiltre" :key="match.id">
            <td>{{ match.numero }}</td>
            <td>{{ match.date }}</td>
            <td>{{ match.ville }}</td>
            <td>{{ match.equipe1_nom }}</td>
            <td>{{ match.equipe2_nom }}</td>
            <td>{{ match.equipe_gagnante_nom || 'À venir...' }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="maps-container">
      <iframe v-if="selectedVille" :src="selectedVilleGoogleMapsUrl" width="600" height="450" style="border: 0;"
        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import villesData from '@/data/villes.json'

const selectedVille = ref('')
const selectedEquipeGagnante = ref('')
const selectedDate = ref('')

const props = defineProps({
  matchs: {
    type: Array,
    default: () => [],
  },
  villes: Array,
  equipes: Array,
  dates: Array,
})

const MatchsFiltre = computed(() => {
  return props.matchs.filter((match) => {
    return (
      (selectedVille.value === '' || match.ville === selectedVille.value) &&
      (selectedEquipeGagnante.value === '' ||
        match.equipe_gagnante_nom === selectedEquipeGagnante.value) &&
      (selectedDate.value === '' || match.date === selectedDate.value)
    )
  })
})

const selectedVilleGoogleMapsUrl = computed(() => {
  const selectedVilleData = villesData.find(
    (villeData) => villeData.ville === selectedVille.value
  )

  if (selectedVilleData && selectedVilleData.googleMapsUrl) {
    return selectedVilleData.googleMapsUrl
  }
  return ''
});


</script>
  
<style lang="scss">
.match-list-container {
  z-index: 1000;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
  min-height: 100vh;
  background-image: url(/images/b-k-HAl6CKxM3xU-unsplash.jpg);
  background-size: cover;
  padding: 2em;
}

.match-list {
  flex: 1;
  margin-left: 1em;
  overflow-y: auto;
}

.filters {
  background-color: #b9b7b7ad;
  display: flex;
  padding: 1em;
  border-radius: 6px;
  flex-direction: column;
  align-items: center;
  margin-top: 3rem;
  margin-left: 2rem;

  label {
    font-size: 23px;
    color: white;
  }
}

select {
  margin-top: 1rem;
  padding: 0.8rem 1rem;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  background-color: #4b4646;
  margin: 0.5rem;
  color: rgb(234, 203, 90);
}

.match {
  margin: 0 auto;
  width: 90%;
  border-collapse: collapse;
  border: 1px solid #ccc;
  background-color: rgb(255, 255, 255);
  margin-top: 2rem;
}

th,
td {
  padding: 0.5rem;
  text-align: center;
  border: 1px solid #7a7878;
}

th {
  background-color: #e3d279;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

/* Autres styles si nécessaires */
</style>







  

