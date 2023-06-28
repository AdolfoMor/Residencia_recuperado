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
          .icons(style='background-size: cover;')
            .conta
              .overlay(v-for = "red in user.redes")
                .text
                  a(v-if="red.Facebook" :href= "red.Facebook"  target='_blank') 
                    i(class="icon-facebook-circled" style="font-size: 3rem; color: #ffffff")
                  a(v-if="red.Instagram" :href='red.Instagram' target='_blank') 
                    i(class="icon-instagram" style="font-size: 3rem; color: #ffffff")
                  a(v-if="red.Twitter" :href='red.Twitter' target='_blank')
                    i(class="icon-twitter-circled" style="font-size: 3rem; color: #ffffff")
                  a(v-if="red.Linkedin" :href='red.Linkedin' target='_blank')
                    i(class="icon-linkedin-circled" style="font-size: 3rem; color: #ffffff")
                  a(v-if="red.Google" :href='red.Google') 
                    i(class="icon-gplus-circled" style="font-size: 3rem; color: #ffffff")
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
      red: {},
      redes: [],
      url: "",
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
    getRedes(){
      axios.get('/api/estructura').then(response => {
        this.users = response.data.data
        //this.meta = response.data.meta
      }).catch(errors => {
        this.manageErrors(errors)
      })
    },
    },
    mounted(){
      this.getRedes()
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
.text {
  color: white;
  font-size: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
}
.imager {
  display: block;
  width: 100%;
  height: auto;
}
.conta:hover .overlay {
  opacity: 1;
}


.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .5s ease;
  background-color: #e61346;
}


</style>