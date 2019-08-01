<?php

class Youzer_WC_Templates {

    public function __construct() {

    	// Shortcodes.
		add_shortcode( 'youzer_woocommerce_orders',  array( &$this, 'orders' ) );
		add_shortcode( 'youzer_woocommerce_addresses',  array( &$this, 'addresses' ) );
		add_shortcode( 'youzer_woocommerce_downloads',  array( &$this, 'downloads' ) );
		add_shortcode( 'youzer_payment_methods',  array( &$this, 'payment_methods' ) );
		add_shortcode( 'youzer_woocommerce_edit_account',  array( &$this, 'edit_account' ) );

		// Template Filters.
		add_filter( 'woocommerce_locate_template',  array( &$this, 'locate_template' ), 0, 3 );
		add_filter( 'wc_get_template',  array( &$this, 'disable_themes_templates_on_profile' ), 10, 5 );

	}

	/**
	 * Edit Account Template
	 */
	function edit_account( $atts ) {
		wc_print_notices();
		wc_get_template(
	   		'myaccount/form-edit-account.php',
	   		array( 'user' => get_user_by( 'id', get_current_user_id() ) )
	   	);
	}

	/**
	 * Account Template
	 */
	function addresses( $atts ) {
		global $wp;
		wc_print_notices();
		$address_type = isset( $wp->query_vars['edit-address'] ) ? $wp->query_vars['edit-address'] : '';
		woocommerce_account_edit_address( $address_type );
	}


	/**
	 * Downloads Template.
	 */
	function downloads( $atts ) {
		wc_print_notices();
		woocommerce_account_downloads();
	}

	/**
	 * Orders ShortCode
	 */
	function orders( $atts ) {
		global $wp;
		wc_print_notices();
		// Get Current Page.		
		$current_page = isset( $wp->query_vars['orders'] ) ? $wp->query_vars['orders'] : 1;
		woocommerce_account_orders( $current_page );
	}

	/**
	 * Payment Methods
	 */
	function payment_methods( $atts ) {

		wc_print_notices();

		$args = array(
			'type'     => 'get',
			'param'    => 'add-payment-method',
			// 'default'  => $default,
			// 'sanitize' => $sanitize,
		);
		$args = wp_parse_args( $args, $defaults );
		if ( isset( $_GET['add-payment-method'] ) ) {
			
			$suffix  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			$path    = WC()->plugin_url() . 'assets/js/frontend/add-payment-method' . $suffix . '.js';
				$deps    = array( 'jquery', 'woocommerce' );
				$version = WC()->version;
				wp_register_script( 'wc-add-payment-method', $path, $deps, $version, true );
				wp_enqueue_script( 'wc-add-payment-method' );
				
			woocommerce_account_add_payment_method();

		} else {
			woocommerce_account_payment_methods();
		}
	}

	/**
	 * Disable Theme Template.
	 */
	function disable_themes_templates_on_profile( $located, $template_name, $args, $template_path, $default_path ) {
		
		if ( ! yz_is_woocommerce_tab() ) {
			return $located;
		}

		// Get Youzer Template
		$youzer_template = yz_wc_template_path();

		// Get Template Location.
		$located = wc_locate_template( $template_name, $youzer_template, $default_path );

		return $located;
	}

	/**
	 * Locate Woocommerce Template Path.
	 */
	function locate_template( $template, $template_name, $template_path ) {
		global $woocommerce;

		$_template = $template;

		if ( ! $template_path ) $template_path = $woocommerce->template_url;

		$plugin_path  = yz_wc_template_path() ;

		// Look within passed path within the theme - this is priority
		$template = locate_template( array( $template_path . $template_name, $template_name ) );

		// Modification: Get the template from this plugin, if it exists
		if ( ! $template && file_exists( $plugin_path . $template_name ) )
		$template = $plugin_path . $template_name;

		// Use default template
		if ( ! $template )
		$template = $_template;

		// Return what we found
		return $template;
	}

}
