<template lang="pug">
div.layout-wrapper(:class="containerClass")
    app-topbar
    //- <!-- <div class="layout-sidebar">
    //-     <app-sidebar></app-sidebar>
    //- </div>
    //- <div class="layout-main-container">
    //-     <div class="layout-main">
    //-         <router-view></router-view>
    //-     </div>
    //-     <app-footer></app-footer>
    //- </div>
    //- <app-config></app-config>
    //- <div class="layout-mask"></div> -->
</template>
<script>
import '../../../css/themes/lara-light-indigo/theme.css';
import AppTopbar from './components/AppTopbar.vue';
import AppFooter from './components/AppFooter.vue';
import AppSidebar from './components/AppSidebar.vue';
import AppConfig from './components/AppConfig.vue';
export default {
    components: {
        AppTopbar,
        AppFooter,
        AppSidebar,
        AppConfig
    },
    created(){

    }
}
</script>