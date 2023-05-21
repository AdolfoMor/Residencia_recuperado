<template lang="pug">
.container-fluid
    table.table.table-striped(v-if="$attrs.data.length")
        thead
            tr
                th.text-center(v-for="column in columns") {{ column.label }}
                    span.fa.fa-sort(v-if="column.sortable && params.sort != column.field" @click="setSort(column)")
                    span.fa.fa-sort-down(v-if="column.sortable && params.sort == column.field && params.order == 'asc'" @click="toggleOrder()")
                    span.fa.fa-sort-up(v-if="column.sortable && params.sort == column.field && params.order == 'desc'" @click="toggleOrder()")
        tbody
            slot(v-for="row in $attrs.data" :row="row")
                tr
    div(v-if="$attrs.data.length == 0")
        h2.text-center No existen registros
    //- paginate(v-model="meta.current_page" :page-count="meta.last_page" :click-handler="changePage" :prev-text="'Anterior'" :next-text="'Siguiente'" :container-class="'pagination'" :page-class="'page-item'" v-if="$attrs.data.length && meta.last_page > 1")
    pagination(v-model="meta.current_page" :per-page="meta.per_page" :records="meta.total" @paginate="changePage" v-if="$attrs.data.length && meta.last_page > 1" :options="{edgeNavigation: true, texts: { count: ''}, theme: 'bootstrap4'}")
</template>
<style scoped>
    span.fa{
        font-size: .7rem;
        margin-left: .3rem;
        cursor: pointer;
    }
</style>
<script>
import Pagination from 'v-pagination-3';
import Tooltip from 'bootstrap/js/dist/tooltip'
export default {
    components: {
        Pagination
    },
    data() {
        return {
            // params: {
            //     order: '',
            //     sort: ''
            // }
        }
    },
    props: {
        columns: {
            type: Array,
            required: true
        },
        meta: {
            type: Object,
        },
        params: {
            type: Object,
        },
    },
    methods: {
        changePage(number){
            if(this.meta.last_page >= this.meta.current_page && this.meta.current_page > 0){
                this.params.page = number
                this.sendOut()
                setTimeout(()=> {
                    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                        return new Tooltip(tooltipTriggerEl)
                    })
                },1000)
            }
        },
        setSort(column){
            this.params.sort = column.field,
            this.params.order = 'asc'
            this.sendOut()
        },
        toggleOrder(){
            if(this.params.order == 'asc'){
                this.params.order = 'desc'
            }else{
                this.params.order = 'asc'
            }
            this.sendOut()
        },
        sendOut(){
            this.$emit('filter', this.params)
        }
    }
}
</script>