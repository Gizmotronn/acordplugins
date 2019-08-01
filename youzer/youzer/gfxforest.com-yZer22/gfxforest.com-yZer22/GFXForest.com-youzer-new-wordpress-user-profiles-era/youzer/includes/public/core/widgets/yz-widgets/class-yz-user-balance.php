<?php

class YZ_User_Balance {

    /**
     * # Widget Arguments.
     */
    function args() {

        // Get Widget Args
        $args = array(
            'menu_order'    => 100,
            'widget_icon'   => 'fas fa-gem',
            'widget_name'   => 'user_balance',
            'widget_title'  => yz_options( 'yz_wg_user_balance_title' ),
            'load_effect'   => yz_options( 'yz_user_balance_load_effect' ),
            'display_title' => yz_options( 'yz_wg_user_balance_display_title' )
        );

        // Filter
        $args = apply_filters( 'yz_user_balance_widget_args', $args );

        return $args;
    }


    /**
     * # Widget Content.
     */
    function widget() {
        do_action( 'yz_user_balance_widget_content' );
    }

    /**
     * # Widget Settings.
     */
    function admin_settings() {
        do_action( 'yz_user_balance_widget_settings' );
    }

}