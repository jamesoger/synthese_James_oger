<template>
  <div class="page-container">
    <div class="carousel-wrapper">
      <CarouselVue />
    </div>

  </div>
  <h2>Joueurs vedettes</h2>
  <div class="vedette_div">
    <div class="joueurs-list_1">
      <router-link v-for="joueur in joueursAvecPlusDe10Buts" :key="joueur.id"
        :to="{ name: 'joueurs.show', params: { id: joueur.id } }">
        <div class="vedette">
          <div class="joueur-info">
            <img class="vedette_img" :src="`/img/joueurs/${joueur.id}/512x512.webp`" alt="">
            <p class="joueur-nom">{{ joueur.nom }}</p>
            <p>{{ joueur.buts }} buts</p>
          </div>
        </div>
      </router-link>
    </div>
    <h2>Équipes vedettes</h2>
    <div v-for="equipe in equipesAvecTroisMatchsGagnes" :key="equipe.id">
      <p class="equipe_ved">{{ equipe.equipe_gagnante_nom }}</p>
      <img class="equipe_gagnante" :src="equipe.equipe_gagnante_image" alt="">
    </div>
  </div>
</template>

<script setup>
import CarouselVue from '@/components/Carousel/Carousel.vue'
import { ref, computed, onBeforeMount } from 'vue'
import axios from 'axios'


const joueurs = ref([])
const matchsEquipes = ref([])

onBeforeMount(async () => {
  const joueursResponse = await axios('http://localhost:8000/api/joueurs')
  joueurs.value = joueursResponse.data

  const matchsEquipesResponse = await axios('http://localhost:8000/api/matchs_equipes')
  matchsEquipes.value = matchsEquipesResponse.data
})


const joueursAvecPlusDe10Buts = computed(() => {
  return joueurs.value.filter(joueur => joueur.buts > 10)
})


const equipesAvecTroisMatchsGagnes = computed(() => {
  const equipeCountMap = {}
  matchsEquipes.value.forEach(match => {
    if (match.equipe_gagnante_nom) {
      if (!equipeCountMap[match.equipe_gagnante_nom]) {
        equipeCountMap[match.equipe_gagnante_nom] = {
          count: 1,
          equipe_gagnante_image: match.equipe_gagnante_image
        }
      } else {
        equipeCountMap[match.equipe_gagnante_nom].count++
      }
    }
  })

  const equipesAvecTroisMatchs = []
  for (const equipe in equipeCountMap) {
    if (equipeCountMap[equipe].count >= 3) {
      equipesAvecTroisMatchs.push({
        equipe_gagnante_nom: equipe,
        equipe_gagnante_image: equipeCountMap[equipe].equipe_gagnante_image // Utilisation de l'image
      })
    }
  }

  return equipesAvecTroisMatchs
});

</script>

<style scoped>
.page-container::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  filter: brightness(0.8);
  z-index: -1;
}

.page-container {
  position: relative;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background-image: url('/images/bjorn-snelders-zNNPSqKRR2c-unsplash.jpg');
  background-size: cover;
}

.vedette_div {
  background-color: #e1e0d2ec;

}

.joueurs-list_1 {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
}

.vedette_img {
  max-width: 300px;
  height: auto;

}

.vedette_img:hover {
  border: 3px solid rgb(255, 149, 0);
  /* Remplacez 'red' par la couleur de votre choix */
  /* Ajoutez d'autres styles au survol si nécessaire */
}

.equipe_gagnante {
  max-width: 500px;
  height: auto;
  border: 2px solid rgb(255, 204, 0);
}

h2 {
  margin: 0 auto;
  padding: 0.75em;
  color: wheat;
  background-color: rgb(52, 48, 45);
}

.equipe_ved {
  font-size: 23px;
}

.vedette {
  display: flex;
  justify-content: center;
  margin-top: 4rem;
  margin-bottom: 4rem;
}

.joueur-info {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.joueur-nom {
  margin-top: 10px;
  font-weight: bold;
  font-size: 23px;
  color: #9c9898;
}

img {
  border-radius: 50%;
  margin: 2rem;
}

p {
  margin: 20px;
}




.carousel-wrapper {
  width: 100%;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>

  
  