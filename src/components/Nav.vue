<template>
	<nav>
	  <div class="nav-content">
		<div class="logo-title">
		  <img src="/images/logo.png" alt="Logo Quidditch Battle">
		</div>
		<div class="center-container">
		  <h1>Quidditch Battle</h1>
		  <ul>
			<li><router-link :to="{name:'accueil'}">Accueil</router-link></li>
			<li><router-link :to="{name:'matchs.index'}">Matchs</router-link></li>
			<li><router-link :to="{name:'joueurs.index'}">Joueurs</router-link></li>
			<li><router-link :to="{name:'equipes.index'}">Equipes</router-link></li>
		  </ul>
		</div>
		<div class="slogan">
		  <p>Unis par la Magie,</p>
		  <p>Divisés par la Compétition</p>
		  <p class="slogan-main">Bienvenue à <span class="slogan-title">Quidditch Battle</span></p> <br>
		  <p >Le quidditch des moldus!</p>
		</div>
	  </div>
	</nav>
  </template>
  
  <script setup>
  import { RouterLink } from 'vue-router'
  </script>
  
  <style scoped>
  nav {
	font-family: Verdana, Geneva, Tahoma, sans-serif;
	position: fixed;
	z-index: 100;
	top: 0;
	left: 0;
	width: 100%;
	height: 220px;
	background-color: #fff;
	padding: 2.5rem 0;
	
  }
  
  .nav-content {
	display: flex;
	justify-content: space-between;
	align-items: center;
	padding: 0 3rem;
	height: 100px;
	width: 100%;
  }
  
  .logo-title {
	display: flex;
	align-items: center;
  }
  
  img {
	margin-top: 2.5rem;
	width: 160px;
	height: auto;
  }
  
  .center-container {
	display: flex;
	flex-direction: column;
	align-items: center;
	margin-left: 10%;
  }
  
  h1 {
	
	font-size: 55px;
	margin: 0;
	margin-top: 1rem; 
  }
  
  ul {
	display: flex;
	list-style-type: none;
	margin: 1rem auto;
	padding: 0;
  }
  
  li {
	margin: 0;
	flex-grow: 0.1;
	text-align: center;
  }
  
  a {
	margin: 1rem;
	border: 2px solid  black;
	font-size: 24px;
	display: inline-block;
	padding: .5em 2em;
	text-decoration: none;
	&:hover {
	  color: rgb(214, 169, 35);
	  border-color: rgb(223, 181, 91);
	}
  }
  
  
.slogan {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding-right: 3rem;
  position: relative;
  overflow: hidden; 
}

.slogan p {
  font-size: 22px;
  margin: 0;
  font-family: Arial, sans-serif;
  overflow: hidden; 
  white-space: nowrap; 
  animation: writeText 3s steps(60, end) forwards; 
}


@keyframes writeText {
  0% {
    width: 0; 
  }
  100% {
    width: 100%; 
  }
}

  .slogan-title {
	font-family: Verdana, Geneva, Tahoma, sans-serif;
	font-weight: bold;
  }
  </style>
  
  
  
  
  