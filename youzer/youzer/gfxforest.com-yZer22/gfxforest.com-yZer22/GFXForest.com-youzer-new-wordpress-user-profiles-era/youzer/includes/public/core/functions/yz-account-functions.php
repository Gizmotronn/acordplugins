<?php

/**
 * # Save Settings.
 */

add_action( 'wp_ajax_youzer_profile_settings_save_data', 'yz_account_save_settings' );

function yz_account_save_settings() {
        
    // If its xprofile fields exit.
    if ( isset( $_POST['field_ids'] ) ) {
        return;
    }

    // if its not Profile Settings go out.
    if ( isset( $_POST['action'] ) && 'youzer_profile_settings_save_data' == $_POST['action'] ) {

    // Check Nonce Security
    check_admin_referer( 'yz_nonce_security', 'security' );

    // Before Save Settings Action.
    do_action( 'youzer_before_save_user_settings', $_POST );

    // Get Form Data
    $data = $_POST;

    unset( $data['security'], $data['action'] );
    
    $die = isset( $_POST['die'] ) ? true : false;

    // Delete Photo
    if ( isset( $data['delete_photo'] ) && ! empty( $data['delete_photo'] ) ) {
        $die = isset( $data['die_after_delete'] ) ? true : false;
        yz_account_delete_photo( $data['delete_photo'], $die );
    }

    // Call Update Profile Settings Function
    if ( isset( $data['youzer_options'] ) ) {
        yz_account_save_profile_settings( $data['youzer_options'] );
    }

    // Save Notification Settings
    if ( isset( $data['youzer_notifications'] ) ) {
        yz_account_save_notifications_settings( $data['youzer_notifications'] );
    }

    // Call Update User Password Function
    if ( isset( $data['youzer_options_pswd'] ) ) {

        // Get Data.
        $pswd_options     = $data['youzer_options_pswd'];
        $new_password     = esc_attr( $pswd_options['new_password'] );
        $confirm_password = esc_attr( $pswd_options['confirm_password'] );
        $current_password = esc_attr( $pswd_options['current_password'] );

        // Call Update User Password Function
        yz_account_save_user_password( $new_password, $confirm_password, $current_password );

    }

    // Save Skills
    if ( isset( $data['yz_data']['yz-skills-data'] ) ) {
        yz_account_save_items(
            array(
                'option_name' => 'youzer_skills',
                'max_items'   => 'yz_wg_max_skills',
                'items'       => isset( $data['youzer_skills'] ) ? $data['youzer_skills'] : null,
                'data_keys'   => array( 'title', 'barpercent' )
            )
        );
    }

    // Save Services.
    if ( isset( $data['yz_data']['yz-services-data'] ) ) {
        yz_account_save_items(
            array(
                'option_name' => 'youzer_services',
                'max_items'   => 'yz_wg_max_services',
                'items'       => isset( $data['youzer_services'] ) ? $data['youzer_services'] : null,
                'data_keys'   => array( 'title' )
            )
        );
    }

    // Save Portfolio
    if ( isset( $data['yz_data']['yz-portfolio-data'] ) ) {
        yz_account_save_items(
            array(
                'option_name' => 'youzer_portfolio',
                'items'       => isset( $data['youzer_portfolio'] ) ? $data['youzer_portfolio'] : null,
                'max_items'   => 'yz_wg_max_portfolio_items',
                'data_keys'   => array( 'original', 'thumbnail' )
            ),
            $die
        );
    }

    // Save SlideShow
    if ( isset( $data['yz_data']['yz-slideshow-data'] ) ) {
        yz_account_save_items(
            array(
                'option_name' => 'youzer_slideshow',
                'items'       => isset( $data['youzer_slideshow'] ) ? $data['youzer_slideshow'] : null,
                'max_items'   => 'yz_wg_max_slideshow_items',
                'data_keys'   => array( 'original', 'thumbnail' )
            ),
            $die
        );
    }

    // After Save Settings Action.
    do_action( 'youzer_after_save_user_settings', $data );


    if ( ! $die ) {
        // Redirect.
        yz_account_redirect( 'success', __( 'Changes saved.', 'youzer' ) );
    }
    
    }

}

// Save Settings
add_action( 'init', 'yz_account_save_settings' );

/**
 * #  Save Profile Settings.
 */
function yz_account_save_profile_settings( $profile_options ) {

    if ( empty( $profile_options ) ) {
        return false;
    }

    $user_id = bp_displayed_user_id();

    // Remove Tags.
    if ( isset( $profile_options['wg_project_title'] ) ) {
        
        // Get Tags Fields.
        $tags_fields = array( 'wg_project_tags', 'wg_project_categories' );

        foreach ( $tags_fields as $tag_id ) {
            if ( ! isset( $profile_options[ $tag_id ] ) ) {
                delete_user_meta( $user_id, $tag_id ); 
            }
        }
        
    }

    foreach ( $profile_options as $option => $value ) {

        if ( ! is_array( $value ) ) {
            $the_value = stripslashes( $value );
        } else {
            $the_value = $value;
        }

        if ( isset( $option ) ) {

            // Check For Empty 
            if ( is_array( $the_value ) && isset( $the_value['original'] ) && empty( $the_value['original'] ) ) {
                $the_value = null;
            }

            if ( 'wg_flickr_account_id' == $option ) {

                // Delete Flickr ID.
                if ( empty( $the_value ) ) {
                    $update_options = delete_user_meta( $user_id, 'wg_flickr_account_id' );
                } else {
                    // Check Flickr ID format
                    if ( false === strpos( $the_value, '@N' ) ) {
                        yz_account_redirect( 'error', __( 'Flickr ID Format is not valid', 'youzer' ) );
                    } else {
                        // Update Flickr
                        $update_options = update_user_meta( $user_id, $option, $the_value );
                    }   
                }

                if ( $update_options ) {
                    do_action( 'yz_after_saving_account_options', $user_id, $option, $the_value );
                }

            } else {
                // Update Options
                $update_options = update_user_meta( $user_id, $option, $the_value );
                if ( $update_options ) {
                    do_action( 'yz_after_saving_account_options', $user_id, $option, $the_value );
                }
            }

        } else {
            delete_user_meta( $user_id, $option );
        }

    }

}

/**
 * #  Save Password.
 */
function yz_account_save_user_password( $new_password, $confirm_password, $current_password ) {

    // Errors Messages
    $errors = array(
        'pswd-wrong'    => __( 'Current password is wrong !', 'youzer' ),
        'empty-fields'  => __( 'All the fields are required !', 'youzer' ),
        'pswd-lenght'   => __( 'Password length must be greater than 5 !', 'youzer' ),
        'pswd-notmatch' => __( "Password confirmation doesn't match Password !", 'youzer' ),
    );

    if ( empty( $new_password ) || empty( $confirm_password ) || empty( $current_password ) ) {
        yz_account_redirect( 'error', $errors['empty-fields'] );
    }

    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;

    if ( $user_id && wp_check_password( $current_password, $current_user->user_pass , $user_id ) ) {

        // if password < 5 send error message.
        if ( 5 > strlen( $new_password ) ) {
            yz_account_redirect( 'error', $errors['pswd-lenght'] );
        }

        // if password not equal confimation password send error message .
        if ( $new_password != $confirm_password ) {
            yz_account_redirect( 'error', $errors['pswd-notmatch'] );
        }

        // Get Current User Profile ID.
        $displayed_user_id = bp_displayed_user_id();
        
        // if password updated refresh page -> logout .
        wp_set_password( $new_password, $displayed_user_id );

        // Redirect.
        bp_core_redirect( yz_get_login_page_url() );


    } else {
        yz_account_redirect( 'error', $errors['pswd-wrong'] );
    }

}

/**
 * #  Save Options.
 */
function yz_account_save_items( $args, $die = null ) {

    // Get User ID
    $user_id = bp_displayed_user_id();

    // Get items Data.
    $items = ! empty( $args['items'] ) ? $args['items'] : null;

    if ( empty( $items ) ) {
        $update_option = delete_user_meta( $user_id, $args['option_name'] );
    } else {        

        // Get Maximum Number OF Allowed Items
        $max_items = yz_options( $args['max_items'] );

        // Re-order & Remove Empty Items
        $items = yz_account_filter_items( $items, $args['data_keys'] );

        // Save Options
        if ( count( $items ) <= $max_items ) {
            $update_option = update_user_meta( $user_id, $args['option_name'], $items );
        }
    }

    if ( $update_option ) {
        // Hook
        do_action( 'yz_account_save_widget_item', $user_id, $args['option_name'], $items );
        // Redirect.
        if ( ! $die ) {
            yz_account_redirect( 'success', __( 'Changes saved.', 'youzer' ) );
        }
    }

}

/**
 * #  Save Notifications Settings.
 */
function yz_account_save_notifications_settings( $notifications ) {

    // Init New Array();
    $bp_notification = array();

    // Change 'On' To 'Yes'. 
    foreach ( $notifications as $key => $value ) {

        // Get Notification Key
        $notification_key = str_replace( 'yz_', '', $key );

        // Get Notification Value.
        $bp_notification[ $notification_key ] = ( 'on' == $value ) ? 'yes': 'no'; 

    }

    // Update Buddypress Notification Settings.
    bp_settings_update_notification_settings( bp_displayed_user_id(), (array) $bp_notification );

    // Save Youzer Options
    yz_account_save_profile_settings( $notifications );

}

/**
 * #  Re-order & Remove Empty Items.
 */
function yz_account_filter_items( $items, $keys ) {
    
    // Re-Order Items
    $items = array_combine( range( 1, count( $items ) ), array_values( $items ) );
    
    // Remove Empty items
    foreach ( $items as $item_key => $item ) {
        foreach ( $keys as $key ) {
            if ( empty( $item[ $key ] ) ) {
                unset( $items[ $item_key ] );
            }
        }
    }
    
    return $items;
}

/**
 * #  Delete Photo.
 */
function yz_account_delete_photo( $photo, $die = false ) {

    // Before Delete Photo Action.
    do_action( 'yz_account_before_delete_photo' );

    // Get Photo Directory Path.
    $upload_dir = wp_upload_dir();
    // Get Photo Path.
    $photo_path = $upload_dir['basedir'] . '/youzer/' . wp_basename( $photo );
    // Delete Photo.
    if ( yz_is_image_exists( $photo ) ) {
        unlink( $photo_path );
    }

    do_action( 'yz_account_after_delete_photo' );
    
    // Return.
    if ( $die ) {
        die();
    }
}

/**
 * Redirect User.
 */
function yz_account_redirect( $action, $msg, $redirect_to = null ) {

    // Get Reidrect page.
    $redirect_to = ! empty( $redirect_to ) ? $redirect_to : yz_get_current_page_url();

    // Add Message.
    bp_core_add_message( $msg, $action );

    // Redirect User.
    bp_core_redirect( $redirect_to );

}

/**
 * Setup Widget Settings Pages.
 */
function yz_add_widgets_settings_subnav_tabs() {

    if ( ! bp_is_active( 'settings' ) || ! bp_core_can_edit_settings() ) {
        return false;
    } 

    if ( ! bp_is_current_component( 'widgets-settings' ) ) {
        return false;
    }
    
    global $Youzer, $bp;

    // Profile Widgets Settings.
    bp_core_new_nav_item(
        array( 
            'position' => 60,
            'slug' => 'widgets-settings', 
            'parent_slug' => $bp->profile->slug,
            'show_for_displayed_user' => bp_core_can_edit_settings(),
            'default_subnav_slug' => 'widgets-settings',
            'name' => __( 'Widgets Settings', 'youzer' ), 
            'screen_function' => 'yz_profile_widgets_settings_tab_screen', 
            'parent_url' => bp_loggedin_user_domain() . '/widgets-settings/'
        )
    );


    // Get Widget Settings.
    $widgets_pages = $Youzer->widgets->get_settings_widgets();

    // Add Widgets Pages The Settings Page List.
    foreach ( $widgets_pages as $page ) {

        bp_core_new_subnav_item( array(
                'slug' => $page['widget_name'],
                'name' => $page['widget_title'],
                'parent_slug' => 'widgets-settings',
                'parent_url' => yz_get_widgets_settings_url(),
                'screen_function' => 'yz_get_profile_settings_page',
            )
        );
    }
}

add_action( 'bp_actions', 'yz_add_widgets_settings_subnav_tabs', 101 );

/**
 * Setup New Profile Settings Pages.
 */
function yz_add_profile_settings_subnav_tabs() {

    if ( ! bp_core_can_edit_settings() || ! bp_is_user_profile() ) {
        return false;
    }

    global $Youzer;

    // Get User Settings.
    $user_pages = $Youzer->account->profile_settings_pages();

    foreach ( $user_pages as $slug => $page ) {

        bp_core_new_subnav_item( array(
                'slug' => $slug,
                'name' => $page['name'],
                'position' => $page['order'],
                'parent_slug' => bp_get_profile_slug(),
                'parent_url' => yz_get_profile_settings_url(),
                'screen_function' => 'yz_get_profile_settings_page',
            )
        );
    }
}

add_action( 'bp_actions', 'yz_add_profile_settings_subnav_tabs', 101 );

/**
 * Setup New Account Settings Pages.
 */
function yz_add_account_settings_subnav_tabs() {

    if ( ! bp_is_active( 'settings' ) || ! bp_core_can_edit_settings() || ! bp_is_settings_component() ) {
        return false;
    }
    
    global $Youzer;

    // Get User Settings.
    $account_pages = $Youzer->account->account_settings_pages();

    foreach ( $account_pages as $slug => $page ) {

        // Get Navbar Args
        $nav_args = array(
            'slug' => $slug,
            'name' => $page['name'],
            'parent_url' => yz_get_settings_url(),
            'parent_slug' => bp_get_settings_slug(),
            'screen_function' => 'yz_get_profile_settings_page',
        );

        if ( 'delete-account' == $slug ) {
            $nav_args['user_has_access'] = ! is_super_admin( bp_displayed_user_id() );
        }

        bp_core_new_subnav_item( $nav_args );
    }
}

add_action( 'bp_actions', 'yz_add_account_settings_subnav_tabs', 101 );


/**
 * Get Profile Settings Page Content.
 */
function yz_get_profile_settings_page() {
    bp_core_load_template( 'buddypress/members/single/plugins' );
}

/**
 * Get Change Avatar Template
 */
function yz_filter_change_avatar_template( $template ) {
    return 'members/single/plugins';
}

/**
 * Activate Avatar Upload On Front Page.
 */
function yz_avatar_is_front_edit(){
         
    // Get Current Sub Page.
    if ( 'profile-picture' == bp_current_action() ) {
        add_filter( 'bp_avatar_is_front_edit', 'yz_filter_change_avatar_template' );
    }

}

add_action( 'bp_init', 'yz_avatar_is_front_edit' );

/**
 * Handles the deleting of a user.
 */
function yz_settings_action_delete_account() {

    // Bail if not a POST action.
    if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ) )
        return;

    // Bail if no submit action.
    if ( ! isset( $_POST['yz-delete-account-understand'] ) )
        return;

    // // Bail if not in settings.
    if ( ! bp_is_settings_component() || 'delete-account' != bp_current_action() )
        return false;

    // 404 if there are any additional action variables attached
    if ( bp_action_variables() ) {
        bp_do_404();
        return;
    }

    // Bail if account deletion is disabled.
    if ( bp_disable_account_deletion() && ! bp_current_user_can( 'delete_users' ) ) {
        return false;
    }

    // Nonce check.
    check_admin_referer( 'delete-account' );

    // Get username now because it might be gone soon!
    $username = bp_get_displayed_user_fullname();

    // Delete the users account.
    if ( bp_core_delete_account( bp_displayed_user_id() ) ) {

        // Add feedback after deleting a user.
        bp_core_add_message( sprintf( __( '%s was successfully deleted.', 'youzer' ), $username ), 'success' );

        // Redirect to the root domain.
        bp_core_redirect(  bp_get_root_domain() );
    }
}

add_action( 'bp_actions', 'yz_settings_action_delete_account' );

/**
 * Redirect User From Settings Pages
 */
function yz_redirect_user_from_settings_pages() {

    // Get Current Page Url.
    $current_page = yz_get_current_page_url();

    if ( ! is_user_logged_in() ) {

        // Get Login Page Url
        $login_url = yz_get_login_page_url();

        // Get Redirect Url.
        $redirect_url = add_query_arg( 'redirect_to', $_REQUEST['redirect_to'], $login_url );

    } else {

        // Get Displayed User ID.
        $user_id = bp_displayed_user_id();

        // Get Current User Domain
        $user_profile = bp_core_get_user_domain( $user_id );

        // Set User Profile as Redirect Page Url.
        $redirect_url = $user_profile;

    }

    // Redirect User.
    wp_redirect( $redirect_url );
    exit;
}

/**
 * Get Account Navbar.
 */
function yz_get_account_page_menu() {

    // Get Buddypress Variables.
    $bp = buddypress();

    // Get Tab Navigation  Menu
    $account_nav = $bp->members->nav->get_secondary( array( 'parent_slug' => 'settings' ) );

    foreach ( $account_nav as $menu_data ) :

        $icon = apply_filters( 'yz_account_seetings_menu_icon', 'gears', $menu['name'] );

    ?>

    <li class="<?php echo $menu_data['class']; ?>">
        <a href="<?php echo yz_get_settings_url( $menu_data['slug'] ); ?>">
            <i class="<?php echo $icon; ?>"></i><?php echo $menu_data['name']; ?></a>
    </li>

    <?php

    endforeach;
}