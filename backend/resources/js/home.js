var myCarousel = document.querySelector('#carouselPlus')
var carousel = new Carousel(myCarousel, { 
  interval: false,
  wrap: true,
})

function multiCarousel(){
	if ( $( "#lg" ).is( ":visible" ) ) {
		do {
			$( "#carouselPlus .carousel-inner" ).children( ".carousel-grid:lt(4)" ).wrapAll( "<div class=\"carousel-item\"><div class=\"row\"></div></div>" );
			$( "#carouselPlus .carousel-inner .carousel-item:first" ).addClass("active");
		} while ( $( "#carouselPlus .carousel-inner" ).children( ".carousel-grid" ).length );
	} else if ( $( "#md" ).is( ":visible" ) ) {
		do {
			$( "#carouselPlus .carousel-inner" ).children( ".carousel-grid:lt(3)" ).wrapAll( "<div class=\"carousel-item\"><div class=\"row\"></div></div>" );
			$( "#carouselPlus .carousel-inner .carousel-item:first" ).addClass("active");
		} while ( $( "#carouselPlus .carousel-inner" ).children( ".carousel-grid" ).length );
	} else {
		do {
			$( "#carouselPlus .carousel-inner" ).children( ".carousel-grid:lt(1)" ).wrapAll( "<div class=\"carousel-item\"><div class=\"row\"></div></div>" );
			$( "#carouselPlus .carousel-inner .carousel-item:first" ).addClass("active");
		} while ( $( "#carouselPlus .carousel-inner" ).children( ".carousel-grid" ).length);
	}
}
var $origin = $("#carouselPlus .carousel-inner").prop("outerHTML");
$(window).on( "load resize", function() {
	$( "#carouselPlus .carousel-inner" ).replaceWith( $origin );
	multiCarousel();
});

