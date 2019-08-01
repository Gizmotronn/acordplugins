<?php

/**
 * Make RTmedia compatible with Youzer.
 */
function yz_rtmedia_main_template_include( $old_template ) {
    
    if ( yz_is_rtmedia_ajax_call() ) {
        return $old_template;
    }

    $new_template = $old_template;

    if ( bp_is_user() ) {
        $new_template = YZ_TEMPLATE . 'profile-template.php';
    } elseif ( bp_is_group() ) {
        $new_template = YZ_TEMPLATE . 'groups/single/home.php';
    }
        
    return apply_filters( 'yz_rtmedia_media_include', $new_template, $old_template );

}

add_filter( 'rtmedia_media_include', 'yz_rtmedia_main_template_include', 0 );

/**
 * Is RT-Media Ajax Call.
 */
function yz_is_rtmedia_ajax_call() {

    $is_ajax = false;

    $rt_ajax_request = yz_get_server_var( 'HTTP_X_REQUESTED_WITH', 'FILTER_SANITIZE_STRING' );
    
    if ( 'xmlhttprequest' === strtolower( $rt_ajax_request ) ) {
        $is_ajax = true;
    }

    return apply_filters( 'yz_is_rtmedia_ajax_call', $is_ajax );

}

/**
 * Get server variable
 */
function yz_get_server_var( $server_key, $filter_type = 'FILTER_SANITIZE_STRING' ) {

	$server_val = '';

	if ( function_exists( 'filter_input' ) && filter_has_var( INPUT_SERVER, $server_key ) ) {
		$server_val = filter_input( INPUT_SERVER, $server_key, constant( $filter_type ) );
	} elseif ( isset( $_SERVER[ $server_key ] ) ) {
		$server_val = $_SERVER[ $server_key ];
	}

	return $server_val;

}

/**
 * Get Rtmedia Content
 */
function yzc_add_rtmedia_content() {

    global $rtmedia_query;  
    
    if ( $rtmedia_query ) {  
        include_once YZ_TEMPLATE . 'rtmedia/main.php';
    }

}

add_action( 'yz_group_main_column', 'yzc_add_rtmedia_content' );
add_action( 'yz_profile_main_column', 'yzc_add_rtmedia_content' );


/**
 * Disable Youzer Template Dor Rtmedia Ajax Call.
 */
function yz_rtmedia_disable_youzer_template( $new_template, $old_template ) {
	
	if ( yz_is_rtmedia_ajax_call() ) {
		return $old_template;
	}

	return $new_template;
}

add_filter( 'youzer_template', 'yz_rtmedia_disable_youzer_template', 10, 2 );