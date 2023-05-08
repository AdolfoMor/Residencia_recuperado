<template lang="pug">
#Content
.section_wrapper.mcb-section-inner
  .wrap.mcb-wrap.one.valign-top.clearfix
    .mcb-wrap-inner
      .column.mcb-column.one-sixth.column_placeholder
        .placeholder
      .column.mcb-column.two-third.column_column
        .column_attr.clearfix.align_center
          v-typical.blink(:steps="['Fortaleciendo...', 3000, 'Impulsando', 3000, 'Preparando', 3000]" :loop='Infinity' :wrapper="'h2'") 
          h2 A Los Jovenes Empresarios.
          hr.no_line(style='margin:0 auto 10px')
          h3 Somos un grupo de jóvenes empresarios que trabaja para elevar la calidad, posicionamiento y competitividad de las empresas duranguenses.
        n-divider
          .section.mcb-section.equal-height-wrap(style='padding-top:50px; padding-bottom:50px')
    
.section_wrapper.mcb-section-inner
  .wrap.mcb-wrap.two-fifth.valign-middle.clearfix
    .mcb-wrap-inner
      .column.mcb-column.one.column_image
        .image_frame.image_item.no_link.scale-with-grid.no_border
          .image_wrapper
          n-carousel(direction='vertical' dot-placement='right' mousewheel='' style='width: 100%; height: 340px')
            img.carousel-img(src='https://naive-ui.oss-cn-beijing.aliyuncs.com/carousel-img/carousel1.jpeg')
            img.carousel-img(src='https://naive-ui.oss-cn-beijing.aliyuncs.com/carousel-img/carousel2.jpeg')
            img.carousel-img(src='https://naive-ui.oss-cn-beijing.aliyuncs.com/carousel-img/carousel3.jpeg')
            img.carousel-img(src='https://naive-ui.oss-cn-beijing.aliyuncs.com/carousel-img/carousel4.jpeg')
  .wrap.mcb-wrap.three-fifth.valign-middle.clearfix(style='padding:0 5%')
    .mcb-wrap-inner
      .column.mcb-column.one.column_column
        .column_attr.clearfix
          h4
            b
              | Buscamos los mejores beneficios para nuestros afiliados
          h6.strong Algunos de los beneficios que tenemos son:
          hr.no_line(style='margin:0 auto 10px')
          p
            li Coaching empresarial para emprendedores
            li Networking interior y exterior.
            li Descuentos entre afiliados.
            li Descuentos y beneficios en vuelos y hoteles.
            li Asesoría sobre programas gubernamentales de apoyo a empresas.
            li Precios especiales en cursos y capacitaciones
            li Temas de interés en cada asamblea
            li Nuevos beneficios cada mes.
  n-divider
.section.mcb-section(style='padding-top:50px; padding-bottom:75px')
.section_wrapper.mcb-section-inner
  .wrap.mcb-wrap.one.valign-top.clearfix
    .mcb-wrap-inner
      .column.mcb-column.one-sixth.column_placeholder
        .placeholder
      .column.mcb-column.two-third.column_column
        .column_attr.clearfix.align_center
          h2(style="color: #e22222") Responsabilidad Empresarial
.section.mcb-section(style='padding-top:0px; padding-bottom:0px; background-image:url(/content/builder2/images/builder2-home-red-square-bg.png); background-repeat:no-repeat; background-position:right top')
.section_wrapper.mcb-section-inner
  .wrap.mcb-wrap.one-second.valign-top.clearfix(style='padding:0 1%')
    .mcb-wrap-inner
      .column.mcb-column.one.column_image
          i(class="icon-chart-bar" style="font-size: 3rem")
      .column.mcb-column.five-sixth.column_column
        .column_attr.clearfix
          h3 Nuestros objetivos
          p
            | Agrupar jóvenes empresarios de pequeñas, medianas o grandes empresas con la finalidad de elevar la calidad, posicionamiento y competitividad de sus negocios.
  .wrap.mcb-wrap.one-second.valign-top.clearfix(style='padding:0 1%')
    .mcb-wrap-inner
      .column.mcb-column.one.column_image
          i(class="icon-money-line" style="font-size: 3rem")
      .column.mcb-column.five-sixth.column_column
        .column_attr.clearfix
          h3 Crecimiento Económico
          p
            | La integración entre los afiliados permite la generación de valor para todos los involucrados, nuevos negocios, crecimiento económico y de las organizaciones.

</template>
<script>
import { NCarousel } from "naive-ui"
import { NDivider } from "naive-ui"
import VTypical from 'vue-typical'
import VuePrlx from 'vue-prlx'
import headimageComponent from '@/Pages/Componentes/headimage.vue'
export default{
  props: {
    testing: String
  },

  components: {
    NCarousel,
    VTypical,
    NDivider,
    VuePrlx,
    headimageComponent
  }
}
</script>
<style scoped>
.carousel-img {
  margin: 0 auto;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.blink::after {
  content: '|';
  animation: blink 1s infinite step-start;
}

@keyframes blink {
  50% {
    opacity: 0;
  }
}
</style>