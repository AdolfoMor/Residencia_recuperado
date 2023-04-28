<template lang="pug">
#Wrapper 
    header-component
    red-component 
    footer-component
</template>
<script>
import footerComponent from '@/Pages/Componentes/footerv.vue'
import redComponent from '@/Pages/Componentes/Redslide.vue'
import tituloComponent from '@/Pages/Componentes/Titulo.vue'
import headerComponent from '@/Pages/Componentes/headerv.vue'
export default {
    components:{
        headerComponent,
        redComponent,
        tituloComponent,
        footerComponent
    }
}
</script>