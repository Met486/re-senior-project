import { Carousel,Modal } from 'bootstrap';

var myCarousel = document.querySelector('#carouselPhotos')
var carousel = new Carousel(myCarousel, { 
  interval: false,
  wrap: true,
})

const bookConfirm = document.getElementById("book_confirm");
const confirmTitle = document.getElementById("confirm_title");
const confirmAuthor = document.getElementById("confirm_author");
const confirmPublisher = document.getElementById("confirm_publisher");
const confirmCover = document.getElementById("confirm_cover");
const confirmDate = document.getElementById("confirm_date");

bookConfirm.style.display = "none";
console.log(isbn_13);

var jsCardModal = document.getElementById('lightboxModalFullscreen');
jsCardModal.addEventListener('show.bs.modal', function (event) {
    console.log('modal start')
    var button = event.relatedTarget
    var lightboximage = button.getAttribute('data-bs-lightbox')
    document.getElementById('LightboxImage').src = lightboximage;
})

  var bdUrl =  "https://api.openbd.jp/v1/get?isbn=" + isbn_13;


  $.ajax({
      method: "GET",
      url: bdUrl,
      data: {
          zipcode: 97201
      },
  })
      .done(function(result) {
          console.log(result);
          console.log("type is " + typeof(result));
          console.log(result[0].summary.title);
          // const from_json = JSON.parse(result);
          // console.log(from_json);
          confirmTitle.value = result[0].summary.title;
          confirmAuthor.value = result[0].summary.author;
          confirmDate.value = result[0].summary.pubdate;
          confirmPublisher.value = result[0].summary.publisher;
          confirmCover.src = result[0].summary.cover;
          
          bookConfirm.style.display = "block";
          console.log("bookConfirm displayed");
      });

