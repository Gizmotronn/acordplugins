<?php

/**
 * Get Available Social Providers.
 */
function logy_get_social_login_box( $attrs = null ) {

	// Check if social login is enabled and there's at least one network available.
	if ( ! logy_is_social_login_enabled() ) {
		return false;
	}

    // Get Providers.
    $providers = apply_filters( 'yz_forms_social_login_providers', logy_get_providers() );

    // Get Buttons Type
    $btns_type = isset( $attrs['social_button_type'] ) ? $attrs['social_button_type'] : logy_options( 'logy_social_btns_type' );

    // Action
	do_action( 'logy_social_box_style' );

	?>
	

	<div class="<?php echo logy_get_social_box_class( $attrs ); ?>">
		<ul>
			<?php foreach( $providers as $provider ) : ?>
				
				<?php 
					// Hide Not Available Networks.
					if ( ! logy_is_provider_available( $provider ) ) {
						continue;
					}
				?>

				<?php $provider_url = home_url( '/?action=logy&provider=' . $provider ); ?>
				<?php $provider_data = logy_get_provider_data( $provider ); ?>
				<?php $provider_name = strtolower( $provider ); ?>
				
				<li class="logy-<?php echo $provider_name; ?>-btn">
					<a href="<?php echo $provider_url; ?>">
						<div class="logy-button-icon">
							<i class="<?php echo $provider_data['icon']; ?>"></i>
						</div>
						<?php if ( 'logy-only-icons' != $btns_type ) : ?>
							<span class="logy-button-title">
							<?php echo sprintf( __( 'connect with %s', 'youzer' ), $provider );?>
							</span>
						<?php endif; ?>
					</a>
				</li>

			<?php endforeach; ?>
			<?php do_action( 'yz_after_login_social_icons' ); ?>
		</ul>
		<div class="logy-social-title">
			<span><?php _e( 'or', 'youzer' ); ?></span>
		</div>
	</div>

	<?php
}

add_action( 'logy_before_login_fields', 'logy_get_social_login_box' );
add_action( 'bp_before_account_details_fields', 'logy_get_social_login_box' );

/**
 * Get Available Social Networks.
 */
function logy_get_providers() {
	// Get Providers
	$providers = logy_options( 'logy_social_providers' );
	// Filter Providers
	$providers = apply_filters( 'logy_providers_list', $providers );
	// Return Providers.
	return $providers;
}

/**
 * Get Providers Data.
 */
function logy_get_provider_data( $provider ) {

	$data = array(
		'Facebook' => array(
			'app'	   => 'id',
			'icon' 	   => 'fab fa-facebook-f'
		),
		'Twitter' => array(
			'app'	   => 'key',
			'icon' 	   => 'fab fa-twitter'
		),
		'Google' => array(
			'app'	   => 'id',
			'icon' 	   => 'fab fa-google'
		),
		'LinkedIn' => array(
			'app'	   => 'id',
			'icon' 	   => 'fab fa-linkedin-in'
		),
		'Instagram' => array(
			'app'	   => 'id',
			'icon' 	   => 'fab fa-instagram'
		)
	);

	$data = apply_filters( 'logy_providers_data', $data );

	return $data[ $provider ];
}

/**
 * Get Social Buttons Class
 */
function logy_get_social_box_class( $attrs = null ) {

	// Init Array();
	$class = array();

	// Get Main Class.
	$class[] = 'logy-social-buttons';

	// Get Button Type
	$class[] = isset( $attrs['social_button_type'] ) ? $attrs['social_button_type'] : logy_options( 'logy_social_btns_type' );

	// Get Button Border Type
	$class[] = logy_options( 'logy_social_btns_format' );

	// Get Button Icons Position.
	$class[] = logy_options( 'logy_social_btns_icons_position' );

	// Filter Class
	$class = apply_filters( 'logy_social_box_class', $class );

	return implode( ' ', $class );
}

/**
 * Check if Social login is enabled.
 */
function logy_is_social_login_enabled() {

	// init Vars.
	$available_network = false;
	$is_social_login_enabled = logy_options( 'logy_enable_social_login' );

	if ( 'off' == $is_social_login_enabled ) {
		return false;
	}

	// Get Providers
	$providers = logy_get_providers();

	if ( empty( $providers ) ) {
		return false;
	}
	
	foreach( $providers as $provider ) {
		if ( logy_is_provider_available( $provider ) ) {
			$available_network = true;
			break;
		}
	}
	
	// Check if there's at least one available network. 
	if ( ! $available_network ) {
		return false;
	}


	return true;
}

/**
 * Check if Provider is available
 */
function logy_is_provider_available( $provider ) {

	$network = strtolower( $provider );

	$is_enabled = logy_options( 'logy_' . $network . '_app_status' );

	if ( 'off' == $is_enabled ) {
		return false;
	}

	$app_key = logy_options( 'logy_' . $network . '_app_key' );
	$app_secret = logy_options( 'logy_' . $network . '_app_secret' );

	if ( empty( $app_key ) || empty( $app_secret ) ) {
		return false;
	}

	return true;
}

/**
 * Change Avatar With User Provider Image
 */
add_filter( 'get_avatar' , 'logy_get_custom_avatar' , 1 , 5 );

function logy_get_custom_avatar( $avatar, $id_or_email, $size, $default, $alt ) {

    $user = false;

    if ( is_numeric( $id_or_email ) ) {

        $id = (int) $id_or_email;
        $user = get_user_by( 'id' , $id );

    } elseif ( is_object( $id_or_email ) ) {

        if ( ! empty( $id_or_email->user_id ) ) {
            $id = (int) $id_or_email->user_id;
            $user = get_user_by( 'id' , $id );
        }

    } else {
        $user = get_user_by( 'email', $id_or_email );	
    }

    if ( $user && is_object( $user ) ) {

    	// Get User Custom Avatar.
    	$user_custom_avatar = yz_get_user_social_avatar( $user->data->ID );

    	//
    	// If user has avatar or have no network image return default avatar.
    	if ( logy_has_gravatar( $user->data->user_email ) || ! $user_custom_avatar ) {
    		return $avatar;
    	}

    	// Get Avatar Img.
        $avatar = "<img alt='{$alt}' src='{$user_custom_avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";

    }

    return $avatar;
}

function yz_set_social_media_avatar_url( $avatar_url = null , $params = null ) {

	// Get User Custom Avatar.
	$user_custom_avatar = yz_get_user_social_avatar( $params['item_id'] );

	// If user has avatar or have no network image return default avatar.
	if ( logy_has_gravatar( $params['email'] ) || ! $user_custom_avatar ) {
		return $avatar_url;
	}

    // Return Old File Path
    return $user_custom_avatar;
}

add_filter( 'bp_core_fetch_avatar_url', 'yz_set_social_media_avatar_url', 999, 2 );

/**
 * Edit User Activity Default Avatar.
 */
function yz_set_social_media_default_avatar_url( $avatar_url = null, $params = null ) {
	if ( ! isset( $params['item_id'] ) ) {
		return $avatar_url;
	}
	// Get User Custom Avatar.
	$user_custom_avatar = yz_get_user_social_avatar( $params['item_id'] );

	if ( $user_custom_avatar ) {
	    return esc_url( $user_custom_avatar );
	}

    return $avatar_url;
}

add_filter( 'bp_core_avatar_default', 'yz_set_social_media_default_avatar_url', 10, 2 );

/**
 * Disable Gravatars
 */
function yz_disable_gravatars( $no_grav = null ) {

	return true;
    
    // Get Default Avatar.
    // $default_avatar = yz_options( 'yz_default_profiles_avatar' );

    // if ( ! empty( $default_avatar ) ) {
		// return true;
	// }

	// return $no_grav;

}

add_filter( 'bp_core_fetch_avatar_no_grav', 'yz_disable_gravatars' );

/**
 * Check if User Has Gravatar
 */
function logy_has_gravatar( $email_address ) {

	// Get User Hash
	$hash = md5( strtolower( trim ( $email_address ) ) );

	// Build the Gravatar URL by hasing the email address
	$url = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';

	// Now check the headers...
	$headers = @get_headers( $url );

	// If 200 is found, the user has a Gravatar; otherwise, they don't.
	return preg_match( '|200|', $headers[0] ) ? true : false;

}

/**
 * Get/Set User Session Data
 */
function logy_user_session_data( $operation, $data = null ) {

	// Get User IP
	$user_ip = isset( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_ADDR']: false;

	// Get Option Name.
	$transient_name = 'logy_user_data_' . $user_ip;

	if ( 'get' == $operation ) {
		return get_transient( $transient_name );
	} elseif ( 'set' == $operation ) {
		set_transient( $transient_name, json_encode( $data ), HOUR_IN_SECONDS );
	} elseif ( 'delete' == $operation ) {
		return delete_transient( $transient_name );
	}

	return false;
}

/**
 * Get/Set User Profile Data Temporarily
 */
function logy_user_profile_data( $operation, $data = null ) {

	// Get User IP
	$user_ip = isset( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_ADDR']: false;

	// Get Option Name.
	$transient_name = 'logy_user_profile_' . $user_ip;

	if ( 'get' == $operation ) {
		return get_transient( $transient_name );
	} elseif ( 'set' == $operation ) {
		set_transient( $transient_name, json_encode( $data ), HOUR_IN_SECONDS );
	} elseif ( 'delete' == $operation ) {
		return delete_transient( $transient_name );
	}

	return false;
}

/**
 * Update User Social Profile Data
 */
function yz_update_user_profile_meta( $user_id, $profile = null ) {

	global $Logy;

	if ( empty( $profile ) ) {
		return false;
	}

 	// User Meta
 	$user_meta = array(
 		'first_name' 	=> $profile->firstName,
 		'last_name' 	=> $profile->lastName,
 		'description' 	=> $profile->description,
	 	'user_url' 		=> esc_url( $profile->webSiteURL )
 	);

 	// Update User Meta.
 	foreach ( $user_meta as $key => $value ) {

 		if ( empty( $value ) ) {
 			continue;
 		}

	 	// Update User Url.
	 	wp_update_user(
	 		array(
	 			'ID' => $user_id,
	 			$key => $value
	 		)
	 	);

 	}

}

/**
 * Update User Social Profile Data.
 */
function yz_update_user_profile_meta_after_confirmation( $user_id ) {

	global $Logy;

	// Update WPMU Social Data User ID
	if ( is_multisite() ) {
		$activated_user_id = get_userdata( $user_id );
		$a_user_email = $activated_user_id->user_email;
		$a_social_data = $Logy->query->wpmu_update_user_social_data( $a_user_email, $user_id );		
	}
	

	$profile = $Logy->query->get_user_stored_social_data( $user_id );

	if ( empty( $profile ) ) {
		return false;
	}

 	// User Meta
 	$user_meta = array(
 		'first_name' 	=> $profile->firstname,
 		'last_name' 	=> $profile->lastname,
 		'description' 	=> $profile->description,
 		'logy_avatar' 	=> $profile->photourl,
	 	'user_url' 		=> esc_url( $profile->websiteurl )
 	);

	$display_name = $Logy->social->get_display_name( null, $profile->firstname, $profile->lastname );

 	if ( ! empty( $display_name ) ) {
 		xprofile_set_field_data( 1, $user_id, $display_name );
 	}

 	// Update User Meta.
 	foreach ( $user_meta as $key => $value ) {

 		if ( empty( $value ) ) {
 			continue;
 		}

	 	// Update User Url.
	 	if( is_multisite() ) {
	 		update_user_option( $user_id, $key, $value );
	 	} else {

		 	wp_update_user(
		 		array(
		 			'ID' => $user_id,
		 			$key => $value
		 		)
		 	);

	 	}
 	}

}

add_action( 'bp_core_activated_user', 'yz_update_user_profile_meta_after_confirmation' );


/**
 * Get User Social Login Avatar
 */
function yz_get_user_social_avatar( $user_id = null ) {

	$user_id = ! empty( $user_id ) ? $user_id : bp_loggedin_user_id();

	if ( is_multisite() ) {
		return get_user_option( 'logy_avatar', $user_id );
	}

	return get_user_meta( $user_id, 'logy_avatar', true );

}

/**
 * Multi Site Social Login
 */
function yz_mu_store_social_login_data( $user_id = null ) {

	global $Logy;
	
	// Get Provider.
	$provider = $Logy->social->get_provider();

	if ( empty( $provider ) ) {
		return;
	}

	// // Get User Data.
	$user_data = $Logy->social->get_user_data( $provider );

	global $Logy;

	if ( isset( $user_data['user_profile'] ) && ! empty( $user_data['user_profile'] ) ) {
		// Store Data.
		$Logy->query->wpmu_store_user_data( $provider, $user_data['user_profile'] );
	}

}

add_action( 'after_signup_user', 'yz_mu_store_social_login_data' );
