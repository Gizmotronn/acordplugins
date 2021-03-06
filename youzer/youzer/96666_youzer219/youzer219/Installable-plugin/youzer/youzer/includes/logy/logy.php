<?php
// Main Path.
define( 'LOGY_PATH', plugin_dir_path( __FILE__ ) );
define( 'LOGY_URL', plugin_dir_url( __FILE__ ) );

// Public & Admin Core Path's
define( 'LOGY_CORE', LOGY_PATH. 'includes/public/core/' );
define( 'LOGY_ADMIN', LOGY_PATH . 'includes/admin/' );

// Assets ( PA = Public Assets ).
define( 'LOGY_PA', plugin_dir_url( __FILE__ ) . 'includes/public/assets/' );

// Templates Path.
define( 'LOGY_TEMPLATE', LOGY_PATH . 'includes/public/templates/' );

global $Logy, $Logy_Admin;

// Init.
require_once LOGY_PATH . 'class.logy.php';

// Init Class
$Logy = new Logy();

// Init Admin
if ( is_admin() ) {
    require_once LOGY_PATH . 'includes/admin/class-logy-admin.php';
    $Logy_Admin = new Logy_Admin();
}