<?php

/**
 * # Register Public Scripts .
 */
function yz_public_scripts() {

    global $Youzer;

    // Get Data.
    $jquery = array( 'jquery' );
    $extra_args = array( 'jquery-ui-sortable', 'jquery-ui-draggable' );

    // Youzer Global Script
    wp_enqueue_script( 'youzer', YZ_PA . 'js/youzer.min.js', $jquery, $Youzer->version, true );

    // Font.
    wp_enqueue_style( 'yz-opensans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600', $Youzer->version );

    // Youzer Css.
    wp_enqueue_style( 'youzer', YZ_PA . 'css/youzer.min.css', $Youzer->version );

    // Get Youzer Script Variables
    $youzer_vars = youzer_scripts_vars();

    if ( ! is_user_logged_in() ) {
        $youzer_vars['ajax_enabled'] = yz_options( 'yz_enable_ajax_login' );
        $youzer_vars['login_popup'] = yz_options( 'yz_enable_login_popup' );
    }

    wp_localize_script( 'youzer', 'Youzer', $youzer_vars );

    // Profile Ajax Pagination Script
    wp_register_script( 'yz-pagination', YZ_PA . 'js/yz-pagination.min.js', $jquery , $Youzer->version, true );

    // Tag Editor Script
    wp_register_script( 'yz-scrolltotop', YZ_PA .'js/yz-scrolltotop.min.js', $jquery, $Youzer->version, true );

    // Call Fonts.
    wp_enqueue_style( 'yz-roboto', 'https://fonts.googleapis.com/css?family=Roboto:400', null, $Youzer->version );
    wp_enqueue_style( 'yz-lato', 'https://fonts.googleapis.com/css?family=Lato:400', null, $Youzer->version );

    // Wall Form Uploader CSS.
    wp_register_style( 'yz-bp-uploader', YZ_PA . 'css/yz-bp-uploader.min.css', $Youzer->version );

    // Headers Css
    wp_enqueue_style( 'yz-headers', YZ_PA . 'css/yz-headers.min.css', null, $Youzer->version );

    // Profile Css.
    wp_register_style( 'yz-profile', YZ_PA . 'css/yz-profile-style.min.css', $Youzer->version );
    
    // Get Plugin Scheme.
    $youzer_scheme = yz_options( 'yz_profile_scheme' );

    // Profile Color Schemes Css.f
    wp_enqueue_style( 'yz-scheme', YZ_PA . 'css/schemes/' . $youzer_scheme .'.min.css', null, $Youzer->version );

    // Group Pages CSS
    if ( bp_is_groups_component() && ! bp_is_groups_directory() ) {
       wp_enqueue_style( 'yz-groups', YZ_PA .'css/yz-groups.min.css', array( 'yz-bp-uploader' ), $Youzer->version );
    }
    
    // Member Pages CSS
    if ( ! bp_is_members_directory() && ! bp_is_groups_directory()  ) {
        wp_enqueue_style( 'yz-social', YZ_PA .'css/yz-social.min.css', array( 'dashicons' ), $Youzer->version );
    }

    // Members & Groups Directories CSS
    if ( bp_is_members_directory() || bp_is_groups_directory() ) {
        wp_enqueue_script( 'masonry' );
        wp_enqueue_style( 'yz-directories', YZ_PA . 'css/yz-directories.min.css', array( 'dashicons' ), $Youzer->version );
        wp_enqueue_script( 'yz-directories', YZ_PA .'js/yz-directories.min.js', $jquery, $Youzer->version, true );
    }
    
    if ( bp_current_component() ) {
        yz_common_scripts();
    }

    // Verify Accounts Script
    if ( yz_is_user_can_verify_accounts() ) {
        wp_enqueue_script( 'yz-verify-user', YZ_PA . 'js/yz-verify-user.min.js', $jquery, $Youzer->version, true );
        // Localize Script.
        wp_localize_script( 'yz-verify-user', 'Yz_Verification', array(
            'verify_account' => __( 'Verify Account', 'youzer' ),
            'unverify_account' => __( 'Unverify Account', 'youzer' ),
            )
        );
    }

    // Global Youzer JS
    wp_enqueue_style( 'yz-icons' );

}

add_action( 'wp_enqueue_scripts', 'yz_public_scripts' );

/**
 * Common Scripts
 */
function yz_common_scripts() {
    
    global $Youzer;

    $jquery = array( 'jquery' );

    // Nice Selector 
    wp_enqueue_script( 'yz-nice-selector', YZ_PA .'js/jquery.nice-select.min.js', $jquery, $Youzer->version, false );
    // Textarea AutoSizing
    wp_enqueue_script( 'yz-textarea-autosize', YZ_PA .'js/autosize.min.js', $jquery, $Youzer->version, true );
    
    // Load Light Box CSS and JS.
    wp_enqueue_style( 'yz-lightbox', YZ_PA . 'css/lightbox.min.css', $Youzer->version );
    wp_enqueue_script( 'yz-lightbox', YZ_PA . 'js/lightbox.min.js', $jquery, $Youzer->version, true );

}

/**
 * Activity Scripts
 */

add_action( 'wp_enqueue_scripts', 'yz_activity_scripts' );

function yz_activity_scripts() {
    
    if ( ! yz_is_activity_component() ) {
        return;
    }

    global $Youzer;

    // Wall JS.
    wp_enqueue_script( 'yz-wall', YZ_PA . 'js/yz-wall.min.js', array( 'jquery' ) );

    // Wall Css
    wp_enqueue_style( 'yz-wall', YZ_PA . 'css/yz-wall.min.css', $Youzer->version );

    // Load Profile Style
    wp_enqueue_style( 'yz-profile' );

    // Enable Url Live Preview
    $enable_url_preview = yz_options( 'yz_enable_wall_url_preview' );

    if ( 'on' == $enable_url_preview ) {
        // URL Preview CSS
        wp_enqueue_script( 'yz-angular', YZ_PA . 'js/angular.min.js', array( 'jquery' ) );
        wp_enqueue_script( 'yz-url-preview', YZ_PA . 'js/yz-url-preview.js', array( 'jquery' ) );
        wp_enqueue_style( 'yz-url-preview', YZ_PA . 'css/yz-url-preview.min.css' );
        wp_localize_script( 'yz-url-preview', 'YouzerLP', array(
            'loading'       => __( 'Loading', 'youzer' ),
            'no_thumbnail'  => __( 'No thumbnail', 'youzer' ),
            'enter_title'   => __( 'Enter a title', 'youzer' ),
            'enter_desc'    => __( 'Enter a description', 'youzer' ),
            'choose_thumbnail' => __( 'Choose a thumbnail', 'youzer' ),
        ) );
    }

    // Load Carousel CSS and JS.
    wp_enqueue_style( 'yz-carousel-css', YZ_PA . 'css/owl.carousel.min.css' );
    wp_enqueue_script( 'yz-carousel-js', YZ_PA . 'js/owl.carousel.min.js' );
    wp_enqueue_script( 'yz-slider', YZ_PA . 'js/yz-slider.min.js' );

    if ( is_user_logged_in() && yz_is_wall_posting_form_active() ) {
        
        global $YZ_upload_url;

        // Wall Uploader
        wp_enqueue_script( 'yz-wall-form', YZ_PA . 'js/yz-wall-form.min.js', array( 'jquery' ), $Youzer->version, true );

        // Localize Script.
        wp_localize_script( 'yz-wall-form', 'Yz_Wall',
            array(
                'invalid_image_ext' => $Youzer->wall->msg( 'invalid_image_extension' ),
                'invalid_video_ext' => $Youzer->wall->msg( 'invalid_video_extension' ),
                'invalid_audio_ext' => $Youzer->wall->msg( 'invalid_audio_extension' ),
                'invalid_file_ext'  => $Youzer->wall->msg( 'invalid_file_extension' ),
                'max_size'          => yz_options( 'yz_attachments_max_size' ),
                'default_extentions'=> yz_get_allowed_extentions( 'default' ),
                'image_extentions'  => yz_get_allowed_extentions( 'image' ),
                'video_extentions'  => yz_get_allowed_extentions( 'video' ),
                'audio_extentions'  => yz_get_allowed_extentions( 'audio' ),
                'file_extentions'   => yz_get_allowed_extentions( 'file' ),
                'max_files_number'  => $Youzer->wall->msg( 'max_files_number' ),
                'invalid_file_size' => $Youzer->wall->msg( 'invalid_file_size' ),
                'max_one_file'      => $Youzer->wall->msg( 'max_one_file' ),
                'base_url'          => $YZ_upload_url,
            )
        );
    }
    
    if ( yz_enable_wall_posts_effect() ) {
        // Load View Port Checker Script
        wp_enqueue_script( 'yz-viewchecker', YZ_PA . 'js/yz-viewportChecker.min.js', array( 'jquery' ), $Youzer->version, true  );
    }
    
    yz_common_scripts();
    
    do_action( 'yz_activity_scripts' );

}


/**
 * Add Groups Custom CSS.
 */
function yz_activity_custom_styling() {

    if ( 'off' == yz_options( 'yz_enable_activity_custom_styling' ) ) {
        return false;
    }

    // if its not the activity directory exit.
    if ( ! bp_is_activity_directory() ) {
        return false;
    }

    // Get CSS Code.
    $custom_css = yz_options( 'yz_activity_custom_styling' );

    if ( empty( $custom_css ) ) {
        return false;
    }

    // Custom Styling File.
    wp_enqueue_style( 'youzer-customStyle', YZ_AA . 'css/custom-script.css' );

    wp_add_inline_style( 'youzer-customStyle', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'yz_activity_custom_styling' );

/**
 * Add Profile Custom CSS.
 */
function yz_profile_custom_styling() {

    if ( 'off' == yz_options( 'yz_enable_profile_custom_styling' ) ) {
        return false;
    }

    if ( ! bp_is_user() || yz_is_account_page() ) {
        return false;
    }

    // Get CSS Code.
    $custom_css = yz_options( 'yz_profile_custom_styling' );

    if ( empty( $custom_css ) ) {
        return false;
    }

    // Custom Styling File.
    wp_enqueue_style( 'youzer-customStyle', YZ_AA . 'css/custom-script.css' );

    wp_add_inline_style( 'youzer-customStyle', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'yz_profile_custom_styling' );

/**
 * Add Groups Custom CSS.
 */
function yz_groups_custom_styling() {

    if ( 'off' == yz_options( 'yz_enable_groups_custom_styling' ) ) {
        return false;
    }

    if ( ! bp_is_groups_component() ) {
        return;
    }

    // Get CSS Code.
    $custom_css = yz_options( 'yz_groups_custom_styling' );

    if ( empty( $custom_css ) ) {
        return false;
    }

    // Custom Styling File.
    wp_enqueue_style( 'youzer-customStyle', YZ_AA . 'css/custom-script.css' );

    wp_add_inline_style( 'youzer-customStyle', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'yz_groups_custom_styling' );

/**
 * Add Account Custom CSS.
 */
function yz_account_custom_styling() {

    if ( 'off' == yz_options( 'yz_enable_account_custom_styling' ) || ! yz_is_account_page() ) {
        return false;
    }

    // Get CSS Code.
    $custom_css = yz_options( 'yz_account_custom_styling' );

    if ( empty( $custom_css ) ) {
        return false;
    }

    // Custom Styling File.
    wp_enqueue_style( 'youzer-customStyle', YZ_AA . 'css/custom-script.css' );

    wp_add_inline_style( 'youzer-customStyle', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'yz_account_custom_styling' );

/**
 * Add Members Directory Custom CSS.
 */
function yz_members_directory_custom_styling() {

    if ( 'off' == yz_options( 'yz_enable_members_directory_custom_styling' ) ) {
        return false;
    }

    if ( ! bp_is_members_directory() ) { 
        return false;
    }

    // Get CSS Code.
    $custom_css = yz_options( 'yz_members_directory_custom_styling' );

    if ( empty( $custom_css ) ) {
        return false;
    }

    // Custom Styling File.
    wp_enqueue_style( 'youzer-customStyle', YZ_AA . 'css/custom-script.css' );

    wp_add_inline_style( 'youzer-customStyle', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'yz_members_directory_custom_styling' );

/**
 * Add Groups Directory Custom CSS.
 */
function yz_groups_directory_custom_styling() {

    if ( 'off' == yz_options( 'yz_enable_groups_directory_custom_styling' ) ) {
        return false;
    }

    if ( ! bp_is_groups_directory() ) { 
        return false;
    }

    // Get CSS Code.
    $custom_css = yz_options( 'yz_groups_directory_custom_styling' );

    if ( empty( $custom_css ) ) {
        return false;
    }

    // Custom Styling File.
    wp_enqueue_style( 'youzer-customStyle', YZ_AA . 'css/custom-script.css' );

    wp_add_inline_style( 'youzer-customStyle', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'yz_groups_directory_custom_styling' );

/**
 * Add Global Custom CSS.
 */
function yz_global_custom_styling() {
    
    if ( 'off' == yz_options( 'yz_enable_global_custom_styling' ) ) {
        return false;
    }

    // Get CSS Code.
    $custom_css = yz_options( 'yz_global_custom_styling' );

    if ( empty( $custom_css ) ) {
        return false;
    }

    // Custom Styling File.
    wp_enqueue_style( 'youzer-customStyle', YZ_AA . 'css/custom-script.css' );


    wp_add_inline_style( 'youzer-customStyle', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'yz_global_custom_styling' );

/**
 * Remove Buddypress Default CSS.
 */
function yz_dequeue_buddypress_css() {
    wp_dequeue_style( 'bp-twentyten' );
    wp_dequeue_style( 'bp-twentyeleven' );
    wp_dequeue_style( 'bp-twentytwelve' );
    wp_dequeue_style( 'bp-twentythirteen' );
    wp_dequeue_style( 'bp-twentyfourteen' );
    wp_dequeue_style( 'bp-twentyfifteen' );
    wp_dequeue_style( 'bp-twentysixteen' );
    wp_dequeue_style( 'bp-twentyseventeen' );
}

add_action( 'wp_enqueue_scripts', 'yz_dequeue_buddypress_css', 999 );

/**
 * Emoji Scripts
 */
function yz_emoji_scripts() {

    if ( ! is_user_logged_in() ) {
        return false;
    }

    // Emojionearea Scripts
    wp_enqueue_script( 'yz-textcomplete', YZ_PA . 'js/textcomplete.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'yz-emojionearea', YZ_PA . 'js/emojionearea.min.js', array( 'jquery' ) );
    wp_enqueue_style( 'yz-emoji',  YZ_PA . 'css/emojionearea.min.css' );
    wp_enqueue_script( 'yz-emoji', YZ_PA . 'js/yz-emoji.min.js' );

}

/**
 * Emoji Scripts
 */
function yz_call_emoji_scripts() {

    // Get Emoji Visibility
    $emoji_visibility = array();
    
    if ( bp_is_messages_conversation() || bp_is_messages_compose_screen() ) {
            
        // Get Visibility Options.
        $messages_emoji = yz_options( 'yz_enable_messages_emoji' );

        if ( 'on' == $messages_emoji ) {
            $emoji_visibility['messages_visibility'] = $messages_emoji;
        }

    }

    if ( yz_is_activity_component() ) {

        // Get Visibility Options.
        $posts_emoji    = yz_options( 'yz_enable_posts_emoji' );
        $comments_emoji = yz_options( 'yz_enable_comments_emoji' );
        
        if ( 'on' == $posts_emoji ) {
            $emoji_visibility['posts_visibility'] = $posts_emoji;
        }

        if ( 'on' == $comments_emoji ) {
            $emoji_visibility['comments_visibility'] = $comments_emoji;
        }

    }

    if ( empty( $emoji_visibility ) ) {
        return false;
    }

    yz_emoji_scripts();

    // Localize Emoji Script.
    wp_localize_script( 'yz-emoji', 'Yz_Emoji', $emoji_visibility );

}

add_action( 'wp_enqueue_scripts', 'yz_call_emoji_scripts' );

/**
 * Widgets Enqueue scripts.
 */
function yz_widgets_enqueue_scripts( $hook_suffix ) {

    if ( 'widgets.php' !== $hook_suffix ) {
        return;
    }

    wp_enqueue_style( 'yz-iconpicker' );
    wp_enqueue_script( 'yz-iconpicker' );

}

add_action( 'admin_enqueue_scripts', 'yz_widgets_enqueue_scripts' );

