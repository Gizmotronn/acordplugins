<?php

/**
 * Check if youzer is active.
 */
function youzer_is_active() {
    return true;
}

/**
 * # Is Youzer Membership system is active.
 */
function yz_is_membership_system_active() {

    if ( 'off' != get_option( 'yz_activate_membership_system' ) ) {
        return true;
    }

    return false;

}

/**
 * Is Activity Component
 */
function yz_is_activity_component() {
    
    // Init Var.
    $active = false;

    if ( bp_is_current_component( 'activity' ) || bp_is_single_activity() || bp_is_group_activity() ) {
        $active = true;
    }

    return apply_filters( 'yz_is_activity_component', $active );

}

/**
 * # Get Youzer Page Template.
 */
function yz_youzer_template( $page_template ) {

    // Check if its youzer plugin page
    if ( bp_current_component() && ! is_404() ) {
        return YZ_TEMPLATE . 'youzer-template.php';
    }
    return $page_template;
}

add_filter( 'template_include', 'yz_youzer_template', 99999 );

/**
 * Youzer Options
 */
function yz_options( $option_id ) {

    // Get Option Value.
    $option_value = get_option( $option_id );

    // Filter Option Value.
    $option_value = apply_filters( 'youzer_edit_options', $option_value, $option_id );

    if ( ! isset( $option_value ) || empty( $option_value ) ) {
        global $Yz_default_options;
        if ( isset( $Yz_default_options[ $option_id ] ) ) {
            $option_value = $Yz_default_options[ $option_id ];
        }
    }

    return $option_value;
}

/**
 * # Get Youzer Plugin Pages
 */
function youzer_pages( $request_type = null, $id = null ) {

    // Get youzer pages.
    $youzer_pages = yz_options( 'youzer_pages' );

    // Switch Key <=> Values
    if ( 'ids' == $request_type ) {
        $yz_pages_ids = array_flip( $youzer_pages );
        return $yz_pages_ids;
    }

    return $youzer_pages;
}

/**
 * # Get Current Profile User id.
 */
function yz_profileUserID() {
    return bp_displayed_user_id();
}

/**
 * # Get Page URL.
 */
function yz_page_url( $page_name, $user_id = null ) {

	// Get Page Data
    $page_id  = yz_page_id( $page_name );
    $page_url = yz_fix_path( get_permalink( $page_id ) );

    // Get Username
    if ( ! empty( $user_id ) ) {
        $username = get_the_author_meta( 'user_login', $user_id );
    }

	// Get Page with Current User if page = profile or account .
	if ( 'profile' == $page_name && ! empty( $user_id ) ) {
        $page_url = $page_url . $username;
    } elseif ( 'profile' == $page_name && empty( $user_id ) ) {
        $page_url = $page_url . esc_html(  yz_data( 'user_login' ) );
    }

	// Return Page Url.
    return $page_url;

}

/**
 * # Get Page ID.
 */
function yz_page_id( $page ) {
    $youzer_pages = yz_options( 'youzer_pages' );
    return $youzer_pages[ $page ];
}

/**
 * Get Wordpress Pages
 */
function yz_get_pages() {

    // Set Up Variables
    $pages    = array();
    $wp_pages = get_pages();

    // Add Default Page.
    $pages[] = __( '-- Select --', 'youzer' );

    // Add Wordpress Pages
    foreach ( $wp_pages as $page ) {
        $pages[ $page->ID ] = sprintf( __( '%1s ( ID : %2d )','youzer' ), $page->post_title, $page->ID );
    }

    return $pages;
}

/**
 * # Sort list by numeric order.
 */
function yz_sortByMenuOrder( $a, $b ) {

    if ( ! isset( $a['menu_order'] ) || ! isset( $b['menu_order'] ) ) {
        return false;
    }

    $a = $a['menu_order'];
    $b = $b['menu_order'];

    if ( $a == $b ) {
        return 0;
    }

    return ( $a < $b ) ? -1 : 1;
}

/**
 * # Class Generator.
 */
function yz_generate_class( $classes ) {
    // Convert Array to String.
    return implode( ' ' , array_filter( $classes ) );
}

/**
 * # Check widget visibility
 */
function yz_is_widget_visible( $widget_name ) {

    $visibility = false;

    $overview_widgets = yz_options( 'yz_profile_main_widgets' );
    $sidebar_widgets  = yz_options( 'yz_profile_sidebar_widgets' );
    $all_widgets      = array_merge( $overview_widgets, $sidebar_widgets );

    foreach ( $all_widgets as $widget ) {
        if ( isset( $widget[ $widget_name ] ) && 'visible' == $widget[ $widget_name ] ) {
            $visibility = true;
        }
    }

    // If its a Custom wiget Return True.
    if ( false !== strpos( $widget_name, 'yz_cwg' ) ) {
        $visibility = true;
    }

    $visibility = apply_filters( 'yz_is_widget_visible', $visibility, $widget_name );

    return $visibility;
}

/**
 * Get Array Key Index.
 */
function yz_get_key_index( $value, $array ) {
    $key = array_search( $value, $array );
    if ( false !== $key ) {
        return $key;
    }
}

/**
 * # Form Messages.
 */
add_action( 'youzer_admin_after_form', 'yz_form_messages' );
add_action( 'youzer_account_footer', 'yz_form_messages' );

function yz_form_messages() {

    ?>

    <div class="youzer-form-msg">
        <div id="youzer-action-message"></div>
        <div id="youzer-wait-message">
            <div class="youzer_msg wait_msg">
                <div class="youzer-msg-icon">
                    <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                </div>
                <span><?php _e( 'Please wait ...', 'youzer' ); ?></span>
            </div>
        </div>
    </div>

    <?php

}

/**
 * Popup Dialog Message
 */
function yz_popup_dialog( $type = null ) {

    // Init Alert Types.
    $alert_types = array( 'reset_tab', 'reset_all' );

    // Get Dialog Class.
    $form_class = ( ! empty( $type ) && in_array( $type, $alert_types ) ) ? 'alert' : 'error';
    
    // Get Dialog Name.
    $form_type  = ( ! empty( $type ) && in_array( $type, $alert_types ) ) ? $type : 'error';

    ?>

    <div id="uk_popup_<?php echo $form_type; ?>" class="uk-popup uk-<?php echo $form_class; ?>-popup">
        <div class="uk-popup-container">
            <div class="uk-popup-msg"><?php yz_get_dialog_msg( $form_type ); ?></div>
            <ul class="uk-buttons"><?php yz_get_dialog_buttons( $form_type ); ?></ul>
            <i class="fa fa-times uk-popup-close" aria-hidden="true"></i>
        </div>
    </div>

    <?php
}

/**
 * Get Pop Up Dialog Buttons
 */
function yz_get_dialog_buttons( $type = null ) {

    // Get Cancel Button title.
    $confirm = __( 'confirm', 'youzer' );
    $cancel  = ( 'error' == $type ) ? __( 'Got it!', 'youzer' ) : __( 'cancel', 'youzer' );

    if ( 'reset_all' == $type ) : ?>
        <li>
            <a class="uk-confirm-popup yz-confirm-reset" data-reset="all"><?php echo $confirm; ?></a>
        </li>
    <?php elseif ( 'reset_tab' == $type ) : ?>
        <li>
            <a class="uk-confirm-popup yz-confirm-reset" data-reset="tab"><?php echo $confirm; ?></a>
        </li>
    <?php endif; ?>

    <li><a class="uk-close-popup"><?php echo $cancel; ?></a></li>

    <?php
}

/**
 * Get Pop Up Dialog Message
 */
function yz_get_dialog_msg( $type = null ) {

    if ( 'reset_all' == $type ) : ?>

    <span class="dashicons dashicons-warning"></span>
    <h3><?php _e( 'Are you sure you want to reset all the settings?', 'youzer' ); ?></h3>
    <p><?php _e( 'Be careful! this will reset all the youzer plugin settings.', 'youzer' ); ?></p>

    <?php elseif ( 'reset_tab' == $type ) : ?>

    <span class="dashicons dashicons-warning"></span>
    <h3><?php _e( 'Are you sure you want to do this ?', 'youzer' ); ?></h3>
    <p><?php _e( 'Be careful! this will reset all the current tab settings.', 'youzer' ); ?></p>

    <?php elseif ( 'error' == $type ) : ?>

    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
    <h3><?php _e( 'Oops!', 'youzer' ); ?></h3>
    <div class="uk-msg-content"></div>

    <?php endif;

}

/**
 * Fix Url Path.
 */
function yz_scroll_to_top() {

    if ( 'off' == yz_options( 'yz_enable_account_scroll_button' ) ) {
        return false;
    }

    echo '<a class="yz-scrolltotop"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>';
}

add_action( 'youzer_account_footer', 'yz_scroll_to_top' );

/**
 * Fix Url Path.
 */
function yz_fix_path( $url ) {
    $url = str_replace( '\\', '/', trim( $url ) );
    return ( substr( $url,-1 ) != '/' ) ? $url .= '/' : $url;
}

/**
 * # Get Post ID .
 */
function yz_get_post_id( $post_type, $key_meta , $meta_value ) {

    // Get Posts
    $posts = get_posts(
        array(
            'post_type'  => $post_type,
            'meta_key'   => $key_meta,
            'meta_value' => $meta_value )
        );

    if ( isset( $posts[0] ) && ! empty( $posts ) ) {
        return $posts[0]->ID;
    }

    return false;
}

/**
 * Detect if Logy Plugin Is installed.
 */
function yz_is_logy_active() {

    if ( yz_is_membership_system_active() ) {
        return true;
    }

    return false;

}

/**
 * Get Login Page Url.
 */
function yz_get_login_page_url() {
        
    // If Logy Plugin Installed Return Login Page Url.
    if ( yz_is_logy_active() ) {
        return logy_page_url( 'login' );
    }

    // Init Vars.
    $login_url = wp_login_url();

    // Get Login Type.
    $login_type = yz_options( 'yz_login_page_type' );

    // Get Login Url.
    if ( 'url' == $login_type ) {
        $url = yz_options( 'yz_login_page_url' ); 
        $login_url = ! empty( $url ) ? $url : $login_url;
    } elseif ( 'page' == $login_type ) {
        $page_id = yz_options( 'yz_login_page' );
        $login_url = ! empty( $page_id ) ? get_the_permalink( $page_id ) : $login_url;
    }

    return $login_url;

}

/**
 * Get Arguments consedering default values.
 */
function yz_get_args( $pairs, $atts, $prefix = null ) {

    // Set Up Arrays
    $out  = array();
    $atts = (array) $atts;

    // Get Prefix Value.
    $prefix = $prefix ? $prefix . '_' : null;

    // Get Values.
    foreach ( $pairs as $name => $default ) {
        if ( array_key_exists(  $prefix . $name, $atts ) ) {
            $out[ $name ] = $atts[ $prefix . $name ];
        } else {
            $out[ $name ] = $default;
        }
    }

    return $out;
}

/**
 * Register New Sidebars
 */
function yz_new_sidebars() {

    register_sidebar(
        array (
            'name' => __( 'Wall Sidebar', 'youzer' ),
            'id' => 'yz-wall-sidebar',
            'description' => __( 'Activity Sidebar', 'youzer' ),
            'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );

    register_sidebar(
        array (
            'name' => __( 'Groups Sidebar', 'youzer' ),
            'id' => 'yz-groups-sidebar',
            'description' => __( 'Groups Sidebar', 'youzer' ),
            'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}

add_action( 'widgets_init', 'yz_new_sidebars' );

/**
 * Add Groups & Wall Sidebar Widgets
 */
function yz_add_sidebar_widgets( $sidebar_id, $widgets_list ) {

    // Get Sidebar Widgets
    $sidebars_widgets = get_option( 'sidebars_widgets' ); 

    // Check if Sidebar is empty.
    if ( ! empty( $sidebars_widgets[ $sidebar_id ] ) ) { 
        return false;
    } 

    // Add Widgets To sidebar.
    foreach ( $widgets_list as $widget ) {

        // Get Widgets Data.
        $widget_data = get_option( 'widget_' . $widget );

        // Get Last Widget Id
        $last_id = (int) ! empty( $widget_data ) ? max( array_keys( $widget_data ) ) : 0;

        // Get Next ID.
        $counter = $last_id + 1;

        // Add Widget Default Settings.
        $widget_data[] = yz_get_widget_defaults_settings( $widget );

        // Get Widgets Data.
        update_option( 'widget_' . $widget, $widget_data );

        // Add Widget To sidebar
        $sidebars_widgets[ $sidebar_id ][] = strtolower( $widget ) . '-' . $counter;
    }

    // Update Sidebar
    update_option( 'sidebars_widgets', $sidebars_widgets );

}

/**
 * Create New Plugin Page.
 */
function yz_add_new_plugin_page( $args ) {

    // Get Page Slug
    $slug = $args['slug'];

    // Check that the page doesn't exist already
    $is_page_exists = yz_get_post_id( 'page', $args['meta'], $slug );

    if ( $is_page_exists ) {

        if ( ! isset( $pages[ $slug ] ) ) {

            // init Array.
            $pages = get_option( $args['pages'] );

            // Get Page ID
            $page_id = yz_get_post_id( 'page', $args['meta'], $slug );

            // Add New Page Data.
            $pages[ $slug ] = $page_id;
            
            update_option( $args['pages'], $pages );
        }

        return false;
    }

    $user_page = array(
        'post_title'     => $args['title'],
        'post_name'      => $slug,
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'post_author'    =>  1,
        'comment_status' => 'closed'
    );

    $post_id = wp_insert_post( $user_page );

    wp_update_post( array('ID' => $post_id, 'post_type' => 'page' ) );

    update_post_meta( $post_id, $args['meta'], $slug );

    // init Array.
    $pages = get_option( $args['pages'] );

    // Add New Page Data.
    $pages[ $slug ] = $post_id;

    if ( isset( $pages ) ) {
        update_option( $args['pages'], $pages );
    }

}

/**
 * Display Notice Function
 */
function yz_display_admin_notice() {

    // Remove Default Function.
    global $BP_Legacy;
    remove_action( 'wp_footer', array( $BP_Legacy, 'sitewide_notices' ), 1 );

}
add_action( 'wp_head', 'yz_display_admin_notice' );

/**f
 * Check is user exist by id
 */
function yz_is_user_exist( $user_id = null ) {

    if ( $user_id instanceof WP_User ) {
        $user_id = $user_id->ID;
    }
    return (bool) get_user_by( 'id', $user_id );
}

/**
 * Template Messages
 */
function yz_template_messages() {

    ?>

    <div id="template-notices" role="alert" aria-atomic="true">
        <?php

        /**
         * Fires towards the top of template pages for notice display.
         *
         * @since 1.0.0
         */
        do_action( 'template_notices' ); ?>

    </div>

    <?php
}

add_action( 'yz_group_main_content', 'yz_template_messages' );
add_action( 'yz_profile_main_content', 'yz_template_messages' );

/**
 * Get Attachments Allowed Extentions
 */
function yz_get_allowed_extentions( $type = null, $format = null ) {

    // Extentions
    $extentions = null;

    switch ( $type ) {

        case 'image':
            // Get Images Extentions.
            $extentions = yz_options( 'yz_atts_allowed_images_exts' );
            break;
        
        case 'video':
            // Get Videos Extentions.
            $extentions = yz_options( 'yz_atts_allowed_videos_exts' );
            break;
        
        case 'audio':
            // Get Audios Extentions.
            $extentions = yz_options( 'yz_atts_allowed_audios_exts' );
            break;

        case 'file':
            // Get Files Extentions.
            $extentions = yz_options( 'yz_atts_allowed_files_exts' );
            break;
        
        default:
            // Get Default Extentions.
            $extentions = array(
                'png', 'jpg', 'jpeg', 'gif', 'doc', 'docx', 'pdf', 'rar',
                'zip', 'mp4', 'mp3', 'ogg', 'pfi'
            );
            break;
    }

    // Convert Extentions To Lower Case.
    $extentions = array_map( 'strtolower', $extentions );

    // Return Extentions as Text Format
    $extentions = ( $format == 'text' ) ? implode( ', ', $extentions ) : $extentions;

    return $extentions;
}

/**
 * Insert After Array.
 */
function yz_array_insert_after( array $array, $key, array $new ) {
    $keys = array_keys( $array );
    $index = array_search( $key, $keys );
    $pos = false === $index ? count( $array ) : $index + 1;
    return array_merge( array_slice( $array, 0, $pos ), $new, array_slice( $array, $pos ) );
}

/**
 * Check is Mycred is Installed & Active.
 */
function yz_is_mycred_installed() {

    if ( ! defined( 'myCRED_VERSION' ) )  {
        return false;
    }

    return true;

}

/**
 * Check is BBpress is Installed & Active.
 */
function yz_is_bbpress_installed() {

    if ( ! class_exists( 'bbPress' ) )  {
        return false;
    }

    return true;

}

/*
 * Set Body Scheme Class
 */
function yz_body_add_youzer_scheme( $classes ) {
 
    // Get Profile Scheme
    $classes[] = yz_options( 'yz_profile_scheme' );
     
    return $classes;

}

add_filter( 'body_class','yz_body_add_youzer_scheme' );

/**
 * Compress Images
 */
function yz_compress_profile_elements_images( $key = null, $user_id = null ) {

    // GET User ID.
    $user_id = ! empty( $user_id ) ? $user_id : bp_displayed_user_id();

    // Get 
    $option_id = 'yz_compress_' . $key . $user_id;
    
    if ( ! get_option( $option_id ) ) {

        // Get Data
        $data = get_the_author_meta( $key, $user_id );

        if ( empty( $data ) ) {
            return;
        }

        switch ( $key ) {

            case 'youzer_skills':

                $skills = array();

                foreach ( $data as $skills_data ) {
                    
                    if ( ! isset( $skills_data['wg_skills_title'] ) ) {
                        break;
                    }

                    $new_skill = array(
                        'title' => $skills_data['wg_skills_title'],
                        'barcolor' => $skills_data['wg_skills_barcolor'],
                        'barpercent' => $skills_data['wg_skills_barpercent'],
                    );

                    $skills[] = $new_skill;

                }


                update_user_meta( $user_id, 'youzer_skills', $skills );

                break;

            case 'youzer_services':

                $services = array();

                foreach ( $data as $service_data ) {

                    if ( ! isset( $service_data['wg_service_title'] ) ) {
                        break;
                    }

                    $new_service = array(
                        'icon' => $service_data['wg_service_icon'],
                        'title' => $service_data['wg_service_title'],
                        'description' => $service_data['wg_service_desc'],
                    );

                    $services[] = $new_service;

                }


                update_user_meta( $user_id, 'youzer_services', $services );

                break;

            case 'youzer_slideshow':

                $slideshows = array();

                foreach ( $data as $slide ) {
                    
                    if ( ! isset( $slide['url'] ) ) {
                        continue;
                    }

                    $file_name = basename( $slide['url'] );
                    $file = array( 'original' => $file_name );
                    unset( $slide['url'] );
                    $new_slide['original'] = $file_name;
                    $new_slide['thumbnail'] = yz_save_image_thumbnail( $file );
                    $slideshows[] = $new_slide;

                }

                if ( ! empty( $slideshows ) ) {
                    update_user_meta( $user_id, $key, $slideshows );
                }
                
                break;
            
            case 'youzer_portfolio':

                $portfolio = array();

                foreach ( $data as $photo ) {
                    
                    if ( ! isset( $photo['url'] ) ) {
                        continue;
                    }

                    $file_name = basename( $photo['url'] );
                    $file = array( 'original' => $file_name );
                    unset( $photo['url'] );
                    $photo['original'] = $file_name;
                    $photo['thumbnail'] = yz_save_image_thumbnail( $file );
                    $portfolio[] = $photo;

                }

                if ( ! empty( $portfolio ) ) {
                    update_user_meta( $user_id, $key, $portfolio );
                }
                
                break;
            case 'wg_link_img':
            case 'wg_quote_img':
            case 'wg_about_me_photo':
            case 'wg_project_thumbnail':

                    if ( is_array( $data ) ) {
                        return;
                    }
                    $file_name = basename( $data );
                    $file = array( 'original' => $file_name );
                    $img['original'] = $file_name;
                    $img['thumbnail'] = yz_save_image_thumbnail( $file );

                    if ( ! empty( $img ) ) {
                        update_user_meta( $user_id, $key, $img );
                    }
                    
                break;
            default:
                break;
        }
        update_option( $option_id, '1' );
    }


}

add_action( 'yz_before_get_data', 'yz_compress_profile_elements_images' );

/**
 * Activate Autoload
 */
function yz_activate_options_autoload() {

    if ( ! get_option( 'yz_activate_options_autoload' ) ) {

        global $Yz_default_options;

        foreach ( $Yz_default_options as $option_id => $value) {
            
            $option_value = get_option( $option_id );
            
            if ( ! empty( $option_value ) ) {
                update_option( $option_id, $option_value, true );
            } else {
                update_option( $option_id, yz_options( $option_id ), true );   
            }

        }
        
        update_option( 'yz_activate_options_autoload', true );

    }

}

add_action( 'init', 'yz_activate_options_autoload' );

/**
 * Check Is Buddypress Followers installed !
 */
function yz_is_bpfollowers_active() {

    if ( class_exists( 'BP_Follow_Component' ) ) {
        return true;
    }

    return false;
    
}

/**
 * Check if Bookmarking Posts Option is Enabled.
 */
function yz_is_bookmark_active() {

    // Get Value.
    $bookmarks = yz_options( 'yz_enable_bookmarks' );

    if ( bp_is_active( 'activity' ) && 'on' == $bookmarks ) {
        $activate = true;
    } else {
        $activate = false;
    }

    return apply_filters( 'yz_is_bookmarks_active', $activate );

}