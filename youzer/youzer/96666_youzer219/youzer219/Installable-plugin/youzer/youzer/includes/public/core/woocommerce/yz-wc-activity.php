<?php

class Youzer_WC_Activity {

    public function __construct() {
		add_action( 'woocommerce_order_status_completed', array( &$this, 'add_new_order_activity' ) );

		// Add Product to Activity Stream.
		add_action( 'save_post', array( &$this, 'add_product' ), 10, 3 );

		// Get Product Content.
		add_filter( 'yz_get_activity_content_body', array( &$this, 'get_activity_content' ), 10, 2 );

		// Add to cart with ajax.		
		add_action( 'wp_ajax_woocommerce_ajax_add_to_cart', array( &$this, 'add_to_cart' ) );
		add_action( 'wp_ajax_nopriv_woocommerce_ajax_add_to_cart', array( &$this, 'add_to_cart' ) );
		
		// Enable WC Activity Posts.    
		add_filter( 'yz_wall_post_types_visibility', array( &$this, 'enable_activity_posts' ) );
		add_filter( 'yz_wall_show_everything_filter_actions', array( &$this, 'add_show_everything_filter_actions' ) );

		$this->enable_product_posts = yz_options( 'yz_enable_wc_product_activity' );
		$this->enable_purchase_posts = yz_options( 'yz_enable_wc_product_activity' );

	}

	/**
	 * Enable Activity Woocommerce Posts Visibility.
	 */
	function enable_activity_posts( $post_types ) {
		if ( $this->enable_product_posts == 'on' ) {
	    	$post_types['new_wc_product'] = 'on';
		}
		if ( $this->enable_purchase_posts == 'on' ) {
	    	$post_types['new_wc_purchase'] = 'on';
		}
	    return $post_types;
	}


	/**
	 * Enable Activity Woocommerce Filter Visibility.
	 */
	function add_show_everything_filter_actions( $actions ) {

		if ( $this->enable_product_posts == 'on' ) {
			$actions[] = 'new_wc_product';
		}

		if ( $this->enable_purchase_posts == 'on' ) {
			$actions[] = 'new_wc_purchase';
		}
		
		return $actions;
	}

	/**
	 * Add prodcut to activity stream.
	 */
	function add_product( $post_id, $post, $update ) {

	    if ( $post->post_status != 'publish' || $post->post_type != 'product' || ! empty( $update ) ) {
	        return;
	    }

	    if ( ! $product = wc_get_product( $post ) ) {
	        return;
	    }

		$user_link = bp_core_get_userlink( $post->post_author );

	    // Get Activity Action.
		$action = apply_filters( 'yz_new_wc_product_action', sprintf(__( '%s added new product', 'youzer' ), $user_link ), $post_id );

		// record the activity
		bp_activity_add( array(
			'user_id'   => $post->post_author,
			'action'    => $action,
			'item_id'   => $post_id,
			'component' => yz_woocommerce_tab_slug(),
			'type'      => 'new_wc_product',
		) );

		return;

	}

	/**
	 * Adds an activity stream item when a user has purchased a new product(s).
	 */
	function add_new_order_activity( $order_id ) {

		if ( ! bp_is_active( 'activity' ) || yz_options( 'yz_enable_wc_purchase_activity' ) != 'on' ) {
			return false;
		}

		$order = new WC_Order( $order_id );

		if ( $order->get_status() != 'completed' ) {
			return false;
		}

		// Check is user is enabling purchases activities.
		$purchase_activity = get_user_meta( $order->get_customer_id(), 'yz_wc_purchase_activity', true );
		
		if ( 'off' == $purchase_activity ) {
			return false;
		}

		$user_link = bp_core_get_userlink( $order->get_customer_id() );

		// if several products - combine them, otherwise - display the product name
		$items = $order->get_items();
		$names    = array();

		/** @var WC_Order_Item_Product $item */
		foreach ( $items as $item ) {

			$product_name = '<a href="' . $item->get_product()->get_permalink() . '">' . $item->get_product()->get_name() . '</a>';

			/**
			 * Modify the string to insert into the BuddyPress Activity Stream on Order Complete
			 */
			$action = apply_filters( 'yz_new_wc_purchase_action', sprintf( __( '%s purchased %s', 'youzer' ), $user_link, $product_name ), $order, $items );

			// record the activity
			bp_activity_add( array(
				'user_id'   => $order->get_user_id(),
				'action'    => $action,
				'item_id'   => $item->get_product()->get_id(),
				'secondary_item_id' => $order_id,
				'component' => yz_woocommerce_tab_slug(),
				'type'      => 'new_wc_purchase',
			) );
			
		}

		return true;
	}

	/**
	 * Get Prodcut Post Content
	 */
	function get_activity_content( $content, $activity ) {


	    if ( 'new_wc_purchase' == $activity->type ) {

			$order = new WC_Order(  );

	    	// $items = $order->get_items();
			$product = wc_get_product( $activity->item_id );
			
			if ( empty( $product ) ) {
				return $content;
			}

    		$args = yz_wc_get_activity_product_args( $product );

	    	return  yz_get_woocommerce_product( $args );

		} elseif ( 'new_wc_product' == $activity->type ) {
			$product = wc_get_product( $activity->item_id  );
	    	$args = yz_wc_get_activity_product_args( $product );
	    	$content = yz_get_woocommerce_product( $args );
		}

		return $content;

	}

    /**
     * Add To Cart With Ajax.
     */    
	function add_to_cart() {

		// Get Product Data.
        $product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
        $quantity = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( $_POST['quantity'] );
        $variation_id = absint( $_POST['variation_id'] );
        $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
        $product_status = get_post_status($product_id);

        if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id) && 'publish' === $product_status ) {

            do_action( 'woocommerce_ajax_added_to_cart', $product_id );

            if ( 'yes' === get_option( 'woocommerce_cart_redirect_after_add' ) ) {
                wc_add_to_cart_message( array( $product_id => $quantity ), true);
            }

            WC_AJAX :: get_refreshed_fragments();

        } else {

            $data = array(
                'error' => true,
                'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id ) );

            echo wp_send_json( $data );
        }

        wp_die();
    }

}