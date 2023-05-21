<template lang="pug">
sakai
    template(v-slot:content)
        .col-12 
            .row
                .card
                    h2.font-semibold.text-xl.text-gray-800.leading-tight
                        | Profiles
                    div
                        .max-w-7xl.mx-auto.py-10(class='sm:px-6 lg:px-8')
                            div(v-if='$page.props.jetstream.canUpdateProfileInformation')
                                update-profile-information-form-component(:user='$page.props.user')
                                    section-border-component
                            div(v-if='$page.props.jetstream.canManageTwoFactorAuthentication')
                                two-factor-authentication-form-component.mt-10(:requires-confirmation='confirmsTwoFactorAuthentication' class='sm:mt-0')
                                    section-border-component

                            template(v-if='$page.props.jetstream.hasAccountDeletionFeatures')
                                section-border-component
                                    delete-user-form-component.mt-10(class='sm:mt-0')
    </template>
        <script>
        import Sakai from '../Sakai/layout.vue';
        // import TableComponent from './Sakai/tableComponent.vue';
        import TableComponent from '../table.vue';
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
        import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
        import LogoutOtherBrowserSessionsFormComponent from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
        import SectionBorderComponent from '@/Components/SectionBorder.vue';
        import TwoFactorAuthenticationFormComponent from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
        import UpdatePasswordFormComponent from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
        import UpdateProfileInformationFormComponent from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
    
        export default {
            components: {
                Sakai,
                TableComponent,
                DataTableComponent,
                Column,
                ToolBarComponent,
                Row,
                ColumnGroup,
                InputTextComponent,
                Rating,
                Tag,
                ButtonComponent,
                DeleteUserForm,
                SectionBorderComponent,
                UpdateProfileInformationFormComponent,
                TwoFactorAuthenticationFormComponent,
                LogoutOtherBrowserSessionsFormComponent,
                UpdatePasswordFormComponent
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
        
        