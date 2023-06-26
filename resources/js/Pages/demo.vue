<template lang="pug">
sakai
  template(v-slot:content)
    .col-12 
      .row
        .card
          h2 Afiliados
          tool-bar-component.mb-4
            template(#start='')
              button-component.mr-2(label='Agregar' icon='pi pi-plus' severity='success' @click.prevent='openNew')
            template(#end='')
          table-component(:columns="columns" :data="users" @filter="filterData($event, getUsers)" :meta="meta" :params="params")
            template(v-slot="{ row }")
              tr
                td.p-6 {{ row.Nombre }}
                td.p-6 {{ row.RFC  }}
                td.p-6 {{ row.Dirección  }}
                td.p-6 {{ row.Teléfono }}
                td.p-6 
                  image-component(:src='row.Logo' alt="Image" width="300" preview )
                td.p-6 {{ row.Descripción  }}
                td(align="center")
                  button-component.btn.btn-primary.mr-1(@click="edit(row)" v-tooltip="'Editar Afiliado'" title="Editar Afiliado")
                    i.pi.pi-pencil
                  button-component.btn.btn-danger(@click="remove(row)" v-tooltip="'Eliminar afiliado'" title="Eliminar afiliado")
                    i.pi.pi-trash
                  a.btn.btn-secondary.mr-1(:href="'/DireccionesV/'+ row.id" v-tooltip="'Gestionar direcciones'" title="Gestionar direcciones")
                    i.pi.pi-building

    dialog-component.p-fluid(v-model:visible='afiliadoDialog', :style="{width: '750px'}", header='Agregar nuevo afiliado', :modal='true')
      form#createForm(@submit.prevent="store" ref="createForm")
        .field
          label(for='Nombre') Nombre
          inputtext-component#Nombre(required='true', name="Nombre" ,v-model='user.Nombre', autofocus='', :class="{'p-invalid': submitted && !user.Nombre}")
          small.p-error(v-if='submitted && !user.Nombre') Es requerido 
        .field
          label(for='RFC') RFC
          inputtext-component#RFC(required='true', minlength="12", maxlength="13", name="RFC", autofocus='',v-model='user.RFC', :class="{'p-invalid': submitted && !afiliado.RFC}")
          small.p-error(v-if='submitted && !afiliado.RFC') Es requerido 
        .field
          label(for='Dirección') Dirección
          inputtext-component#Direccion(required='true', name="Dirección", autofocus='', v-model='user.Dirección', :class="{'p-invalid': submitted && !afiliado.Direccion}")
          small.p-error(v-if='submitted && !afiliado.Dirección') Es requerido 
        .field
          label(for='Teléfono') Teléfono
          inputtext-component#Telefono(minlength="10", maxlength="10", required='true', name="Teléfono" ,v-model='user.Teléfono', autofocus='', pattern="[0-9]+", :class="{'p-invalid': submitted && !user.Teléfono}")
          small.p-error(v-if='submitted && !user.Nombre') Es requerido 
        .field
          label(for='Logo') Logo
          br
          input#Logo(type='file' name='Logo' accept='image/png, image/jpeg')

        .field
          label(for='Descripción') Descripción
          textarea-component#Descripcion(required='true', name="Descripción", autofocus='', v-model='user.Descripción', :class="{'p-invalid': submitted && !afiliado.Descripción}")
          small.p-error(v-if='submitted && !afiliado.Descripción') Es requerido 
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
        { label: 'RFC', field: 'RFC', sortable: true },
        { label: 'Dirección', field: 'Dirección', sortable: true },
        { label: 'Teléfono', field: 'Teléfono', sortable: true },
        { label: 'Logo', field: 'Logo', sortable: true},
        { label: 'Descripción', field: 'Descripción', sortable: true },
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
      axios.get('/api/afiliado').then(response => {
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
      this.user.RFC = user.RFC
      this.user.Dirección = user.Dirección
      this.user.Teléfono = user.Teléfono
      this.user.Logo = user.Logo
      this.user.Descripción = user.Descripción
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

