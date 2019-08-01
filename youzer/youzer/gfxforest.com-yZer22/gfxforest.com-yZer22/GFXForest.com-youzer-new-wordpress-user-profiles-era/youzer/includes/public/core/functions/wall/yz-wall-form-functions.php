<?php

/**
 * Post user/group activity update.
 */
function yz_wall_action_post_update() {
	
	global $Youzer;

	// Do not proceed if user is not logged in, not viewing activity, or not posting.
	if ( ! is_user_logged_in() || ! bp_is_activity_component() || ! bp_is_current_action( 'post' ) ) {
		return false;
	}

	do_action( 'yz_before_wall_post_update' );
	
	// Check the nonce.
	check_admin_referer( 'yz_post_update', '_yz_wpnonce_post_update' );

	// Init Vars.
	$post_type = sanitize_text_field( $_POST['post_type'] );

	/**
	 * Filters the content provided in the activity input field.
	 */
	$content = apply_filters( 'yz_bp_activity_post_update_content', $_POST['status'] );

	if ( ! empty( $_POST['yz-whats-new-post-object'] ) ) {

		/**
		 * Filters the item type that the activity update should be associated with.
		 *
		 * @since 1.2.0
		 *
		 * @param string $value Item type to associate with.
		 */
		$object = apply_filters( 'bp_activity_post_update_object', $_POST['yz-whats-new-post-object'] );
	}

	if ( ! empty( $_POST['yz-whats-new-post-in'] ) ) {

		/**
		 * Filters what component the activity is being to.
		 *
		 * @since 1.2.0
		 *
		 * @param string $value Chosen component to post activity to.
		 */
		$item_id = apply_filters( 'bp_activity_post_update_item_id', $_POST['yz-whats-new-post-in'] );
	}
	
	do_action( 'yz_before_adding_wall_post', $_POST );

	// No existing item_id.
	if ( empty( $item_id ) ) {

		$activity_id = yz_activity_post_update( array(
			'content' => $content,
			'type'    => 'activity_' . $post_type,
		) );

	// Post to groups object.
	} elseif ( 'groups' == $object && bp_is_active( 'groups' ) ) {
		if ( (int) $item_id ) {
			$activity_id = yz_groups_post_update(
				array(
					'content' => $content,
					'group_id' => $item_id,
					'type' => 'activity_' . $post_type
					)
			);
		}
	} else {

		/**
		 * Filters activity object for BuddyPress core and plugin authors before posting activity update.
		 *
		 * @since 1.2.0
		 *
		 * @param string $object  Activity item being associated to.
		 * @param string $item_id Component ID being posted to.
		 * @param string $content Activity content being posted.
		 */
		$activity_id = apply_filters( 'bp_activity_custom_update', $object, $item_id, $content );
	}

	do_action( 'yz_after_adding_wall_post', $activity_id, $_POST );

	// Provide user feedback.
	if ( ! empty( $activity_id ) ) {
		bp_core_add_message( __( 'Update Posted!', 'youzer' ) );
	} else {
		bp_core_add_message( __( 'There was an error when posting your update. Please try again.', 'youzer' ), 'error' );
	}

	// Redirect.
	bp_core_redirect( wp_get_referer() );
}

add_action( 'bp_actions', 'yz_wall_action_post_update' );

/**
 * Save Activity Attachments
 */
function yz_save_wall_post_attachments( $activity_id, $data ) {
	
	if ( empty( $data['attachments_files'] ) ) {
		return;
	}

	global $Youzer;
	$atts = $Youzer->wall->move_attachments( $data['attachments_files'] );
	bp_activity_update_meta( $activity_id, 'attachments', $atts );

}

add_action( 'yz_after_adding_wall_post', 'yz_save_wall_post_attachments', 10, 2 );

/**
 * Save Activity Meta
 */
function yz_save_activity_meta( $activity_id, $data ) {
	
	// Update Post Type.
	bp_activity_update_meta( $activity_id, 'post-type', $data['post_type'] );

	switch ( $data['post_type'] ) {

		case 'link':

			// Init Vars.
			$link_url = esc_url( $data['link_url'] );
			$link_desc = esc_textarea( $data['link_desc'] );
			$link_title = sanitize_text_field( trim( $data['link_title'] ) );

			// Save Data
			bp_activity_update_meta( $activity_id, 'yz-link-url', $link_url );
			bp_activity_update_meta( $activity_id, 'yz-link-desc', $link_desc );
			bp_activity_update_meta( $activity_id, 'yz-link-title', $link_title );

			break;
		
		case 'quote':

			// Init Vars.
			$quote_text = esc_textarea( $data['quote_text'] );
			$quote_owner = sanitize_text_field( $data['quote_owner'] );

			// Save Data.
			bp_activity_update_meta( $activity_id, 'yz-quote-text', $quote_text );
			bp_activity_update_meta( $activity_id, 'yz-quote-owner', $quote_owner );

			break;
	}

}

add_action( 'yz_after_adding_wall_post', 'yz_save_activity_meta', 10, 2 );

/**
 * Save Activity Meta
 */
function yz_save_activity_live_preview( $activity_id, $data ) {

	if ( ! isset( $data['url_preview_link'] ) || empty( $data['url_preview_link'] ) ) {
		return;
	}

	$url_preview_args = array(
		'image' 		=> $data['url_preview_img'],
		'site'  		=> $data['url_preview_site'],
		'link'  		=> esc_url( $data['url_preview_link'] ),
		'description'   => esc_textarea( $data['url_preview_desc'] ),
		'title' 		=> sanitize_text_field( $data['url_preview_title'] ),
		'use_thumbnail' => sanitize_text_field( $data['url_preview_use_thumbnail'] ),
	);

	// Serialize.
	$url_preview_data = base64_encode( serialize( $url_preview_args ) );

	// Save Url Data.
	bp_activity_update_meta( $activity_id, 'url_preview', $url_preview_data );

	do_action( 'yz_after_saving_activity_live_preview', $activity_id, $url_preview_args );
	 
}

add_action( 'yz_after_adding_wall_post', 'yz_save_activity_live_preview', 10, 2 );

/**
 * Processes Activity updates received via a POST request.
 *
 * @since 1.2.0
 *
 * @return string|null HTML
 */
function yz_legacy_theme_post_update() {

	$bp = buddypress();

	if ( ! bp_is_post_request() ) {
		return;
	}
	
	do_action( 'yz_before_adding_wall_post', $_POST, true );

	// Check the nonce.
	check_admin_referer( 'yz_post_update', '_yz_wpnonce_post_update' );

	/**
	 * Filters the content provided in the activity input field.
	 */
	$content = apply_filters( 'yz_bp_activity_post_update_content', $_POST['status'] );

	$activity_id = 0;
	$item_id     = 0;
	$object      = '';


	// Try to get the item id from posted variables.
	if ( ! empty( $_POST['item_id'] ) ) {
		$item_id = (int) $_POST['item_id'];
	}

	// Try to get the object from posted variables.
	if ( ! empty( $_POST['object'] ) ) {
		$object  = sanitize_key( $_POST['object'] );

	// If the object is not set and we're in a group, set the item id and the object
	} elseif ( bp_is_group() ) {
		$item_id = bp_get_current_group_id();
		$object = 'groups';
	}

	if ( ! $object && bp_is_active( 'activity' ) ) {

		$activity_id = yz_activity_post_update( array(
			'content' => $content,
			'type'    => 'activity_' . $_POST['post_type'],
		) );

	} elseif ( 'groups' === $object ) {

		if ( $item_id && bp_is_active( 'groups' ) ) {

			$activity_id = yz_groups_post_update(
				array(
					'content' => $content,
					'group_id' => $item_id,
					'type' => 'activity_' . $_POST['post_type']
				)
			);

		}

	} else {

		/** This filter is documented in bp-activity/bp-activity-actions.php */
		$activity_id = apply_filters( 'bp_activity_custom_update', false, $object, $item_id, $_POST['content'] );
	}

	do_action( 'yz_after_adding_wall_post', $activity_id, $_POST );

	if ( false === $activity_id ) {
		$error_msg = __( 'There was a problem posting your update. Please try again.', 'youzer' );
		yz_die( $error_msg );
	} elseif ( is_wp_error( $activity_id ) && $activity_id->get_error_code() ) {
		$error_msg = $activity_id->get_error_message();
		yz_die( $error_msg );
	}

	$last_recorded = ! empty( $_POST['since'] ) ? date( 'Y-m-d H:i:s', intval( $_POST['since'] ) ) : 0;
	if ( $last_recorded ) {
		$activity_args = array( 'since' => $last_recorded );
		$bp->activity->last_recorded = $last_recorded;
		add_filter( 'bp_get_activity_css_class', 'bp_activity_newest_class', 10, 1 );
	} else {
		$activity_args = array( 'include' => $activity_id );
	}

	// Remove Effect Class.
	remove_filter( 'bp_get_activity_css_class', 'yz_add_activity_css_class' );

	if ( bp_has_activities ( $activity_args ) ) {
		while ( bp_activities() ) {
			bp_the_activity();
			bp_get_template_part( 'activity/entry' );
		}
	}

	if ( ! empty( $last_recorded ) ) {
		remove_filter( 'bp_get_activity_css_class', 'bp_activity_newest_class', 10 );
	}

	exit;
}

add_action( 'wp_ajax_yz_post_update', 'yz_legacy_theme_post_update' );

/**
 * Validate Wall Form.
 */

add_action( 'yz_before_adding_wall_post', 'yz_validate_wall_form', 10, 2 );

function yz_validate_wall_form( $post, $using_ajax = false ) {

	global $Youzer;

	// Get Vars.
	$post_type = sanitize_text_field( $post['post_type'] );
	$post_content = sanitize_text_field( $post['status'] );

	// Get Allowed Post Types.
	$allowed_post_types = array(
		'status', 'photo', 'video' , 'audio',
		'link', 'slideshow','file', 'quote'
	);
	
	// Check Post Type.	
	if ( ! in_array( $post_type, $allowed_post_types ) ) {
		if ( $using_ajax ) {
			yz_die( $Youzer->wall->msg( 'invalid_post_type' ) );
		} else {
			$Youzer->wall->redirect( 'error', 'invalid_post_type' );
		}
	}

	// Get Attachments Post Types.
	$attachments_post_types = array( 'photo', 'video', 'audio', 'slideshow', 'file' );

	// Check Attachments.
	if ( in_array( $post_type, $attachments_post_types ) && empty( $post['attachments_files'] ) ) {
		if ( $using_ajax ) {
			yz_die( $Youzer->wall->msg( 'no_attachments' ) );
		} else {
			$Youzer->wall->redirect( 'error', 'no_attachments' );
		}
	}
	
	// Check if status is empty.
	if ( 'status' == $post_type ) {

		if ( ( empty( $post_content ) || ! strlen( trim( $post_content ) ) ) && 'off' == yz_options( 'yz_enable_wall_url_preview' ) ) {
			if ( $using_ajax ) {
				yz_die( $Youzer->wall->msg( 'empty_status' ) );
			} else {
				$Youzer->wall->redirect( 'error', 'empty_status' );
			}
		}		

		if ( ( empty( $post_content ) || ! strlen( trim( $post_content ) ) ) && 'on' == yz_options( 'yz_enable_wall_url_preview' ) && empty( $_POST['url_preview_link'] ) ) {
			if ( $using_ajax ) {
				yz_die( $Youzer->wall->msg( 'empty_status' ) );
			} else {
				$Youzer->wall->redirect( 'error', 'empty_status' );
			}
		}

	}

	// Check Slideshow Post.
	if ( 'slideshow' == $post_type && count( $post['attachments_files'] ) < 2 ) {
		if ( $using_ajax ) {
			yz_die( $Youzer->wall->msg( 'slideshow_need_images' ) );
		} else {
			$Youzer->wall->redirect( 'error', 'slideshow_need_images' );
		}
	}

	// Check Quote Post.
	if ( 'quote' == $post_type ) {

		// Init Vars.
		$quote_text = esc_textarea( $post['quote_text'] );
		$quote_owner = sanitize_text_field( trim( $post['quote_owner'] ) );

		// Validate Quote text.
		if ( empty( $quote_text ) ) {
			if ( $using_ajax ) {
				yz_die( $Youzer->wall->msg( 'empty_quote_text' ) );
			} else {
				$Youzer->wall->redirect( 'error', 'empty_quote_text' );
			}
		}		

		// Validate Quote Owner.
		if ( empty( $quote_owner ) ) {
			if ( $using_ajax ) {
				yz_die( $Youzer->wall->msg( 'empty_quote_owner' ) );
			} else {
				$Youzer->wall->redirect( 'error', 'empty_quote_owner' );
			}
		}

	}

	// Check Link Post.
	if ( 'link' == $post_type ) {

		// Init Vars.
		$link_url = esc_url( $post['link_url'] );
		$link_desc = esc_textarea( $post['link_desc'] );
		$link_title = sanitize_text_field( trim( $post['link_title'] ) );

		// Validate Link Url.
		if ( ! empty( $link_url ) && filter_var( $link_url, FILTER_VALIDATE_URL ) === false ) {
			if ( $using_ajax ) {
				yz_die( $Youzer->wall->msg( 'invalid_link_url' ) );
			} else {
				$Youzer->wall->redirect( 'error', 'invalid_link_url' );
			}
		}			

		// Validate Link title.
		if ( empty( $link_title ) ) {
			if ( $using_ajax ) {
				yz_die( $Youzer->wall->msg( 'empty_link_title' ) );
			} else {
				$Youzer->wall->redirect( 'error', 'empty_link_title' );
			}
		}		

		// Validate Link Description.
		if ( empty( $link_desc ) ) {
			if ( $using_ajax ) {
				yz_die( $Youzer->wall->msg( 'empty_link_desc' ) );
			} else {
				$Youzer->wall->redirect( 'error', 'empty_link_desc' );
			}
		}
	}
}


/**
 * Post an Activity status update affiliated with a group.
 */
function yz_groups_post_update( $args = '' ) {

	if ( ! bp_is_active( 'activity' ) ) {
		return false;
	}

	$bp = buddypress();

	$defaults = array(
		'content'    => false,
		'type'    	 => 'activity_update',
		'user_id'    => bp_loggedin_user_id(),
		'group_id'   => 0,
		'error_type' => 'bool'
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	if ( empty( $group_id ) && !empty( $bp->groups->current_group->id ) )
		$group_id = $bp->groups->current_group->id;

	if ( empty( $user_id ) || empty( $group_id ) )
		return false;

	$bp->groups->current_group = groups_get_group( $group_id );

	// Be sure the user is a member of the group before posting.
	if ( ! bp_current_user_can( 'bp_moderate' ) && ! groups_is_user_member( $user_id, $group_id ) ) {
		return false;
	}

	// Record this in activity streams.
	$activity_action  = sprintf( __( '%1$s posted an update in the group %2$s', 'youzer' ), bp_core_get_userlink( $user_id ), '<a href="' . bp_get_group_permalink( $bp->groups->current_group ) . '">' . esc_attr( $bp->groups->current_group->name ) . '</a>' );
	$activity_content = $content;

	/**
	 * Filters the action for the new group activity update.
	 */
	$action = apply_filters( 'yz_groups_activity_new_update_action',  $activity_action, $user_id, $group_id );

	/**
	 * Filters the content for the new group activity update.
	 */
	$content_filtered = apply_filters( 'yz_groups_activity_new_update_content', $activity_content );

	$activity_id = groups_record_activity( array(
		'user_id'    => $user_id,
		'action'     => $action,
		'content'    => $content_filtered,
		'type'       => $r['type'],
		'item_id'    => $group_id,
		'error_type' => $error_type
	) );

	groups_update_groupmeta( $group_id, 'last_activity', bp_core_current_time() );

	/**
	 * Fires after posting of an Activity status update affiliated with a group.
	 */
	do_action( 'yz_groups_posted_update', $content, $user_id, $group_id, $activity_id );

	return $activity_id;
}

/**
 * Wall Form Post Types Options. 
 */
function yz_wall_form_post_types_buttons() {

	// Init Array().
	$checked = true;
	$post_types = array();

	// Status Data.
	$post_types[] = array(
		'id'	=> 'status',
		'icon' 	=> 'fas fa-comment-dots',
		'name'  => __( 'status', 'youzer' ),
		'show'	=> yz_options( 'yz_enable_wall_status' )
	);

	// Photo Data.
	$post_types[] = array(
		'id'	=> 'photo',
		'icon' 	=> 'fas fa-camera-retro',
		'name'  => __( 'photo', 'youzer' ),
		'show'	=> yz_options( 'yz_enable_wall_photo' )
	);

	// Slideshow Data.
	$post_types[] = array(
		'icon' 	=> 'fas fa-film',
		'id'	=> 'slideshow',
		'name'  => __( 'slideshow', 'youzer' ),
		'show'	=> yz_options( 'yz_enable_wall_slideshow' )
	);

	// Quote Data.
	$post_types[] = array(
		'id'	=> 'quote',
		'icon' 	=> 'fas fa-quote-right',
		'name'  => __( 'quote', 'youzer' ),
		'show'	=> yz_options( 'yz_enable_wall_quote' )
	);

	// File Data.
	$post_types[] = array(
		'id'	=> 'file',
		'icon' 	=> 'fas fa-cloud-download-alt',
		'name'  => __( 'file', 'youzer' ),
		'show'	=> yz_options( 'yz_enable_wall_file' )
	);

	// Video Data.
	$post_types[] = array(
		'id'	=> 'video',
		'icon' 	=> 'fas fa-video',
		'name'  => __( 'video', 'youzer' ),
		'show'	=> yz_options( 'yz_enable_wall_video' )
	);

	// Audio Data.
	$post_types[] = array(
		'id'	=> 'audio',
		'icon' 	=> 'fas fa-volume-up',
		'name'  => __( 'audio', 'youzer' ),
		'show'	=> yz_options( 'yz_enable_wall_audio' )
	);

	// Link Data.
	$post_types[] = array(
		'id'	=> 'link',
		'icon' 	=> 'fas fa-link',
		'name'  => __( 'link', 'youzer' ),
		'show'	=> yz_options( 'yz_enable_wall_link' )
	);

	// Filter
	$post_types = apply_filters( 'yz_wall_form_post_types_buttons', $post_types );

	// Remove Disabled Post Types.
	foreach ( $post_types as $key => $post_type ) {
		if ( 'off' == $post_type['show'] ) {
			unset( $post_types[ $key] );
		}
	}

	// Print Code.
	foreach ( $post_types as $post_type ) : ?>

		<div class="yz-wall-opts-item">
			<input type="radio" value="<?php echo $post_type['id']; ?>" name="post_type" id="yz-wall-add-<?php echo $post_type['id']; ?>" <?php if ( $checked ) echo 'checked'; ?>>
			<label class="yz-wall-add-<?php echo $post_type['id']; ?>" for="yz-wall-add-<?php echo $post_type['id']; ?>">
				<i class="<?php echo $post_type['icon']; ?>"></i><?php echo $post_type['name']; ?>
			</label>
		</div>

		<?php $checked = false; ?>
	
	<?php endforeach;

	// After Printing Buttons.
	do_action( 'yz_wall_form_post_types' );

	?>

	<?php if ( count( $post_types ) > 5 ) : ?>
		<div class="yz-wall-opts-item yz-wall-opts-show-all">
				<label class="yzw-form-show-all">
					<i class="fas fa-ellipsis-h"></i>
				</label>
		</div>
	<?php endif; ?>
	
	<?php
}


/**
 * Post an activity update.
 */
function yz_activity_post_update( $args = '' ) {

	$r = wp_parse_args( $args, array(
		'content'    => false,
		'type'    	 => 'activity_update',
		'user_id'    => bp_loggedin_user_id(),
		'error_type' => 'bool',
	) );

	if ( bp_is_user_inactive( $r['user_id'] ) ) {
		return false;
	}

	// Record this on the user's profile.
	$activity_content = $r['content'];
	$primary_link     = bp_core_get_userlink( $r['user_id'], false, true );

	/**
	 * Filters the new activity content for current activity item.
	 */
	$add_content = apply_filters( 'yz_activity_new_update_content', $activity_content );

	/**
	 * Filters the activity primary link for current activity item.
	 */
	$add_primary_link = apply_filters( 'yz_activity_new_update_primary_link', $primary_link );

	// Now write the values.
	$activity_id = bp_activity_add( array(
		'user_id'      => $r['user_id'],
		'content'      => $add_content,
		'primary_link' => $add_primary_link,
		'component'    => buddypress()->activity->id,
		'type'         => $r['type'],
		'error_type'   => $r['error_type']
	) );

	// Bail on failure.
	if ( false === $activity_id || is_wp_error( $activity_id ) ) {
		return $activity_id;
	}

	/**
	 * Filters the latest update content for the activity item.
	 */
	$activity_content = apply_filters( 'yz_activity_latest_update_content', $r['content'], $activity_content );

	// Add this update to the "latest update" usermeta so it can be fetched anywhere.
	bp_update_user_meta( bp_loggedin_user_id(), 'bp_latest_update', array(
		'id'      => $activity_id,
		'content' => $activity_content
	) );

	/**
	 * Fires at the end of an activity post update, before returning the updated activity item ID.
	 *
	 */
	do_action( 'yz_activity_posted_update', $r['content'], $r['user_id'], $activity_id );

	return $activity_id;
}