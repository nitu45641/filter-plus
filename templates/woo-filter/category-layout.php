<?php
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals -- template file included in function scope
/**
 * Category layout template.
 *
 * Renders the Filter Plus widget on WooCommerce product category archive pages
 * when "Enable Category Layout" is turned on.
 *
 * Mirrors the structure of WooCommerce's own archive-product.php so the
 * active theme provides the correct content wrappers and sidebar columns.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header( 'shop' );

/**
 * woocommerce_before_main_content fires the theme's opening content wrapper
 * (e.g. storefront_before_content → <div id="primary"><main id="main">).
 * This keeps the page inside the same layout grid as every other WC page.
 */
do_action( 'woocommerce_before_main_content' );

$filterplus_settings = get_option( 'filter_plus_category_settings', array() );
$filterplus_term     = get_queried_object();

$filterplus_settings['current_cat_id'] = isset( $filterplus_term->term_id )
	? (int) $filterplus_term->term_id
	: '';

if ( ! defined( 'FP_CATEGORY_LAYOUT_RENDERING' ) ) {
	define( 'FP_CATEGORY_LAYOUT_RENDERING', true );
}
\FilterPlus\Base\DataFactory::instance()->woo_render_html( $filterplus_settings );

/**
 * woocommerce_after_main_content closes the wrapper opened above.
 * We deliberately skip woocommerce_sidebar because the filter plugin
 * already renders its own sidebar column inside the shopContainer.
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
