<template lang="pug">
#Wrapper 
    header-component
    estructura-component 
    fotos-component
    footer-component
</template>
<script>
import footerComponent from '@/Pages/Componentes/footerv.vue'
import estructuraComponent from '@/Pages/Componentes/estructura.vue'
import tituloComponent from '@/Pages/Componentes/Titulo.vue'
import headerComponent from '@/Pages/Componentes/headerv.vue'
import headimageComponent from '@/Pages/Componentes/headimage.vue'
import fotosComponent from '@/Pages/Componentes/fotos.vue'
export default {
    components:{
        headerComponent,
        estructuraComponent,
        tituloComponent,
        footerComponent,
        fotosComponent,
        headimageComponent
    },
}
</script>