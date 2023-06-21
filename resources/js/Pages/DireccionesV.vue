<template lang="pug">
sakai
    template(v-slot:content)
        .col-12
            .card
                .row
                    .col-10 
                        h5 Direcciones
                    .col-2
                    tool-bar-component.mb-4
                        template(#start='')
                            button-component.mr-2(label='Agregar' icon='pi pi-plus' severity='success' @click.prevent='openNew')
                        template(#end='')
                table-component(:columns="columns" :data="addresses" @filter="filterData($event, getAddresses)" :meta="meta" :params="params")
                    template(v-slot="{ row }")
                        tr
                            td.p-6 {{ row.Dirección }}
                            td(align="center")
                                button-component.btn.btn-primary.mr-1(@click="edit(row)" v-tooltip="'Gestionar direccione'" title="Gestionar direccione")
                                    i.pi.pi-pencil
                                button-component.btn.btn-danger(@click="remove(row)" v-tooltip="'Eliminar direccione'" title="Eliminar direccione")
                                    i.pi.pi-trash
        dialog-component.flex.flex-wrap.gap-3.p-fluid(header="Registro de direcciones"  :breakpoints="{ '160px': '75vw' }" :style="{ width: '80vw' }" v-model:visible="dialogs.create" :modal="true")
            form#createForm(@submit.prevent="store" ref="createForm")
                .row 
                    div.col-12
                        transition-group(name="p-message" tag="div")
                            Message(v-for="msg of localErrors" severity="error" :key="msg") {{ msg }}
                    div.flex-auto
                        label(for="stateClient") Estado 
                        multi-select-component(v-model="address.state" :minChars="1" :delay="0" valueProp="id" :resolveOnLoad="true" :filterResults="false" :options="state" mode="single" :trackBy="'name'" :searchable="true" label="name" @select="getCities")
                    div.flex-auto
                        label(for="cityClient") Ciudad 
                        multi-select-component(v-model="address.city" :minChars="1" :delay="0" valueProp="id" :resolveOnLoad="true" :filterResults="false" :options="cities" mode="single" :trackBy="'name'" :searchable="true" label="name")
                    div.col-5
                        span.p-float-label
                            inputtext-component#customerRFC(type="text" name="street" v-model="address.street")
                            label(for="customerRFC") Calle
                    div.col-2
                        span.p-float-label
                            inputtext-component(type="text" id="userAddress" name="number" v-model="address.number" required="true")
                            label(for="userAddress") Número
                    div.col-2
                        span.p-float-label
                            inputtext-component(type="text" id="userAddress" name="letter" v-model="address.letter" required="false")
                            label(for="userAddress") Letra 
                    div.col-3
                        span.p-float-label
                            inputtext-component(type="text" id="userAddress" name="suburb" v-model="address.suburb" required="true")
                            label(for="userAddress") Colonia
                    div.col-12
                        span.p-float-label
                            inputtext-component(type="text" id="userAddress" name="description" v-model="address.description" required="true")
                            label(for="userAddress") Descripción
            template(#footer)
                button-component.p-button-outlined(label="Guardar" @click="$refs.createForm.requestSubmit()" icon="pi pi-check")
                button-component.p-button-danger.p-button-outlined(label="Cancelar" @click.prevent="cancel" icon="pi pi-times")
</template>
<script>
import moment from 'moment';
import Sakai from './Sakai/layout.vue';
import ImageComponent from 'primevue/image';
// import TableComponent from './Sakai/tableComponent.vue';
import TableComponent from './tableComponent.vue';
import DialogComponent from 'primevue/dialog';
import InputtextComponent from 'primevue/inputtext';
import ToolBarComponent from 'primevue/toolbar';
import ButtonComponent from 'primevue/button';
import TextareaComponent from 'primevue/textarea';
import MultiSelectComponent from 'primevue/multiselect';


export default {
    components: {
        Sakai,
        TableComponent,
        ToolBarComponent,
        DialogComponent,
        InputtextComponent,
        ButtonComponent,
        TextareaComponent,
        ImageComponent,
        MultiSelectComponent
    }, 
    props: {
        DireccionesID: {required:true}
    },
    data(){
        return {
            address: {},
            addresses: [],
            columns: [
                { label: 'Dirección', field: 'city_id', sortable: true },
            ],
            dialogs: {
                create: false
            },
            meta: {
                last_page: 1
            },
            moment: moment,
            params: {},
            afiliados: [],

        }
    },
    methods: {
        remove(address){
            axios.delete('/api/direcciones/' + address.id).then(respose => {
                alert("Direccion eliminada correctamente")
                this.getAddresses()
                this.dialogs.create = false
            }).catch(errors => {
                this.manageErrors(errors)
            })
        },
        cancel(){
            this.closeCreate()
            this.address = {}
        },
        closeCreate(){
            this.dialogs.create = false
        },
        edit(address){
            this.address = address
            this.address.city_id = address.address.city
        },
        getAddresses(){
            axios.get('/api/afiliado/show/' + this.DireccionesID).then(response => {
                this.addresses = response.data.data
            }).catch(errors => {
                this.manageErrors(errors)
            })
        },
        getAfiliado(){
            axios.get('/api/afiliado').then(response => {
                this.afiliados = response.data.data
            }).catch(errors => { 
                this.manageErrors(errors)
            })
        },
 /*        getStates(){
            axios.get('/api/state').then(response => {
                this.state = response.data.data
            }).catch(errors => {
                this.manageErrors(errors)
            })
        },
        getCities(){
            axios.get('/api/state/'+ this.address.state).then(response => {
                this.cities = response.data.data
            }).catch(errors => {
                this.manageErrors(errors)
            })
        }, */ 
        openNew() {
      if(this.user > 0){
        this.afiliado = {};
        this.afiliadoDialog = true;
      }else{
        this.user = {};
        this.afiliado = {};
        this.afiliadoDialog = true;
      }
        },
        store(){
            this.localErrors = []
            let form = document.getElementById('createForm');
            let formData = new FormData(form);
            let ruta = window.location.pathname;
            let partes = ruta.split("/");
            let id = partes[partes.length - 1];
            //console.log(id);
            formData.append('client_id', id);
            formData.append('city_id', this.address.city);
            let url = '/api/address'
            if(this.address.edit){
                formData.append('_method', 'PUT');
                formData.append('id', this.address.id);
                url = url + '/' + this.address.id
            }
            
            axios.post(url, formData).then(respose => {
                this.$toast.add({ severity: 'success', summary: 'Guardado correcto', detail: 'La dirección se ha guardado correctamente', life: 5000 });
                this.getAddresses()
                this.dialogs.create = false
            }).catch(errors => {
                this.manageErrors(errors)
            })
        }
    },
    mounted(){
        this.getAddresses()
    }
}
</script>