<?php 

/**
 * Get User Balance
 */
function yz_mycred_get_user_balance_box( $user_id = null , $title = null, $point_type = null ) {

	if ( ! yz_is_mycred_active() )  {
		return;
	}

	// Get User ID.
	$user_id = ! empty( $user_id ) ? $user_id : bp_displayed_user_id();

	// Get Ballance 
	$user_balance = mycred_get_users_balance( $user_id, 'customtypekey' );

	// Load myCRED with this points type.
	$mycred = mycred( 'mycred_default' );

	?>

	<div class="yz-user-balance-box">
		<?php if ( ! empty( $title ) ) : ?>
			<span class="yz-box-head"><i class="fa fa-diamond" aria-hidden="true"></i><?php echo $title; ?></span>
		<?php endif; ?>
		<span class="yz-user-points"><?php echo $user_balance; ?></span>
		<span class="yz-user-points-slash">/</span>
		<span class="yz-user-points-title"><?php echo _n( $mycred->singular(), $mycred->plural(), $user_balance ); ?></span>

		<?php do_action( 'yz_after_user_balance_widget', $user_id ); ?>
		
		 
	</div>

	<?php
}

/**
 * Function Get Mycred balance widget content.
 */
function yz_mycred_profile_balance_widget_content() {

	// Get Widget Title.
	$title = yz_options( 'yz_wg_user_balance_title' );
	
	// Get Widget.
	yz_mycred_get_user_balance_box( null, $title );

}

add_action( 'yz_user_balance_widget_content', 'yz_mycred_profile_balance_widget_content' );

/**
 * Check User Balance Widget Visibility.
 */
function yz_mycred_is_user_have_balance( $widget_visibility, $widget_name ) {

    if ( 'user_balance' != $widget_name ) {
        return $widget_visibility;
    }

    return true;
}

add_filter( 'yz_profile_widget_visibility', 'yz_mycred_is_user_have_balance', 10, 2 ); 

/**
 * Add User level to user balance.
 */
function yz_mycred_add_level_to_user_balance( $user_id ) {

	if ( ! function_exists( 'mycred_get_users_rank' ) ) {
		return;
	}
	
	// Get rank object
	$rank = mycred_get_users_rank( $user_id );
	
	// If the user has a rank, $rank will be an object
	if ( is_object( $rank ) ) {
		
		// Rank Logo
		$rank_logo = ( $rank->has_logo ) ? $rank->get_image( 'logo' ) : '<i class="fa fa-user" arial-hidden="true"></i>';

		// Show rank title
		echo '<div class="yz-user-level-data">' . $rank_logo . '<span class="yz-user-level-title">' . $rank->title . '</span></div>';
	
	}

}

add_action( 'yz_after_user_balance_widget', 'yz_mycred_add_level_to_user_balance' );

/**
 * User Balance WP Widget
 */
function yz_mycred_user_balance_wp_widget() {
    register_widget( 'YZ_Mycred_Balance_Widget' );
}

add_action( 'widgets_init', 'yz_mycred_user_balance_wp_widget' );
