<template lang="pug">
div(data-aos='fade-left')
  #Content
    .content_wrapper.clearfix
      .sections_group
        .entry-content
          .section.mcb-section.full-screen.bg-cover(style='padding-top:500px; padding-bottom:150px; background-image:url(content/builder2/images/consejo.jpg); background-repeat:no-repeat; background-position:right bottom')
            .section_wrapper.mcb-section-inner
              .wrap.mcb-wrap.one.valign-top.clearfix
                .mcb-wrap-inner
                  .column.mcb-column.one-second.column_column
                    .column_attr.clearfix
                      h6 NOSOTROS
                      hr.no_line(style='margin:0 auto 10px')
                      h2(style='color:#ffffff')
                        | La revolución empresarial de Durango #SomosElPresente
          div(data-aos='fade-up')
            .section.mcb-section.no-margin-h.dark(style='padding-top:0px; padding-bottom:125px')
              .section_wrapper.mcb-section-inner
                .wrap.mcb-wrap.one-second.valign-middle.move-up.clearfix(style='padding:0 6% 60px 6%; background-color:#000; margin-top:-60px' data-tablet='no-up' data-mobile='no-up')
                  .mcb-wrap-inner
                    .column.mcb-column.one.column_column
                      .column_attr.clearfix(style="background-image:url('content/builder2/images/builder2-contact-line.png'); background-repeat:no-repeat; background-position:left top; padding:100px 0 0 0;")
                        h3
                          | Quiénes somos
                    .column.mcb-column.one.column_divider
                      hr.no_line(style='margin:0 auto 20px')
                    .column.mcb-column.one.column_column
                      .column_attr.clearfix(style="background-image:url('content/builder2/images/builder2-red-wheel-bg.png'); background-repeat:no-repeat; background-position:left top; padding:0 0 0 20%;")
                        p
                          | En el Consejo de Empresarios Jóvenes, somos una asociación civil apasionada por el éxito y crecimiento de las empresas en Durango. Nos esforzamos por elevar la calidad, posicionamiento y competitividad de nuestros negocios, mientras cultivamos los valores fundamentales de la responsabilidad, respeto, lealtad, unidad y compromiso.
                .wrap.mcb-wrap.one-second.valign-middle.clearfix
                  .mcb-wrap-inner
                    .column.mcb-column.two-third.column_column
                      div(data-aos='fade-left')
                        .column_attr.clearfix.align_center.bg-cover(style="background-image:url('content/builder2/images/builder2-slider-boxbg-red.png'); background-repeat:no-repeat; background-position:right top; padding:50px;")
                          .image_frame.image_item.no_link.scale-with-grid.no_border
                            .image_wrapper
                              i(class="icon-lightbulb-line" style="font-size: 3rem; color: #ffffff") 
                          hr.no_line(style='margin:0 auto 30px')
                          h4(style='color:#fff') ¡Has llegado al lugar indicado!
                          hr.no_line(style='margin:0 auto 10px')
                          p(style='color:#fff')
                            | Nuestra asociación está compuesta por empresarios jóvenes dinámicos y visionarios que están dispuestos a compartir su conocimiento, experiencia y recursos para impulsar el éxito colectivo.
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
      show:true
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

</style>