<template lang="pug">
div.layout-wrapper(:class="containerClass")
    app-topbar
    div.layout-sidebar
        app-sidebar
    div.layout-main-container
        div.layout-main
        app-footer
    app-config
    div.layout-mask
</template>
<script>
import '@/../css/styles.scss';
import AppTopbar from './components/AppTopbar.vue';
import AppFooter from './components/AppFooter.vue';
import AppSidebar from './components/AppSidebar.vue';
import AppConfig from './components/AppConfig.vue';
import { useLayout } from './components/composables/layout';
import { ref } from 'vue';

const { layoutConfig, layoutState, isSidebarActive } = useLayout();
const outsideClickListener = ref(null);

export default {
    name: 'LayoutComponent',
    components: {
        AppTopbar,
        AppFooter,
        AppSidebar,
        AppConfig
    },
    computed: {
        containerClass: {
            'layout-theme-light': layoutConfig.darkTheme.value === 'light',
            'layout-theme-dark': layoutConfig.darkTheme.value === 'dark',
            'layout-overlay': layoutConfig.menuMode.value === 'overlay',
            'layout-static': layoutConfig.menuMode.value === 'static',
            'layout-static-inactive': layoutState.staticMenuDesktopInactive.value && layoutConfig.menuMode.value === 'static',
            'layout-overlay-active': layoutState.overlayMenuActive.value,
            'layout-mobile-active': layoutState.staticMenuMobileActive.value,
            'p-input-filled': layoutConfig.inputStyle.value === 'filled',
            'p-ripple-disabled': !layoutConfig.ripple.value
        }
    },
    watch: {
        isSidebarActive: (newVal) => {
            if (newVal) {
                bindOutsideClickListener();
            } else {
                unbindOutsideClickListener();
            }
        }
    },
    methods: {
        bindOutsideClickListener(){
            if (!outsideClickListener.value) {
                outsideClickListener.value = (event) => {
                    if (isOutsideClicked(event)) {
                        layoutState.overlayMenuActive.value = false;
                        layoutState.staticMenuMobileActive.value = false;
                        layoutState.menuHoverActive.value = false;
                    }
                };
                document.addEventListener('click', outsideClickListener.value);
            }
        },
        unbindOutsideClickListener(){
            if (outsideClickListener.value) {
                document.removeEventListener('click', outsideClickListener);
                outsideClickListener.value = null;
            }
        },
        isOutsideClicked(event){
            const sidebarEl = document.querySelector('.layout-sidebar');
            const topbarEl = document.querySelector('.layout-menu-button');

            return !(sidebarEl.isSameNode(event.target) || sidebarEl.contains(event.target) || topbarEl.isSameNode(event.target) || topbarEl.contains(event.target));
        }
    }
}
</script>
<style>

</style>