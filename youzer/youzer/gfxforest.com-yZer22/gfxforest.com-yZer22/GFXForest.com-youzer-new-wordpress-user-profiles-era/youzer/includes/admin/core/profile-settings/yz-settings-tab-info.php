<?php

/**
 * Infos settings
 */
function yz_profile_info_tab_settings() {

    global $Yz_Settings;
    
    $Yz_Settings->get_field(
        array(
            'title' => __( 'info styling settings', 'youzer' ),
            'class' => 'ukai-box-2cols',
            'type'  => 'openBox'
        )
    );

    $Yz_Settings->get_field(
        array(
            'title' => __( 'info title', 'youzer' ),
            'desc'  => __( 'info titles color', 'youzer' ),
            'id'    => 'yz_infos_wg_title_color',
            'type'  => 'color'
        )
    );

    $Yz_Settings->get_field(
        array(
            'title' => __( 'info value', 'youzer' ),
            'desc'  => __( 'info values color', 'youzer' ),
            'id'    => 'yz_infos_wg_value_color',
            'type'  => 'color'
        )
    );

    $Yz_Settings->get_field( array( 'type' => 'closeBox' ) );
}
