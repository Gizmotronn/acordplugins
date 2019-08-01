<?php 

/**
 * # Add Woocommerce Settings Tab
 */
function yz_woocommerce_settings_menu( $tabs ) {

	$tabs['woocommerce'] = array(
        'id'    => 'woocommerce',
   	    'icon'  => 'fas fa-shopping-cart',
   	    'function' => 'yz_woocommerce_settings',
   	    'title' => __( 'Woocommerce settings', 'youzer' ),
    );
    
    return $tabs;

}

add_filter( 'yz_panel_general_settings_menus', 'yz_woocommerce_settings_menu' );

/**
 * # Add Woocommerce Settings Tab
 */
function yz_woocommerce_settings() {

    global $Youzer_Admin, $Yz_Settings;

    $Yz_Settings->get_field(
        array(
            'title' => __( 'general settings', 'youzer' ),
            'type'  => 'openBox'
        )
    );

    $Yz_Settings->get_field(
        array(
            'title' => __( 'Woocommerce Integration', 'youzer' ),
            'desc'  => __( 'enable woocommerce integration', 'youzer' ),
            'id'    => 'yz_enable_woocommerce',
            'type'  => 'checkbox'
        )
    );

    $Yz_Settings->get_field( array( 'type' => 'closeBox' ) );

}