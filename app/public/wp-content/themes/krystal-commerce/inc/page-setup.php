<?php
/**
 * Theme page setup utilities.
 *
 * @package KrystalCommerce
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create required pages and assign core reading + WooCommerce pages.
 */
function krystal_commerce_setup_required_pages() {
	$pages = array(
		'home'                  => array( 'title' => 'Home', 'content' => '<!-- wp:paragraph --><p>Welcome to Krystal Commerce.</p><!-- /wp:paragraph -->' ),
		'shop'                  => array( 'title' => 'Shop', 'content' => '' ),
		'cart'                  => array( 'title' => 'Cart', 'content' => '' ),
		'checkout'              => array( 'title' => 'Checkout', 'content' => '' ),
		'my-account'            => array( 'title' => 'My Account', 'content' => '' ),
		'about'                 => array( 'title' => 'About', 'content' => '<!-- wp:pattern {"slug":"krystal-commerce/about-story"} /-->' ),
		'contact'               => array( 'title' => 'Contact', 'content' => '<!-- wp:pattern {"slug":"krystal-commerce/contact-layout"} /-->' ),
		'faq'                   => array( 'title' => 'FAQ', 'content' => '<!-- wp:pattern {"slug":"krystal-commerce/faq-content"} /-->' ),
		'shipping-returns'      => array( 'title' => 'Shipping & Returns', 'content' => '<!-- wp:pattern {"slug":"krystal-commerce/shipping-returns-content"} /-->' ),
		'privacy-policy'        => array( 'title' => 'Privacy Policy', 'content' => '' ),
		'terms-and-conditions'  => array( 'title' => 'Terms & Conditions', 'content' => '' ),
	);

	$page_ids = array();

	foreach ( $pages as $slug => $data ) {
		$existing_page = get_page_by_path( $slug, OBJECT, 'page' );

		if ( $existing_page instanceof WP_Post ) {
			$page_ids[ $slug ] = (int) $existing_page->ID;
			continue;
		}

		$page_ids[ $slug ] = (int) wp_insert_post(
			array(
				'post_title'   => $data['title'],
				'post_name'    => $slug,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => $data['content'],
			)
		);
	}

	if ( ! empty( $page_ids['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $page_ids['home'] );
	}

	if ( function_exists( 'WC' ) ) {
		$map = array(
			'woocommerce_shop_page_id'     => 'shop',
			'woocommerce_cart_page_id'     => 'cart',
			'woocommerce_checkout_page_id' => 'checkout',
			'woocommerce_myaccount_page_id'=> 'my-account',
		);

		foreach ( $map as $option => $slug ) {
			if ( ! empty( $page_ids[ $slug ] ) ) {
				update_option( $option, $page_ids[ $slug ] );
			}
		}
	}
}
add_action( 'after_switch_theme', 'krystal_commerce_setup_required_pages' );
