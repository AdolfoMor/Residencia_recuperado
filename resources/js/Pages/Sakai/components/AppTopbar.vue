<template lang="pug">
div.layout-topbar
    a.layout-topbar-logo(href="/")
        img(:src="logoUrl" alt="logo")
        span Plataforma CJE
    button(class="p-link layout-menu-button layout-topbar-button" @click="onMenuToggle()")
        i.pi.pi-bars
    button(class="p-link layout-topbar-menu-button layout-topbar-button" @click="onTopBarMenuButton()")
        i.pi.pi-ellipsis-v
    div.layout-topbar-menu(:class="topbarMenuClasses")
    dropdown-component(align='right' width='48')
        template(#trigger='')
            button.flex.text-sm.border-2.border-transparent.rounded-full.transition(v-if='$page.props.jetstream.managesProfilePhotos' class='focus:outline-none focus:border-gray-300')
                img.h-8.w-8.rounded-full.object-cover(:src='$page.props.user.profile_photo_url' :alt='$page.props.user.name')
            span.inline-flex.rounded-md(v-else='')
                button.inline-flex.items-center.px-3.py-2.border.border-transparent.text-sm.leading-4.font-medium.rounded-md.text-gray-500.bg-white.transition(type='button' class='hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50')
                    | {{ $page.props.user.name }}
        template(#content='')
            .border-t.border-gray-100
                form(@submit.prevent='logout')
                    dropdown-link-component(href='#' as='button' @click.prevent='logout')
                        | Log Out

    button( onclick="location.href=route('profile.show');" class="p-link layout-topbar-button")
                    i.pi.pi-cog
                    span Settings
</template>

<style lang="scss" scoped></style>
<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { useLayout } from './composables/layout';
import DropdownComponent from '@/Components/Dropdown.vue';
import DropdownLinkComponent from '@/Components/DropdownLink.vue';
import ButtonComponent from 'primevue/button';
import ResponsiveNavLinkComponent from '@/Components/ResponsiveNavLink.vue';

const { layoutConfig, onMenuToggle, contextPath } = useLayout();
const logout = () => {
    router.post(route('logout'));
};

const outsideClickListener = ref(null);
const topbarMenuActive = ref(false);

onMounted(() => {
    bindOutsideClickListener();
});

onBeforeUnmount(() => {
    unbindOutsideClickListener();
});

const logoUrl = computed(() => {
    return `/content/builder2/images/logo-cej.png`;
});

const onTopBarMenuButton = () => {
    topbarMenuActive.value = !topbarMenuActive.value;
};
const onSettingsClick = () => {
    topbarMenuActive.value = false;
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
<script>
export default {
    ResponsiveNavLinkComponent,
    DropdownLinkComponent,
    DropdownComponent,
    ButtonComponent

}
</script>   