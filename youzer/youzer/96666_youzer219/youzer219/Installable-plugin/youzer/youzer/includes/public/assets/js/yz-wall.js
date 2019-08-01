( function( $ ) {

	'use strict';

	$( document ).ready( function() {

		/**
		 * # Modal.
		 */
		$( document ).on( 'click', '.yz-trigger-who-modal' , function( e ) {
			
			$( '.yz-wall-modal-overlay' ).fadeIn( 500, function() {
				$( this ).find( '.yz-modal-loader' ).fadeIn( 400 );
			});

			e.preventDefault();

			var post_id = $( this ).data( 'who-liked' );
			var data = {
				'action': 'yz_get_who_liked_post',
				'post_id': post_id
			};

			// We can also pass the url value separately from ajaxurl for front end AJAX implementations
			jQuery.post( Youzer.ajax_url, data, function( response ) {
				var $new_modal = $( '#yz-wall-modal' ).append( response );		
			    // Display Modal
				$new_modal.find( '.yz-wall-modal' ).addClass( 'yz-wall-modal-show' );
				// Hide Loader
				$( '.yz-wall-modal-overlay' ).find( '.yz-modal-loader' ).hide();
			});

		});

		// Hide Modal If User Clicked Escape Button
		$( document ).keyup( function( e ) {
			if ( $( '.yz-wall-modal-show' )[0] ) {
			    if ( e.keyCode === 27 ) {
				    $( '.yz-wall-modal-close' ).trigger( 'click' );
			    }
			}
		});

		// # Hide Modal if User Clicked Outside
		$( document ).mouseup( function( e ) {
		    if ( $( '.yz-wall-modal-overlay' ).is( e.target ) && $( '.yz-wall-modal-show' )[0] ) {
				$( '.yz-wall-modal-close' ).trigger( 'click' );
		    }
		});
		    
	});

})( jQuery );