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

		$fields['billing']['billing_phone']['required'] = true;

		return $fields;
	}
);

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

		return $tabs;
	}
);

add_action(
	'wp_footer',
	static function () {
		if ( ! is_product() ) {
			return;
		}
		$product = wc_get_product( get_the_ID() );

		if ( ! $product instanceof WC_Product ) {
			return;
		}
		?>
		<div class="kc-mobile-sticky-atc" aria-hidden="true">
			<span class="kc-mobile-sticky-atc__price"><?php echo wp_kses_post( wc_price( $product->get_price() ) ); ?></span>
			<button class="wp-element-button kc-mobile-sticky-atc__button" type="button" data-kc-scroll-to-add>
				<?php esc_html_e( 'Add to cart', 'krystal-commerce' ); ?>
			</button>
		</div>
		<?php
	}
);
