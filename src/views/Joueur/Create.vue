<template>
  <div class="component">
    <div class="joueur_form">
      <JoueurForm :joueur="joueur" :equipes="equipes" @submit="evt.submit" />
      <p class="annuler"><router-link :to="{ name: 'joueurs.index' }">Annuler</router-link></p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
import JoueurForm from '@/components/Joueur/Form.vue';

const router = useRouter();

const joueur = ref({
  prenom: '',
  nom: '',
  buts: '',
  image: '',
  equipe_id: '',
});

const equipes = ref([]);

axios.get('http://localhost:8000/api/equipes')
  .then(response => {
    equipes.value = response.data;
  })
  .catch(error => {
    console.log(error);
  });


const evt = {
    submit: (formData) => {
        axios.post('http://localhost:8000/api/joueurs', formData).then((res) => {
          router.push({ name: 'joueurs.index' });
        }).catch(error => {
        console.log(error);
      });
    }
};

</script>

<style lang="scss">


.joueur_form {
  width: 100vw;
  height: 100vh;
  background-image: url('/images/aditya-vyas-b7MUFydsU64-unsplash.jpg');
  background-size: cover;
  display: flex;
  align-items: center;
  justify-content: center;

  .annuler {
    margin: 0 auto;
    width: 20%;
    padding: 0.5em 1em;
    background-color: #f0c02f;
    border: none;
    border-radius: 4px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s;

    &:hover {
      background-color: #555;
      color: white;
    }
  }
}
</style>

  

  
