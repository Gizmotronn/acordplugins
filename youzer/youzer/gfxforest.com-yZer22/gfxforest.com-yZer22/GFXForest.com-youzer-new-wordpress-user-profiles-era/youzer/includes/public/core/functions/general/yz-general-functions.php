<?php
/**
 * Force Xprofile Compoentn
 */
function yz_force_xprofile_activation( $components ) {

    if ( ! isset( $components['xprofile'] ) ) {
        $components['xprofile'] = 1;
    } elseif ( ! isset( $components['settings'] ) ) {
        $components['settings'] = 1;
    }

    return $components;
}

add_filter( 'bp_active_components', 'yz_force_xprofile_activation', 10 );

/**
 * Youzer Options
 */
function yz_options( $option_id ) {

    // Get Option Value.
    $option_value = get_option( $option_id );

    // Filter Option Value.
    $option_value = apply_filters( 'youzer_edit_options', $option_value, $option_id );

    if ( ! isset( $option_value ) || empty( $option_value ) ) {
        $Yz_default_options = yz_standard_options();
        if ( isset( $Yz_default_options[ $option_id ] ) ) {
            $option_value = $Yz_default_options[ $option_id ];
        }
    }

    return $option_value;
}

/**
 * # Get Option Array Values
 */
function yz_get_select_options( $option_id ) {

    // Set Up Variables
    $array_values  = array();
    $option_value  = get_option( $option_id );

    // Get Default Value
    if ( ! $option_value ) {
        $Yz_default_options = yz_standard_options();
        $option_value = $Yz_default_options[ $option_id ];
    }

    foreach ( $option_value as $key => $value ) {
        $array_values[ $value ] = $value;
    }

    return $array_values;
}

/**
 * # Youzer Standard Options .
 */
function yz_standard_options() {

    $default_options = array(

        // Author Box
        'yz_author_photo_effect'        => 'on',
        'yz_display_author_networks'    => 'on',
        'yz_enable_author_pattern'      => 'on',
        'yz_enable_author_overlay'      => 'on',
        'yz_author_photo_border_style'  => 'circle',
        'yz_author_sn_bg_type'          => 'silver',
        'yz_author_sn_bg_style'         => 'radius',
        'yz_author_meta_type'           => 'location',
        'yz_author_meta_type'           => 'full_location',
        'yz_author_meta_icon'           => 'map-marker',
        'yz_author_layout'              => 'yzb-author-v1',
        'yz_display_author_first_statistic' => 'on',
        'yz_display_author_third_statistic' => 'on',
        'yz_display_author_second_statistic'=> 'on',
        'yz_author_first_statistic' => 'posts',
        'yz_author_third_statistic' => 'views',
        'yz_author_second_statistic'=> 'comments',

        // Author Statistics.
        'yz_author_use_statistics_bg' => 'on',
        'yz_display_widget_networks' => 'on',
        'yz_author_use_statistics_borders' => 'on',

        // User Profile Header  
        'yz_profile_photo_effect'           => 'on',
        'yz_display_header_site'            => 'on',
        'yz_display_header_networks'        => 'on',
        'yz_display_header_location'        => 'on',
        'yz_enable_header_pattern'          => 'on',
        'yz_enable_header_overlay'          => 'on',
        'yz_header_enable_user_status'      => 'on',
        'yz_header_use_photo_as_cover'      => 'off',
        'yz_header_photo_border_style'      => 'circle',
        'yz_header_sn_bg_type'              => 'silver',
        'yz_header_sn_bg_style'             => 'circle',
        'yz_header_layout'                  => 'hdr-v1',
        'yz_header_meta_type'               => 'full_location',
        'yz_hheader_meta_type_1'            => 'full_location',
        'yz_hheader_meta_type_2'            => 'user_url',
        'yz_header_meta_icon'               => 'fas fa-map-marker-alt',
        'yz_hheader_meta_icon_1'            => 'fas fa-map-marker-alt',
        'yz_hheader_meta_icon_2'       	    => 'fas fa-link',
        'yz_header_use_statistics_bg'       => 'on',
        'yz_header_use_statistics_borders'  => 'off',
        'yz_display_header_first_statistic' => 'on',
        'yz_display_header_third_statistic' => 'on',
        'yz_display_header_second_statistic'=> 'on',
        'yz_header_first_statistic'         => 'posts',
        'yz_header_third_statistic'         => 'views',
        'yz_header_second_statistic'        => 'comments',

        // Group Header 
        'yz_group_photo_effect'                 => 'on',
        'yz_display_group_header_privacy'       => 'on',
        'yz_display_group_header_posts'         => 'on',
        'yz_display_group_header_members'       => 'on',
        'yz_display_group_header_networks'      => 'on',
        'yz_display_group_header_activity'      => 'on',
        'yz_enable_group_header_pattern'        => 'on',
        'yz_enable_group_header_overlay'        => 'on',
        'yz_enable_group_header_avatar_border'  => 'on',
        'yz_group_header_use_avatar_as_cover'   => 'on',
        'yz_group_header_sn_bg_type'            => 'silver',
        'yz_group_header_sn_bg_style'           => 'circle',
        'yz_group_header_layout'                => 'hdr-v1',
        'yz_group_header_avatar_border_style'   => 'circle',
        'yz_group_header_use_statistics_bg'     => 'on',
        'yz_group_header_use_statistics_borders'=> 'off',

        // WP Navbar
        'yz_disable_wp_menu_avatar_icon' => 'on',

        // Navbar
        'yz_display_navbar_icons' => 'on',
        'yz_profile_navbar_menus_limit' => 5,
        'yz_navbar_icons_style' => 'navbar-inline-icons',
        'yz_vertical_layout_navbar_type' => 'wild-navbar',

        // Posts Tab
        'yz_profile_posts_per_page'  => 5,
        'yz_display_post_meta'       => 'on',
        'yz_display_post_excerpt'    => 'on',
        'yz_display_post_date'       => 'on',
        'yz_display_post_cats'       => 'on',
        'yz_display_post_comments'   => 'on',
        'yz_display_post_readmore'   => 'on',
        'yz_display_posts_tab'       => 'on',
        'yz_display_post_meta_icons' => 'on',
        'yz_posts_tab_icon'          => 'fas fa-pencil-alt',
        'yz_posts_tab_title'         => __( 'Posts', 'youzer' ),

        // Overview Tab
        'yz_display_overview_tab' => 'on',
        'yz_overview_tab_icon'    => 'fas fa-globe-asia',
        'yz_bookmarks_tab_icon'    => 'fas fa-bookmark',
        'yz_reviews_tab_icon'       => 'fas fa-star',
        'yz_overview_tab_title'   => __( 'Overview', 'youzer' ),

        // Overview Tab
        'yz_display_wall_tab' => 'on',
        'yz_wall_tab_icon'    => 'fas fa-address-card',
        'yz_wall_tab_title'   => __( 'Wall', 'youzer' ),

        // infos Tab
        'yz_display_infos_tab'  => 'on',
        'yz_info_tab_icon'      => 'fas fa-info',
        'yz_info_tab_title' => __( 'Info', 'youzer' ),

        // Comments Tab
        'yz_profile_comments_nbr'     => 5,
        'yz_display_comment_date'     => 'on',
        'yz_display_comments_tab'     => 'on',
        'yz_display_view_comment'     => 'on',
        'yz_display_comment_username' => 'on',
        'yz_comments_tab_icon'        => 'far fa-comments',
        'yz_comments_tab_title'       => __( 'Comments', 'youzer' ),

        // Widgets Settings
        'yz_display_wg_title_icon' => 'on',
        'yz_use_wg_title_icon_bg'  => 'on',
        'yz_wgs_border_style'      => 'radius',

        // Display Widget Titles
        'yz_wg_sn_display_title'        => 'on',
        'yz_wg_link_display_title'      => 'off',
        'yz_wg_quote_display_title'     => 'off',
        'yz_wg_video_display_title'     => 'on',
        'yz_wg_rposts_display_title'    => 'on',
        'yz_wg_skills_display_title'    => 'on',
        'yz_wg_flickr_display_title'    => 'on',
        'yz_wg_about_me_display_title'  => 'on',
        'yz_wg_services_display_title'  => 'on',
        'yz_wg_portfolio_display_title' => 'on',
        'yz_wg_friends_display_title'   => 'on',
        'yz_wg_reviews_display_title'   => 'on',
        'yz_wg_groups_display_title'    => 'on',
        'yz_wg_instagram_display_title' => 'on',
        'yz_wg_slideshow_display_title' => 'off',
        'yz_wg_user_tags_display_title' => 'off',
        'yz_wg_user_badges_display_title' => 'on',
        'yz_wg_user_balance_display_title' => 'off',

        // Widget Titles
        'yz_wg_post_title'      => __( 'Post', 'youzer' ),
        'yz_wg_link_title'      => __( 'Link', 'youzer' ),
        'yz_wg_video_title'     => __( 'Video', 'youzer' ),
        'yz_wg_quote_title'     => __( 'Quote', 'youzer' ),
        'yz_wg_skills_title'    => __( 'Skills', 'youzer' ),
        'yz_wg_flickr_title'    => __( 'Flickr', 'youzer' ),
        'yz_wg_reviews_title'   => __( 'Reviews', 'youzer' ),
        'yz_wg_friends_title'   => __( 'Friends', 'youzer' ),
        'yz_wg_groups_title'    => __( 'Groups', 'youzer' ),
        'yz_wg_project_title'   => __( 'Project', 'youzer' ),
        'yz_wg_aboutme_title'   => __( 'About me', 'youzer' ),
        'yz_wg_services_title'  => __( 'Services', 'youzer' ),
        'yz_wg_portfolio_title' => __( 'Portfolio', 'youzer' ),
        'yz_wg_instagram_title' => __( 'Instagram', 'youzer' ),
        'yz_wg_user_tags_title' => __( 'User Tags', 'youzer' ),
        'yz_wg_slideshow_title' => __( 'Slideshow', 'youzer' ),
        'yz_wg_rposts_title'    => __( 'Recent posts', 'youzer' ),
        'yz_wg_sn_title'        => __( 'Keep in touch', 'youzer' ),
        'yz_wg_user_badges_title'  => __( 'user badges', 'youzer' ),
        'yz_wg_user_balance_title' => __( 'user balance', 'youzer' ),

        // Social Networks
        'yz_wg_sn_bg_style'   => 'radius',
        'yz_wg_sn_bg_type'    => 'colorful',
        'yz_wg_sn_icons_size' => 'full-width',

        // Badges.
        'yz_wg_max_user_badges_items' => 12,

        // Skills
        'yz_wg_max_skills' => 5,

        // About Me
        'yz_wg_aboutme_img_format' => 'circle',

        // Project
        'yz_display_prjct_meta' => 'on',
        'yz_display_prjct_tags' => 'on',
        'yz_display_prjct_meta_icons' => 'on',
        'yz_wg_project_types' => array(
            __( 'featured project', 'youzer' ),
            __( 'recent project', 'youzer' )
        ),

        // Post
        'yz_display_wg_post_meta'       => 'on',
        'yz_display_wg_post_readmore'   => 'on',
        'yz_display_wg_post_tags'       => 'on',
        'yz_display_wg_post_excerpt'    => 'on',
        'yz_display_wg_post_date'       => 'on',
        'yz_display_wg_post_comments'   => 'on',
        'yz_display_wg_post_meta_icons' => 'on',
        'yz_wg_post_types'              => array(
            __( 'featured post', 'youzer' ),
            __( 'recent post', 'youzer' )
        ),

        // Login Page Settings.
        'yz_login_page' => null,
        'yz_login_page_type' => 'url',
        'yz_enable_ajax_login' => 'off',
        'yz_enable_login_popup' => 'off',
        // 'yz_login_page_url' => wp_login_url(),

        // Services
        'yz_wg_max_services' => 4,
        'yz_display_service_icon' => 'on',
        'yz_display_service_text' => 'on',
        'yz_display_service_title' => 'on',
        'yz_wg_service_icon_bg_format' => 'circle',
        'yz_wg_services_layout' => 'vertical-services-layout',

        // Slideshow
        'yz_wg_max_slideshow_items' => 3,
        'yz_slideshow_height_type' => 'fixed',
        'yz_display_slideshow_title' => 'off',

        // Portfolio
        'yz_wg_max_portfolio_items' => 9,
        'yz_display_portfolio_url'  => 'on',
        'yz_display_portfolio_zoom' => 'on',
        'yz_display_portfolio_title' => 'on',

        // Flickr
        'yz_wg_max_flickr_items' => 6,

        // Friends
        'yz_wg_max_friends_items' => 5,
        'yz_wg_friends_layout' => 'list',
        'yz_wg_friends_avatar_img_format' => 'circle',

        // Groups
        'yz_wg_max_groups_items' => 3,
        'yz_wg_groups_avatar_img_format' => 'circle',

        // Instagram
        'yz_wg_max_instagram_items' => 9,
        'yz_display_instagram_url'  => 'on',
        'yz_display_instagram_zoom' => 'on',
        'yz_display_instagram_title' => 'on',

        // Recent Posts
        'yz_wg_max_rposts' => 3,
        'yz_wg_rposts_img_format' => 'circle',

        // Use Profile Effects
        'yz_use_effects' => 'off',
        'yz_profile_login_button' => 'on',

        // Profile Main Content Available Widgets
        'yz_profile_main_widgets' => array(
            array( 'slideshow'  => 'visible' ),
            array( 'project'    => 'visible' ),
            array( 'skills'     => 'visible' ),
            array( 'portfolio'  => 'visible' ),
            array( 'quote'      => 'visible' ),
            array( 'instagram'  => 'visible' ),
            array( 'services'   => 'visible' ),
            array( 'post'       => 'visible' ),
            array( 'link'       => 'visible' ),
            array( 'video'      => 'visible' ),
            array( 'reviews'    => 'visible' ),
        ),

        // Profile Sidebar Available Widgets
        'yz_profile_sidebar_widgets' => array (
            array( 'user_balance'    => 'visible' ),
            array( 'user_badges'     => 'visible' ),
            array( 'about_me'        => 'visible' ),
            array( 'social_networks' => 'visible' ),
            array( 'friends'         => 'visible' ),
            array( 'flickr'          => 'visible' ),
            array( 'groups'          => 'visible' ),
            array( 'recent_posts'    => 'visible' ),
            array( 'user_tags'       => 'visible' ),
            array( 'email'           => 'visible' ),
            array( 'address'         => 'visible' ),
            array( 'website'         => 'visible' ),
            array( 'phone'           => 'visible' ),
        ),

        // Profile 404
        'yz_profile_404_button' => __( 'Go Back Home', 'youzer' ),
        'yz_profile_404_desc'   => __( "we're sorry the profile you're looking for cannot be found.", 'youzer' ),

        // Profil Scheme.
        'yz_profile_scheme' => 'yz-blue-scheme',
        'yz_enable_profile_custom_scheme' => 'off',

        // Panel Options.
        'yz_enable_panel_fixed_save_btn' => 'on',
        'yz_panel_scheme' => 'uk-yellow-scheme',
        'yz_tabs_list_icons_style' => 'yz-tabs-list-gradient',

        // Tabs Settings.
        'yz_display_profile_tabs_count' => 'on',

        // Panel Messages.
        'yz_msgbox_mailchimp' => 'on',
        'yz_msgbox_captcha' => 'on',
        'yz_msgbox_logy_login' => 'on',
        'yz_msgbox_mail_tags' => 'off',
        'yz_msgbox_mail_content' => 'on',
        'yz_msgbox_ads_placement' => 'on',
        'yz_msgbox_profile_schemes' => 'on',
        'yz_msgbox_profile_structure' => 'on',
        'yz_msgbox_instagram_wg_app_setup_steps' => 'on',
        'yz_msgbox_custom_widgets_placement' => 'on',
        'yz_msgbox_user_badges_widget_notice' => 'on',
        'yz_msgbox_user_balance_widget_notice' => 'on',

        // Account Settings
        'yz_enable_account_scroll_button' => 'on',
        'yz_files_max_size' => 3,

        // Wall Settings
        'yz_enable_youzer_activity_filter' => 'on',
        'yz_enable_wall_url_preview' => 'on',
        'yz_enable_wall_activity_loader' => 'on',
        'yz_enable_wall_activity_effects' => 'on',
        'yz_enable_wall_posts_reply' => 'on',
        'yz_enable_wall_posts_likes' => 'on',
        'yz_enable_wall_posts_comments' => 'on',
        'yz_enable_wall_posts_deletion' => 'on',
        'yz_enable_activity_directory_filter_bar' => 'on',
        'yz_attachments_max_size' => 10,
        'yz_attachments_max_nbr'  => 200,
        'yz_atts_allowed_images_exts' => array(
            'png', 'jpg', 'jpeg', 'gif'
        ),
        'yz_atts_allowed_videos_exts' => array(
            'mp4', 'ogg', 'ogv', 'webm',
        ),
        'yz_atts_allowed_audios_exts' => array(
            'mp3', 'ogg', 'wav',
        ),
        'yz_atts_allowed_files_exts' => array(
            'png', 'jpg', 'jpeg', 'gif', 'doc', 'docx', 'pdf', 'rar',
            'zip', 'mp4', 'mp3', 'ogg', 'pfi'
        ),

        // Reviews Settings
        'yz_enable_reviews' => 'off',
        'yz_user_reviews_privacy' => 'public',
        'yz_allow_users_reviews_edition' => 'off',
        'yz_profile_reviews_per_page' => 25,
        'yz_wg_max_reviews_items' => 3,
        

        // Bookmarking Posts.
        'yz_enable_bookmarks' => 'on',
        'yz_enable_bookmarks_privacy' => 'private',

        // Sticky Posts.
        'yz_enable_sticky_posts' => 'on',
        'yz_enable_groups_sticky_posts' => 'on',
        'yz_enable_activity_sticky_posts' => 'on',
        
        // Scroll to top.
        'yz_display_scrolltotop' => 'off',
        'yz_display_group_scrolltotop' => 'off',
        'yz_enable_settings_copyright' => 'on',

        // Wall Posts Per Page
        'yz_activity_wall_posts_per_page' => 5,
        'yz_profile_wall_posts_per_page' => 5,
        'yz_groups_wall_posts_per_page' => 5,
        
        // Wall Settings.
        'yz_enable_wall_file' => 'on',
        'yz_enable_wall_link' => 'on',
        'yz_enable_wall_photo' => 'on',
        'yz_enable_wall_audio' => 'on',
        'yz_enable_wall_video' => 'on',
        'yz_enable_wall_quote' => 'on',
        'yz_enable_wall_status' => 'on',
        'yz_enable_wall_comments' => 'off',
        'yz_enable_wall_new_cover' => 'on',
        'yz_enable_wall_new_member' => 'on',
        'yz_enable_wall_slideshow' => 'on',
        'yz_enable_wall_filter_bar' => 'on',
        'yz_enable_wall_new_avatar' => 'on',
        'yz_enable_wall_joined_group' => 'on',
        'yz_enable_wall_posts_embeds' => 'on',
        'yz_enable_wall_new_blog_post' => 'on',
        'yz_enable_wall_created_group' => 'on',
        'yz_enable_wall_comments_embeds' => 'on',
        'yz_enable_wall_updated_profile' => 'off',
        'yz_enable_wall_new_blog_comment' => 'off',
        'yz_enable_wall_friendship_created' => 'on',
        'yz_enable_wall_friendship_accepted' => 'on',

        // Profile Settings
        'yz_allow_private_profiles' => 'off',

        // Profile Settings
        'yz_disable_bp_registration' => 'off',

        // Members Directory
        'yz_md_users_per_page' => 18,
        'yz_md_card_meta_icon' => 'at',
        'yz_enable_md_cards_cover' => 'on',
        'yz_enable_md_cards_status' => 'on',
        'yz_show_md_cards_online_only' => 'on',
        'yz_enable_md_users_statistics' => 'on',
        'yz_md_card_meta_field' => 'user_login',
        'yz_enable_md_custom_card_meta' => 'off',
        'yz_enable_md_cards_avatar_border' => 'off',
        'yz_enable_md_user_followers_statistics' => 'on',
        'yz_enable_md_user_following_statistics' => 'on',
        'yz_enable_md_user_points_statistics' => 'on',
        'yz_enable_md_user_views_statistics' => 'on',
        'yz_enable_md_cards_actions_buttons' => 'on',
        'yz_enable_md_user_posts_statistics' => 'on',
        'yz_enable_md_user_friends_statistics' => 'on',
        'yz_enable_md_user_comments_statistics' => 'on',

        // Groups Directory
        'yz_gd_groups_per_page' => 18,
        'yz_enable_gd_cards_cover' => 'on',
        'yz_show_gd_cards_online_only' => 'on',
        'yz_enable_gd_groups_statistics' => 'on',
        'yz_enable_gd_cards_avatar_border' => 'on',
        'yz_enable_gd_cards_actions_buttons' => 'on',
        'yz_enable_gd_group_posts_statistics' => 'on',
        'yz_enable_gd_group_members_statistics' => 'on',
        'yz_enable_gd_group_activity_statistics' => 'on',

        // Groups Directory - Styling
        'yz_gd_cards_buttons_border_style' => 'oval',
        'yz_gd_cards_avatar_border_style' => 'circle',
        'yz_gd_cards_buttons_layout' => 'block',

        // Members Directory - Styling
        'yz_md_cards_buttons_layout' => 'block',
        'yz_md_cards_buttons_border_style' => 'oval',
        'yz_md_cards_avatar_border_style' => 'circle',

        // Custom Styling.
        'yz_enable_global_custom_styling'   => 'off',
        'yz_enable_profile_custom_styling'  => 'off',
        'yz_enable_account_custom_styling'  => 'off',
        'yz_enable_activity_custom_styling' => 'off',
        'yz_enable_groups_custom_styling'   => 'off',
        'yz_enable_groups_directory_custom_styling'  => 'off',
        'yz_enable_members_directory_custom_styling' => 'off',

        // Emoji Settings.
        'yz_enable_posts_emoji' => 'on',
        'yz_enable_comments_emoji' => 'on',
        'yz_enable_messages_emoji' => 'on',

        // General.
        'yz_buttons_border_style' => 'oval',
        'yz_activate_membership_system' => 'on',

        // Account Verification
        'yz_enable_account_verification' => 'on',

        // Login Form
        'logy_login_form_enable_header'     => 'on',
        'logy_user_after_login_redirect'    => 'home',
        'logy_after_logout_redirect'        => 'login',
        'logy_admin_after_login_redirect'   => 'dashboard',
        'logy_login_form_layout'            => 'logy-field-v1',
        'logy_login_icons_position'         => 'logy-icons-left',
        'logy_login_actions_layout'         => 'logy-actions-v1',
        'logy_login_btn_icons_position'     => 'logy-icons-left',
        'logy_login_btn_format'             => 'logy-border-radius',
        'logy_login_fields_format'          => 'logy-border-flat',
        'logy_login_form_title'             => __( 'Login', 'youzer' ),
        'logy_login_signin_btn_title'       => __( 'Log In', 'youzer' ),
        'logy_login_register_btn_title'     => __( 'Create New Account', 'youzer' ),
        'logy_login_lostpswd_title'         => __( 'Lost password?', 'youzer' ),
        'logy_login_form_subtitle'          => __( 'Sign in to your account', 'youzer' ),

        // Social Login
        'logy_social_btns_icons_position'   => 'logy-icons-left',
        'logy_social_btns_format'           => 'logy-border-radius',
        'logy_social_btns_type'             => 'logy-only-icon',
        'logy_enable_social_login'          => 'on',
        'logy_use_auth_modal'               => 'on',
        'logy_enable_social_login_email_confirmation' => 'on',

        // Lost Password Form
        'logy_lostpswd_form_enable_header'  => 'on',
        'logy_lostpswd_form_title'          => __( 'Forgot your password?', 'youzer' ),
        'logy_lostpswd_submit_btn_title'    => __( 'Reset Password', 'youzer' ),
        'logy_lostpswd_form_subtitle'       => __( 'Reset your account password', 'youzer' ),

        // Register Form
        'logy_show_terms_privacy_note'      => 'on',
        'logy_signup_form_enable_header'    => 'on',
        'logy_signup_form_layout'           => 'logy-field-v1',
        'logy_signup_icons_position'        => 'logy-icons-left',
        'logy_signup_actions_layout'        => 'logy-regactions-v1',
        'logy_signup_btn_icons_position'    => 'logy-icons-left',
        'logy_signup_btn_format'            => 'logy-border-radius',
        'logy_signup_fields_format'         => 'logy-border-flat',
        'logy_signup_signin_btn_title'      => __( 'Log In', 'youzer' ),
        'logy_signup_form_title'            => __( 'Sign Up', 'youzer' ),
        'logy_signup_register_btn_title'    => __( 'Sign Up', 'youzer' ),
        'logy_signup_form_subtitle'         => __( 'Create New Account', 'youzer' ),

        // Limit Login Settings
        'logy_long_lockout_duration'    => 86400,
        'logy_short_lockout_duration'   => 43200,
        'logy_retries_duration'         => 1200,
        'logy_enable_limit_login'       => 'on',
        'logy_allowed_retries'          => 4,
        'logy_allowed_lockouts'         => 2,

        // User Tags Settings
        'yz_enable_user_tags' => 'on',
        'yz_enable_user_tags_icon' => 'on',
        'yz_enable_user_tags_description' => 'on',
        'yz_wg_user_tags_border_style' => 'radius',

        // Mail Settings
        'yz_enable_woocommerce' => 'off',
        'yz_enable_mailster' => 'off',
        'yz_enable_mailchimp' => 'off',
        'logy_notify_admin_on_registration' => 'on',

        // Admin Toolbar & Dashboard
        'logy_hide_subscribers_dash' => 'off',

        // Captcha.
        'logy_enable_recaptcha' => 'on',

        // Panel Messages.
        'logy_msgbox_captcha' => 'on',
        'yz_active_styles' => array(),

    );
    
    // Filter.
    $default_options = apply_filters( 'yz_default_options', $default_options );
    
    return $default_options;
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
 * Get Current Page Url
 */
function yz_get_current_page_url() {

    // Build the redirect URL.
    $redirect_url  = is_ssl() ? 'https://' : 'http://';
    $redirect_url .= $_SERVER['HTTP_HOST'];
    $redirect_url .= $_SERVER['REQUEST_URI'];

    return $redirect_url;
}

/**
 * # Class Generator.
 */
function yz_generate_class( $classes ) {
    // Convert Array to String.
    return implode( ' ' , array_filter( (array) $classes ) );
}


/**
 * # Get Profile Photo.
 */
function yz_get_image_url( $img_url = null ) {

    if ( ! empty( $img_url ) ) {
        $img_path = $img_url;
    } else {
        $img_path = YZ_PA . 'images/default-img.png';
    }

    return $img_path;
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
            <i class="fas fa-times uk-popup-close"></i>
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

    <i class="fas fa-exclamation-triangle"></i>
    <h3><?php _e( 'Oops!', 'youzer' ); ?></h3>
    <div class="uk-msg-content"></div>

    <?php endif;

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
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
                <span><?php _e( 'Please wait ...', 'youzer' ); ?></span>
            </div>
        </div>
    </div>

    <?php

}


/**
 * # Get User Data
 */
function yz_data( $key, $user_id = null ) {

    do_action( 'yz_before_get_data', $key, $user_id );

    // Get User ID.
    $user_id = ! empty( $user_id ) ? $user_id : bp_displayed_user_id();
    
    // Get user informations.
    $user_data = get_the_author_meta( $key, $user_id );

    return apply_filters( 'yz_get_user_data', $user_data, $user_id, $key );

}

/**
 * Check if tab is a Custom Tab.
 */
function yz_is_custom_tab( $tab_name ) {
    if ( false !== strpos( $tab_name, 'yz_custom_tab_' ) ) {
        return true;
    }
    return false;
}

/**
 * # Get Youzer Page Template.
 */
function youzer_template( $old_template ) {

    // New Template.
    $new_template = $old_template;

    // Init Var.
    $enable_youzer_page = bp_current_component() && ! is_404();

    // Filter
    $enable_youzer_page = apply_filters( 'yz_enable_youzer_page', $enable_youzer_page );

    // Check if its youzer plugin page
    if ( $enable_youzer_page ) {
        $new_template = YZ_TEMPLATE . 'youzer-template.php';
    }

    return apply_filters( 'youzer_template', $new_template, $old_template );

}

add_filter( 'template_include', 'youzer_template', 99999 );


/**
 * Get File URL By Name.
 */
function yz_get_file_url( $file ) {
    
    if ( empty( $file ) ) {
        return false;
    }

    global $YZ_upload_url;

    // Init Vars.
    $file_name = null;

    $compression_enabled = apply_filters( 'yz_enable_attachments_compression', true );

    // Prepare Url.
    if ( $compression_enabled ) {
        if ( isset( $file['thumbnail'] ) && $file['thumbnail'] != 'false' ) {
            $file_name = $file['thumbnail'];
        } else {
            $file_name = yz_save_image_thumbnail( $file );
        }
    }

    if ( empty( $file_name ) ) {

        // Get Backup File.
        $backup_file = isset( $file['file_name'] ) ? $file['file_name'] : $file;

        // Get File Name.
        $file_name = isset( $file['original'] ) ? $file['original'] : $backup_file;

    }

    // Return File Url.
    return $YZ_upload_url . $file_name;

}

/**
 * Save New Thumbnail
 */
function yz_save_image_thumbnail( $file, $activity_id = null ) {
    
    global $YZ_upload_dir;  

    // Get image from file
    $img = false;

    // Get Backup File.
    $backup_file = isset( $file['file_name'] ) ? $file['file_name'] : $file;

    // Get Filename.
    $filename = isset( $file['original'] ) ? $file['original'] : $backup_file;

    // Get File Type.
    $file_type = wp_check_filetype( $filename );

    // Get File Name.
    $file_name = pathinfo( $filename, PATHINFO_FILENAME );

    // Get File Path.
    $file_path = $YZ_upload_dir . $filename;

    // Get New Image Path.
    $new_img_path = $YZ_upload_dir . $file_name . '_thumb.jpg';

    switch ( $file_type['type'] ) {

        case 'image/jpeg': {
            $img = imagecreatefromjpeg( $file_path );
            break;          
        }

        case 'image/png': {
            $img = imagecreatefrompng( $file_path );
            break;          
        }

    }
    
    if ( empty( $img ) ) {
        return false;
    }

    // Get Compression Quality.
    $quality = apply_filters( 'yz_attachments_compression_quality', 80 );

    if ( imagejpeg( $img, $new_img_path , $quality ) ) {

        // Get New File Name.
        $file_basename = $file_name . '_thumb.jpg';

        if ( yz_is_activity_component() ) {

            // Get Activity ID.
            $activity_id = bp_get_activity_id() ? bp_get_activity_id() : $activity_id;

            // Get Attachments.
            $attachments = (array) unserialize( bp_activity_get_meta( $activity_id, 'attachments' ) );

            // Get File Key
            $file_key = array_search( $file, $attachments );

            // // Add Thumbnail To Data.
            $attachments[ $file_key ]['thumbnail'] = $file_basename;

            // Serialize Data.
            $attachments = serialize( $attachments );
            
            // Update Data.
            bp_activity_update_meta( $activity_id, 'attachments', $attachments );

        }

        return $file_basename;

    }
    
    return false;

}

/**
 * Get Notification Icon.
 */
function yz_get_notification_icon( $args ) {

    switch ( $args->component_action ) {

        case 'new_at_mention':
            $icon = '<i class="fas fa-at"></i>';
            break;
            
        case 'membership_request_accepted':
            $icon = '<i class="fas fa-thumbs-up"></i>';
            break;

        case 'membership_request_rejected':
            $icon = '<i class="fas fa-thumbs-down"></i>';
            break;

        case 'member_promoted_to_admin':
            $icon = '<i class="fas fa-user-secret"></i>';
            break;

        case 'member_promoted_to_mod':
            $icon = '<i class="fas fa-shield-alt"></i>';
            break;

        case 'bbp_new_reply':
        $icon = '<i class="fas fa-reply"></i>';
            break;              
        case 'update_reply':
            $icon = '<i class="fas fa-reply-all"></i>';
            break;

        case 'new_message':
            $icon = '<i class="fas fa-envelope"></i>';
            break;

        case 'friendship_request':
            $icon = '<i class="fas fa-handshake"></i>';
            break;

        case 'friendship_accepted':
            $icon = '<i class="fas fa-hand-peace"></i>';
            break;

        case 'new_membership_request':
            $icon = '<i class="fas fa-sign-in-alt"></i>';
            break;

        case 'group_invite':
            $icon = '<i class="fas fa-user-plus"></i>';
            break;

        case 'new_follow':
            $icon = '<i class="fas fa-share-alt"></i>';
            break;

        case 'yz_new_like':
            $icon = '<i class="fas fa-heart"></i>';
            break;

        default:
            $icon = '<i class="fas fa-bell"></i>';
            break;
    }

    return $icon;
}

/**
 * # Get Posts Excerpt.
 */
function yz_get_excerpt( $content, $limit = 12 ) {

    // Strip Shortcodes
    $excerpt = strip_shortcodes( $content ); 

    // Strip Tag.
    $excerpt = wp_strip_all_tags( $excerpt );

    $excerpt = explode( ' ', $excerpt, $limit );

    if ( count( $excerpt ) >= $limit ) {
        array_pop( $excerpt );
        $excerpt = implode( " ", $excerpt ) . '...';
    } else {
        $excerpt = implode( " ", $excerpt );
    }

    $excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

    $excerpt = apply_filters( 'yz_get_excerpt', $excerpt, $content, $limit );
    
    return $excerpt;
}

/**
 * # Get Post Format Icon.
 */
function yz_get_format_icon( $format = "standard" ) {

    switch ( $format ) {
        case 'video':
            return "fas fa-video";
            break;

        case 'image':
            return "fas fa-image";
            break;

        case 'status':
            return "fas fa-pencil-alt";
            break;

        case 'quote':
            return "fas fa-quote-right";
            break;

        case 'link':
            return "fas fa-link";
            break;

        case 'gallery':
            return "fas fa-images";
            break;

        case 'standard':
            return "fas fa-file-alt";
            break;

        case 'audio':
            return "fas fa-volume-up";
            break;

        default:
            return "fas fa-pencil-alt";
            break;
    }
}

/**
 * Get Product Images
 */
function yz_get_product_image( $args = null ) {

    if ( $args ) {
        echo "<a data-lightbox='yz-product-{$args['id']}' href='{$args['original']}' class='yz-product-thumbnail' style='background-image: url({$args['thumbnail']});'></a>";
    } else {
        echo '<div class="yz-no-thumbnail">';
        echo '<div class="thumbnail-icon"><i class="fas fa-image"></i></div>';
        echo '</div>';
    }

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

/**
 * Check is bbpress is Installed & Active.
 */
function yz_is_bbpress_active() {
    
    if ( ! yz_is_bbpress_installed() ) {
        return false;
    }

    // Get Value.
    $is_bbpress_enabled = yz_options( 'yz_enable_bbpress' );

    if ( 'off' == $is_bbpress_enabled ) {
        return false;
    }

    return true;
}

/**
 * Check is Woocommerce is Installed & Active.
 */
function yz_is_woocommerce_installed() {

    if ( ! class_exists( 'Woocommerce' ) )  {
        return false;
    }

    return true;

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
    
    if ( yz_is_bbpress_active() ) {

        register_sidebar(
            array (
                'name' => __( 'Forum Sidebar', 'youzer' ),
                'id' => 'yz-forum-sidebar',
                'description' => __( 'Forums Pages Sidebar', 'youzer' ),
                'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
                'after_widget' => "</div>",
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            )
        );

    }
}

add_action( 'widgets_init', 'yz_new_sidebars' );

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