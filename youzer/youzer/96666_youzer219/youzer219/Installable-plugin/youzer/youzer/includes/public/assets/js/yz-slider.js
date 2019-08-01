( function( $ ) {

    'use strict';

	$( document ).ready( function() {

	    $.youzer_sliders_init = function() {

			// Set Up Variables.
			var $progressBar, $bar, $elem, isPause, tick, percentTime, time = 4;
			
			var yz_auto_slideshow = ( Youzer.slideshow_auto == '1' ) ? true : false;

		    // Init progressBar where elem is $(".yz-slider")
		    function progressBar( elem ) {
		    	
		    	if ( ! yz_auto_slideshow ) {
		    		return;
		    	}

			    $elem = elem;
			    // build progress bar elements
			    buildProgressBar();
			    // start counting
			    start();
		    }

		    // Create div#progressBar and div#bar then prepend to the slider.
		    function buildProgressBar() {
				$progressBar = $( '<div>', { id: 'yz-progressBar' } );
				$bar 		 = $( '<div>', { id: 'yz-bar' } );
				$progressBar.append( $bar ).prependTo( $elem );
		    }

		    function start() {
		    	// Reset timer
		    	percentTime = 0;
		    	isPause 	= false;
		    	// Run interval every 0.01 second
		    	tick = setInterval( interval, 10 );
		    };

		    function interval() {
		      	if ( isPause === false ) {
			        percentTime += 1 / time;
			        $bar.css( {
			           width: percentTime+"%"
			        } );

		        //if percentTime is equal or greater than 100
		        if ( percentTime >= 100 ) {
					//slide to next item
					$elem.trigger( 'owl.next' )
		        }
		      }
		    }

		    // Pause while dragging
		    function pauseOnDragging() {
		   		isPause = true;
		    }

		    // Moved callback
		    function moved(){
		    	
		    	if ( ! yz_auto_slideshow ) {
		    		return;
		    	}

				clearTimeout( tick );
				start();
		    }

			/**
			 * SlideShow
			 */

			var yz_slides_height = ( Youzer.slides_height_type == 'auto' ) ? true : false; 

	    	if ( $( '.yz-slider' )[0] ) {

			    // Init the carousel
			    $( '.yz-slider' ).owlCarousel( {
					slideSpeed 		: 500,
					autoplay 		: false,
					paginationSpeed : 500,
					loop			: false,
					singleItem 		: true,
					navigation 		: true,
					afterMove 		: moved,
					transitionStyle : 'fade',
					afterInit 		: progressBar,
					startDragging 	: pauseOnDragging,
			    	autoHeight		: yz_slides_height
			    } );
			}

		    $.yz_wall_slider = function() {
			    // Init the carousel
			    $( '.yzw-slider' ).owlCarousel( {
					autoplay 		: false,
					slideSpeed 		: 500,
					paginationSpeed : 500,
					singleItem 		: true,
					navigation 		: true,
					afterMove 		: moved,
					transitionStyle : 'fade',
					afterInit 		: progressBar,
					startDragging 	: pauseOnDragging,
			    	autoHeight		: yz_slides_height
			    } );
		    }

	    	if ( $( '.yzw-slider' )[0] ) {
	    		$.yz_wall_slider();
			}

		}
		
		$.youzer_sliders_init();

	});

})( jQuery );