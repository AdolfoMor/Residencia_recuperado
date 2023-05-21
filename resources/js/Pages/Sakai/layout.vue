<template lang="pug">
<!-- div.layout-wrapper(:class="containerClass") -->
div.layout-wrapper(class="layout-theme-light layout-static" :class="toggleMenu ? 'layout-static-inactive layout-mobile-active' : ''")
    app-topbar
    div.layout-sidebar
            app-sidebar
    div.layout-main-container
        div.layout-main
            slot(name="content")
        app-footer
    div.layout-mask
</template>
<style>
    @import 'bootstrap';
    a{
        text-decoration: none;
    }
    .p-inputtext{
        width: 100%
    }
    .layout-sidebar{
        z-index: 1 !important;
    }
    .p-dialog.p-component{
        background-color: white;
    }
    .p-dialog-mask.p-component-overlay.p-component-overlay-enter{
        z-index: 9 !important;
    }
</style>
<script>
import '@/../css/styles.scss';
import '@/../css/layout/styles/theme/lara-light-indigo/theme.css';
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
