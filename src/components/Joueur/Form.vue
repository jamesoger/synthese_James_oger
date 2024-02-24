<template>
	<form class="form" @submit.prevent="evt.submit" enctype="multipart/form-data">
		<div class="form-row">
			<label for="prenom">Prénom</label>
			<span><input type="text" id="prenom" name="prenom" v-model="joueur.prenom"></span>
		</div>
		<div class="form-row">
			<label for="nom">Nom</label>
			<span><input type="text" id="nom" name="nom" v-model="joueur.nom"></span>
		</div>
		<div class="form-row">
			<label for="buts">Buts</label>
			<span><input type="text" id="buts" name="buts" v-model="joueur.buts"></span>
		</div>
		<div class="form-row">
			<label for="image">Image</label>
			<span><input type="file" id="image" name="image"></span>
		</div>
		<div class="form-row">
			<label for="equipe_id" class="equipe_id">Equipe</label>
			<span>
				<select id="equipe_id" name="equipe_id" v-model="joueur.equipe_id">
					<option v-for="equipe in equipes" :key="equipe.id" :value="equipe.id">{{ equipe.nom }}</option>
				</select>
			</span>
		</div>
		<div class="form-row">
			<slot><button class="bouton-envoyer " type="submit">Envoyer</button></slot>
		</div>
	</form>
</template>
  
<script setup>
import { defineProps, defineEmits, ref } from 'vue'

const props = defineProps({
	joueur: {
		type: Object,
		default: () => ({}),
	},
	equipes: {
		type: Array,
		default: () => [],
	},
})

const emit = defineEmits(['submit'])
const joueur = ref(props.joueur)

const evt = {
	submit: () => {
		const formData = new FormData(document.forms[0])
		emit('submit', formData)
	}
};

</script>
  
<style lang="scss">
.form {
	border-radius: 4%;
	background-color: #161515d7;
	border: 2px solid rgb(222, 186, 71);
	padding: 1em;
	width: 30%;
	margin: 15rem auto 22px;
	text-align: center;
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
	color: white;

	.form-row {
		margin: 0.5em 0;
		display: flex;
		flex-direction: column;
		align-items: center;

		label {
			font-size: 25px;
			text-align: center;
			margin-bottom: 0.5em;
			color: white;
		}

		.equipe_id {
			font-size: 25px;
		}

		span {

			input[type="text"],
			input[type="file"],
			select {
				width: 100%;
				padding: 0.5em;
				border: 1px solid #ccc;
				border-radius: 4px;
			}
		}
	}

	.bouton-envoyer {
		margin-top: 1em;
		padding: 0.5em 1em;
		background-color: #cfaa31;
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
</style>

