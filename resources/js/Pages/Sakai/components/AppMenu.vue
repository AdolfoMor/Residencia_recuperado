<script setup>
import { ref } from 'vue';

import AppMenuItem from './AppMenuItem.vue';

const model = ref([
    {
        label: 'Home',
        items: [{ label: 'Dashboard', icon: 'pi pi-fw pi-check', url: '/dashboard' }]
    },
    {
        label: 'Directorio',
        items: [
            { label: 'Afiliados', icon: 'pi pi-fw pi-table', url: '/Afiliados' },
        ]
    },
    {
        label: 'Administración',
        items: [
            { label: 'Usuarios', icon: 'pi pi-fw pi-user', url: '/Usuario'}
        ]
    },
    {
        label: 'Editar Contenido',
        items: [
            {
                label: 'Páginas',
                icon: 'pi pi-fw pi-bookmark',
                items: [
                    { label: 'Inicio', icon: 'pi pi-fw pi-home', url: '/Afiliados' },
                    { label: 'Estructura Orgánica', icon: 'pi pi-fw pi-users' }
                ]
            }
        ]
    },
]);
</script>

<template>
    <ul class="layout-menu">
        <template v-for="(item, i) in model" :key="item">
            <app-menu-item v-if="!item.separator" :item="item" :index="i"></app-menu-item>
            <li v-if="item.separator" class="menu-separator"></li>
        </template>
    </ul>
</template>

<style lang="scss" scoped></style>
