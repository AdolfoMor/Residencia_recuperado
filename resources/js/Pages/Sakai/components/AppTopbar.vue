<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { useLayout } from './composables/layout';

const { layoutConfig, onMenuToggle, contextPath } = useLayout();

const outsideClickListener = ref(null);
const topbarMenuActive = ref(false);

onMounted(() => {
    bindOutsideClickListener();
});

onBeforeUnmount(() => {
    unbindOutsideClickListener();
});

const logoUrl = computed(() => {
    return `${contextPath}layout/images/${layoutConfig.darkTheme.value ? 'logo-white' : 'logo-dark'}.svg`;
});

const onTopBarMenuButton = () => {
    topbarMenuActive.value = !topbarMenuActive.value;
};
const onSettingsClick = () => {
    topbarMenuActive.value = false;
    router.push('/documentation');
};
const topbarMenuClasses = computed(() => {
    return {
        'layout-topbar-menu-mobile-active': topbarMenuActive.value
    };
});

const bindOutsideClickListener = () => {
    if (!outsideClickListener.value) {
        outsideClickListener.value = (event) => {
            if (isOutsideClicked(event)) {
                topbarMenuActive.value = false;
            }
        };
        document.addEventListener('click', outsideClickListener.value);
    }
};
const unbindOutsideClickListener = () => {
    if (outsideClickListener.value) {
        document.removeEventListener('click', outsideClickListener);
        outsideClickListener.value = null;
    }
};
const isOutsideClicked = (event) => {
    if (!topbarMenuActive.value) return;

    const sidebarEl = document.querySelector('.layout-topbar-menu');
    const topbarEl = document.querySelector('.layout-topbar-menu-button');

    return !(sidebarEl.isSameNode(event.target) || sidebarEl.contains(event.target) || topbarEl.isSameNode(event.target) || topbarEl.contains(event.target));
};
</script>

<template lang="pug">
div.layout-topbar
    a.layout-topbar-logo(href="/")
        img(:src="logoUrl" alt="logo")
        span SAKAI
    button(class="p-link layout-menu-button layout-topbar-button" @click="onMenuToggle()")
        i.pi.pi-bars
    button(class="p-link layout-topbar-menu-button layout-topbar-button" @click="onTopBarMenuButton()")
        i.pi.pi-ellipsis-v
    div.layout-topbar-menu(:class="topbarMenuClasses")
        button(@click="onTopBarMenuButton()" class="p-link layout-topbar-button")
            i.pi.pi-calendar
            span Calendar
        button(@click="onTopBarMenuButton()" class="p-link layout-topbar-button")
            i.pi.pi-user
            span Profile
        button(@click="onSettingsClick()" class="p-link layout-topbar-button")
            i.pi.pi-cog
            span Settings
</template>

<style lang="scss" scoped></style>
