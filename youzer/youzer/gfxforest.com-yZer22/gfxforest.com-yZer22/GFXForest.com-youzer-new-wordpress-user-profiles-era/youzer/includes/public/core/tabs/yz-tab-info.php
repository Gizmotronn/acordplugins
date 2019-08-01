<?php

class YZ_Info_Tab {

    /**
     * Constructor
     */
    function __construct() {
    }

    /**
     * # Tab.
     */
    function tab() {

        // Get User Profile Widgets
        $this->get_user_infos();

        do_action( 'youzer_after_infos_widgets' );
    }

    /**
     * # Get Custom Widgets functions.
     */
    function get_user_infos() {
        
        if ( ! bp_is_active( 'xprofile' ) ) {
            return false;
        }

        do_action( 'bp_before_profile_loop_content' );
        
        if ( bp_has_profile() ) : while ( bp_profile_groups() ) : bp_the_profile_group();
                
            if ( bp_profile_group_has_fields() ) :
                    
                $group_id = bp_get_the_profile_group_id();

                // Custom infos Widget Arguments
                $custom_infos_args = array(
                    'widget_icon'       => yz_get_xprofile_group_icon( $group_id ),
                    'widget_title'      => bp_get_the_profile_group_name(),
                    'widget_name'       => 'custom_infos',
                );

                youzer()->widgets->yz_widget_core( $custom_infos_args );

        endif; endwhile;
        
        endif;

        do_action( 'bp_after_profile_loop_content' );

    }

}