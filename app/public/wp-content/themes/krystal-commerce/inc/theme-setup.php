<?php
/**
 * Theme setup and assets.
 *
 * @package KrystalCommerce
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'after_setup_theme',
	static function () {
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
	}
);

add_action(
	'wp_enqueue_scripts',
	static function () {
		$theme = wp_get_theme();

		wp_enqueue_style(
			'krystal-commerce-style',
			get_theme_file_uri( 'assets/css/theme.css' ),
			array(),
			$theme->get( 'Version' )
		);

		if ( is_product() ) {
			wp_enqueue_script(
				'krystal-commerce-store',
				get_theme_file_uri( 'assets/js/store.js' ),
				array(),
				$theme->get( 'Version' ),
				true
			);
		}
	}
);
