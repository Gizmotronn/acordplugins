<?php

class Youzer_Tabs {

	protected $youzer;

    public function __construct() {

		global $Youzer;

    	$this->youzer = &$Youzer;

    	// Init Tabs.
		$this->overview  = new YZ_Overview_Tab();
		$this->comments  = new YZ_Comments_Tab();
		$this->custom 	 = new YZ_Custom_Tabs();
		$this->posts 	 = new YZ_Posts_Tab();
		$this->info 	 = new YZ_Info_Tab();

		// Call Tabs.
		add_action( 'yz_profile_main_column', array( &$this, 'get_tabs' ) );

    }

	/**
	 * # Tab Core.
	 */
	function core( $args ) {

		// Get Tab Class Name.
	    $tab_name = $args['tab_name'];
	    $class_name = 'yz-' . $tab_name;

		?>

		<div class="yz-tab <?php echo $class_name; ?>">
			<?php $this->$tab_name->tab_content(); ?>
		</div>

		<?php

	}

	/**
	 * Get Tabs Content
	 */
	public function get_tabs() {

		// Show Private Account Message.
		if ( ! yz_display_profile() ) {
			yz_private_account_message();
			return false;
		}

		// If page is single activity show single activity template.
	    if ( bp_is_single_activity() ) {
	        yz_get_single_wall_post();
	        return;
	    }

		/**
		 * Fires before the display of member body content.
		 *
		 * @since 1.2.0
		 */
		do_action( 'bp_before_member_body' );

		if ( bp_is_user_front() ) :
			bp_displayed_user_front_template_part();

		elseif ( bp_is_user_activity() ) :
			bp_get_template_part( 'members/single/activity' );

		elseif ( bp_is_user_blogs() ) :
			bp_get_template_part( 'members/single/blogs'    );

		elseif ( bp_is_user_friends() ) :
			bp_get_template_part( 'members/single/friends'  );

		elseif ( bp_is_user_groups() ) :
			bp_get_template_part( 'members/single/groups'   );

		elseif ( bp_is_user_messages() ) :
			bp_get_template_part( 'members/single/messages' );

		elseif ( bp_is_user_profile() ) :
			bp_get_template_part( 'members/single/profile'  );

		elseif ( bp_is_user_notifications() ) :
			bp_get_template_part( 'members/single/notifications' );

		elseif ( bp_is_user_settings() ) :
			bp_get_template_part( 'members/single/settings' );


		// If nothing sticks, load a generic template
		else :
			bp_get_template_part( 'members/single/plugins'  );

		endif;

		/**
		 * Fires after the display of member body content.
		 *
		 * @since 1.2.0
		 */
		do_action( 'bp_after_member_body' );

	}
	
}