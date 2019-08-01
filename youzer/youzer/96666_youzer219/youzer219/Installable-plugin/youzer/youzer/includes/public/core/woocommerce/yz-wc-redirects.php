<?php

class Youzer_WC_Redirects {


    public function __construct() {

        add_action( 'template_redirect',  array( &$this, 'get_redirect_link' ) );
        add_filter( 'page_link',  array( &$this, 'redirect_link' ), 10, 2 );
        add_filter( 'woocommerce_get_myaccount_page_permalink',  array( &$this, 'account_url' ) );
        add_filter( 'woocommerce_get_view_order_url', array( &$this, 'get_view_order_url' ), 10, 2 );
        add_filter( 'woocommerce_get_endpoint_url', array( $this, 'endpoint_url' ), 10, 4 ); 

    }

    /*
     * Change End Point.
     */
    public function endpoint_url( $url, $endpoint, $value, $permalink ) {

        // Init Vars.
        $default = $url;
        $base_path = yz_get_wocommerce_url();

        switch ( $endpoint ) {

            case 'order-pay':
                $checkout_page_id = wc_get_page_id( 'checkout' );
                $checkout_page = get_post( $checkout_page_id );
                $url = get_bloginfo( 'url' ) . '/' . $checkout_page->post_name . '/' . $endpoint . '/' . $value;
                break;

            case 'orders':
            case 'edit-address':
                $url = $base_path . $endpoint . '/' . $value;
                break;

            case 'payment-methods':
                $url = add_query_arg( $endpoint, 'w2ewe3423ert', $base_path . 'payment-methods' );
                break;

            case 'order-received':
                $checkout_page_id = wc_get_page_id( 'checkout' );
                $checkout_page = get_post( $checkout_page_id );
                $url = get_bloginfo( 'url' ) . '/' . $checkout_page->post_name . '/' . $endpoint . '/' . $value;
                
                // If checkout page do not exist, assign this url.
                if ( -1 === $checkout_page_id ) {
                        $url = $base_path . '/orders/view-order/' . $value;
                }

                break;

            case 'set-default-payment-method':
            case 'delete-payment-method':
                $url = add_query_arg( $endpoint, $value, $base_path . 'payment' );
                break;

            case 'add-payment-method':
                $url = add_query_arg( $endpoint, 'w2ewe3423ert', $base_path . 'payment-methods' );
                break;
        }

        return $url;

    }
    /**
     * Filter the account root url if needed.
     * WooCommerce use this to redirect the user when a form is submitted.
     */
    public function account_url( $url = '' ) {

        global $wp;
        
        if ( ! yz_is_woocommerce_tab() && ! apply_filters( 'yz_wc_account_url_use_everywhere', false ) && ! isset( $wp->query_vars['customer-logout'] ) ) {
            return $url;
        }
        
        if ( isset( $wp->query_vars['customer-logout'] ) ) {
            return bp_get_root_domain();
        } elseif ( isset( $wp->query_vars['edit-address'] ) ) {
            return yz_get_current_page_url();
        } else {
            return trailingslashit( bp_loggedin_user_domain() . yz_woocommerce_tab_slug() );
        }
    
    }

	/**
	 * Redirect Woocommerce My Account Page.
	 */
	function redirect_myaccount_page() {
		if ( is_user_logged_in() && is_account_page() && apply_filters( 'yz_wc_enable_my_account_redirect', true ) ) {
			$redirect_url = bp_loggedin_user_domain() . yz_woocommerce_tab_slug();
			wp_redirect( $redirect_url );
			exit;
		}
	}

    /**
     * Redirect.
     */
    function get_redirect_link( $page_link ) {
        
        global $post;

        if ( ! is_user_logged_in() || is_admin() || empty( $post->ID ) ) {
            return $page_link;
        }

        $link = $this->get_page_slug( $post->ID );
        
        if ( ! empty( $link ) ) {
            wp_safe_redirect( $link );
            exit;
        }
        
        return $page_link;

    }

    /**
     * Get Page Slug.
     */
    function get_page_slug( $page_id = null ) {
        
        global $wp;

        $cart_page     = wc_get_page_id( 'cart' );
        $checkout_page = wc_get_page_id( 'checkout' );
        $account_page  = wc_get_page_id( 'myaccount' );

        switch ( $page_id ) {
            
            case $cart_page:
                return yz_get_wocommerce_url( 'cart' );
                break;
            
            case $checkout_page:

                $slug = 'checkout';

                // Get Order Recieved Slug.
                if ( isset( $wp->query_vars['order-received'] ) && ! empty( $wp->query_vars['order-received'] ) ) {
                    $order_key = isset( $_GET['key'] ) ? $_GET['key'] : 0;
                    $slug .= '/order-received/' . $wp->query_vars['order-received'] . '/?key=' . $order_key;
                }    

                return yz_get_wocommerce_url( $slug );
                break;
            
            case $account_page:
                return yz_get_wocommerce_url();
                break;
            
            default:
                return;
                break;
        }

    }

    /**
     * Edit Woocoomerce Links.
     */
    public function redirect_link( $page_link, $post_id = false ) {

        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            return $this->get_woocommerce_page_link_by_id( $post_id, $page_link );
        }
        
        if ( empty( $post_id ) ) {
            return $page_link;
        }

        /**
         * Add more endpoint to avoid the rewrite of the url for the plugin
         *
         * @param array String values of the endpoint to by pass the url transform
         */
        $avoid_woo_endpoints = apply_filters( 'wc4bp_avoid_woo_endpoints', array( 'order-received', 'order-pay' ) );
        
        global $bp, $wp;
        
        if ( ( isset( $wp->query_vars['name'] ) && in_array( $wp->query_vars['name'], $avoid_woo_endpoints ) ) ) {
            return false;
        }

        foreach ( $avoid_woo_endpoints as $avoid_woo_endpoint ) {
            if ( isset( $wp->query_vars[ $avoid_woo_endpoint ] ) ) {
                return false;
            }
        }

        if ( ! empty( $bp->pages ) ) {

            // Get WC Pages.
            $cart_page_id     = wc_get_page_id( 'cart' );
            $checkout_page_id = wc_get_page_id( 'checkout' );
            $account_page_id  = wc_get_page_id( 'myaccount' );

            $granted_selected_pages_id = array();
            $granted_wc_pages_id       = array( $account_page_id, $checkout_page_id, $cart_page_id );

            
            if ( in_array( $post_id, $granted_wc_pages_id, true ) ) {
                switch ( $post_id ) {
                    
                    case $cart_page_id:
                            return yz_get_wocommerce_url( 'cart' );

                        break;

                    case $checkout_page_id:
                        return yz_get_wocommerce_url( 'checkout');
                        break;

                    case $account_page_id:
                        return yz_get_wocommerce_url();
                        break;
                }

                return $page_link;
            } else {
                return $page_link;
            }
        } else {
            return $page_link;
        }

        return $page_link;
    }

    /**
     * Get Page Link.
     */
    function get_woocommerce_page_link_by_id( $page_id, $page_link ) {

        // Get WC Pages.
        $cart_page_id     = wc_get_page_id( 'cart' );
        $checkout_page_id = wc_get_page_id( 'checkout' );
        $account_page_id  = wc_get_page_id( 'myaccount' );

        switch ( $page_id ) {
        
            case $cart_page_id:
                return yz_get_wocommerce_url( 'cart' );

            case $checkout_page_id:
                return yz_get_wocommerce_url( 'checkout');

            case $account_page_id:
                return yz_get_wocommerce_url();

            default :
            return $page_link;
        }        
    } 

    /**
     * Change url for view order endpoint.
     */
    function get_view_order_url( $view_order_url, $order ){
        
        $orders_url = yz_get_wocommerce_url( 'orders' );
        $view_order_url = wc_get_endpoint_url( 'view-order', $order->get_id(), $orders_url );

        return $view_order_url;
    }

}