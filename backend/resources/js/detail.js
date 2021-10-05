import { Carousel,Modal } from 'bootstrap';

var myCarousel = document.querySelector('#carouselPhotos')
var carousel = new Carousel(myCarousel, { 
  interval: false,
  wrap: true,
})

var jsCardModal = document.getElementById('lightboxModalFullscreen');
jsCardModal.addEventListener('show.bs.modal', function (event) {
    console.log('modal start')
    var button = event.relatedTarget
    var lightboximage = button.getAttribute('data-bs-lightbox')
    document.getElementById('LightboxImage').src = lightboximage;
})
