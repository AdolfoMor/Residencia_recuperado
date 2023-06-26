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
                            td.p-6 {{ row.Estado }}
                            td.p-6 {{ row.Ciudad }}
                            td.p-6 {{ row.Calle }}
                            td.p-6 {{ row.Numero }}
                            td.p-6 {{ row.Colonia }}
                            td.p-6 {{ row.Telefono }}
                            td(align="center")
                                button-component.btn.btn-primary.mr-1(@click="edit(row)" v-tooltip="'Gestionar direccione'" title="Gestionar direccione")
                                    i.pi.pi-pencil
                                button-component.btn.btn-danger(@click="remove(row)" v-tooltip="'Eliminar direccione'" title="Eliminar direccione")
                                    i.pi.pi-trash
        dialog-component.p-fluid(v-model:visible='afiliadoDialog', :style="{width: '750px'}", header='Dirección', :modal='true')
            form#createForm(@submit.prevent="store" ref="createForm")
                .row 
                    div.col-12
                        transition-group(name="p-message" tag="div")
                            Message(v-for="msg of localErrors" severity="error" :key="msg") {{ msg }}
                    div.flex-auto
                        label(for="Estado") Estado 
                        inputtext-component#Estado(required='true', name="Estado" ,v-model='address.Estado', autofocus='', :class="{'p-invalid': submitted && !address.Estado}")
                    div.flex-auto
                        label(for="Ciudad") Ciudad 
                        inputtext-component#Ciudad(required='true', name="Ciudad" ,v-model='address.Ciudad', autofocus='', :class="{'p-invalid': submitted && !address.calle}")
                    div.col-5
                        span.p-float-label
                            inputtext-component#Calle(type="text" name="Calle" v-model="address.Calle")
                            label(for="Calle") Calle
                    div.col-2
                        span.p-float-label
                            inputtext-component#Numero(required='true', name="Numero" ,v-model='address.Numero', autofocus='', :class="{'p-invalid': submitted && !address.Numero}")
                            label(for="Numero") Número
                    div.col-2
                        span.p-float-label
                            inputtext-component#Telefono(required='true', name="Telefono" ,v-model='address.Telefono', autofocus='', :class="{'p-invalid': submitted && !address.Telefono}")
                            label(for="Telefono") Teléfono 
                    div.col-3
                        span.p-float-label
                            inputtext-component#Colonia(required='true', name="Colonia" ,v-model='address.Colonia', autofocus='', :class="{'p-invalid': submitted && !address.Colonia}")
                            label(for="Colonia") Colonia
            template(#footer)
                button-component.p-button-outlined(label="Guardar" @click="$refs.createForm.requestSubmit()" icon="pi pi-check")
                button-component.p-button-danger.p-button-outlined(label="Cancelar" @click.prevent="hideDialog" icon="pi pi-times")
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
                { label: 'Estado', field: 'Estado', sortable: true },
                { label: 'Ciudad', field: 'Ciudad', sortable: true },
                { label: 'Calle', field: 'Calle', sortable: true },
                { label: 'Numero', field: 'Numero', sortable: true },
                { label: 'Colonia', field: 'Colonia', sortable: true },
                { label: 'Telefono', field: 'Telefono', sortable: true },
                { label: 'Acciones', sortable: true },
            ],
            afiliadoDialog: false,
            meta: {
                last_page: 1
            },
            moment: moment,
            params: {},
            afiliado: null,

        }
    },
    methods: {
        remove(address){
            axios.delete('/api/direcciones/' + address.id).then(respose => {
                alert("Direccion eliminada correctamente")
                this.getAddresses()
                this.afiliadoDialog = false
            }).catch(errors => {
                this.manageErrors(errors)
            })
        },
        cancel(){
            this.hideDialog()
            this.address = {}
        },
        hideDialog() {
            this.address = {};
            this.afiliadoDialog = false;
            this.submitted = false;
        },
        edit(address){
            this.address = address
            this.address.Estado = address.Estado
            this.address.Ciudad = address.Ciudad
            this.address.Calle = address.Calle
            this.address.Numero = address.Numero
            this.address.Telefono = address.Telefono
            this.address.edit = true
            this.afiliadoDialog = true
        },
        getAddresses(){
            axios.get('/api/direcciones/' + this.DireccionesID).then(response => {
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
            if(this.address > 0){
                this.afiliado = {};
                this.afiliadoDialog = true;
            }else{
                this.address = {};
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
            formData.append('afiliado_id', id);
            let url = '/api/direcciones'
            if(this.address.edit){
                formData.append('_method', 'PUT');
                formData.append('id', this.address.id);
                url = url + '/' + this.address.id
            } 
            axios.post(url, formData).then(respose => {
                alert("Éxito")
                this.getAddresses()
                this.afiliadoDialog = false
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