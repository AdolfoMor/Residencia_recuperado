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
            }
        }
        </script>
        
        