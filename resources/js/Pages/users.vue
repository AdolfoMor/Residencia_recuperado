<template lang="pug">
sakai
    template(v-slot:content)
        .col-12 
            .row
                .card
                    h2 Usuarios
                    tool-bar-component.mb-4
                        template(#start='')
                            button-component.mr-2(label='Agregar' icon='pi pi-plus' severity='success' @click.prevent='openNew')
                        template(#end='')
                    table-component(:columns="columns" :data="users" @filter="filterData($event, getUsers)" :meta="meta" :params="params")
                        template(v-slot="{ row }")
                            tr(align="center")
                                td.p-6 {{ row.name }}
                                td.p-6 {{ row.email }}
                                td(align="center")
                                    button-component.btn.btn-primary.mr-1(@click="edit(row)" v-tooltip="'Editar Afiliado'" title="Editar Afiliado")
                                        i.pi.pi-pencil
                                    button-component.btn.btn-danger(@click="remove(row)" v-tooltip="'Eliminar afiliado'" title="Eliminar afiliado")
                                        i.pi.pi-trash

        dialog-component.p-fluid(v-model:visible='afiliadoDialog', :style="{width: '750px'}", header='Usuario', :modal='true')
            form#createForm(@submit.prevent="store" ref="createForm")
                .field
                    label(for='name') Nombre
                    inputtext-component#name(required='true', name="name" ,v-model='user.name', autofocus='', :class="{'p-invalid': submitted && !user.name}")
                    small.p-error(v-if='submitted && !user.name') Es requerido 
                .field
                    label(for='email') Correo electrónico
                    inputtext-component#email(required='true', name="email", autofocus='',v-model='user.email', :class="{'p-invalid': submitted && !afiliado.email}")
                    small.p-error(v-if='submitted && !user.email') Es requerido 
                .field
                    label(for='password') Contraseña
                    inputtext-component#password(required='true', type='password', name="password", autofocus='', v-model='user.password', :class="{'p-invalid': submitted && !afiliado.password}")
                    small.p-error(v-if='submitted && !user.password') Es requerido 
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
        { label: 'Email', field: 'Correo Electrónico', sortable: true },
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
        axios.get('/api/users').then(response => {
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
        this.user.name = user.name
        this.user.email = user.email
        this.user.password = user.password
        this.user.edit = true
        this.afiliadoDialog = true
    },
    remove(user){
        axios.delete('/api/users/' + user.id).then(respose => {
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
        let url = '/api/users'
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

