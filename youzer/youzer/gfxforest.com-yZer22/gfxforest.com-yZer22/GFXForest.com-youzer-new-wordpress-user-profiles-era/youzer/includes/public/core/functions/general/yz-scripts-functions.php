<?php

/**
 * Register Global Scripts
 */
function yz_global_scripts() {

    global $Youzer;
    
    // Get Data.
    $jquery = array( 'jquery' );

    // Register Panel Style.
    wp_register_style( 'yz-panel-css',  YZ_AA . 'css/yz-panel-css.min.css', $Youzer->version );

    // Font Awesome.
    wp_register_style( 'yz-icons', YZ_AA . 'css/all.min.css', $Youzer->version );
    
    // Icon Picker.
    wp_register_style( 'yz-iconpicker', YZ_AA . 'css/yz-icon-picker.min.css', $Youzer->version );

    // IconPicker Script
    wp_register_script( 'yz-iconpicker', YZ_AA .'js/ukai-icon-picker.min.js', $jquery, $Youzer->version, true );

    // Tag Editor Script
    wp_register_script( 'yz-ukaitags', YZ_PA .'js/ukaitag.min.js', $jquery, $Youzer->version, true );

    // IconPicker Script
    wp_register_script( 'yz-iconpicker', YZ_AA .'js/ukai-icon-picker.min.js', $jquery, $Youzer->version, true );

}

add_action( 'wp_loaded', 'yz_global_scripts' );