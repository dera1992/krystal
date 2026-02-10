<?php
/**
 * WooCommerce enhancements.
 *
 * @package KrystalCommerce
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter(
	'woocommerce_checkout_fields',
	static function ( $fields ) {
		unset( $fields['billing']['billing_company'] );
		unset( $fields['billing']['billing_address_2'] );
		unset( $fields['shipping']['shipping_company'] );
		unset( $fields['shipping']['shipping_address_2'] );

		if ( isset( $fields['billing']['billing_phone'] ) ) {
			$fields['billing']['billing_phone']['required'] = true;
		}

		return $fields;
	}
);

add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

add_filter(
	'woocommerce_product_tabs',
	static function ( $tabs ) {
		$tabs['shipping_policy'] = array(
			'title'    => __( 'Shipping & Returns', 'krystal-commerce' ),
			'priority' => 40,
			'callback' => static function () {
				echo wp_kses_post(
					'<h2>Shipping & Returns</h2><p>Orders typically ship within 1–2 business days. Returns are accepted within 30 days in original condition. Contact support for return authorization before sending items back.</p>'
				);
			},
		);

		$tabs['product_specs'] = array(
			'title'    => __( 'Specs', 'krystal-commerce' ),
			'priority' => 25,
			'callback' => static function () {
				wc_display_product_attributes( wc_get_product() );
			},
		);

		return $tabs;
	}
);

add_action(
	'template_redirect',
	static function () {
		if ( ! function_exists( 'is_product' ) || ! is_product() ) {
			return;
		}

		$product_id = get_queried_object_id();
		if ( ! $product_id ) {
			return;
		}

		$viewed_products = wp_parse_id_list( (array) json_decode( wp_unslash( $_COOKIE['kc_recently_viewed'] ?? '[]' ), true ) );
		$viewed_products = array_values( array_diff( $viewed_products, array( $product_id ) ) );
		array_unshift( $viewed_products, $product_id );
		$viewed_products = array_slice( $viewed_products, 0, 8 );

		wc_setcookie( 'kc_recently_viewed', wp_json_encode( $viewed_products ), time() + WEEK_IN_SECONDS );
	}
);

add_action(
	'woocommerce_after_single_product_summary',
	static function () {
		if ( ! function_exists( 'wc_get_product' ) ) {
			return;
		}

		$viewed_products = wp_parse_id_list( (array) json_decode( wp_unslash( $_COOKIE['kc_recently_viewed'] ?? '[]' ), true ) );
		$current_id      = get_the_ID();
		$viewed_products = array_values( array_diff( $viewed_products, array( $current_id ) ) );
		$viewed_products = array_slice( $viewed_products, 0, 4 );

		if ( empty( $viewed_products ) ) {
			return;
		}

		echo '<section class="kc-recently-viewed"><h2>' . esc_html__( 'Recently viewed', 'krystal-commerce' ) . '</h2>';
		echo do_shortcode( '[products ids="' . esc_attr( implode( ',', $viewed_products ) ) . '" columns="4" orderby="post__in"]' );
		echo '</section>';
	},
	25
);

add_action(
	'wp_footer',
	static function () {
		if ( ! function_exists( 'is_product' ) || ! is_product() || ! function_exists( 'wc_get_product' ) ) {
			return;
		}

		$product = wc_get_product( get_the_ID() );

		if ( ! $product instanceof WC_Product || ! $product->is_purchasable() ) {
			return;
		}
		?>
		<div class="kc-mobile-sticky-atc" aria-hidden="true">
			<span class="kc-mobile-sticky-atc__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
			<button class="wp-element-button kc-mobile-sticky-atc__button" type="button" data-kc-scroll-to-add>
				<?php esc_html_e( 'Add to cart', 'krystal-commerce' ); ?>
			</button>
		</div>
		<?php
	}
);
