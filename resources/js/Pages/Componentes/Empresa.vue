<template lang="pug">
.card.shadow-sm.m-5(style='width: 18rem;' v-for = "user in users" )
  img.card-img-top.mx-auto.d-block.m-3(:src='user.Logo' alt='Card image cap' style="width:100px;height:auto;") 
  .card-body
    h5.card-title {{user.Nombre}}
    p.card-text
      | {{user.Descripción}}
  ul.list-group.list-group-flush
    li.list-group-item Cras justo odio
    li.list-group-item Dapibus ac facilisis in
    li.list-group-item Vestibulum at eros
  .card-body
    a.card-link(href='#') Card link
    a.card-link(href='#') Another link

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