<template lang="pug">
head(title='Welcome')
sakai
  template(v-slot:content)
    .col-12 
      .row
        table-component(:columns="columns" :data="customers" @filter="filterData($event, getCustomers)" :meta="meta" :params="params")
</template>
<script>
import Sakai from './Sakai/layout.vue';
// import TableComponent from './Sakai/tableComponent.vue';
import TableComponent from './table.vue';
import { Head } from '@inertiajs/vue3';

export default {
  name: 'ViewClient',
  components: {
      Sakai,
      TableComponent
  },
  data(){
    return{
      columns:[
        {label: "Nombre", field: "name", sortable: true},
        {label: "RFC", field: "rfc", sortable: true},
        {label: "Acciones", sortable: true}
      ],
      customer: {},
      customers: [],
      clients:{},
      dialogs: {
        create: false
      },
      meta:{
        last_page: 1
      },
      params: {}
    }
  }
}
</script>

