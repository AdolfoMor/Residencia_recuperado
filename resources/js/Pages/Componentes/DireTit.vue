<template lang="pug">
div(data-aos='fade-left')
  #Subheader(style='padding:125px 0;')
    .container
      .column.one
          h1.title Directorio Empresarial 


empresa-component



</template>
<script>
import buscaComponent from '@/Pages/Componentes/Busca.vue'
import empresaComponent from '@/Pages/Componentes/Empresa.vue'
export default {
  components:{
    buscaComponent,
    empresaComponent
  }
  
}
</script>