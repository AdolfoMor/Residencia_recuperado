<template lang="pug">
card-component.mt-5(style='width: 25em' v-for = "user in users")
  template(#header='')
    img(alt='user header' :src='user.Logo' width="100px")
  template(#title='') {{user.Nombre}} 
  template(#subtitle='')  Card subtitle 
  template(#content='') 
    p
      | {{ user.Descripción }}
</template>
<script>
import CardComponent from 'primevue/card';
import TableComponent from '../tableComponent.vue';
import ButtonComponent from 'primevue/button';

export default {
    components:{
        CardComponent,
        ButtonComponent,
        TableComponent
        
    },
    data() {
        return {
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
    },
    mounted(){
        this.getUsers()
    }
}
</script>