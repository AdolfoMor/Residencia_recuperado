<template lang="pug">
sakai
    template(v-slot:content)
        .col-12 
            .row
                .card
                    h2 Estructura Orgánica
                    tool-bar-component.mb-4
                        template(#start='')
                            button-component.mr-2(label='Agregar' icon='pi pi-plus' severity='success' @click.prevent='openNew')
                        template(#end='')
                    table-component(:columns="columns" :data="users" @filter="filterData($event, getUsers)" :meta="meta" :params="params")
                        template(v-slot="{ row }")
                            tr(align="center")
                                td.p-6 {{ row.Nombre }}
                                td.p-6 {{ row.Posicion }}
                                td.p-6 
                                    image-component(:src='row.Foto' alt="Image" width="150" preview )
                                td(align="center")
                                    button-component.btn.btn-primary.mr-1(@click="edit(row)" v-tooltip="'Editar Integrante'" title="Editar Integrante")
                                        i.pi.pi-pencil
                                    button-component.btn.btn-danger(@click="remove(row)" v-tooltip="'Eliminar Integrante'" title="Eliminar Integrante")
                                        i.pi.pi-trash
                                    a.btn.btn-secondary.mr-1(:href="'/Redes/'+ row.id" v-tooltip="'Gestionar direcciones'" title="Gestionar redes")
                                        i.pi.pi-user-edit

        dialog-component.p-fluid(v-model:visible='afiliadoDialog', :style="{width: '750px'}", header='Usuario', :modal='true')
            form#createForm(@submit.prevent="store" ref="createForm")
                .field
                    label(for='Nombre') Nombre
                    inputtext-component#name(required='true', name="Nombre" ,v-model='user.Nombre', autofocus='', :class="{'p-invalid': submitted && !user.Nombre}")
                    small.p-error(v-if='submitted && !user.Nombre') Es requerido 
                .field
                    label(for='Posicion') Posición
                    inputtext-component#posicion(required='true', name="Posicion", autofocus='',v-model='user.Posicion', :class="{'p-invalid': submitted && !afiliado.Posicion}")
                    small.p-error(v-if='submitted && !user.Posicion') Es requerido 
                .field
                    label(for='password') Foto
                    input#Foto(type='file' name='Foto' accept='image/png, image/jpeg')
            template(#footer='')
                button-component(label='Cancelar' icon='pi pi-times' text='' @click='hideDialog')
                button-component(label='Guardar' icon='pi pi-save' text='' @click="$refs.createForm.requestSubmit()")
</template>
<script>
import Sakai from './Sakai/layout.vue';
import ImageComponent from 'primevue/image';
// import TableComponent from './Sakai/tableComponent.vue';
import TableComponent from './tableComponent.vue';
import DialogComponent from 'primevue/dialog';
import InputtextComponent from 'primevue/inputtext';
import ToolBarComponent from 'primevue/toolbar';
import ButtonComponent from 'primevue/button';
import TextareaComponent from 'primevue/textarea';


export default {
    components: {
    Sakai,
    TableComponent,
    ToolBarComponent,
    DialogComponent,
    InputtextComponent,
    ButtonComponent,
    TextareaComponent,
    ImageComponent
    },
    data() {
    return {
        columns: [
        { label: 'Nombre', field: 'Nombre', sortable: true},
        { label: 'Posición', field: 'Posicion', sortable: true },
        { label: 'Foto', field: 'Foto', sortable: true },
        { label: 'Acciones', field: 'Acciones', sortable: true }
        ],
        user: {},
        users: [],
        meta: {
            last_page: 1
        },
        params: {},
        afiliado: null,
        afiliadoDialog: false,
        deleteProductDialog: false,
        afiliado: {},
        filters: {},
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
        axios.get('/api/estructura').then(response => {
            this.users = response.data.data
            //this.meta = response.data.meta
        }).catch(errors => {
            this.manageErrors(errors)
        })
    },
    onAdvancedUpload() {
        this.$toast.add({ severity: 'info', summary: 'Success', detail: 'File Uploaded', life: 3000 });
    },
    edit(user){
        this.user = user
        // alert(JSON.stringify(customer))
        this.user.id = user.id
        this.user.Nombre = user.Nombre
        this.user.Posicion = user.Posicion
        this.user.Foto = user.Foto
        this.user.edit = true
        this.afiliadoDialog = true
    },
    remove(user){
        axios.delete('/api/estructura/' + user.id).then(respose => {
            this.getUsers()
            this.afiliadoDialog = false;
        }).catch(errors => {
            this.manageErrors(errors)
        })
    },
    store(){
        this.localErrors = []
        let form = document.getElementById('createForm');
        let formData = new FormData(form);
        //alert(this.user.edit);
        let url = '/api/estructura'
        if(this.user.edit){
            formData.append('_method', 'PUT');
            formData.append('id', this.user.id);
            url = url + '/' + this.user.id
        }        
        axios.post(url, formData).then(response => {
            this.getUsers()
            this.afiliadoDialog = false
        }).catch(errors => {
            this.manageErrors(errors)
        })
    },
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
    hideDialog() {
        this.user = {};
        this.afiliadoDialog = false;
        this.submitted = false;
    }
    },
    mounted(){
    this.getUsers()
    }
}
</script>

