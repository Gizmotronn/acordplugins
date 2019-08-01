( function( $ ) {

    'use strict';

	$( document ).ready( function() {
	
	/**
	 * Documentation Index Accordion.
	 */
	
	var accordionsMenu = $( '.uk-docs-index' );

	if ( accordionsMenu.length > 0 ) {
		
		accordionsMenu.each( function() {
			// Detect Change In The Input[type="checkbox"] Value.
			$( this ).on( 'change', 'input[type="checkbox"]', function() {
				var checkbox = $( this );
				( checkbox.prop('checked') ) ? checkbox.siblings( 'ul' )
				.attr( 'style', 'display:none;' ).slideDown( 300 ) : checkbox.siblings( 'ul' )
				.attr( 'style', 'display:block;' ).slideUp( 300 );
			});
		});
	}

	/**
	 * Documentation Tabs
	 */

	// Declare Variables
    var yz_options_panel = $( '#ukai-panel' ),
        first_menu       = $( '.uk-docs-index a:first' ),
        first_section    = $( '.uk-docs-section:first' );

    // Add Avtive tab to The first menu and section .
    first_menu.addClass( 'yz-active-tab' );
    first_section.addClass( 'yz-active-tab' );

    // Get Title Menu 
    first_section.find( 'h1' ).prepend( first_menu.find( 'i' ).clone() );

    // Handle the section change when a section link is clicked 
    $( '.uk-docs-index a' ).click( function( e ) {

        // Scroll to top
        $( 'html, body' ).animate( {
            scrollTop: $( '.yz-active-tab' ).offset().top - 100
        }, 500 );

        // Prevent default behaviour 
        e.preventDefault();
         
        // Get the section id
        var section_id   = $( this ).attr( 'href' ),
            section_icon = $( this ).find( 'i' ).clone();
        
        // Display Selected Section
        $( this ).addClass( 'yz-active-tab' );
        $( '.yz-active-tab' ).removeClass( 'yz-active-tab' );
        $( section_id ).addClass( 'yz-active-tab' ).siblings( '.yz-active-tab' ).removeClass( 'yz-active-tab' );

        // Remove Old Icon
        $( section_id ).find( 'h1 i' ).remove();
        $( section_id ).find( 'h1' ).prepend( section_icon );
         
    });

	});

})( jQuery );