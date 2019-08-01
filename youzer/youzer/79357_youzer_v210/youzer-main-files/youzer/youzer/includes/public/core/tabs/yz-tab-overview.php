<?php

class YZ_Overview_Tab {

	/**
	 * Tab Core
	 */
	function tab() {
		
		global $Youzer;

        // Overview Tab Arguments
        $args = array(
        	'tab_order'	  => 10,
            'tab_name'    => 'overview',
            'tab_slug'	  => 'overview',
			'tab_icon'	  => yz_options( 'yz_overview_tab_icon' ),
			'tab_title'   => yz_options( 'yz_overview_tab_title' ),
			'display_tab' => yz_options( 'yz_display_overview_tab' )
        );

	    $Youzer->tabs->core( $args );
	}

    /**
     * # Tab Content.
     */
	function tab_content() {

		global $Yz_Widgets;

		// Get Overview Widgets
		$profile_widgets = yz_options( 'yz_profile_main_widgets' );

		// Get Widget Content.
		$Yz_Widgets->get_widget_content( $profile_widgets );	
	}

}