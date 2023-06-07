<template lang="pug">
#Content
transition(appear duration='550' name='nested')
  .outer(style='transition-delay: 1s')
    headimage-component
br    

.section_wrapper.mcb-section-inner
  .wrap.mcb-wrap.one.valign-top.clearfix
    .mcb-wrap-inner
      .column.mcb-column.one-sixth.column_placeholder
        .placeholder
      .column.mcb-column.two-third.column_column
        .column_attr.clearfix.align_center
          v-typical.blink(:steps="['FORTALECIENDO', 3000, 'IMPULSANDO', 3000, 'PREPARANDO', 3000]" :loop='Infinity' :wrapper="'h6'") 
          h6 A LOS JOVENES EMPRESARIOS
          hr.no_line(style='margin:0 auto 10px')
          h2 Siempre buscando elevar la calidad, posicionamiento y competitividad de las empresas duranguenses.

.section.mcb-section.no-margin-h.no-margin-v.equal-height-wrap(style='padding-top:0px; padding-bottom:125px; background-image:url(content/builder2/images/builder2-home-grey-square-bg.png); background-repeat:no-repeat; background-position:left top')  
  .section.mcb-section(style='padding-top:0px; padding-bottom:30px')
    .section_wrapper.mcb-section-inner
      .wrap.mcb-wrap.one-fourth.valign-top.bg-contain.clearfix(style='padding:100px 20px; background-image:url("/content/builder2/images/builder2-featured-bg.png"); background-repeat:no-repeat; background-position:left center')
        .mcb-wrap-inner
          .column.mcb-column.one.column_image
            .image_frame.image_item.no_link.scale-with-grid.aligncenter.no_border
              .image_wrapper
                img.scale-with-grid(src='/content/builder2/images/builder2-home-featured-icon1.png')
          .column.mcb-column.one.column_column
            .column_attr.clearfix.align_center(style='padding:0 4%;')
              hr.no_line(style='margin:0 auto 10px')
              h3 Constructions
              hr.no_line(style='margin:0 auto 30px')
              p
                | Vivamus in diam turpis. In condimentum maximus tristique vestibulum.
      .wrap.mcb-wrap.one-fourth.valign-top.bg-contain.clearfix(style='padding:100px 20px; background-image:url(/content/builder2/images/builder2-featured-bg.png); background-repeat:no-repeat; background-position:left center')
        .mcb-wrap-inner
          .column.mcb-column.one.column_image
            .image_frame.image_item.no_link.scale-with-grid.aligncenter.no_border
              .image_wrapper
                img.scale-with-grid(src='/content/builder2/images/builder2-home-featured-icon2.png')
          .column.mcb-column.one.column_column
            .column_attr.clearfix.align_center(style='padding:0 4%;')
              hr.no_line(style='margin:0 auto 10px')
              h3 Problem solving
              hr.no_line(style='margin:0 auto 30px')
              p
                | Vivamus in diam turpis. In condimentum maximus tristique vestibulum.
      .wrap.mcb-wrap.one-fourth.valign-top.bg-contain.clearfix(style='padding:100px 20px; background-image:url(/content/builder2/images/builder2-featured-bg.png); background-repeat:no-repeat; background-position:left center')
        .mcb-wrap-inner
          .column.mcb-column.one.column_image
            .image_frame.image_item.no_link.scale-with-grid.aligncenter.no_border
              .image_wrapper
                img.scale-with-grid(src='content/builder2/images/builder2-home-featured-icon3.png')
          .column.mcb-column.one.column_column
            .column_attr.clearfix.align_center(style='padding:0 4%;')
              hr.no_line(style='margin:0 auto 10px')
              h3 Carpentry
              hr.no_line(style='margin:0 auto 30px')
              p
                | Vivamus in diam turpis. In condimentum maximus tristique vestibulum.
      .wrap.mcb-wrap.one-fourth.valign-top.bg-contain.clearfix(style='padding:100px 20px; background-image:url(content/builder2/images/builder2-featured-bg.png); background-repeat:no-repeat; background-position:left center')
        .mcb-wrap-inner
          .column.mcb-column.one.column_image
            .image_frame.image_item.no_link.scale-with-grid.aligncenter.no_border
              .image_wrapper
                img.scale-with-grid(src='content/builder2/images/builder2-home-featured-icon4.png')
          .column.mcb-column.one.column_column
            .column_attr.clearfix.align_center(style='padding:0 4%;')
              hr.no_line(style='margin:0 auto 10px')
              h3 Management
              hr.no_line(style='margin:0 auto 30px')
              p
                | Vivamus in diam turpis. In condimentum maximus tristique vestibulum.
.section.mcb-section(style='padding-top:0px; padding-bottom:0px; background-image:url(./content/builder2/images/builder2-home-red-square-bg.png); background-repeat:no-repeat; background-position:right top')
  .section.mcb-section(style='padding-top:50px; padding-bottom:75px')
    .section_wrapper.mcb-section-inner
      .wrap.mcb-wrap.one.valign-top.clearfix
        .mcb-wrap-inner
          .column_attr.clearfix.align_center
            h2(style="color: #e22222") Responsabilidad Empresarial

.section.mcb-section(style='padding-top:0px; padding-bottom:0px; background-image:url(./content/builder2/images/builder2-home-red-square-bg.png); background-repeat:no-repeat; background-position:left top')
  .section_wrapper.mcb-section-inner
    .wrap.mcb-wrap.two-fifth.valign-middle.bg-cover.clearfix(style='padding:30px 4%; background-image:url(content/builder2/images/builder2-slider-boxbg-red.png); background-repeat:no-repeat; background-position:right top')
      .mcb-wrap-inner
        .column.mcb-column.one.column_column
          .column_attr.clearfix.align_center(style='padding:50px;')
            .image_frame.image_item.no_link.scale-with-grid.no_border
              .image_wrapper
                img.scale-with-grid(src='content/builder2/images/builder2-home-ruller.png')
            hr.no_line(style='margin:0 auto 30px')
            h4(style='color:#fff') Nuestros objetivos
            hr.no_line(style='margin:0 auto 10px')
            p(style='color:#fff')
              | Agrupar jóvenes empresarios de pequeñas, medianas o grandes empresas con la finalidad de elevar la calidad, posicionamiento y competitividad de sus negocios.

    .wrap.mcb-wrap.two-fifth.valign-middle.bg-cover.clearfix(style='padding:50px 2%;')
      .mcb-wrap-inner
        .column.mcb-column.one.column_column
          .column_attr.clearfix.align_center(style='padding:40px;')
            .image_frame.image_item.no_link.scale-with-grid.no_border
              .image_wrapper
                i(class="icon-money-line" style="font-size: 3rem")
            hr.no_line(style='margin:0 auto 30px')
            h4 Crecimiento económico
            hr.no_line(style='margin:0 auto 10px')
            p
              | La integración entre los afiliados permite la generación de valor para todos los involucrados, nuevos negocios, crecimiento económico y de las organizaciones.
            
.section.mcb-section.no-margin-h.no-margin-v.equal-height-wrap(style='padding-top:0px; padding-bottom:125px; background-image:url(content/builder2/images/builder2-home-grey-square-bg.png); background-repeat:no-repeat; background-position:right top')  
  .section.mcb-section(style='padding-top:50px; padding-bottom:75px')
    .section_wrapper.mcb-section-inner
      .wrap.mcb-wrap.one.valign-top.clearfix
        .mcb-wrap-inner  
          .column_attr.clearfix.align_center
            h2(style="color: #e22222") Nuestra comunidad
            a.twitter-timeline(href='https://twitter.com/CEJDurango?ref_src=twsrc%5Etfw' data-tweet-limit="3") Tweets by CEJDurango





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
  setup() {
    function onTweetLoadSuccess(embedNode) {
      console.log(embedNode)
    }

    function onTweetLoadError() {
      console.log("Ops... an error has occurred")
    }

    return { onTweetLoadSuccess, onTweetLoadError }
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
.outer, .inner {
	background: #eee;
  padding: 30px;
  min-height: 100px;
}
  
.inner { 
  background: #ccc;
}
  
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