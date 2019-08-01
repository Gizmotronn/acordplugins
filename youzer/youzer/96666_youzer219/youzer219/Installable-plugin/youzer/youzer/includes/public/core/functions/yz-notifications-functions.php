<?php

// Step 1: Register components for notification component use
add_action( 'bp_setup_globals', 'yz_register_notifications' );

function yz_register_notifications() {

    // Register component manually into buddypress() singleton
    buddypress()->yz_like_notification = new stdClass;

	// Add notification callback function
    buddypress()->yz_like_notification->notification_callback = 'yz_format_new_like_notifications';

    // Now register components into active components array
    buddypress()->active_components['yz_like_notification'] = 1;

}

/**
 * Add User Like Notification.
 */
function yz_add_user_like_notification( $activity_id, $user_id = 0 ) {

	if ( bp_loggedin_user_id() == $user_id ) {
		return;
	}
	// Get Acitivy
    $activity = bp_activity_get_specific( array( 'activity_ids' => $activity_id ) );

    bp_notifications_add_notification(
    	array(
	        'user_id'           => $activity["activities"][0]->user_id,
	        'item_id'           => $activity_id,
	        'secondary_item_id' => $user_id,
	        'component_name'    => 'yz_like_notification',
	        'component_action'  => 'yz_new_like',
	        'date_notified'     => bp_core_current_time(),
	        'is_new'            => 1,
    	)
    );

}

add_action( 'bp_activity_add_user_favorite', 'yz_add_user_like_notification', 10, 2 );

function yz_format_new_like_notifications( $action, $item_id, $secondary_item_id, $total_items, $format = 'string' ) {

    // New custom notifications
    if ( 'yz_new_like' === $action ) {

        if ( 1 == $total_items ) {

            $custom_text = sprintf( __( '%s liked your post', 'youzer' ), bp_core_get_user_displayname( $secondary_item_id ) );
            $custom_title = sprintf( __( '%s liked your post', 'youzer' ), bp_core_get_user_displayname( $secondary_item_id ) );
            $activity_link      = bp_activity_get_permalink( $item_id ) ;

            $custom_link = wp_nonce_url(
add_query_arg(array('action' => 'yz_new_like_mark_read', 'activity_id' => $item_id ), $activity_link ), 'yz_new_like_mark_read_' . $item_id );
            // $custom_link = bp_core_get_user_domain( $secondary_item_id  ) . '?bpf_read';

        } else {
            $custom_text = sprintf( __( '%d more users liked your post', 'youzer' ), $total_items );
            $custom_title = sprintf( __( '%d more users liked your post', 'youzer' ), $total_items );

            if ( bp_is_active( 'notifications' ) ) {
                $custom_link = bp_get_notifications_permalink();
            } else {
                $link = bp_loggedin_user_domain() . $bp->follow->followers->slug . '/?new';
            }
        }
 
        // WordPress Toolbar
        if ( 'string' === $format ) {
            $return = apply_filters( 'custom_filter', '<a href="' . esc_url( $custom_link ) . '" title="' . esc_attr( $custom_title ) . '">' . esc_html( $custom_text ) . '</a>', $custom_text, $custom_link );
            // Deprecated BuddyBar
        } else {
            $return = apply_filters( 'custom_filter', array(
                'text' => $custom_text,
                'link' => $custom_link
            ), $custom_link, (int) $total_items, $custom_text, $custom_title );
        }
        
        return $return;
        
    }

    return $action;
    
}

/**
 * Mark Likes notifications as read when reading a topic
 *
 */
function yz_buddypress_mark_like_notifications_as_read( $action = '' ) {

	if ( ! bp_is_active( 'activity' ) || ! bp_is_single_activity()  ) {
		return;
	}

	// Bail if no activity ID is passed
	if ( empty( $_GET['activity_id'] ) || ! isset( $_GET['action'] ) || $_GET['action'] != 'yz_new_like_mark_read' ) {
		return;
	}

	// Get required data
	$user_id  = bp_loggedin_user_id();
	$activity_id = intval( $_GET['activity_id'] );

	// Check nonce
	if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], 'yz_new_like_mark_read_' . $activity_id ) || ! current_user_can( 'edit_user', $user_id ) ) {
	    bp_core_add_message( "<strong>ERROR</strong>: Sorry you don't have permission to do that !", 'error' );
		return;
	}

	// Attempt to clear notifications for the current user from this topic
	$success = bp_notifications_mark_notifications_by_item_id( $user_id, $activity_id, 'yz_like_notification', 'yz_new_like' );

	// Do additional subscriptions actions
	do_action( 'yz_notifications_handler', $success, $user_id, $activity_id, $action );

	// Redirect to the topic
	$redirect = bp_activity_get_permalink( $activity_id );

	// Redirect
	wp_safe_redirect( $redirect );

	// For good measure
	exit();
}

add_action( 'bp_actions', 'yz_buddypress_mark_like_notifications_as_read', 1 );