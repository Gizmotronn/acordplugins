<?php

/**
 * Get Xprofile Group Icon
 */
function yz_get_xprofile_group_icon( $group_id = null ) {

	// Get Group Icon. 
	$group_icon = get_option( 'yz_xprofile_group_icon_' . $group_id );

	// Get Icon Value.
	$icon = ! empty( $group_icon ) ? $group_icon : 'fas fa-info';

	return apply_filters( 'yz_xprofile_group_icon', $icon, $group_id );
}

/**
 * Display Spammer Profile as 404 Profile Page
 */
function yz_show_spammer_404() {

    if ( bp_displayed_user_id() && bp_is_user_spammer( bp_displayed_user_id() ) && ! bp_current_user_can( 'bp_moderate' ) ) {
        return true;
    }

    return false;
}

/**
 * Check is Page: Profile 404
 */
function yz_is_404_profile() {

    if ( yz_show_spammer_404() ) {
        return true;
    }

    global $wp;

    // Get Members Slug
    $members_slug = bp_get_members_slug();

    // Get Page Path.
    $page_path = isset( $wp->request ) ? $wp->request : null;

    if ( ! $page_path ) {
        return false;
    }

    // Get Sub Pages
    $sub_pages = explode( '/', $page_path );

    // Get Current Component.
    $component = isset( $sub_pages[0] ) ? $sub_pages[0] : null;

    if ( $component == $page_path ) {
        return;
    }

    // Get Buddypresss Values
    $bp = buddypress();

    // Get User ID.
    $user_id = ! empty( $bp->displayed_user->id ) ? $bp->displayed_user->id : 0;

    // Check if it's a 404 profile
    if ( strcasecmp( $members_slug, $component ) == 0 && 0 == $user_id ) {
        return true;
    }

    return false;
}

/**
 * Get Open Graph Tags
 */
function yz_get_open_graph_tags( $type = null, $url = null,  $title = nul, $description = null, $image = null ) {

    $type = ! empty( $type ) ? $type : 'profile';

    ?>

    <meta property="og:type" content="<?php echo $type; ?>"/>
    
    <?php if ( ! empty( $title ) ) : ?>
        <meta property="og:title" content="<?php echo $title; ?>"/>
    <?php endif; ?>


    <meta property="og:url" content="<?php echo $url; ?>"/>

    <?php if ( ! empty( $image ) ) : ?>
        <?php $image_size = yz_get_image_size( $image ); ?>
        <meta property="og:image" content="<?php echo $image; ?>"/>
        <meta property="og:image:url" content="<?php echo $image; ?>"/>
        <meta property="og:image:width" content="<?php echo $image_size[0]; ?>"/>
        <meta property="og:image:height" content="<?php echo $image_size[1]; ?>"/>
    <?php endif; ?>

    <?php if ( ! empty( $description ) ) : ?>
    	<?php $description = wp_strip_all_tags( $description ); ?>
        <meta property="og:description" content="<?php echo $description; ?>"/>
    <?php endif; ?>
    <?php 

}

/**
 * Default Cover Path
 */
function yz_get_default_profile_cover() {
    return apply_filters( 'yz_default_profile_cover', YZ_PA . 'images/geopattern.png' );
}

/**
 * # Navbar Settings Menu.
 */
function yz_get_social_buttons( $user_id = false ) {

    if ( ! is_user_logged_in() ) {
        return;
    }
    
    if ( ! bp_is_active( 'friends' ) && ! bp_is_active( 'messages' ) ) {
        return false;
    }

    ?>

    <div id="item-header" class="yz-social-buttons">
        <?php 
            if ( bp_is_active( 'friends' ) ) {
                bp_add_friend_button( $user_id );
            }
        ?>

        <?php do_action( 'yz_social_buttons', $user_id );  ?>
        
        <?php
            if ( ! yz_is_bpfollowers_active() ) {
                yz_send_private_message_button( $user_id );
            }
        ?>
    </div>

    <?php
}

/**
 * # Get Profile Layout
 */
function yz_get_profile_layout() {

    // Set Up Variable
    $header_layout = yz_options( 'yz_header_layout' );

    if ( false !== strpos( $header_layout, 'yzb-author' ) ) {
        $profile_layout = 'yz-vertical-layout';
    } else {
        $profile_layout = 'yz-horizontal-layout';
    }

    return $profile_layout;
}


/**
 * Add Profile Tabs
 */
function yz_add_profile_tabs() {

    global $bp;

    $user_domain = bp_loggedin_user_domain();

    $overview_args = apply_filters( 'yz_profile_overview_tab_args', array( 
        'position' => 1,
        'slug' => 'overview', 
        'default_subnav_slug' => 'overview',
        'parent_slug' => $bp->profile->slug,
        'name' => yz_options( 'yz_overview_tab_title' ), 
        'screen_function' => 'yz_profile_overview_tab_screen', 
        'parent_url' => $user_domain . '/overview/'
    ) );

    $info_args = apply_filters( 'yz_profile_info_tab_args', array( 
        'position' => 3,
        'slug' => 'info', 
        'default_subnav_slug' => 'info',
        'parent_slug' => $bp->profile->slug,
        'name' => yz_options( 'yz_info_tab_title' ), 
        'screen_function' => 'yz_profile_infos_tab_screen', 
        'parent_url' => $user_domain . '/info/'
    ) );

    $posts_args = apply_filters( 'yz_profile_posts_tab_args', array( 
        'position' => 4,
        'slug' => 'posts', 
        'default_subnav_slug' => 'posts',
        'parent_slug' => $bp->profile->slug,
        'name' => yz_options( 'yz_posts_tab_title' ), 
        'screen_function' => 'yz_profile_posts_tab_screen', 
        'parent_url' => $user_domain . '/posts/'
    ) );
    
    $comments_args = apply_filters( 'yz_profile_comments_tab_args', array( 
        'position' => 5,
        'slug' => 'comments', 
        'parent_slug' => $bp->profile->slug,
        'default_subnav_slug' => 'comments',
        'name' => yz_options( 'yz_comments_tab_title' ), 
        'screen_function' => 'yz_profile_comments_tab_screen', 
        'parent_url' => $user_domain . '/comments/'
    ) );

    // Add Overview Tab.
    bp_core_new_nav_item( $overview_args );
    // Add Infos Tab.
    bp_core_new_nav_item( $info_args );
    // Add Posts Tab.
    bp_core_new_nav_item( $posts_args );
    // Add Comments Tab.
    bp_core_new_nav_item( $comments_args );

    // Get Access.
    $access = bp_core_can_edit_settings();

    // Add My Profile Page.
    bp_core_new_nav_item(
        array( 
            'position' => 200,
            'slug' => 'yz-home', 
            'parent_slug' => $bp->profile->slug,
            'show_for_displayed_user' => $access,
            'default_subnav_slug' => 'yz-home',
            'name' => __( 'My Profile', 'youzer' ), 
            'parent_url' => bp_loggedin_user_domain() . '/yz-home/'
        )
    );

    do_action( 'yz_add_new_profile_tabs' );

}

add_action( 'bp_setup_nav', 'yz_add_profile_tabs', 100 );

/**
 * Add Custom Profile Tabs
 */
function yz_add_profile_custom_tabs() {
    
    global $bp;

    // Get Custom Tabs.
    $custom_tabs = yz_options( 'yz_custom_tabs' );

    if ( empty( $custom_tabs ) ) {
        return false;
    }

    foreach ( $custom_tabs as $tab_id => $data ) {

        // Hide Tab For Non Logged-In Users.
        if ( 'false' == $data['display_nonloggedin'] && ! is_user_logged_in() ) {
            continue;
        }

        // Get Slug.
        $tab_slug = yz_get_custom_tab_slug( $data['title'] );

        // Add New Tab.
        bp_core_new_nav_item(
            array( 
                'position' => 100,
                'slug' => $tab_slug, 
                'name' => $data['title'], 
                'default_subnav_slug' => $tab_slug,
                'parent_slug' => $bp->profile->slug,
                'screen_function' => 'yz_profile_custom_tab_screen', 
                'parent_url' => bp_loggedin_user_domain() . "/$tab_slug/"
            )
        );
    }

}

add_action( 'bp_setup_nav', 'yz_add_profile_custom_tabs' );

/**
 * Get Posts Tab Content
 */
function yz_profile_posts_tab_screen() {

    global $Youzer;

    // Call Posts Tab Content.
    add_action( 'bp_template_content', array( &$Youzer->tabs->posts, 'tab' ) );

    // Load Tab Template
    bp_core_load_template( 'buddypress/members/single/plugins' );

}

/**
 * Get Comments Tab Content
 */
function yz_profile_comments_tab_screen() {

    global $Youzer;

    // Call Posts Tab Content.
    add_action( 'bp_template_content', array( &$Youzer->tabs->comments, 'tab' ) );

    // Load Tab Template
    bp_core_load_template( 'buddypress/members/single/plugins' );

}

/**
 * Get Widgets Settings Tab Content
 */
function yz_profile_widgets_settings_tab_screen() {

    global $Youzer;

    // Call Posts Tab Content.
    add_action( 'bp_template_content', array( &$Youzer->account, 'get_widgets_settings' ) );

    // Load Tab Template
    bp_core_load_template( 'buddypress/members/single/plugins' );

}

/**
 * Get Custom Tab Content
 */
function yz_profile_custom_tab_screen() {

    global $Youzer;

    // Call Posts Tab Content.
    add_action( 'bp_template_content', array( &$Youzer->tabs->custom, 'tab' ) );

    // Load Tab Template
    bp_core_load_template( 'buddypress/members/single/plugins' );

}

/**
 * Get Overview Tab Content
 */
function yz_profile_overview_tab_screen() {

    global $Youzer;

    // Call Posts Tab Content.
    add_action( 'bp_template_content', array( &$Youzer->tabs->overview, 'tab' ) );

    // Load Tab Template
    bp_core_load_template( 'buddypress/members/single/plugins' );

}

/**
 * Get Infos Tab Content
 */
function yz_profile_infos_tab_screen() {

    global $Youzer;

    // Call Posts Tab Content.
    add_action( 'bp_template_content', array( &$Youzer->tabs->info, 'tab' ) );

    // Load Tab Template
    bp_core_load_template( 'buddypress/members/single/plugins' );

}

/**
 * # User Quick Buttons.
 */
function yz_user_quick_buttons( $user_id = false ) {

    $user_id = ! empty( $user_id ) ? $user_id : bp_loggedin_user_id();

    ?>

    <div class="yz-quick-buttons">        

        <?php if ( bp_is_active( 'friends' ) ) : ?>
            
            <?php 

                // Get Buttons Data
                $friends_url = bp_loggedin_user_domain() . bp_get_friends_slug();
                $friend_requests = bp_friend_get_total_requests_count( $user_id );
                $friends_link = ( $friend_requests > 0 ) ? $friends_url . '/requests' : $friends_url;

            ?>

            <a href="<?php echo $friends_link; ?>" class="yz-button-item yz-friends-btn">
                <span class="dashicons dashicons-groups"></span>
                <?php if ( $friend_requests > 0 ) : ?>
                    <div class="yz-button-count"><?php echo $friend_requests; ?></div>
                <?php endif; ?>
            </a>

        <?php endif; ?>

        <?php if ( bp_is_active( 'messages' ) ) : ?>
            
            <?php $msgs_nbr = bp_get_total_unread_messages_count( $user_id ); ?>
            
            <a href="<?php echo bp_nav_menu_get_item_url( 'messages' ); ?>" class="yz-button-item yz-messages-btn">
                <span class="dashicons dashicons-email-alt"></span>
                <?php if ( $msgs_nbr > 0 ) : ?>
                <div class="yz-button-count"><?php echo $msgs_nbr; ?></div>
                <?php endif; ?>
            </a>

        <?php endif; ?>
        
        <?php if ( bp_is_active( 'notifications' ) ) : ?>
    
            <?php $notification_nbr = bp_notifications_get_unread_notification_count( $user_id ); ?>
            
            <a href="<?php echo bp_nav_menu_get_item_url( 'notifications' ); ?>" class="yz-button-item yz-notification-btn">
                <i class="fas fa-globe-asia"></i>
                <?php if ( $notification_nbr > 0 ) : ?>
                <div class="yz-button-count"><?php echo $notification_nbr; ?></div>
                <?php endif; ?>
            </a>

        <?php endif; ?>

    </div>

    <?php
}

/**
 * Get User Profile Page.
 */
function yz_get_user_profile_page( $slug = false, $user_id = false ) {

    // Get User ID.
    $user_id = ! empty( $user_id ) ? $user_id : bp_displayed_user_id();

    // Get User Profile Url.
    $page_url = bp_core_get_user_domain( $user_id );

    if ( $slug ) {
        $page_url = $page_url . $slug;
    }

    return $page_url;
}

/**
 * # Get Post Thumbnail
 */
function yz_get_post_thumbnail( $args = false ) {

    $widget = isset( $args['widget'] ) ? $args['widget'] : 'post';

    if ( 'post' == $widget ) {

        // Get Post Data
        $post_id  = isset( $args['post_id'] ) ? $args['post_id'] : false;
        $img_size = isset( $args['img_size'] ) ? $args['img_size'] : 'large'; 

        if ( $post_id ) {
            $img_id  = get_post_thumbnail_id( $post_id );
            $img_url = wp_get_attachment_image_src( $img_id , $img_size );
            if ( ! empty( $img_url[0] ) ) {
                echo '<div class="yz-post-thumbnail" style="background-image: url(' . $img_url[0] . ');"></div>';
            } else {
                // Get Post Format
                $format = get_post_format();
                $format = ! empty( $format ) ? $format : 'standard';
                echo '<div class="yz-no-thumbnail">';
                echo '<div class="thumbnail-icon"><i class="'. yz_get_format_icon( $format ) .'"></i></div>';
                echo '</div>';
            }
        }
    } else {
        // Setup Variables.
        $img_url = isset( $args['img_url'] ) ? $args['img_url'] : false;
        if ( $img_url ) {
            echo "<div class='yz-$widget-thumbnail' style='background-image: url( $img_url );'></div>";
        } else {
            echo '<div class="yz-no-thumbnail">';
            echo '<div class="thumbnail-icon"><i class="fas fa-image"></i></div>';
            echo '</div>';
        }
    }

}

/**
 * Get All BP Fields
 */
function yz_get_bp_profile_fields() {
    // Init Fields.
    $fields = array();
    
    if ( ! bp_is_active( 'xprofile' ) ) {
        return $fields;
    }
    // Get Profile Groups Fields.    
    $profile_groups = BP_XProfile_Group::get( array( 'fetch_fields' => true ) );
    if ( ! empty( $profile_groups ) ) {
         foreach ( $profile_groups as $profile_group ) {
            if ( ! empty( $profile_group->fields ) ) {               
                foreach ( $profile_group->fields as $field ) {
                    $fields[] = array(
                        'id' => $field->id,
                        'name' => $field->name
                    );
                }
            }
        }
    }
    // Filter;
    $fields = apply_filters( 'yz_get_bp_profile_fields', $fields );
    return $fields;
}
/**
 * Get Xprofile fields by field type.
 */
function yz_get_xprofile_fields_by_type( $fields_type ) {
    
    global $wpdb;

    // Get Fields Table Name.
    $fields_table = buddypress()->profile->table_name_fields;

    // Get Sql Query.
    $sql = "SELECT id FROM {$fields_table} WHERE type = %s";

    // Get Fields ID'S.
    $fields_ids = $wpdb->get_col( $wpdb->prepare( $sql, $fields_type ) );

    return $fields_ids;
}