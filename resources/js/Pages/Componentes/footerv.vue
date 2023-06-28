<template lang="pug">
.footer#Footer.clearfix
    .widgets_wrapper(style='padding:30px 100px 5px;')
        .container
            .column.one-second
                .aside.widget_text.widget.widget_custom_html
                    .textwidget.custom-html-widget
                        h4.strong Contáctanos  
                        hr.no_line(style='margin:0 auto 50px')
                        form#newsletterform.newsletter_form(@submit.prevents="submit")
                            .column.three-fourth
                                input#name(v-model="form.name" placeholder='Tu nombre' type='text' name='email_news' size='40' aria-required='true' aria-invalid='false')
                            .column.three-fourth
                                input#email(v-model="form.email" placeholder='Tu e-mail' type='email' name='email_news' size='40' aria-required='true' aria-invalid='false')
                            .column.three-fourth
                                input#body(v-model="form.body" placeholder='Descripción' type='email' name='email_news' size='40' aria-required='true' aria-invalid='false')
                            .column.one-fourth
                                input#submit(type='button' value='Afiliate')
                        
            .column.one-second
                .aside.widget_text.widget.widget_custom_html
                    .textwidget.custom-html-widget
                        hr.no_line(style='margin:0 auto 50px')
                        div(style='text-align:center;')
                            img(src='/content/builder2/images/logo-cej.png' style='max-width:200px; width:100%;')
                            h4(style="color:#e61346") Llámanos
                                h6 (618) 302 9067
                            h4(style="color:#e61346") Email
                                h6 contacto@cejdurango.com

                    
    .footer_copy
        .container
            .column.one
            a#back_to_top.button.button_js(href='#')
                i.icon-up-open-big
            .copyright
                |
            ul.social
                li.facebook
                a(href='https://www.facebook.com/CejDgo/' target="_blank" title='Facebook')
                    i.icon-facebook
                li.twitter
                a(href='https://twitter.com/cejdurango?lang=es' target="_blank" title='Twitter')
                    i.icon-twitter
                li.instagram
                a(href='https://www.instagram.com/cejdurango/' target="_blank" title='Instagram')
                    i.icon-instagram
                li.login
                a(href='/dashboard' target="_blank" title='Login')
                    i.icon-lock
</template>
<script>
 
export default {
    
}
</script>
<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const form=useForm({

    name: "",
    email: "",
    body: ""
})

const submit = () =>{
    form.post(route('contact'))
}
</script>