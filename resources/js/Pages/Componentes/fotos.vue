<template lang="pug">
div(data-aos='fade-up' data-aos-anchor-placement='bottom-bottom')
  .section.mcb-section.dark.full-screen(style='padding-top:105px; padding-bottom:0px; background-color:#f82f2f')
    .section_wrapper.mcb-section-inner
      .wrap.mcb-wrap.one.valign-top.clearfix
        .mcb-wrap-inner
          .column.mcb-column.one-sixth.column_placeholder
            .placeholder
          .column.mcb-column.two-third.column_column
            .column_attr.clearfix.align_center
              h6(style='color:#000') Conoce nuestro equipo 
              hr.no_line(style='margin:0 auto 20px')
              h2  Uniendo talento y pasión
              hr.no_line(style='margin:0 auto 60px')


section#section-team.no-padding(style='background-size: cover;')
  .row.col-md-10.mx-auto.mt-3
    .col-lg-3.col-md-6.col-sm-8(v-for = "user in users")
      div(data-aos='zoom-in-down' data-aos-anchor-placement='bottom-bottom')
        .profile_pic.text-center(style='background-size: cover;')
          figure.picframe.sc-icon.mb20
            .icons(style='background-size: cover;')
              a(href='https://www.facebook.com/alextregam' target='_blank')
                i.fa.fa-facebook.fa-lg
              a(href='https://twitter.com/alextregam' target='_blank')
                i.fa.fa-twitter.fa-lg
              a(href='https://mx.linkedin.com/in/alejandro-trevi%C3%B1o-gamboa-467704ba' target='_blank')
                i.fa.fa-linkedin.fa-lg
              a(href='https://instagram.com/alextregam' target='_blank')
                i.fa.fa-instagram.fa-lg
            img.img-fluid(:src='user.Foto' alt='')
          h3 {{user.Nombre}}
          span.subtitle {{user.Posicion}}
</template>
<script>
import { NCarousel } from "naive-ui"
import { NDivider } from "naive-ui"
import VTypical from 'vue-typical'
import VuePrlx from 'vue-prlx'
import headimageComponent from '@/Pages/Componentes/headimage.vue'
import { defineComponent, ref } from "vue";



export default{
  data(){
    return{
      show:true,
      user: {},
      users: [],
    }
  },
  props: {
    testing: String
  },

  components: {
    NCarousel,
    VTypical,
    NDivider,
    VuePrlx,
    headimageComponent
  },
  methods: {
    getUsers(){
      axios.get('/api/estructura').then(response => {
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
<style scoped>

  
.nested-enter-active, .nested-leave-active {
	transition: all 0.3s ease-in-out;
}
/* delay leave of parent element */
.nested-leave-active {
  transition-delay: 0.25s;
}

.nested-enter-from,
.nested-leave-to {
  transform: translateY(30px);
  opacity: 0;
}

/* we can also transition nested elements using nested selectors */
.nested-enter-active .inner,
.nested-leave-active .inner { 
  transition: all 0.3s ease-in-out;
}
/* delay enter of nested element */
.nested-enter-active .inner {
	transition-delay: 0.25s;
}

.nested-enter-from .inner,
.nested-leave-to .inner {
  transform: translateX(30px);
  /*
  	Hack around a Chrome 96 bug in handling nested opacity transitions.
    This is not needed in other browsers or Chrome 99+ where the bug
    has been fixed.
  */
  opacity: 0.001;
}
.hover {
  overflow: hidden;
  position: relative;
  padding-bottom: 60%;
}

.hover-overlay {
  width: 500%;
  height: 71%;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 90;
  transition: all 0.4s;
}

.hover img {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  transition: all 0.3s;
}

.hover-content {
  position: relative;
  z-index: 99;
}


/* DEMO 1 ============================== */
.hover-1 img {
  width: 100%;
  position: sticky;
  top: 0;
  transition: all 0.3s;
}

.hover-1-content {
  position: absolute;
  bottom: 0;
  left: 0;
  z-index: 99;
  transition: all 0.4s;
}

.hover-1 .hover-overlay {
  background: rgba(0, 0, 0, 0.5);
}

.hover-1-description {
  transform: translateY(0.5rem);
  transition: all 0.4s;
  opacity: 0;
}

.hover-1:hover .hover-1-content {
  bottom: 2rem;
}

.hover-1:hover .hover-1-description {
  opacity: 1;
  transform: none;
}

.hover-1:hover img {
  left: 0;
}

.hover-1:hover .hover-overlay {
  opacity: 0;
}


</style>