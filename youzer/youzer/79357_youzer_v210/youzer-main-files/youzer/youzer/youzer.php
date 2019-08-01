<?php
/**
 * Plugin Name: Youzer
 * Plugin URI:  http://youzer.kainelabs.com
 * Description: Youzer is a Community & User Profiles Management Solution with a Secure Membership System, Front-end Account Settings, Powerful Admin Panel, 14 Header Styles, +20 Profile Widgets, 16 Color Schemes, Advanced Author Widgets, Fully Responsive Design, Extremely Customizable and a Bunch of Unlimited Features Provided By KaineLabs.
 * Version:     2.1.0
 * Author:      Youssef Kaine
 * Author URI:  http://www.kainelabs.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: youzer
 * Domain Path: /languages/
 */

if ( ! defined( 'WPINC' ) ) {
    die;
}

// Force Buddypress Legacy Theme.
add_theme_support( 'buddypress-use-legacy' );

// Youzer Basename
define( 'YOUZER_BASENAME', plugin_basename( __FILE__ ) );

// Youzer Path.
define( 'YZ_PATH', plugin_dir_path( __FILE__ ) );

// Youzer Path.
define( 'YZ_URL', plugin_dir_url( __FILE__ ) );

// Templates Path.
define( 'YZ_TEMPLATE', YZ_PATH . 'includes/public/templates/' );

// Public & Admin Core Path's
define( 'YZ_PUBLIC_CORE', YZ_PATH. 'includes/public/core/' );
define( 'YZ_ADMIN_CORE', YZ_PATH . 'includes/admin/core/' );

// Assets ( PA = Public Assets & AA = Admin Assets ).
define( 'YZ_PA', plugin_dir_url( __FILE__ ) . 'includes/public/assets/' );
define( 'YZ_AA', plugin_dir_url( __FILE__ ) . 'includes/admin/assets/' );

/**
 * Youzer Init.
 */
function youzer_init() {

    // If Parent Plugin is NOT active
    if ( current_user_can( 'activate_plugins' ) && ! class_exists( 'Buddypress' ) ) {
        add_action( 'admin_init', 'youzer_deactivate' );
        add_action( 'admin_notices', 'youzer_admin_notice' );

        // Deactivate Youzer.
        function youzer_deactivate() {
            deactivate_plugins( plugin_basename( __FILE__ ) );
        }

        // Throw an Alert to tell the Admin why it didn't activate.
        function youzer_admin_notice() {
            echo '<div class="error"><p>'
                . sprintf( __( '%1$s requires %2$s to function correctly. Please activate %2$s before activating %1$s. For now, the plugin has been deactivated.', 'textdomain' ), '<strong>' . __( 'Youzer', 'youzer' ) . '</strong>', '<strong><a target="_blank" class="youzer-download-button" href="https://fr.wordpress.org/plugins/buddypress/">' . __( 'Buddypress', 'youzer' ) . '</a></strong>' )
                . '</p></div>';
           if ( isset( $_GET['activate'] ) ) {
                unset( $_GET['activate'] );
           }
        }
    } else {

        // Init.
        require_once YZ_PATH . 'class.youzer.php';

        global $Youzer, $Youzer_Admin;

        // Init Class
        $Youzer = new Youzer();

        // Include Membership System.
        if ( yz_is_membership_system_active() ) {
            require_once YZ_PATH . 'includes/logy/logy.php';
        }

        // Init Admin
        if ( is_admin() ) {
            require_once YZ_PATH . 'includes/admin/class.youzer-admin.php';
            $Youzer_Admin = new Youzer_Admin();
        }

    }
}

add_action( 'plugins_loaded', 'youzer_init' );

/**
 * On Youzer Activation Hook.
 */
function youzer_activated_hook() {

    // Include Setuo File.    
    require_once YZ_PUBLIC_CORE . 'class-yz-setup.php';
    
    // Init Setup Class.
    $Youzer_Setup = new Youzer_Setup();

    // Install Youzer Options
    $Youzer_Setup->install_yz_options();

    // Install New Version Options.
    $Youzer_Setup->install_new_version_options();

    // Build Database.
    $Youzer_Setup->build_database_tables();

    // Install Pages
    $Youzer_Setup->install_pages();

    // Instam Reset Password E-mail.
    $Youzer_Setup->register_bp_reset_password_email();

    do_action( 'youzer_activated' );
}

register_activation_hook( __FILE__, 'youzer_activated_hook' );

/**
 * Load Youzer Text Domain!
 */
function youzer_localization() {

    $domain = 'youzer';
    $mofile_custom = trailingslashit( WP_LANG_DIR ) . sprintf( '%s-%s.mo', $domain, get_locale() );

    if ( is_readable( $mofile_custom ) ) {
        return load_textdomain( $domain, $mofile_custom );
    } else {
        return load_plugin_textdomain( $domain, FALSE, dirname( YOUZER_BASENAME ) . '/languages/' );

    }
}

add_action( 'plugins_loaded', 'youzer_localization' );
