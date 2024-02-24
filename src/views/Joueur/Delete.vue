<template>
  <div class="component">
    <div class="delete">
      <h2 v-if="joueur">Suppression du joueur "{{ joueur.nom }}"</h2>
      <p v-if="joueur">Voulez-vous vraiment supprimer ce joueur?</p>
      <button v-if="joueur" class="confirm-button" @click="submit">Confirmer la suppression</button>
      <p v-if="joueur" class="annuler"><router-link :to="{ name: 'joueurs.index' }">Annuler</router-link></p>
    </div>
  </div>
</template>

<script setup>
import { ref, defineProps } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

const router = useRouter()
const props = defineProps({
  id: {
    type: [Number, String],
    required: true,
  },
})
const joueur = ref(null)

axios
  .get('http://localhost:8000/api/joueurs/' + props.id)
  .then(response => {
    joueur.value = response.data
  })
  .catch(error => {
    console.log(error)
  })

const submit = async () => {
  try {
    await axios.delete(`http://localhost:8000/api/joueurs/${joueur.value.id}`)
    router.push({ name: 'joueurs.index' }) 
  } catch (error) {
    console.error('Erreur lors de la suppression du joueur', error)
  }
};
</script>

<style lang="scss">
.component {

  .delete {
    position: absolute;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-image: url('/images/aditya-vyas-b7MUFydsU64-unsplash.jpg');
    background-size: cover;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    h2{
      color: white;
      font-size: 39px;
      text-shadow: -1px -1px 0 #333, 1px -1px 0 #333, -1px 1px 0 #333, 1px 1px 0 #333;
    }
    p{
      color: white;
      font-size: 22px;
      text-shadow: -1px -1px 0 #333, 1px -1px 0 #333, -1px 1px 0 #333, 1px 1px 0 #333;
    }

    .confirm-button {
      margin-top: 1em;
      padding: 0.5em 1em;
      background-color: #d1603d;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 18px;
      cursor: pointer;
      transition: background-color 0.3s;

      &:hover {
        background-color: #555;
      }
    }

    .annuler {
      margin-top: 1em;
      padding: 0.5em 1em;
      background-color: #d1603d;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 18px;
      cursor: pointer;
      transition: background-color 0.3s;

      &:hover {
        background-color: #555;
      }
    }
  }
}
</style>

  