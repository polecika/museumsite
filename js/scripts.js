$(document).ready(function() {


   $( "#slider-range" ).slider({
      range: true,
      min: 4500,
      max: 31000,
      values: [ 4500, 28570 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "от: " + ui.values[ 0 ] + " до: " + ui.values[ 1 ] );
		$( "#amount-ot" ).val( ui.values[ 0 ] );
		$( "#amount-do" ).val( ui.values[ 1 ] );
      }
    });
	
    $( "#amount" ).val( " " + $( "#slider-range" ).slider( "values", 0 ) +
      " " + $( "#slider-range" ).slider( "values", 1 ) );
	$( "#amount-ot" ).val( $( "#slider-range" ).slider( "values", 0 ));
    $( "#amount-do" ).val( $( "#slider-range" ).slider( "values", 1 ));
	
$('.carousel-stage')
    .on('jcarousel:create jcarousel:reload', function() {
        var element = $(this),
            width = element.innerWidth();

        // This shows 1 item at a time.
        // Divide `width` to the number of items you want to display,
        // eg. `width = width / 3` to display 3 items at a time.
        element.jcarousel('items').css('width', width + 'px');
    })
    .jcarousel({
        // Your configurations options
    });
	
$('.carousel-navigation')
    .on('jcarousel:create jcarousel:reload', function() {
        var element = $(this),
            width = element.innerWidth();
			width = width / 3;

        // This shows 1 item at a time.
        // Divide `width` to the number of items you want to display,
        // eg. `width = width / 3` to display 3 items at a time.
        element.jcarousel('items').css('width', width + 'px');
    })
    .jcarousel({
        // Your configurations options
    });
	  /*
$(".carousel").on("touchstart", function(event){
        var xClick = event.originalEvent.touches[0].pageX;
    $(this).one("touchmove", function(event){
        var xMove = event.originalEvent.touches[0].pageX;
        if( Math.floor(xClick - xMove) > 5 ){
            $(".carousel").carousel('prev');
        }
        else if( Math.floor(xClick - xMove) < -5 ){
            $(".carousel").carousel('next');
        }
    });
    $(".carousel").on("touchend", function(){
            $(this).off("touchmove");
    });
});
	  */
});




