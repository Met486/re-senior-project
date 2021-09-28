// import $ from 'jquery';
// import 'slick-carousel';
// import { Fancybox, Carousel, PanZoom } from "@fancyapps/ui";
import { Carousel } from 'bootstrap';

var myCarousel = document.querySelector('#carouselPhotos')
var carousel = new Carousel(myCarousel, { 
  interval: false,
  wrap: true,
})

// Fancybox.getInstance().getSlide().Panzoom.toggleZoom();
// Fancybox.bind("[data-fancybox]", {
//     Image: {
//       zoom: true,
//     },
//   });

//   Fancybox.show(gallery, {
//     Image: {
//       // Image-specific options go here, for example:
//       click: 'close'
      
//     },
//   });
// $('.slider').slick({
//     autoplay: false,//自動的に動き出すか。初期値はfalse。
//     infinite: true,//スライドをループさせるかどうか。初期値はtrue。
//     slidesToShow: 1,//スライドを画面にn枚見せる
//     slidesToScroll: 1,//1回のスクロールでn枚の写真を移動して見せる
//     prevArrow: '<div class="slick-prev"></div>',//矢印部分PreviewのHTMLを変更
//     nextArrow: '<div class="slick-next"></div>',//矢印部分NextのHTMLを変更
//     dots: true,//下部ドットナビゲーションの表示
//     responsive: [
//         {
//         breakpoint: 769,//モニターの横幅が769px以下の見せ方
//         settings: {
//             slidesToShow: 1,//スライドを画面にn枚見せる
//             slidesToScroll: 1,//1回のスクロールでn枚の写真を移動して見せる
//         }
//     },
//     {
//         breakpoint: 426,//モニターの横幅が426px以下の見せ方
//         settings: {
//             slidesToShow: 1,//スライドを画面にn枚見せる
//             slidesToScroll: 1,//1回のスクロールでn枚の写真を移動して見せる
//         }
//     }
// ]
// });