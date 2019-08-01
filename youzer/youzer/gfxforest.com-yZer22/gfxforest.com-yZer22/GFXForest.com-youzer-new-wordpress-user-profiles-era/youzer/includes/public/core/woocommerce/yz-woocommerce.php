<?php

class Youzer_Woocommerce {

	public function __construct() {

		// Init Vars.
		$this->name = __( 'Shop', 'youzer' );
		$this->slug = yz_woocommerce_tab_slug();

		// Init Classes.
		$this->templates = new Youzer_WC_Templates();

		if ( is_user_logged_in() ) {
			$this->redirects = new Youzer_WC_Redirects();
		}

		$this->activity = new Youzer_WC_Activity();

		// Hooks.
		add_action( 'bp_setup_nav',  array( &$this, 'setup_tabs' ) );
		add_action( 'bp_setup_admin_bar',  array( &$this, 'topbar_menu' ), 300 );
		add_action( 'yz_user_account_privacy_settings', array( &$this, 'privacy_settings' ) );
		add_filter( 'yz_default_options', array( $this, 'default_options' ) );
		add_action( 'yz_wall_posts_visibility_settings',  array( &$this, 'posts_visibility_settings' ) );

	}
	 
	/**
	 * # Setup Tabs.
	 */
	function setup_tabs() {
		
		$is_youzer_panel = is_youzer_panel();

		if ( bp_is_user() || $is_youzer_panel ) {

			$bp = buddypress();

			$access = bp_core_can_edit_settings();
			$parent_slug = bp_displayed_user_domain() . $this->slug . "/";

			// Add Woocommerce Tab.
			bp_core_new_nav_item(
				array( 
					'position' => 250,
					'slug' => $this->slug, 
					'parent_url' => $parent_slug,
					'default_subnav_slug' => apply_filters( 'yz_profile_woocommerce_default_tab', 'cart' ),
					'parent_slug' => $bp->profile->slug,
					'name' => __( 'Shop' , 'youzer' ), 
					'screen_function' => 'yz_woocommerce_screen',
				)
			);
		}

		if ( yz_is_woocommerce_tab() || $is_youzer_panel ) {

			$sub_tabs = yz_woocommerce_sub_tabs();

			foreach ( $sub_tabs as $key => $tab ) {
				bp_core_new_subnav_item( array(
						'slug' => $tab['slug'],
						'name' => $tab['name'],
						'parent_slug' => $this->slug,
						'parent_url' => $parent_slug,
						'position' => $tab['position'],
						'screen_function' => 'yz_woocommerce_screen',
						'user_has_access' => $access 
					)
				);
			}

		}
	}

	/**
	 * Add Top Bar Menu.
	 */
	function topbar_menu() {

		if ( ! apply_filters( 'yz_enable_woocommerce_top_bar_menu', true ) ) {
			return;
		}

		global $wp_admin_bar, $bp;

		if ( ! bp_use_wp_admin_bar() || defined( 'DOING_AJAX' ) ) {	
			return;
		}

		$user_domain = bp_loggedin_user_domain();
		$item_link = trailingslashit( $user_domain . $this->slug );

		// Get Main Menu
		$wp_admin_bar->add_menu(
			array(
				'parent'  => $bp->my_account_menu_id,
				'id'      => 'yz-wc-shop',
				'title'   => $this->name,
				'href'    => trailingslashit( $item_link ),
				'meta'    => array( 'class' => 'menupop' )
			)
		);
		
		// // Get Woocommerce Tabs.
		$tabs = yz_woocommerce_sub_tabs();

		if ( ! is_admin() && WC()->cart->get_cart_contents_count() == 0 ) {
			unset( $tabs['checkout'] ); 
		}
		
		// Get Submenu.
	    foreach ( $tabs as $slug => $tab ) {
			$wp_admin_bar->add_menu(
				array(
					'parent' => 'yz-wc-shop',
					'id'     => 'yz-wc-' . $slug,
					'title'  => $tab['name'],
					'href'   => trailingslashit( $item_link ) . $slug
				)
			);
	    }
	      
	}

	/**
	 * Privacy Settings
	 */
	function privacy_settings( $Yz_Settings ) {

        $Yz_Settings->get_field(
            array(
                'title' => __( 'Activity Stream Purchases', 'youzer' ),
                'desc'  => __( "Post my purchases in the activity stream.", 'youzer' ),
                'id'    => 'yz_wc_purchase_activity',
                'type'  => 'checkbox',
                'std'   => 'on',
            ), true, 'youzer_options'
        );

	}
	
	/**
	 * # Default Options 
	 */
	function default_options( $options ) {

	    // Options.
	    $yzsq_options = array(
			'yz_shop_tab_icon' => 'fas fa-shopping-cart',
			'yz_enable_wc_product_activity' => 'on',
			'yz_enable_wc_purchase_activity' => 'off',
			'yz_ctabs_' . $this->slug . '_cart_icon' => 'fas fa-shopping-cart',
			'yz_ctabs_' . $this->slug . '_checkout_icon' => 'far fa-credit-card',
			'yz_ctabs_' . $this->slug . '_track_icon' => 'fas fa-truck-moving',
			'yz_ctabs_' . $this->slug . '_orders_icon' => 'fas fa-shopping-basket',
			'yz_ctabs_' . $this->slug . '_downloads_icon' => 'fas fa-download',
			'yz_ctabs_' . $this->slug . '_edit-address_icon' => 'fas fa-address-card',
			'yz_ctabs_' . $this->slug . '_payment-methods_icon' => 'fas fa-credit-card',
			'yz_ctabs_' . $this->slug . '_edit-account_icon' => 'far fa-user-circle',
			'yz_ctabs_' . $this->slug . '_subscriptions_icon' => 'fas fa-clipboard-list',
	    );
	    
	    $options = array_merge( $options, $yzsq_options );

	    return $options;
	}

	/**
	 * Add Activity Posts Visibility
	 **/
	function posts_visibility_settings( $post_types ) {
	    
	    global $Yz_Settings;

	    $Yz_Settings->get_field(
	        array(
	            'type'  => 'checkbox',
	            'id'    => 'yz_enable_wc_product_activity',
	            'title' => __( 'New Product', 'youzer' ),
	            'desc'  => __( 'enable new product posts', 'youzer' ),
	        )
	    );
	    $Yz_Settings->get_field(
	        array(
	            'type'  => 'checkbox',
	            'id'    => 'yz_enable_wc_purchase_activity',
	            'title' => __( 'User Purchases', 'youzer' ),
	            'desc'  => __( 'enable users purchases posts', 'youzer' ),
	        )
	    );

	}

}