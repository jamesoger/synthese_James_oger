<template>
  <div class="joueurs-list" :class="{ wait: joueursEquipes.length === 0 }">
    <button><router-link :to="{ name: 'joueurs.create' }">Ajouter un joueur</router-link></button>
    <input class="recherche" v-model="recherche" type="text" placeholder="Rechercher un joueur">
    <div class="joueurs-container">
      <div v-for="(equipeJoueurs, equipeNom) in joueursParEquipe" :key="equipeNom" class="equipe">
        <div class="equipe-header">
          <h2>{{ equipeNom }}</h2>
        </div>
        <img :src="getEquipeImage(equipeJoueurs[0])" alt="" class="equipe-image">
        <p class="voir-joueurs" @click="toggleEquipeJoueurs(equipeNom)">
          Voir les joueurs <i :class="{'arrow-up': equipeJoueursVisible[equipeNom], 'arrow-down': !equipeJoueursVisible[equipeNom]}"></i>
        </p>
        <div class="equipe-joueurs" v-if="equipeJoueursVisible[equipeNom]">
          <div v-for="joueur in equipeJoueurs" :key="joueur.id" class="joueur">
            <div class="joueur-image">
              <img :src="`/img/joueurs/${joueur.id}/512x512.webp`" alt="">
            </div>
            <div class="joueur-info">
              <p>{{ joueur.prenom }} {{ joueur.nom }}</p>
              <p class="voir_plus"><router-link :to="{ name: 'joueurs.show', params: { id: joueur.id } }">voir plus...</router-link></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { defineProps, computed, ref } from 'vue';

const props = defineProps({
  joueursEquipes: {
    type: Array,
    default: () => [],
  },
});

const recherche = ref('');

const joueursParEquipe = computed(() => {
  const joueursParEquipeMap = {};
  joueursFiltres.value.forEach(joueurEquipe => {
    const equipeNom = joueurEquipe.equipe_nom;
    if (!joueursParEquipeMap[equipeNom]) {
      joueursParEquipeMap[equipeNom] = [];
    }
    joueursParEquipeMap[equipeNom].push(joueurEquipe);
  });
  return joueursParEquipeMap;
});

const equipeJoueursVisible = ref({});

const toggleEquipeJoueurs = (equipeNom) => {
  equipeJoueursVisible.value[equipeNom] = !equipeJoueursVisible.value[equipeNom];
};

const getEquipeImage = (joueurEquipe) => {
  return joueurEquipe.equipe_image;
};

const joueursFiltres = computed(() => {
  if (!recherche.value) {
    return props.joueursEquipes;
  }

  const rechercheMinuscules = recherche.value.toLowerCase();
  return props.joueursEquipes.filter(joueurEquipe => {
    const nomComplet = `${joueurEquipe.prenom} ${joueurEquipe.nom}`.toLowerCase();
    return nomComplet.includes(rechercheMinuscules);
  });
});
</script>

<style lang="scss">

.recherche{
  width: 20%;
  margin: 0 auto;
  padding: 1em;
}
.joueurs-list {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  background-image: url('/images/thomas-tucker-3W8ZM8nGeHI-unsplash.jpg');
  background-size: cover;

  button {
    width: 250px;
    display: inline-block;
    padding: 0.7em 0.7em;
    margin: 16rem auto 2rem;
    border: 2px solid #333;
    background-color: #564f4f;
    color: #f8ecec;
    text-decoration: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;

    &:hover {
      background-color: #ded6d6;
      color: #1e1d1d;
    }
  }
}

.joueurs-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  margin-bottom: 3rem;
  

}

.equipe{
  margin-bottom: 8rem;
  .equipe-image{
    width: 400px;
    height: auto;
    border-radius: 50%;
    margin: 2rem;
  }
}

.joueur {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 1rem;
}

.equipe-header {
  display: flex;
  align-items: center;
  justify-content:center;
  
}

.equipe-header h2 {
  
  text-shadow: -1px -1px 0 #f0eaea, 1px -1px 0 #eae0e0, -1px 1px 0 #e6e3e3, 1px 1px 0 #333;
}

.voir-joueurs {
  border-radius: 4px;
  padding: 0.25em;
  background-color: rgb(219, 199, 81);
  cursor: pointer;
  font-size: 23px;
  text-decoration: none; 
  display: flex;
  align-items: center;
  justify-content: center;
  color: black;
  &:hover{
    background-color: black;
    color: white;
  }
  
}

.toggle-arrow {
  font-size: 45px;
}

.arrow-up::before {
  content: "▲";
}

.arrow-down::before {
  content: "▼";
}

.equipe-image {
  width: 400px;
  height: 400px;
  object-fit: contain;
}

.joueur-image img {
  width: 160px;
  height: 160px;
  border-radius: 50%;
  object-fit: cover;
}

.joueur-info {
  text-align: center;
  margin-top: 0.5rem;
  color: white;
}

.joueur-info p {
  font-weight: bold;
  font-size: 18px;
  margin: 0;
  text-shadow: -1px -1px 0 #333, 1px -1px 0 #333, -1px 1px 0 #333, 1px 1px 0 #333;
}

.joueur-info p.voir_plus {
  background-color: rgb(8, 8, 7);
  padding: 0.3em 0.7em;
  border-radius: 4px;
  margin-top: 0.5em;
  text-shadow: none;
  &:hover {
    background-color: white;
    color: black;
  }
}

.joueur-info router-link {
  text-decoration: none;
  color: blue;
}
</style>
