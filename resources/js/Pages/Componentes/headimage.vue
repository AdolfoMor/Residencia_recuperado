<template lang="pug">
.parallax
  .caption
    v-typical.blink(:steps="['FORTALECIENDO', 3000, 'IMPULSANDO', 3000, 'PREPARANDO', 3000]" :loop='Infinity' :wrapper="'h1'", style="color: #fff; left: 10%") 
    h1(style="color: #fff;") A LOS JOVENES EMPRESARIOS
</template> 
<script>
import VTypical from 'vue-typical'
export default {

  components:{
    VTypical
  }
}
</script>
<style scoped>
.blink::after {
  content: '|';
  animation: blink 1s infinite step-start;
  color: #fff;
}

@keyframes blink {
  50% {
    opacity: 0;
  }
}
</style>

