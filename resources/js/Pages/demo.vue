<template lang="pug">
sakai
  template(v-slot:content)
    .col-12 
      .row
        .card
          tool-bar-component.mb-4
            template(#start='')
              button-component.mr-2(label='Agregar' icon='pi pi-plus' severity='success' @click.prevent='openNew')
            template(#end='')
          table-component(:columns="columns" :data="users" @filter="filterData($event, getUsers)" :meta="meta" :params="params")
            template(v-slot="{ row }")
              tr
                td.p-6 {{ row.Nombre }}
                td.p-6 {{ row.RFC  }}
                td.p-6 {{ row.Estado  }}
                td(align="center")
                  button-component.btn.btn-primary.mr-1(@click="edit(row)" v-tooltip="'Editar Afiliado'" title="Editar Afiliado")
                      i.pi.pi-pencil
                  button-component.btn.btn-danger(@click="remove(row)" v-tooltip="'Eliminar afiliado'" title="Eliminar afiliado")
                      i.pi.pi-trash

    dialog-component.p-fluid(v-model:visible='afiliadoDialog', :style="{width: '750px'}", header='Agregar nuevo afiliado', :modal='true')
      form#createForm(@submit.prevent="store" ref="createForm")
        .field
          label(for='Nombre') Nombre
          inputtext-component#Nombre(required='true', name="Nombre" ,v-model='user.Nombre', autofocus='', :class="{'p-invalid': submitted && !user.Nombre}")
          small.p-error(v-if='submitted && !user.Nombre') Es requerido 
        .field
          label(for='RFC') RFC
          inputtext-component#RFC(required='true', name="RFC", autofocus='',v-model='user.RFC', :class="{'p-invalid': submitted && !afiliado.RFC}")
          small.p-error(v-if='submitted && !afiliado.RFC') Es requerido 
        .field
          label(for='Estado') Estado
          inputtext-component#Estado(required='true', name="Estado", autofocus='', v-model='user.Estado', :class="{'p-invalid': submitted && !afiliado.Estado}")
          small.p-error(v-if='submitted && !afiliado.estado') Es requerido 
      template(#footer='')
        button-component(label='Cancelar' icon='pi pi-times' text='' @click='hideDialog')
        button-component(label='Guardar' icon='pi pi-save' text='' @click="$refs.createForm.requestSubmit()")
</template>
<script>
import Sakai from './Sakai/layout.vue';
// import TableComponent from './Sakai/tableComponent.vue';
import TableComponent from './tableComponent.vue';
import DialogComponent from 'primevue/dialog';
import InputtextComponent from 'primevue/inputtext';
import ToolBarComponent from 'primevue/toolbar';
import ButtonComponent from 'primevue/button';

export default {
  components: {
    Sakai,
    TableComponent,
    ToolBarComponent,
    DialogComponent,
    InputtextComponent,
    ButtonComponent
  },
  data() {
    return {
      columns: [
        { label: 'Nombre', field: 'Nombre', sortable: true},
        { label: 'RFC', field: 'RFC', sortable: true },
        { label: 'Dirección', field: 'Estado', sortable: true },
        { label: '', field: 'Nombre', sortable: true},
        { label: 'RFC', field: 'RFC', sortable: true },
        { label: 'Estado', field: 'Estado', sortable: true },
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
      deleteProductsDialog: false,
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
      axios.get('/api/afiliado').then(response => {
        this.users = response.data.data
        //this.meta = response.data.meta
      }).catch(errors => {
        this.manageErrors(errors)
      })
    },
    edit(user){
      this.user = user
      // alert(JSON.stringify(customer))
      this.user.id = user.id
      this.user.Nombre = user.Nombre
      this.user.RFC = user.RFC
      this.user.Estado = user.Estado
      this.user.edit = true
      this.afiliadoDialog = true
    },
    remove(user){
      axios.delete('/api/afiliado/' + user.id).then(respose => {
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
      let url = '/api/afiliado'
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

