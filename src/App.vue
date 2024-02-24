<script setup>
import { RouterView } from 'vue-router'
import MainNav from '@/components/Nav.vue'
</script>

<template>
  <main-nav />
  <RouterView />
  <footer>
    <div class="left-section">
      <img src="/images/logo.png" alt="logo" width="120px">
    </div>
    <div class="middle-section">
      <p>123 Chemin des Balais Magiques<br>
        Château-en-Ciel<br>
        Poudlard, XX 12345<br>
        Pays des Sorciers</p>
      <a href="http://quidditchcanada.com/fr/page-accueil/"
        target="_blank">http://quidditchcanada.com/fr/page-accueil/</a><br>
    </div>
    <div class="right-section">

      <a href="https://www.facebook.com/groups/3268643229895487" target="_blank">
        <img src="/images/facebook.png" alt="" width="80px">
        <p>&copy;James Oger</p> <br>
      </a>
    </div>
  </footer>
</template>
