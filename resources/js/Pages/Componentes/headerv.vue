<template lang="pug">
nav.navbar.navbar-expand-lg.navbar-light.bg-light.fixed-top
  .container
    a.navbar-brand(href="/home" title='Consejo de Empresarios Jovenes')
      img.logo-main.scale-with-grid(src='/content/builder2/images/logo-cej.png' data-retina='/content/builder2/images/logo-cej.png' width="100" height="100")
    button.navbar-toggler.ml-auto(type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation')
      span.navbar-toggler-icon
    #navbarSupportedContent.collapse.navbar-collapse
      ul.menu.menu-main.navbar-nav.ml-auto
        li.nav-item
          a.nav-link(href="/home") Inicio
        li.nav-item
          a.nav-link(href='/Directorio') Directiorio
        li.nav-item
          a.nav-link(href='/acerca') Sobre Nosotros



</template>
<script>
export default{
  props: {
    
  },

  components: {
  }
}
</script>
<style scoped>

.navbar .navbar-collapse {
  text-align: center;
}

</style>