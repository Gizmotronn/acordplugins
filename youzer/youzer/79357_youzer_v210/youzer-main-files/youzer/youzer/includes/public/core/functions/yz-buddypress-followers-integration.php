<?php

/**
 * Get Users Follow Button !
 */
function yz_follow_message_button() {

	if ( bp_is_active( 'messages' ) ) {

	?>

	<div class="yz-follow-message-button">
		<?php 

            bp_follow_add_profile_follow_button();

			if ( bp_is_active( 'messages' ) ) {
                yz_send_private_message_button( bp_displayed_user_id(), '<span>' . __( 'Message', 'youzer' ) . '</span>' );
            }

        ?>
	</div>

	<?php

	} else {
        bp_follow_add_profile_follow_button();
	}

}

add_action( 'yz_social_buttons', 'yz_follow_message_button' );

/**
 * Remove Js Script
 */
function yz_delete_buddypress_follwers_script() {

	global $Youzer;

	// Remove Buddypress Follwers Default Script.
	wp_dequeue_script( 'bp-follow-js' );

	// Add the youzer compatible script.
	wp_enqueue_script( 'yz-follow-js', YZ_PA . 'js/yz-follow.min.js', array( 'jquery' ), $Youzer->version );

}

add_action( 'wp_enqueue_scripts', 'yz_delete_buddypress_follwers_script', 999 );
	
/**
 * # Setup Tabs.
 */
function yz_bpfollwers_tabs() {

	$bp = buddypress();

	// Remove Settings Profile, General Pages
	bp_core_remove_nav_item( 'followers' );
	bp_core_remove_nav_item( 'following' );

	$follow_slug = yz_bpfollowers_follows_tab_slug();

	// Add Follows Tab.
	bp_core_new_nav_item(
	    array( 
	        'position' => 100,
	        'slug' => $follow_slug, 
	        'name' => __( 'Follows' , 'youzer' ), 
	        'default_subnav_slug' => 'following',
	        'parent_slug' => $bp->profile->slug,
	        'screen_function' => 'yz_bpfollwers_follow_screen_following', 
	        'parent_url' => bp_loggedin_user_domain() . "$follow_slug/"
	    )
	);

	// Add Follwers Sub Tab.
    bp_core_new_subnav_item( array(
            'slug' => 'followers',
            'name' => __( 'followers', 'youzer' ),
            'parent_slug' => yz_bpfollowers_follows_tab_slug(),
            'parent_url' => bp_displayed_user_domain() . "$follow_slug/",
            'screen_function' => 'yz_bpfollwers_follow_screen_following',
        )
    );

	// Add Following Sub Tab.
    bp_core_new_subnav_item( array(
            'slug' => 'following',
            'name' => __( 'following', 'youzer' ),
            'parent_slug' => yz_bpfollowers_follows_tab_slug(),
            'parent_url' => bp_displayed_user_domain() . "$follow_slug/",
            'screen_function' => 'yz_bpfollwers_follow_screen_following',
        )
    );
}

add_action( 'bp_setup_nav', 'yz_bpfollwers_tabs' );

/**
 * Get Follows Tab Screen Function.
 */
function yz_bpfollwers_follow_screen_following() {
	
	do_action( 'bp_follow_screen_following' );

    add_action( 'bp_template_content', 'yz_get_user_following_template' );

    // Load Tab Template
    bp_core_load_template( 'buddypress/members/single/plugins' );
}

/**
 * Get Follows Tab Content.
 */
function yz_get_user_following_template() {
	bp_get_template_part( 'members/single/follows' );
}

/**
 * Follows Slug.
 */
function yz_bpfollowers_follows_tab_slug() {
	return apply_filters( 'yz_bpfollowers_follows_tab_slug', 'follows' );
}
