<template lang="pug">
#Subheader(style='padding:125px 0;')
  .container
    .column.one
      h1.title Directorio Empresarial 
.row.col-md-8.mx-auto.mt-3
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