<?php

/**
 * Check if youzer is active.
 */
function youzer_is_active() {
    return true;
}

/**
 * Is Activity Component
 */
function yz_is_activity_component() {
    
    // Init Var.
    $active = false;
    
    global $post;

    if ( bp_is_current_component( 'activity' ) || bp_is_current_component( 'wall' ) || bp_is_user_activity() || bp_is_single_activity() || bp_is_group_activity() || bp_is_activity_component() || ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'youzer_activity' ) )  ) {
        $active = true;
    }

    return apply_filters( 'yz_is_activity_component', $active );

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
 * Fix Url Path.
 */
function yz_scroll_to_top() {

    if ( 'off' == yz_options( 'yz_enable_account_scroll_button' ) ) {
        return false;
    }

    echo '<a class="yz-scrolltotop"><i class="fas fa-chevron-up"></i></a>';
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
        $url = wp_login_url(); 
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

/*
 * Set Body Scheme Class
 */
function yz_body_add_youzer_scheme( $classes ) {
 
    // Get Profile Scheme
    $classes[] = yz_options( 'yz_profile_scheme' );
    $classes[] = is_user_logged_in() ? 'logged-in' : 'not-logged-in';
     
    return $classes;

}

add_filter( 'body_class', 'yz_body_add_youzer_scheme' );

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
            update_option( $option_id, '1' );
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

        $Yz_default_options = yz_standard_options();

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

    /**
     * Detect plugin. For use on Front End only.
     */
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    // check for plugin using plugin name
    if ( is_plugin_active( 'buddypress-followers/loader.php' ) || is_plugin_active( 'buddypress-followers-master/loader.php' ) ) {

        if ( ! defined( 'BP_FOLLOW_DIR' ) ) {
            // Show Notice.
            add_action( 'admin_notices', 'yz_get_buddypress_followers_admin_notice' );
            return false;
        }

        return true;

    } 

    return false;
    
}

/**
 * Buddypress Followers Notice
 */
function yz_get_buddypress_followers_admin_notice() {

    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php echo sprintf( __( "<strong> Notice : </strong>The <strong>Buddypress Follow - Version 1.2</strong></a> plugin you are using is not compatible with <strong>Youzer</strong> because it's a very old version. please install their new <strong>Version 1.3</strong> from the following link : <a href='%1s'>Buddypress Followers</a>", 'youzer' ), 'https://github.com/r-a-y/buddypress-followers' ); ?></p>
    </div>
    <?php
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

/**
 * Init Bookmarks
 */
function yz_init_bookmarks() {

    if ( yz_is_bookmark_active() ) {
        require_once YZ_PUBLIC_CORE . 'functions/posts-tools/yz-bookmarks-functions.php';
    }

}

add_action( 'plugins_loaded', 'yz_init_bookmarks', 999 );

/**
 * Check if Review Option is Enabled.
 */
function yz_is_reviews_active() {

    // Get Value.
    $reviews = yz_options( 'yz_enable_reviews' );
    
    if ( 'on' == $reviews ) {
        $activate = true;
    } else {
        $activate = false;
    }

    return apply_filters( 'yz_is_reviews_active', $activate );

}

/**
 * Init Reviews
 */
function yz_init_reviews() {
    
    if ( yz_is_reviews_active() ) {
        global $Youzer;
        require_once YZ_PUBLIC_CORE . 'class-yz-reviews.php';
        require_once YZ_PUBLIC_CORE . 'functions/yz-reviews-functions.php';
        require_once YZ_PUBLIC_CORE . 'reviews/yz-reviews-query.php';
        $Youzer->reviews = new Youzer_Reviews();

    }

}

add_action( 'plugins_loaded', 'yz_init_reviews', 999 );

/**
 * Get Image Size.
 */
function yz_get_image_size0( $img_url ) {

    global $YZ_upload_dir, $YZ_upload_url;

    // Get Image Path;
    $img_path = str_replace( $YZ_upload_url, $YZ_upload_dir, $img_url );

    // Get Image Size
    $img_size = getimagesize( $img_path );
    
    return $img_size;
}

/**
 * Get Image Size.
 */
function yz_get_image_size( $url, $referer = null ) {

    // Set headers    
    $headers = array( 'Range: bytes=0-131072' );   

    if ( ! empty( $referer ) ) { array_push( $headers, 'Referer: ' . $referer ); }

    // Get remote image
    $ch = curl_init();    
    curl_setopt( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/536.6 (KHTML, like Gecko) Chrome/20.0.1090.0 Safari/536.6' );
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
    $data = curl_exec( $ch );
    $http_status = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
    $curl_errno = curl_errno( $ch );
    curl_close( $ch );

    // Get network stauts
    if ( $http_status != 200 ) {
        // echo 'HTTP Status[' . $http_status . '] Error [' . $curl_errno . ']';
        return array( 0, 0 );
    }

    // Process image
    $image = imagecreatefromstring( $data );
    $dims = array( imagesx( $image ), imagesy( $image ) );
    imagedestroy( $image );

    return $dims;
}

/**
 *  Font-edn Modal
 */
function yz_modal( $args, $modal_function, $options = null ) {

    $title        = $args['title'];
    $button_id    = $args['button_id'];
    $default_submit_icon = isset( $args['operation'] ) && $args['operation'] == 'add' ? 'far fa-edit' : 'fas fa-sync-alt'; 
    $submit_btn_icon = isset( $args['submit_button_icon'] ) ? $args['submit_button_icon'] : $default_submit_icon;
    $button_title = isset( $args['button_title'] ) ? $args['button_title'] : __( 'save', 'youzer' );
    $show_close = isset( $args['show_close'] ) ? $args['show_close'] : true;
    $show_delete_btn = isset( $args['show_delete_button'] ) ? $args['show_delete_button'] : false;
    $delete_btn_title = isset( $args['delete_button_title'] ) ? $args['delete_button_title'] : __( 'delete', 'youzer' );
    $delete_btn_id = isset( $args['delete_button_id'] ) ? $args['delete_button_id'] : null;
    $delete_btn_item_id = isset( $args['delete_button_item_id'] ) ? $args['delete_button_item_id'] : null;

    ?>

    <form class="yz-modal" id="<?php echo $args['id'] ;?>" method="post" >

        <div class="yz-modal-title" data-title="<?php echo $title; ?>">
            <?php echo $title; ?>
            <i class="fas fa-times yz-modal-close-icon"></i>
        </div>
        
        <div class="yz-modal-content">
            <?php $modal_function( $options ); ?>
        </div>
        
        <div class="yz-modal-actions">
            <button id="<?php echo $button_id; ?>" data-action="<?php echo $args['operation']; ?>" class="yz-modal-button yz-modal-save">
                <i class="<?php echo $submit_btn_icon; ?>"></i><?php echo $button_title ?>
            </button>

            <?php if ( $show_delete_btn ) : ?>
            <button id="<?php echo $delete_btn_id; ?>" class="yz-md-button yz-modal-delete" data-item-id="<?php echo $delete_btn_item_id ?>">
                <i class="far fa-trash-alt"></i><?php echo $delete_btn_title; ?>
            </button>
            <?php endif; ?>

            <?php if ( $show_close ) : ?>
            <button class="yz-modal-button yz-modal-close">
                <i class="fas fa-times"></i><?php _e( 'close', 'youzer' ); ?>
            </button>
            <?php endif; ?>
        </div>

    </form>

    <?php
}

function yz_fix_networks_icons_css( $icon ) {
    if ( strpos( $icon, ' ' ) === false) {
        $icon = 'fab fa-' . $icon; 
    }
 
    return $icon;

}

add_filter( 'yz_panel_networks_icon', 'yz_fix_networks_icons_css' );
add_filter( 'yz_user_social_networks_icon', 'yz_fix_networks_icons_css' );

/**
 * Youzer Scrips Vars.
 */
function youzer_scripts_vars() {

    // Get Activity Loader Value.
    $activity_loader = ! wp_is_mobile() && yz_options( 'yz_enable_wall_activity_loader' ) == 'on' ? 'on' : 'off';

    $vars = array(
        'unknown_error' => __( 'An unknown error occurred. Please try again later.', 'youzer' ),
        'slideshow_auto' => apply_filters( 'yz_profile_slideshow_auto_loop' , true ),
        'slides_height_type' => yz_options( 'yz_slideshow_height_type' ),
        'authenticating' => __( 'Authenticating ...', 'youzer' ),
        'security_nonce' => wp_create_nonce( 'youzer-nonce' ),
        'displayed_user_id' => bp_displayed_user_id(),
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'thanks'   => __( 'ok! thanks', 'youzer' ),
        'activity_autoloader' => $activity_loader,
        'confirm' => __( 'Confirm', 'youzer' ),
        'cancel' => __( 'Cancel', 'youzer' ),
        'gotit' => __( 'Got it!', 'youzer' ),
        'done' => __( 'Done !', 'youzer' ),
        'ops' => __( 'Oops !', 'youzer' ),
        'youzer_url' => YZ_URL,
    );

    return apply_filters( 'youzer_scripts_vars', $vars );
}

/**
 * Get Suggestions List.
 */
function yz_get_users_list( $users, $args = null ) {

    if ( empty( $users ) ) {
        return;
    }

    // Get Widget Class.
    $main_class = isset( $args['main_class'] ) ? $args['main_class'] : null;
    
    ?>

    <div class="yz-items-list-widget yz-list-avatar-circle <?php echo yz_generate_class( $main_class ); ?>">

        <?php foreach ( $users as $user_id ) : ?>

        <?php $profile_url = bp_core_get_user_domain( $user_id ); ?>

        <div class="yz-list-item">
            <a href="<?php echo $profile_url; ?>" class="yz-item-avatar"><?php echo bp_core_fetch_avatar( array( 'item_id' => $user_id, 'type' => 'thumb' ) ); ?></a>
            <div class="yz-item-data">
                <a href="<?php echo $profile_url; ?>" class="yz-item-name"><?php echo bp_core_get_user_displayname( $user_id ); ?><?php yz_the_user_verification_icon( $user_id ); ?></a>
                <div class="yz-item-meta">
                    <div class="yz-meta-item">@<?php echo bp_core_get_username( $user_id ); ?></div>
                </div>
            </div>
        </div>

        <?php endforeach; ?>

    </div>

    <?php

}

/**
 * Die Message
 */
function yz_die( $message ) {
    $response['error'] = $message;
    die( json_encode( $response ) );
}

/**
 * Get User ID By Email.
 */
function yz_get_user_id_by_email( $email_address = null ) {

    // Get User Data.
    $user = get_user_by( 'email', $email_address );

    return $user->ID;
}

/**
 * Get Image Tag By Url
 */
function yz_get_avatar_img_by_url( $url ) {
    return '<img src="' . $url . '" alt="' . __( 'User Avatar', 'youzer' ) . '">';
}