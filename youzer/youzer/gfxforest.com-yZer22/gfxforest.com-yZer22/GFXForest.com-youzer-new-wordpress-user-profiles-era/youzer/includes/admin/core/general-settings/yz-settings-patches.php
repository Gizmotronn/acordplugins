<?php

/**
 * # Add Patches Settings Tab
 */
function yz_patches_settings_menu( $tabs ) {

	$tabs['patches'] = array(
   	    'id'    => 'patches',
   	    'hide_menu' => true,
   	    'icon'  => 'fas fa-magic',
   	    'function' => 'yz_patches_settings',
   	    'title' => __( 'Patches settings', 'youzer' ),
    );
    
    return $tabs;

}

add_filter( 'yz_panel_general_settings_menus', 'yz_patches_settings_menu', 9999 );

/**
 * # Add Patches Settings Tab
 */
function yz_patches_settings() {
	do_action( 'yz_patches_settings' );
}

/**
 * Move WP Fields To Buddypress Xprofile Fields
 */
function yz_patche_move_wp_fields_to_bp_settings() {

    if ( ! get_option( 'install_youzer_2.1.5_options' ) ) {
        return false;
    }

    global $Yz_Settings;
	
	$already_installed = is_multisite() ? get_blog_option( BP_ROOT_BLOG, 'yz_patch_move_wptobp' ) : get_option( 'yz_patch_move_wptobp' );
	
	$patche_status = $already_installed ? '<span class="yz-title-status">' . __( 'Installed', 'youzer' ) . '</span>' : '';

    $Yz_Settings->get_field(
        array(
            'title' => sprintf( __( 'Move WP Fields To Buddypress Xprofile Fields. %s', 'youzer' ), $patche_status ),
            'type'  => 'openBox'
        )
    );
    
    // Get User Total Count.
	$user_count_query = count_users();
	$button_args = array(
    	'class' => 'yz-wild-field',
        'desc'  => __( 'This is a required step to move all the previous profile & contact fields values to the new generated xprofile fields. please note that this operation might take a long time to finish because it will go through all the users in database one by one and update their fields.', 'youzer' ),
        'button_title' => __( 'Update Fields', 'youzer' ),
        'button_data' => array(
        	'step' => 1,
        	'total' => $user_count_query['total_users'],
        	'perstep' => apply_filters( 'yz_patch_move_wptobp_per_step', 5 ),
        ),
        'id'    => 'yz-run-wptobp-patch',
        'type'  => 'button'
    );
	
	if ( $already_installed ) {
		unset( $button_args['button_title'] );
	}

    $Yz_Settings->get_field( $button_args );

	// Check is Profile Fields Are Installed.
    $xprofile_fields_installed = is_multisite() ? get_blog_option( BP_ROOT_BLOG, 'yz_install_xprofile_groups' ) : get_option( 'yz_install_xprofile_groups' );

    if ( ! $xprofile_fields_installed ) {

	    // Include Setup File.    
	    require_once dirname( YOUZER_FILE ) .  '/includes/public/core/class-yz-setup.php';
	    
	    // Init Setup Class.
	    $Youzer_Setup = new Youzer_Setup();

	    // Install Xprofile Fields.
	    $Youzer_Setup->create_xprofile_groups();

    }
    
    $Yz_Settings->get_field( array( 'type' => 'closeBox' ) );

	?>

	<script type="text/javascript">

		/**
		 * Process Updating Fields.
		 */
		$.process_step  = function( step, perstep, total, self ) {

			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
					action: 'yz_patche_move_wp_fields_to_bp',
					step: step,
					total: total,
					perstep: perstep,
				},
				dataType: "json",
				success: function( response ) {

					var export_form = $( '#yz-run-wptobp-patch' );

					if ( 'done' == response.step ) {

						export_form.addClass( 'yz-is-updated' );

						// window.location = response.url;
						export_form.html( '<i class="fas fa-check"></i>Done !' );

					} else {

						$('.yz-button-progress').animate({
							width: response.percentage + '%',
						}, 50, function() {
							// Animation complete.
						});

						var total_users = ( response.step * response.perstep ) - response.perstep,
							users = total_users < response.total ? total_users : response.total;

						export_form.find( '.yz-items-count' ).html(users);

						$.process_step( parseInt( response.step ), parseInt( response.perstep ), parseInt( response.total ), self );

					}

				}
			}).fail(function (response) {
				if ( window.console && window.console.log ) {
					console.log( response );
				}
			});

		}

		$( 'body' ).on( 'click', '#yz-run-wptobp-patch', function(e) {

			if ( $( this ).hasClass( 'yz-is-updated' ) ) {
				return;
			}

			e.preventDefault();

			var per_step = $( this ).data( 'perstep' );
			var total = $( this ).data( 'total' );

			$( this ).html( '<i class="fas fa-spinner fa-spin"></i>Updating <div class="yz-button-progress"></div><span class="yz-items-count">' + 1 + '</span>' + ' / ' + total + ' Users' );

			// Start The process.
			$.process_step( 1, per_step, total, self );

		});

	</script>

	<?php
}

add_action( 'yz_patches_settings', 'yz_patche_move_wp_fields_to_bp_settings' );


/**
 * Process batch exports via ajax
 *
 * @since 2.4
 * @return void
 */
function yz_patche_move_wp_fields_to_bp() {
	
	// Init Vars.	
	$total = isset( $_POST['total'] ) ? absint( $_POST['total'] ): null;
	$step = isset( $_POST['step'] ) ? absint( $_POST['step'] ) : null;
	$perstep = isset( $_POST['perstep'] ) ? absint( $_POST['perstep'] ) : null;

	// $ret = $export->process_step( $step );
	$ret = yz_patch_move_wptobp_process_step( $step, $perstep, $total );

	// Get Percentage.
	$percentage = ( $step * $perstep / $total ) * 100;

	if ( $ret ) {
		$step += 1;
		echo json_encode( array( 'users' => $ret, 'step' => $step, 'total'=> $total, 'perstep' => $perstep, 'percentage' => $percentage ) ); exit;

	} else {

		echo json_encode( array( 'step' => 'done' ) ); exit;

	}
}
add_action( 'wp_ajax_yz_patche_move_wp_fields_to_bp', 'yz_patche_move_wp_fields_to_bp' );


function yz_patch_move_wptobp_process_step( $step, $per_step, $total  ) {
	
	// Init Vars
	$more = false;
	// $done = false;
	$i      = 1;
	$offset = $step > 1 ? ( $per_step * ( $step - 1 ) ) : 0;

	$done = $offset > $total ? true :  false;
	
	if ( ! $done ) {

		$more = true;

		// main user query
		$args  = array(
		    'fields'    => 'id',
		    'number'    => $per_step,
		    'offset'    => $offset // skip the number of users that we have per page  
		);

		// Get the results
		$authors = get_users( $args );		

	    // Get Profile Fields.
		$profile_fields = is_multisite() ? get_blog_option( BP_ROOT_BLOG, 'yz_xprofile_contact_info_group_ids' ) : get_option( 'yz_xprofile_contact_info_group_ids' );
		$contact_fields = is_multisite() ? get_blog_option( BP_ROOT_BLOG, 'yz_xprofile_profile_info_group_ids' ) : get_option( 'yz_xprofile_profile_info_group_ids' );

		$all_fields = (array) $contact_fields + (array) $profile_fields;
			
		// Remove Group ID Field.
		unset( $all_fields['group_id'] );

		// Update Fields.
		foreach ( $authors as $user_id ) {
				
			foreach ( $all_fields as $user_meta => $field_id ) {
				
				// Get Old Value.
				$old_value = get_the_author_meta( $user_meta, $user_id );
				
				if ( empty( $old_value ) ) {
					continue;
				}

				// Set New Value.
		        xprofile_set_field_data( $field_id, $user_id, $old_value );

		        // Delete Old Value.
				// delete_user_meta( $user_id, $user_meta );
			
			}

		}

	} else {

	    if ( is_multisite() ) {
	        update_blog_option( BP_ROOT_BLOG, 'yz_patch_move_wptobp', true );
	    } else {
	        update_option( 'yz_patch_move_wptobp', true );
	    }

	}

	return $more;
}