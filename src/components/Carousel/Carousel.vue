<template>
  <div class="carousel-container">
    <vueper-slides
      ref="myVueperSlides"
      autoplay
      :pause-on-hover="pauseOnHover"
      @autoplay-pause="internalAutoPlaying = false"
      @autoplay-resume="internalAutoPlaying = true"
      class="custom-carousel">
      <vueper-slide
        v-for="(slide, i) in slides"
        :key="slide.id"
        :style="{
          backgroundImage: 'url(' + slide.backgroundImage + ')',
          backgroundSize: 'cover'
        }"
      >
      </vueper-slide>
      <template #pause>
        <i class="icon pause_circle_outline"></i>
      </template>
    </vueper-slides>
  </div>
</template>

<script setup>
import { VueperSlides, VueperSlide } from 'vueperslides';
import 'vueperslides/dist/vueperslides.css';

const slides = [
  { id: 1,  backgroundImage: '/images/carousel/pexels-vinícius-vieira-ft-3151954.jpg' },
  { id: 2,  backgroundImage: '/images/carousel/pexels-stephan-streuders-3767825.jpg' },
  { id: 3,  backgroundImage: '/images/carousel/pexels-rdne-stock-project-7979104.jpg' },
  { id: 4,  backgroundImage: '/images/aditya-vyas-b7MUFydsU64-unsplash.jpg' },
  { id: 5,  backgroundImage: '/images/jules-marvin-eguilos-YrcfSDVli3Y-unsplash.jpg' },
  { id: 6,  backgroundImage: '/images/aditya-vyas-3yfE6tF6N24-unsplash.jpg' },
  { id: 7,  backgroundImage: '/images/leo-rivas-SHRc2LNaskE-unsplash.jpg' },
  { id: 8,  backgroundImage: '/images/match.png' },
  { id: 9,  backgroundImage: '/images/Muggle_Quidditch_Game_in_Vancouver_2.jpg' },
  { id: 10,  backgroundImage: '/images/christmas-3048700_1280.jpg' },

];

const pauseOnHover = true;
let internalAutoPlaying = true; 
</script>

<style scoped>
.carousel-container {
  position: relative;
  width: 100%;
  height: 100%; 
  overflow: hidden;
  filter: brightness(1.4); 
  
}

.custom-carousel {
  position: absolute;
  top: 80%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 80%; 
  height: 100%; 
 
   
}


</style>










