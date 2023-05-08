<template lang="pug">     
.card
    tool-bar-component.mb-4
        template(#start='')
            button-component.mr-2(label='New' icon='pi pi-plus' severity='success' @click='openNew')
            button-component(label='Delete' icon='pi pi-trash' severity='danger' @click='confirmDeleteSelected' :disabled='!selectedProducts || !selectedProducts.length')
        template(#end='')
    data-table-component(ref='dt' :value='products' datakey='id' :paginator='false' :rows='2' :filters='filters' class="table1")
        template(#header='')
            .flex.flex-wrap.gap-2.align-items-center.justify-content-between
            h4.m-0 Afiliados
            span.p-input-icon-left
                i.pi.pi-search
                input-text-component(v-model="filters['global'].value" placeholder='Search...')
        column(selectionmode='multiple' style='width: 3rem' :exportable='false')
        column(field='code' header='Code' sortable='' style='min-width:12rem')
        column(field='name' header='Name' sortable='' style='min-width:16rem')
        column(header='Image')
            template(#body='slotProps')
            img.shadow-2.border-round(:src='`https://primefaces.org/cdn/primevue/images/product/${slotProps.data.image}`' :alt='slotProps.data.image' style='width: 64px')
        column(field='price' header='Price' sortable='' style='min-width:8rem')
            template(#body='slotProps')
            | {{formatCurrency(slotProps.data.price)}}
        column(field='category' header='Category' sortable='' style='min-width:10rem')
        column(field='rating' header='Reviews' sortable='' style='min-width:12rem')
            template(#body='slotProps')
            rating(:modelvalue='slotProps.data.rating' :readonly='true' :cancel='false')
        column(field='inventoryStatus' header='Status' sortable='' style='min-width:12rem')
            template(#body='slotProps')
            tag(:value='slotProps.data.inventoryStatus' :severity='getStatusLabel(slotProps.data.inventoryStatus)')
        column(:exportable='false' style='min-width:8rem')
            template(#body='slotProps')
            button.mr-2(icon='pi pi-pencil' outlined='' rounded='' @click='editProduct(slotProps.data)')
        button(icon='pi pi-trash' outlined='' rounded='' severity='danger' @click='confirmDeleteProduct(slotProps.data)')
</template>
<script>
import DataTableComponent from 'primevue/datatable';
import ToolBarComponent from 'primevue/toolbar';
import ButtonComponent from 'primevue/button';
import Rating from 'primevue/rating';
import Tag from 'primevue/tag';
import InputTextComponent from 'primevue/inputtext';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row'; 
import { FilterMatchMode } from 'primevue/api';
export default {
    components: {
        DataTableComponent,
        Column,
        ToolBarComponent,
        Row,
        ColumnGroup,
        InputTextComponent,
        Rating,
        Tag,
        ButtonComponent
    },
    data() {
        return {
            products: null,
            productDialog: false,
            deleteProductDialog: false,
            deleteProductsDialog: false,
            product: {},
            selectedProducts: null,
            filters: {},
            submitted: false,
            statuses: [
				{label: 'INSTOCK', value: 'instock'},
				{label: 'LOWSTOCK', value: 'lowstock'},
				{label: 'OUTOFSTOCK', value: 'outofstock'}
            ]
        }
    },
    created() {
        this.initFilters();
    },
    methods: {
        formatCurrency(value) {
            if(value)
				return value.toLocaleString('en-US', {style: 'currency', currency: 'USD'});
			return;
        },
        openNew() {
            this.product = {};
            this.submitted = false;
            this.productDialog = true;
        },
        hideDialog() {
            this.productDialog = false;
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
<style lang="scss" scoped>
.table1{
    .p-datatable{
        background: var(--blue-500);
    }
}
</style>