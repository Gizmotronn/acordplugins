<?php

/**
 * # Get Profile Class.
 */
function yz_get_profile_class() {

    // New Array
    $profile_class = array();

    // Get Profile Layout
    $profile_class[] = yz_get_profile_layout();

    // Get Profile Width Type
    $profile_class[] = 'yz-wild-content';

    // Get Tabs List Icons Style
    $profile_class[] = yz_options( 'yz_tabs_list_icons_style' );

    // Get Elements Border Style.
    $profile_class[] = 'yz-wg-border-' . yz_options( 'yz_wgs_border_style' );

    // Get Navbar Layout
    $navbar_layout = yz_options( 'yz_vertical_layout_navbar_type' );

    // Get Page Buttons Style
    $profile_class[] = 'yz-page-btns-border-' . yz_options( 'yz_buttons_border_style' );

    // Add Vertical Wild Navbar. 
    if ( yz_is_wild_navbar_active() ) { 
        $profile_class[] = "yz-vertical-wild-navbar";
    }

    // Get Profile 404 Page Class
    $profile_class[] = yz_is_404_profile() ? ' yz-404-profile' : null;

    return yz_generate_class( $profile_class );
}

/**
 * Check is Wild Navbar Activated
 */
function yz_is_wild_navbar_active() {

    // Get Profile Layout
    $profile_layout = yz_get_profile_layout();

    // Get Navbar Layout
    $navbar_layout = yz_options( 'yz_vertical_layout_navbar_type' );

    // Add Vertical Wild Navbar. 
    if ( 'yz-vertical-layout' == $profile_layout && 'wild-navbar' == $navbar_layout ) { 
        return true;
    }

    return false;
}

/**
 * # Navbar Settings Menu.
 */
function yz_account_settings_menu() {
    
	do_action( 'yz_profile_navbar_right_area' );
	
    // Get Header Layout.
    $header_layout = yz_get_profile_layout();

    if ( ! bp_is_my_profile() && 'yz-horizontal-layout' == $header_layout  ) {
        yz_get_social_buttons();
        return false;
    }

    if ( ! bp_is_my_profile() ) {
        return false;
    }

    global $Youzer;

    ?>

    <div class="yz-settings-area">

        <?php 

            // Get Navbar Quick Buttons.
            if ( 'yz-horizontal-layout' == $header_layout || yz_is_wild_navbar_active() ) {
                yz_user_quick_buttons( bp_loggedin_user_id() );
            }

        ?>
        
        <div class="yz-nav-settings">
            <div class="yz-settings-img"><?php echo bp_core_fetch_avatar( array( 'item_id' => bp_displayed_user_id(), 'type' => 'thumb', 'width' => 35, 'height' => 35 ) ); ?></div>
            <i class="fas fa-angle-down yz-settings-icon"></i>
        </div>

        <?php $Youzer->user->settings(); ?>
        
    </div>

    <?php

}

/**
 * # Add Login Button to Profile Page.
 */
function yz_sidebar_login_button() {

    // Get Login Button Visibility Option.
    $hide_button = ( 'off' == yz_options( 'yz_profile_login_button' ) ) ? true : false;

    // Check Visibility Requirements.
    if ( $hide_button || 'yz-vertical-layout' == yz_get_profile_layout() || is_user_logged_in() ) {
        return false;
    }

    global $Youzer, $wp;

    // Get Box Data Attribute
    $box_data = $Youzer->widgets->get_loading_effect( 'fadeInDown' );

    // Get Box Class Name.
    $box_class[] = 'yz-profile-login';

    // Get Effect Style
    $box_class[] = $Youzer->widgets->get_loading_effect( 'fadeInDown', 'class' );

    ?>

    <a href="<?php echo yz_get_login_page_url(); ?>" data-show-youzer-login="true" class="<?php echo yz_generate_class( $box_class ); ?>" <?php echo $box_data ?>>
        <i class="fas fa-user-circle"></i>
        <?php _e( 'Sign in to your account', 'youzer' ); ?>
    </a>

    <?php

}

add_action( 'yz_profile_sidebar', 'yz_sidebar_login_button', 1 );

/**
 * Get Post Thumbnail
 */
function yz_post_img() {

    global $post;

    // Get Post Format
    $post_format = get_post_format();
    $post_format = ! empty( $post_format ) ? $post_format : 'standard';

    if ( has_post_thumbnail() ) {

        // Get Data
        $post_thumb = get_the_post_thumbnail_url( 'large' );

    ?>

    <div class="yz-post-img" style="background-image: url(<?php echo $post_thumb; ?>);"></div>

    <?php

    } elseif ( ! has_post_thumbnail() ) {
        echo '<div class="ukai-alt-thumbnail">';
        echo '<div class="thumbnail-icon"><i class="'. yz_get_format_icon( $post_format ) .'"></i></div>';
        echo '</div>';
    }
}


/**
 * # Get Pagination Loading Spinner.
 */
function yz_loading() {

    ?>

    <div class="yz-loading">
        <div class="youzer_msg wait_msg">
            <div class="youzer-msg-icon">
                <i class="fas fa-spinner fa-spin"></i>
            </div>
            <span><?php _e( 'Please wait ...', 'youzer' ); ?></span>
        </div>
    </div>

    <?php

}

/**
 * # Get Post Categories
 */
function yz_get_post_categories( $post_id , $hide_icon = false ) {

    $post_categories = get_the_category_list( ', ', '', $post_id );

    if ( $post_categories ) {
        echo '<li>';
        if ( 'on' == $hide_icon ) {
            echo '<i class="fas fa-tags"></i>';
        }
        echo $post_categories;
        echo '</li>';
    }

}

/**
 * # Get Project Tags
 */
function yz_get_project_tags( $tags_list ) {

    if ( ! $tags_list ) {
        return false;
    }

    ?>

    <ul class="yz-project-tags">
        <?php
            foreach( $tags_list as $tag ) {
                echo "<li><span class='yz-tag-symbole'>#</span>$tag</li>";
            }
        ?>
    </ul>

    <?php

}

/**
 * Check if is widget = AD widget
 */
function yz_is_ad_widget( $widget_name ) {
    if ( false !== strpos( $widget_name, 'yz_ad_' ) ) {
        return true;
    }
    return false;
}

/**
 * Check if is widget = Custom widget
 */
function yz_is_custom_widget( $widget_name ) {
    if ( false !== strpos( $widget_name, 'yz_custom_widget_' ) ) {
        return true;
    }
    return false;
}

/**
 * # Check Link HTTP .
 */
function yz_esc_url( $url ) {
    $url = esc_url( $url );
    $disallowed = array( 'http://', 'https://' );
    foreach( $disallowed as $protocole ) {
        if ( strpos( $url, $protocole ) === 0 ) {
            return str_replace( $protocole, '', $url );
        }
    }
    return $url;
}

/**
 * #  Enable Widgets Shortcode.
 */
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Make Profile Tab Private for other users.
 */
function yz_hide_profile_settings_page_for_other_users() {

    if ( apply_filters( 'yz_hide_profile_settings_page_for_other_users', true ) ) {

        if ( bp_is_user() && ! is_super_admin() && ! bp_is_my_profile() ) {
            bp_core_remove_nav_item( bp_get_profile_slug() );
        }
    }

}

add_action( 'bp_setup_nav', 'yz_hide_profile_settings_page_for_other_users', 15 );

/**
 * Display Profile
 */
function yz_display_profile() {

    if ( 'off' == yz_options( 'yz_allow_private_profiles' ) ) {
        return true;
    }

    // Get Profile Visitbily.
    $display_profile = yz_data( 'yz_enable_private_account', bp_displayed_user_id() );
    $profile_visibility = $display_profile ? $display_profile : 'off';

    if ( 'off' == $profile_visibility ) {
        return true;
    }

    if ( yz_displayed_user_is_friend() ) {
        return true;
    }

    return false;
}

/**
 * Private Account Message.
 */
function yz_private_account_message() { ?>

    <div id="yz-not-friend-message">
        <i class="fas fa-user-secret"></i>
        <strong><?php _e( 'Private Account', 'youzer' ); ?></strong>
        <p><?php _e( 'You must be friends in order to access this profile.', 'youzer' ); ?></p>
    </div>

    <?php
}

/**
 * Change Cover Image Size.
 */
function yz_attachments_get_cover_image_dimensions( $wh ) {
    return array( 'width' => 1350, 'height' => 350 );
}

add_filter( 'bp_attachments_get_cover_image_dimensions', 'yz_attachments_get_cover_image_dimensions' );

/**
 * 404 Porfile Template
 */
function yz_404_profile_template() {

    // Get Header
    get_header();

    // Get Profile Template.
    include YZ_TEMPLATE . 'profile-template.php';

    // Get Footer
    get_footer();
    
}

/**
 * # Get 404 Profile Template
 */
function yz_get_404_profile_template( $template ) {

    if ( is_404() && yz_is_404_profile() ) {

        if ( ! yz_show_spammer_404() ) {

            global $wp_query;

            status_header( 200 );
            
            // Mark Page As 404.
            $wp_query->is_404 = false;

        }

        // Add 404 Profile Content.
        add_action( 'yz_profile_main_content', array( youzer()->profile, 'profile_404' ) );
        
        return yz_404_profile_template();

    }

    return $template;
}

add_filter( 'youzer_template', 'yz_get_404_profile_template' );

/**
 * Replace Author Url By Buddypress Profile Url.
 */
function yz_edit_author_link_url( $link, $author_id ) {
    return bp_core_get_user_domain( $author_id );
}

add_filter( 'author_link', 'yz_edit_author_link_url', 9999, 2 );

/**
 * Redirect Author Page to Buddypress Profile Page.
 */
function yz_redirect_author_page_to_bp_profile() {

    if ( is_author() && function_exists( 'bp_core_redirect' ) ) {

        // Get Author ID.
        $author_id = get_queried_object_id();

        // Redirect.
        bp_core_redirect( bp_core_get_user_domain( $author_id ) );

    }

}

add_action( 'template_redirect', 'yz_redirect_author_page_to_bp_profile', 5 );

/**
 * Set Default Profile Avatar.
 */
function yz_set_default_profile_avatar( $avatar, $params ) {

    // Get Default Avatar.
    $default_avatar = yz_options( 'yz_default_profiles_avatar' );

    if ( empty( $default_avatar ) ) {
        $default_avatar = $avatar;
    }

    return apply_filters( 'yz_set_default_profile_avatar', $default_avatar, $params );

}

add_filter( 'bp_core_default_avatar_user', 'yz_set_default_profile_avatar', 10, 2 );

/**
 * Check if User Has Gravatar
 */
function yz_user_has_gravatar( $email_address ) {

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
 * Change Profile Avatar
 */
function yz_edit_profile_default_avatar( $avatar_url = null , $params = null ) {

    // Get Default Avatar.
    $default_avatar = yz_options( 'yz_default_profiles_avatar' );

    if ( empty( $default_avatar ) ) {
        return $avatar_url;
    }

    if (
        isset( $params['email'] )&& ! yz_user_has_gravatar( $params['email'] )&&
        strpos( $avatar_url, 'gravatar' ) !== false
    ) {
        return $default_avatar;
    }

    // Return Avatar Url.
    return $avatar_url;
}

// add_filter( 'bp_core_fetch_avatar_url', 'yz_edit_profile_default_avatar', 99, 2 );

/**
 * Add Profiles Open Graph Support.
 */
function yz_profiles_open_graph() {

    if ( ! bp_is_user() || bp_is_single_activity() ) {
        return false;
    }

    global $Youzer;

    // Get Displayed Profile user id.
    $user_id = bp_displayed_user_id();

    // Get Username
    $user_name = bp_core_get_user_displayname( $user_id );
    
    // Get User Cover.
    $user_cover = bp_attachments_get_attachment( 'url', array('object_dir' => 'members', 'item_id' => $user_id ) );

    // Get User Cover Image
    $user_image = apply_filters( 'yz_og_profile_cover_image', $user_cover );

    // Get Avatar if Cover Not found.
    if ( empty( $user_image ) ) {
        $user_image = apply_filters( 'yz_og_profile_default_thumbnail', null );
    }

    // Get User Description.
    $user_desc = get_the_author_meta( 'description', $user_id );

    // Get Page Url !
    $url = bp_core_get_user_domain( $user_id );

    // if description empty get about me description
    if ( empty( $user_desc ) ) {
        $user_desc = get_the_author_meta( 'wg_about_me_bio', $user_id );
    } 

    yz_get_open_graph_tags( 'profile', $url, $user_name, $user_desc, $user_image );

}

add_action( 'wp_head', 'yz_profiles_open_graph' );

/**
 * # 404 Profile Scripts.
 */
function yz_404_profile_scripts() {

    if ( yz_is_404_profile() ) {
        wp_enqueue_style( 'yz-profile' );
        wp_enqueue_style( 'yz-schemes' );
    }

}

add_action( 'wp_enqueue_scripts', 'yz_404_profile_scripts' );