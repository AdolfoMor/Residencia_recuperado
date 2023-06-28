<template lang="pug">
sakai
    template(v-slot:content)
        .col-12
            .card
                .row
                    .col-10
                        h5 Redes Sociales
                    .col-2
                    tool-bar-component.mb-4
                        template(#start='')
                            button-component.mr-2(label='Agregar' icon='pi pi-plus' severity='success' @click.prevent='openNew')
                        template(#end='')
                table-component(:columns="columns" :data="redes" @filter="filterData($event, getRedes)" :meta="meta" :params="params")
                    template(v-slot="{ row }")
                        tr(align="center")
                            td.p-6 {{ row.Facebook }}
                            td.p-6 {{ row.Instagram }}
                            td.p-6 {{ row.Linkedin }}
                            td.p-6 {{ row.Twitter }}
                            td.p-6 {{ row.Google }}
                            td(align="center")
                                button-component.btn.btn-primary.mr-1(@click="edit(row)" v-tooltip="'Gestionar direccione'" title="Gestionar direccione")
                                    i.pi.pi-pencil
                                button-component.btn.btn-danger(@click="remove(row)" v-tooltip="'Eliminar direccione'" title="Eliminar direccione")
                                    i.pi.pi-trash
        dialog-component.p-fluid(v-model:visible='redDialog', :style="{width: '750px'}", header='Dirección', :modal='true')
            form#createForm(@submit.prevent="store" ref="createForm")
                .row 
                    div.col-12
                        transition-group(name="p-message" tag="div")
                            Message(v-for="msg of localErrors" severity="error" :key="msg") {{ msg }}
                    div.flex-auto
                        label(for="Facebook") Facebook 
                        inputtext-component#Facebook(name="Facebook" ,v-model='red.Facebook', autofocus='', :class="{'p-invalid': submitted && !red.Facebook}")
                    div.flex-auto
                        label(for="Instagram") Instagram 
                        inputtext-component#Instagram(name="Instagram" ,v-model='red.Instagram', autofocus='', :class="{'p-invalid': submitted && !red.Linkedin}")
                    div.flex-auto
                        label(for="Linkedin") Linkedin
                        inputtext-component#Linkedin(type="text" name="Linkedin" v-model="red.Linkedin")
                    div.flex-auto
                        label(for="Twitter") Twitter
                        inputtext-component#Twitter(name="Twitter" ,v-model='red.Twitter', autofocus='', :class="{'p-invalid': submitted && !red.Twitter}")
                    div.flex-auto
                        label(for="Google+") Google+ 
                        inputtext-component#Google(name="Google+" ,v-model='red.Google', autofocus='', :class="{'p-invalid': submitted && !red.Google}")
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
        RedesID: {required:true}
    },
    data(){
        return {
            red: {},
            redes: [],
            columns: [
                { label: 'Facebook', field: 'Facebook', sortable: true },
                { label: 'Instagram', field: 'Instagram', sortable: true },
                { label: 'Linkedin', field: 'Linkedin', sortable: true },
                { label: 'Twitter', field: 'Twitter', sortable: true },
                { label: 'Google+', field: 'Google+', sortable: true },
                { label: 'Acciones', sortable: true },
            ],
            redDialog: false,
            meta: {
                last_page: 1
            },
            moment: moment,
            params: {},
            afiliado: null,

        }
    },
    methods: {
        remove(red){
            axios.delete('/api/redes/' + red.id).then(respose => {
                alert("Red eliminada correctamente")
                this.getRedes()
                this.redDialog = false
            }).catch(errors => {
                this.manageErrors(errors)
            })
        },
        cancel(){
            this.hideDialog()
            this.red = {}
        },
        hideDialog() {
            this.red = {};
            this.redDialog = false;
            this.submitted = false;
        },
        edit(red){
            this.red = red
            this.red.Facebook = red.Facebook
            this.red.Instagram = red.Instagram
            this.red.Linkedin = red.Linkedin
            this.red.Twitter = red.Twitter
            this.red.Google = red.Google
            this.red.edit = true
            this.redDialog = true
        },
        getRedes(){
            axios.get('/api/redes/' + this.RedesID).then(response => {
                this.redes = response.data.data
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
            axios.get('/api/state/'+ this.red.state).then(response => {
                this.cities = response.data.data
            }).catch(errors => {
                this.manageErrors(errors)
            })
        }, */ 
        openNew() {
            if(this.red > 0){
                this.afiliado = {};
                this.redDialog = true;
            }else{
                this.red = {};
                this.afiliado = {};
                this.redDialog = true;
            }
        },
        store(){
            this.localErrors = []
            let form = document.getElementById('createForm');
            let formData = new FormData(form);
            let ruta = window.location.pathname;
            let partes = ruta.split("/");
            let id = partes[partes.length - 1];
            formData.append('estructura_id', id);
            let url = '/api/redes'
            if(this.red.edit){
                formData.append('_method', 'PUT');
                formData.append('id', this.red.id);
                url = url + '/' + this.red.id
            } 
            axios.post(url, formData).then(respose => {
                alert("Éxito")
                this.getRedes()
                this.redDialog = false
            }).catch(errors => {
                this.manageErrors(errors)
            })
        }
    },
    mounted(){
        this.getRedes()
    }
}
</script>