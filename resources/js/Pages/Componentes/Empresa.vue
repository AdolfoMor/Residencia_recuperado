<template lang="pug">
.row.col-md-8.mx-auto.mt-3 
  .col-sm-12.col-md-2
    .form-group.bmd-form-group.is-filled
      input.form-control.has-tooltip(v-model="busqueda" placeholder='Buscar: ej. Limpieza' data-original-title='null' )
    .input-group-btn
        button.btn.btn-default(type='button'  @click="buscarAfiliado") Go!

transition(appear duration='550' name='nested')
    .row.col-md-8.mx-auto.mt-3( style='transition-delay: 1s')
        .card.w-7.m-5(style='width: 18rem; background-color: rgba(0, 0, 0, 0.03);' v-for = "user in users" )
            img.card-img-top.mx-auto.d-block.m-3(:src='user.Logo' alt='Card image cap' style="width:250px;height:auto;") 
            .card-body
                h5.card-title {{user.Nombre}}
                p.card-text
                | {{user.Descripción}}
            ul.list-group.list-group-flush
                li.list-group-item Teléfono: {{user.Teléfono}}
                li.list-group-item Dirección: {{user.Dirección}}
            ul.list-group.list-group-flush
                n-button(@click='showModal = true')
                    | Mostrar Sucursales

            n-modal.custom-card(v-model:show='showModal' preset='card' :style='bodyStyle' title='Modal' :bordered='false' size='huge' :segmented='segmented' v-for = "direccion in users.direcciones")
                template(#header-extra='')
                    | Oops!
                |     Content {{direccion.Dirección}}
                template(#footer='')
                    | Footer







</template>
<script setup>
import { ref } from 'vue'

const show = ref(true)
</script>
<script>
import CardComponent from 'primevue/card';
import TableComponent from '../tableComponent.vue';
import ButtonComponent from 'primevue/button';
import DialogComponent from 'primevue/dialog';
import AccordionTabComponent from 'primevue/accordiontab';
import { NButton } from "naive-ui"
import { NModal } from "naive-ui"

export default {
    components:{
        CardComponent,
        ButtonComponent,
        TableComponent,
        DialogComponent,
        AccordionTabComponent,
        NModal,
        NButton
        
        
    },
    data() {
        return {
            busqueda:'',
            user: {},
            users: [],
            direccion: {},
            direcciones: [],
            bodyStyle: {
            width: "1000px"
        },
            segmented: {
                content: "soft",
                footer: "soft"
            },
            showModal: ref(false),
            meta: {
                last_page: 1
            },
            params: {},
            afiliado: null,
            afiliadoDialog: false,
            deleteProductDialog: false,
            afiliado: {},
            filters: {},
            visible: false,
            submitted: false,
            statuses: [
                {label: 'Durango', value: 'Durango'},
                {label: 'Hidalgo', value: 'lowstock'},
                {label: 'OUTOFSTOCK', value: 'outofstock'}
            ]
        }
    },
    methods: {
        getUsers(){
            axios.get('/api/afiliado').then(response => {
                this.users = response.data.data
                //this.meta = response.data.meta
        }).catch(errors => {
            this.manageErrors(errors)
        })
        },
        buscarAfiliado(){
            axios.get('/api/afiliado/show/' + this.busqueda).then(response => {
                this.users = response.data.data
                this.meta = response.data.meta
            })
        }
    },
    mounted(){
        this.getUsers()
    }
}
</script>
<style scoped>
  
.nested-enter-active, .nested-leave-active {
	transition: all 0.3s ease-in-out;
}
/* delay leave of parent element */
.nested-leave-active {
  transition-delay: 0.25s;
}

.nested-enter-from,
.nested-leave-to {
  transform: translateY(30px);
  opacity: 0;
}

/* we can also transition nested elements using nested selectors */
.nested-enter-active .inner,
.nested-leave-active .inner { 
  transition: all 0.3s ease-in-out;
}
/* delay enter of nested element */
.nested-enter-active .inner {
	transition-delay: 0.25s;
}

.nested-enter-from .inner,
.nested-leave-to .inner {
  transform: translateX(30px);
  /*
  	Hack around a Chrome 96 bug in handling nested opacity transitions.
    This is not needed in other browsers or Chrome 99+ where the bug
    has been fixed.
  */
  opacity: 0.001;
}
</style>