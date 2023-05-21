<template lang="pug">
sakai
  template(v-slot:content)
    .col-12 
      .row
        .card
          tool-bar-component.mb-4
            template(#start='')
              button-component.mr-2(label='Agregar' icon='pi pi-plus' severity='success' @click='openNew')
            template(#end='')
          table-component(:columns="columns" :data="users" @filter="filterData($event, getUsers)" :meta="meta" :params="params")
            template(v-slot="{ row }")
              tr
                td.p-6 {{ row.Nombre }}
                td.p-6 {{ row.RFC  }}
                td.p-6 {{ row.Estado  }}
                td(align="center")

    dialog-component.p-fluid(v-model:visible='afiliadoDialog', :style="{width: '450px'}", header='Agregar nuevo afiliado', :modal='true')
      form#createForm(@submit.prevent="store" ref="createForm")
        .field
          label(for='Nombre') Nombre
          inputtext-component#name(required='true', name="Nombre" ,autofocus='', :class="{'p-invalid': submitted && !afiliado.nombre}")
          small.p-error(v-if='submitted && !afiliado.nombre') Es requerido 
        .field
          label(for='RFC') RFC
          inputtext-component#name(required='true', name="RFC", autofocus='', :class="{'p-invalid': submitted && !afiliado.RFC}")
          small.p-error(v-if='submitted && !product.name') Es requerido 
        .field
          label(for='Estado') Estado
          inputtext-component#name(required='true', name="Estado", autofocus='', :class="{'p-invalid': submitted && !afiliado.estado}")
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
import { ref  } from 'vue';
export default {
  components: {
    Sakai,
    TableComponent,
    ToolBarComponent,
    DialogComponent,
    InputtextComponent,
    ButtonComponent
  },
  props: {
    usersID: {required:true}
  },
  data() {
    return {
      columns: [
        { label: 'Nombre', field: 'Nombre', sortable: true},
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
  mounted(){
    this.getUsers()
  },
  methods: {
    getUsers(){
      axios.get('/api/afiliado/' + this.usersID ).then(response => {
        this.users = response.data.data
        //this.meta = response.data.meta
      }).catch(errors => {
        this.manageErrors(errors)
      })
    },
    store(){
      this.localErrors = []
      let form = document.getElementById('createForm');
      let formData = new FormData(form);
      //alert(this.user.edit)
      let url = '/api/afiliado'
      /* if(this.user.edit){
          formData.append('_method', 'PUT');
          formData.append('id', this.user.id);
          url = url + '/' + this.user.id
      }    */        
      axios.post(url, formData).then(response => {
      //this.getUsers()
        this.afiliadoDialog.create = false
      }).catch(errors => {
        this.manageErrors(errors)
      })
    },
    openNew() {
      this.afiliado = {};
      this.submitted = false;
      this.afiliadoDialog = true;
    },
    hideDialog() {
      this.afiliadoDialog = false;
      this.submitted = false;
    },
    getStatusLabel(status) {
      switch (status) {
        case 'INSTOCK':
          return 'success';

        case 'LOWSTOCK':
          return 'warning';

        case 'OUTOFSTOCK':
          return 'danger';

        default:
          return null;
      }
    }
  }
}
</script>

