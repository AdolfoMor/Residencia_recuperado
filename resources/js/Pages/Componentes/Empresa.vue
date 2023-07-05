<template lang="pug">
.row.col-md-8.mx-auto.mt-3 
  .col-sm-8
    .form-group.bmd-form-group.is-filled
      input.form-control.has-tooltip(v-model="busqueda" placeholder='Buscar: ej. Limpieza' data-original-title='null' )
  button.btn.btn-default(type='button'  @click="buscarAfiliado") Go!

div(data-aos='fade-up')
    .row.col-md-10.mx-auto.mt-3( style='transition-delay: 1s')
        .card.w-7.m-5(style='width: 25rem; background-color: rgba(0, 0, 0, 0.03);' v-for = "user in users" )
            .conta
                img.card-img-top.mx-auto.d-block.m-3(:src='user.Logo' alt='Card image cap' style="width:250px; height:auto;") 
            .card-body  
                h5.card-title {{user.Nombre}}
                p.card-text
                | {{user.Descripción}}
            #accordion1
              .card
                #headingOne.card-header
                  h5.mb-0
                    buttoncomponent.btn.btn-link(data-toggle='collapse' :data-target="'#' + user.RFC" aria-expanded='true' :aria-controls="'#' + user.RFC")
                      | Mostrar Sucursales 
                  .collapse(:id='user.RFC' aria-labelledby='headingOne' data-parent='#accordion1')
                    .card-body
                      #accordion2
                        .card(v-for="direccion in user.direcciones")
                          #headingOne.card-header
                            h5.mb-0
                              buttoncomponent.btn.btn-link(data-toggle='collapse' :data-target="'#' + direccion.Calle" aria-expanded='true' :aria-controls="'#' + direccion.Calle")
                                | Sucursal {{direccion.Estado}}
                            .collapse(:id='direccion.Calle' aria-labelledby='headingOne' data-parent='#accordion2')
                              .card-body
                                h4 Teléfono 
                                  p(style="font-size:13px") {{direccion.Telefono}}
                                h4 Dirección 
                                  p(style="font-size:13px") {{direccion.Estado}} {{direccion.Ciudad}} {{direccion.Calle}} {{direccion.Numero}}
                          


</template>
<script setup>
import { ref } from 'vue'
import { NCollapse } from "naive-ui"

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
        NButton,
        NCollapse
        
        
    },
    data() {
        return {
            busqueda:'',
            user: {},
            users: [],
            collapse: '',
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
        toggleButton() {
          this.isActive = !this.isActive;
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
.text {
  color: white;
  font-size: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
}
.imager {
  display: block;
  width: 100%;
  height: auto;
}
.conta:hover .overlay {
  opacity: 1;
}


.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .5s ease;
  background-color: #e61346;
}
</style>