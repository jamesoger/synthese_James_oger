<template>
  <div class="component">
    <div class="joueur_form">
      <JoueurForm v-if="joueur" :joueur="joueur" :equipes="equipes" @submit="evt.submit" />
      <p class="annuler"><router-link :to="{ name: 'joueurs.index' }">Annuler</router-link></p>
    </div>
  </div>
</template>

<script setup>
import { ref, defineProps } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
import JoueurForm from '@/components/Joueur/Form.vue';

const router = useRouter();

const props = defineProps({
  id: {
    type: [Number, String],
    required: true,
  },
});

const joueur = ref(null);
const equipes = ref([]);

axios.get('http://localhost:8000/api/equipes')
  .then(response => {
    equipes.value = response.data;
  })
  .catch(error => {
    console.log(error);
  });

axios.get('http://localhost:8000/api/joueurs/' + props.id)
  .then(response => {
    joueur.value = response.data;
  })
  .catch(error => {
    console.log(error);
  });


const evt = {
  submit: (formData) => {
    axios.post(`http://localhost:8000/api/joueurs/${joueur.value.id}`, formData)
      .then((response) => {
        router.push({ name: 'joueurs.show', params: { id: joueur.value.id } });
      })
      .catch((error) => {
        console.error(error);
      });
  },
};


</script>


<style lang="scss"></style>
