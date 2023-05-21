<template lang="pug">     
.card
    tool-bar-component.mb-4
        template(#start='')
            button-component.mr-2(label='Agregar' icon='pi pi-plus' severity='success' @click='openNew')
            button-component(label='Eliminar' icon='pi pi-trash' severity='danger' @click='confirmDeleteSelected' :disabled='!selectedProducts || !selectedProducts.length')
        template(#end='')
    .container-fluid
        table.table.table-striped.border-collapse.border.w-full(v-if="$attrs.data.length")
            thead
                tr.border
                    th.p-3.text-center.border(v-for="column in columns") {{ column.label }}
                        span.fa.fa-sort(v-if="column.sortable && params.sort != column.field" @click="setSort(column)")
                        span.fa.fa-sort-down(v-if="column.sortable && params.sort == column.field && params.order == 'asc'" @click="toggleOrder()")
                        span.fa.fa-sort-up(v-if="column.sortable && params.sort == column.field && params.order == 'desc'" @click="toggleOrder()")
            tbody
                slot(v-for="row in $attrs.data" :row="row")
                    tr
        div(v-if="$attrs.data.length == 0")
            h2.text-center No existen registros

dialog-component.p-fluid(v-model:visible='afiliadoDialog', :style="{width: '450px'}", header='Agregar nuevo afiliado', :modal='true')
    img.block.m-auto.pb-3(v-if='product.image', :src='`https://primefaces.org/cdn/primevue/images/product/${product.image}`', :alt='product.image')
    form#createForm(@submit.prevent="store" ref="createForm")
        .field
            label(for='Nombre') Nombre
            inputtext-component#name(required='true', name="Nombre" ,autofocus='', :class="{'p-invalid': submitted && !afiliado.nombre}")
            small.p-error(v-if='submitted && !afiliado.nombre') Es requerido 
            br
            label(for='RFC') RFC
            inputtext-component#name(required='true', name="RFC", autofocus='', :class="{'p-invalid': submitted && !afiliado.RFC}")
            small.p-error(v-if='submitted && !product.name') Es requerido 
            br
            label(for='Estado') Estado
            inputtext-component#name(required='true', name="Estado", autofocus='', :class="{'p-invalid': submitted && !afiliado.estado}")
            small.p-error(v-if='submitted && !afiliado.estado') Es requerido 
    template(#footer='')
        button-component(label='Limpiar' icon='pi pi-times' text='' @click='hideDialog')
        button-component(label='Guardar' icon='pi pi-save' text='' @click="$refs.createForm.requestSubmit()")
</template>
<script>
import DataTableComponent from 'primevue/datatable';
import DialogComponent from 'primevue/dialog';
import InputtextComponent from 'primevue/inputtext';
import ToolBarComponent from 'primevue/toolbar';
import ButtonComponent from 'primevue/button';
import RatingComponent from 'primevue/rating';
import Tag from 'primevue/tag';
import Column from 'primevue/column';
import TextAreaComponent from 'primevue/textarea';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row'; 
import { FilterMatchMode } from 'primevue/api';
import { ref  } from 'vue';
export default {
    components: {
        DataTableComponent,
        Column,
        ToolBarComponent,
        Row,
        ColumnGroup,
        InputtextComponent,
        RatingComponent,
        Tag,
        ButtonComponent,
        TextAreaComponent,
        DialogComponent
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
            products: null,
            afiliadoDialog: false,
            deleteProductDialog: false,
            deleteProductsDialog: false,
            product: {},
            selectedProducts: null,
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
    created() {
        this.initFilters();
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
        getUsers(){
            axios.get('/api/afiliado').then(response => {
                this.users = response.data.data
                this.meta = response.data.meta
            }).catch(errors => {
                this.manageErrors(errors)
            })
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
                this.dialogs.create = false
            }).catch(errors => {
                this.manageErrors(errors)
            })
        },
        formatCurrency(value) {
            if(value)
				return value.toLocaleString('en-US', {style: 'currency', currency: 'USD'});
			return;
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
        saveProduct() {
            this.submitted = true;

			if (this.product.name.trim()) {
                if (this.product.id) {
                    this.product.inventoryStatus = this.product.inventoryStatus.value ? this.product.inventoryStatus.value: this.product.inventoryStatus;
                    this.products[this.findIndexById(this.product.id)] = this.product;
                    this.$toast.add({severity:'success', summary: 'Successful', detail: 'Product Updated', life: 3000});
                }
                else {
                    this.product.id = this.createId();
                    this.product.code = this.createId();
                    this.product.image = 'product-placeholder.svg';
                    this.product.inventoryStatus = this.product.inventoryStatus ? this.product.inventoryStatus.value : 'INSTOCK';
                    this.products.push(this.product);
                    this.$toast.add({severity:'success', summary: 'Successful', detail: 'Product Created', life: 3000});
                }

                this.productDialog = false;
                this.product = {};
            }
        },
        editProduct(product) {
            this.product = {...product};
            this.productDialog = true;
        },
        confirmDeleteProduct(product) {
            this.product = product;
            this.deleteProductDialog = true;
        },
        deleteProduct() {
            this.products = this.products.filter(val => val.id !== this.product.id);
            this.deleteProductDialog = false;
            this.product = {};
            this.$toast.add({severity:'success', summary: 'Successful', detail: 'Product Deleted', life: 3000});
        },
        findIndexById(id) {
            let index = -1;
            for (let i = 0; i < this.products.length; i++) {
                if (this.products[i].id === id) {
                    index = i;
                    break;
                }
            }

            return index;
        },
        createId() {
            let id = '';
            var chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            for ( var i = 0; i < 5; i++ ) {
                id += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return id;
        },
        exportCSV() {
            this.$refs.dt.exportCSV();
        },
        confirmDeleteSelected() {
            this.deleteProductsDialog = true;
        },
        deleteSelectedProducts() {
            this.products = this.products.filter(val => !this.selectedProducts.includes(val));
            this.deleteProductsDialog = false;
            this.selectedProducts = null;
            this.$toast.add({severity:'success', summary: 'Successful', detail: 'Products Deleted', life: 3000});
        },
        initFilters() {
            this.filters = {
                'global': {value: null, matchMode: FilterMatchMode.CONTAINS},
            }
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