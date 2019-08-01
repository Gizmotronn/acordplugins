<?php

/**
 * Check Is Youzer Panel Page.
 */
function is_youzer_panel_page( $page_name ) {

    // Is Panel.
    $is_panel = isset( $_GET['page'] ) && $_GET['page'] == $page_name ? true : false;

    return apply_filters( 'is_youzer_panel_page', $is_panel, $page_name );
}

/**
 * Check Is Youzer Panel Page.
 */
function is_youzer_panel_tab( $tab_name ) {

    // Is Panel.
    $is_tab = isset( $_GET['tab'] ) && $_GET['tab'] == $tab_name ? true : false;

    return apply_filters( 'is_youzer_panel_tab', $is_tab, $tab_name );
}

/**
 * Top Bar Youzer Icon Css
 */
function yz_bar_icons_css() {

    // Show "Youzer Panel" Bar Icon
    if ( is_super_admin() ) {

        echo '<style>
            #adminmenu .toplevel_page_youzer-panel img {
                padding-top: 5px !important;
            }
            </style>';
    }

}

add_action( 'wp_head','yz_bar_icons_css' );
add_action( 'admin_head','yz_bar_icons_css' );


/**
* Add Documentation Submenu.
*/
function yz_add_documentation_submenu() {

    global $submenu;
    
    // Add Documentation Url
    $documentation_url = 'http://kainelabs.com/docs/youzer/';

    // Add Documentation Menu.
    $submenu['youzer-panel'][] = array(
        __( 'Documentation','youzer' ),
        'manage_options',
        $documentation_url
    );

}

add_action( 'admin_menu', 'yz_add_documentation_submenu', 9999 );

/**
 * Check if page is an admin page  tab
 */
function yz_is_panel_tab( $page_name, $tab_name ) {

    if ( is_admin() && isset( $_GET['page'] ) && isset( $_GET['tab'] ) && $_GET['page'] == $page_name && $_GET['tab'] == $tab_name ) {
        return true;
    }

    return false;
}


/**
 * Get Panel Profile Fields.
 */
function yz_get_panel_profile_fields() {

    // Init Panel Fields.
    $panel_fields = array();

    // Get All Fields.
    $all_fields = yz_get_all_profile_fields();

    foreach ( $all_fields as $field ) {

        // Get ID.
        $field_id = $field['id'];

        // Add Data.
        $panel_fields[ $field_id ] = $field['name'];

    }

    // Add User Login Option Data.
    $panel_fields['user_login'] = __( 'Username', 'youzer' );

    return $panel_fields;
}

/**
 * Get Panel Profile Fields.
 */
function yz_get_user_tags_xprofile_fields() {

    // Init Panel Fields.
    $xprofile_fields = array();

    // Get xprofile Fields.
    $fields = yz_get_bp_profile_fields();

    foreach ( $fields as $field ) {

        // Get ID.
        $field_id = $field['id'];

        // Add Data.
        $xprofile_fields[ $field_id ] = $field['name'];

    }

    return $xprofile_fields;
}

/**
 * Run WP TO BP Patch Notice.
 */
function yz_move_wp_fields_to_bp_notice() {


    if ( ! get_option( 'install_youzer_2.1.5_options' ) ) {
        return false;
    }


    $already_installed = is_multisite() ? get_blog_option( BP_ROOT_BLOG, 'yz_patch_move_wptobp' ) : get_option( 'yz_patch_move_wptobp' );
    
    if ( $already_installed ) {
        return;
    }

    $patch_url = add_query_arg( array( 'page' => 'youzer-panel&tab=patches' ), admin_url( 'admin.php' ) );
    
    ?>
    <div class="notice notice-warning">
        <p><?php echo sprintf( __( "<strong>Youzer - Important Patch :<br> </strong>Please Run The Following Patch <strong><a href='%1s'>Move Wordpress Fields To The Buddypress Xprofile Fields.</a></strong> This patch will move all the previews users fields values to the new created buddypress fields so now you can have the full control over profile info tab and contact info tab fields also : Re-order them, Control their visibility or even remove them if you want.</strong>", 'youzer' ), $patch_url ); ?></p>
    </div>
    
    <?php

}

add_action( 'admin_notices', 'yz_move_wp_fields_to_bp_notice' );

/**
 * Mark Xprofile Component as a "Must-Use" Component
 */
function yz_mark_xprofile_component_as_must_use( $components, $type ) {

    if ( 'required' == $type ) {
        
        $components['xprofile'] = array(
            'title'       => __( 'Extended Profiles', 'buddypress' ),
            'description' => __( 'Customize your community with fully editable profile fields that allow your users to describe themselves.', 'buddypress' )
        );

        $components['settings'] = array(
            'title'       => __( 'Account Settings', 'buddypress' ),
            'description' => __( 'Allow your users to modify their account and notification settings directly from within their profiles.', 'buddypress' )
        );

    }

    return $components;
}

add_filter( 'bp_core_get_components', 'yz_mark_xprofile_component_as_must_use', 10, 2 );
