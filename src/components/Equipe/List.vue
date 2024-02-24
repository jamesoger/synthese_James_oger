<template>
	<div class="equipes-list" :class="{ wait: equipes.length === 0 || matchsEquipes.length === 0 }">
		<div class="contenu_tableau" v-if="!selectedTeam">
			<h2 class="intro">Toutes les statistiques sur vos équipes, cliquez sur l'image de votre équipe pour en savoir
				plus!</h2>
			<table border="1">
				<thead>
					<tr>
						<th>Équipe</th>
						<th>Nom</th>
						<th>Ville</th>
						<th>Matchs Joués</th>
						<th>Matchs Gagnés</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="equipe in equipes" :key="equipe.id">
						<td @click="showTeamStats(equipe)"><img class="img_clic" :src="equipe.image" alt=""></td>
						<td>{{ equipe.nom }}</td>
						<td>{{ equipe.ville }}</td>
						<td>{{ getMatchesJoues(equipe.id) }}</td>
						<td>{{ getMatchesGagnes(equipe.id) }}</td>
					</tr>
				</tbody>
			</table>
		</div>
			<div class="selected" v-if="selectedTeam" :key="selectedTeam.id">
				<h2>Statistiques {{ selectedTeam.nom }}</h2>
				<table border="1">
					<thead>
						<tr>
							<th>Numéro du match</th>
							<th>Date</th>
							<th>Ville</th>
							<th>Équipe 1</th>
							<th>Équipe 2</th>
							<th>Gagnant</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="match in getTeamMatches(selectedTeam.id)" :key="match.id">
							<td>{{ match.numero }}</td>
							<td>{{ match.date }}</td>
							<td>{{ match.ville }}</td>
							<td>{{ match.equipe1_nom }}</td>
							<td>{{ match.equipe2_nom }}</td>
							<td :class="{ 'match-won': isMatchWon(match, selectedTeam.id) }">{{ match.equipe_gagnante_nom ||
								'À venir...' }}</td>
						</tr>
					</tbody>
				</table>
				<h2>Joueurs de l'équipe {{ selectedTeam.nom }}</h2>
				<table border="1">
					<thead>
						<tr>
							<th>Joueur</th>
							<th>Prénom</th>
							<th>Nom</th>
							<th>Ville</th>
							<th>Buts</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="joueur in getTeamPlayers(selectedTeam.id)" :key="joueur.id">
							<td> <img class="miniature" :src="`/img/joueurs/${joueur.id}/128x128.webp`" alt=""></td>
							<td>{{ joueur.prenom }}</td>
							<td>{{ joueur.nom }}</td>
							<td>{{ joueur.equipe_ville }}</td>
							<td>{{ joueur.buts }}</td>
						</tr>
					</tbody>
				</table>
				<button @click="selectedTeam = null">Retour</button>
			</div>
		
	</div>

</template>
  
<script setup>
import { defineProps, ref } from 'vue'

const props = defineProps({
	equipes: Array,
	matchsEquipes: Array,
	joueursEquipes: Array,
	getMatchesJoues: Function,
	getMatchesGagnes: Function,
	isMatchWon: Function,
	showTeamStats: Function,
	getTeamMatches: Function,
	getTeamPlayers: Function,
	selectedTeam: Object,
});



</script>
  
<style lang="scss">
.match-won {
	background-color: yellow;
}

.equipes-list {
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	background-image: url('/images/jules-marvin-eguilos-YrcfSDVli3Y-unsplash.jpg');
	background-size: cover;

	.img_clic {
		width: 100px;
		cursor: pointer;
	}
}

.contenu_tableau {
	width: 70%;
	margin-top: 5rem;

	h2 {
		text-shadow: -1px -1px 0 #fffafa, 1px -1px 0 #ffffff, -1px 1px 0 #d3d0d0, 1px 1px 0 #f5f0f0;
	}
}

.selected {
	margin-top: 19rem;
	margin-bottom: 3rem;
	

	h2 {
		text-shadow: -1px -1px 0 #fffafa, 1px -1px 0 #ffffff, -1px 1px 0 #d3d0d0, 1px 1px 0 #f5f0f0;
	}

	.miniature {
		border-radius: 50%;
		width: 40%;
	}

	button{
		font-size: 19px;
		width: 140px;
		padding:1em ;
		margin-top: 2rem;
		cursor: pointer;
		background-color: rgb(209, 170, 64) ;
		&:hover{
			background-color: grey;
			color: white;
		}
	}
}


table {
	margin: 0 auto;
	width: 70%;
	border-collapse: collapse;
	border: 1px solid #ccc;
	background-color: rgb(255, 255, 255);
	margin-top: 2rem;
}

.centered-table {
	max-width: 60%;
	margin: 0 auto;
	border: 1px solid black;
	border-collapse: collapse;
}

.centered-table th,
.centered-table td {
	border: 1px solid black;
	padding: 8px;
	text-align: center;
}

.centered-table img {
	max-width: 120px;
}

</style>
  

  
  
  