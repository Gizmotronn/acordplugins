<?php

class Youzer_WC_Activity {

    public function __construct() {
    	
		// Get Product Content.
		add_filter( 'yz_get_activity_content_body', array( &$this, 'get_activity_content' ), 10, 2 );

		// Add to cart with ajax.		
		add_action( 'wp_ajax_woocommerce_ajax_add_to_cart', array( &$this, 'add_to_cart' ) );
		add_action( 'wp_ajax_nopriv_woocommerce_ajax_add_to_cart', array( &$this, 'add_to_cart' ) );
		
		// Enable WC Activity Posts.    
		add_filter( 'yz_wall_post_types_visibility', array( &$this, 'enable_activity_posts' ) );
		add_filter( 'yz_wall_show_everything_filter_actions', array( &$this, 'add_show_everything_filter_actions' ) );

		$this->enable_product_posts = yz_options( 'yz_enable_wc_product_activity' );
		$this->enable_purchase_posts = yz_options( 'yz_enable_wc_purchase_activity' );

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