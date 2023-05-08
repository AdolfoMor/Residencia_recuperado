<template lang="pug">
.footer#Footer.clearfix
    .widgets_wrapper(style='padding:30px 100px 5px;')
        .container
            .column.one-second
                .aside.widget_text.widget.widget_custom_html
                    .textwidget.custom-html-widget
                        h4.strong Contáctanos  
                        hr.no_line(style='margin:0 auto 50px')
                        form#newsletterform.newsletter_form
                            .column.three-fourth
                                input#email_news(placeholder='Your e-mail' type='email' name='email_news' size='40' aria-required='true' aria-invalid='false')
                            .column.one-fourth
                                input#submit(type='button' value='Afiliate' onclick='return check_values_news();')
                        
            .column.one-second
                .aside.widget_text.widget.widget_custom_html
                    .textwidget.custom-html-widget
                        hr.no_line(style='margin:0 auto 50px')
                        div(style='text-align:center;')
                            img(src='/content/builder2/images/logo-cej.png' style='max-width:200px; width:100%;')
                    
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