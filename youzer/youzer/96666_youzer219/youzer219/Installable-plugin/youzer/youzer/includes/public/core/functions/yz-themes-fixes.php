<?php

/**
 * Bimber Theme Fix
 */
function yz_disable_bimber_theme_bp_css() {
    return false;
}

add_filter( 'bimber_bp_load_css', 'yz_disable_bimber_theme_bp_css' );


/**
 * Kleo Theme Fix
 */
function yz_remove_kleo_bp_css() {
	wp_dequeue_style( 'bp-parent-css' );
	wp_dequeue_style( 'kleo-bbpress' );	
}
add_action( 'wp_enqueue_scripts' , 'yz_remove_kleo_bp_css', 999 );

/**
 * My Listing Theme Fix
 */
function yz_remove_c27_bp_css() {
  	// 27 Theme
	wp_dequeue_style( 'c27-buddypress-style' );
}

add_action( 'wp_enqueue_scripts' , 'yz_remove_c27_bp_css', 999 );

/**
 * Remove Theme Default Buddypress CSS
 */
function youzer_remove_themes_default_bp_css() {

	$theme = wp_get_theme();

	if ( $theme == 'Aardvark' || $theme == 'Aardvark Child' ) {
		wp_dequeue_style( 'ghostpool-bp' );
		wp_dequeue_style( 'ghostpool-bbp' );
	}

}

add_action( 'wp_enqueue_scripts' , 'youzer_remove_themes_default_bp_css', 999 );


function yz_my_listing_theme_css_fix() {

	$theme = wp_get_theme();

	if ( 'My Listing' != $theme ) {
		return;
	}

	?>

	<style type="text/css">
		.bp-user .yz-page {
			margin-top: 89px;
		}
		.buddypress.bp-user  .c27-main-header.header.header-fixed {
			background-color: rgba(29, 35, 41, 0.98);
		}

		.buddypress.listings .yz-sidebar-column {
			display:none;
		}

		#buddypress.youzer #activity-stream .ac-reply-content a {
		    background: transparent;
		    color: #898989;
		    font-weight: 600;
		}

		.directory.activity #buddypress div.item-list-tabs ul li.selected a,
		#buddypress.youzer #activity-stream .ac-reply-content a:hover  {
			background:transparent !important;
		}

		.youzer #activity-stream .ac-reply-content input[type="submit"] {
			width:initial;
		}

		@media screen and ( max-width: 1024px ) {
			.bp-user .yz-page {
			margin-top: 80px;
			}
		}
		@media screen and ( max-width: 425px ) {
			.bp-user .yz-page {
			margin-top: 60px;
			}
		}	
	</style>
	
	<?php
}

add_action( 'wp_head', 'yz_my_listing_theme_css_fix' );