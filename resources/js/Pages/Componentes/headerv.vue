<template lang="pug">
#Wrapper
  #Header_wrapper
    .header#Header
      #Top_bar
        .container
          .column.one
            .top_bar_left.clearfix
              .logo
                a#logo(href="/home" title='Consejo de Empresarios Jovenes' data-height='400' data-padding='15')
                  img.logo-main.scale-with-grid(src='/content/builder2/images/logo-cej.png' data-retina='/content/builder2/images/logo-cej.png' data-height='100')
                  img.logo-sticky.scale-with-grid(src='/content/builder2/images/logo-cej.png' data-retina='/content/builder2/images/logo-cej.png' data-height='100')
                  img.logo-mobile.scale-with-grid(src='/content/builder2/images/logo-cej.png' data-retina='/content/builder2/images/logo-cej.png' data-height='100')
                  img.logo-mobile-sticky.scale-with-grid(src='/content/builder2/images/logo-cej.png' data-retina='/content/builder2/images/logo-cej.png' data-height='100')
              .menu_wrapper
                nav#menu
                  ul#menu-menu.menu.menu-main
                    li
                      a(href="/home")
                        span Inicio
                    li
                      a(href="/Directorio")
                        span Directorio
                    li
                      a(href='/Direcciones')
                        span Direcciones
                    li 
                      a(href='/Direcciones')
                          span Direcciones
                a.responsive-menu-toggle(href='#')
                  i.icon-menu-fine

</template>
<script>
export default{
  props: {
    
  },

  components: {
  }
}
</script>