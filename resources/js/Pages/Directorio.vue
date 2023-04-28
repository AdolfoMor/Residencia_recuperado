<script>
import footerComponent from '@/Pages/Componentes/footerv.vue'
import DireComponent from '@/Pages/Componentes/DireTit.vue'
import headerComponent from '@/Pages/Componentes/headerv.vue'
export default {
    components:{
        headerComponent,
        DireComponent,
        footerComponent
    }
}
</script>
<template lang="pug">
#Wrapper 
    header-component 
    Dire-component
    footer-component
</template>
