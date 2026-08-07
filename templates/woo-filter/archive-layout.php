<?php
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals -- template file included in function scope
/**
 * Product archive layout template.
 *
 * Renders the Filter Plus widget on the WooCommerce shop, category, and tag
 * archive pages when "Show FilterPlus Layout on Product Archive Page" is turned on.
 *
 * Mirrors the structure of WooCommerce's own archive-product.php so the
 * active theme provides the correct content wrappers and sidebar columns.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header( 'shop' );

do_action( 'woocommerce_before_main_content' );

if ( ! defined( 'FP_CATEGORY_LAYOUT_RENDERING' ) ) {
	define( 'FP_CATEGORY_LAYOUT_RENDERING', true );
}
$filterplus_settings   = \FilterPlus\Utils\Helper::get_settings();
$filterplus_is_archive = ! is_shop();

// This template also renders on the actual WooCommerce category archive
// (product_archive_template hook covers shop + category + tag). Lock the
// query to the current category server-side, otherwise products from every
// category get pulled in — see Helper::product_filter() / Actions::get_products().
$filterplus_term_id = '';
if ( is_product_category() ) {
	$filterplus_term    = get_queried_object();
	$filterplus_term_id = isset( $filterplus_term->term_id ) ? (int) $filterplus_term->term_id : '';
}

\FilterPlus\Base\DataFactory::instance()->woo_render_html( array(
	'template'            => ! empty( $filterplus_settings['product_archive_layout'] ) ? $filterplus_settings['product_archive_layout'] : '1',
	'show_categories'     => $filterplus_is_archive ? 'no' : 'yes',
	'enable_category_layout' => $filterplus_term_id ? 'yes' : 'no',
	'current_cat_id'      => $filterplus_term_id,
	'colors'              => 'yes',
	'size'                => 'yes',
	'show_tags'           => 'yes',
	'show_attributes'     => 'yes',
	'show_reviews'        => 'yes',
	'show_price_range'    => 'yes',
	'on_sale'             => 'yes',
	'stock'               => 'yes',
	'sorting'             => 'yes',
	'product_count'       => 'yes',
	'sub_categories'      => 'yes',
	'product_categories'  => 'yes',
	'product_tags'        => 'yes',
	'show_sale_badge'     => 'yes',
	'hide_prod_title'     => 'yes',
	'hide_prod_desc'      => 'yes',
	'hide_prod_price'     => 'yes',
	'hide_prod_add_cart'  => 'yes',
	'hide_prod_rating'    => 'yes',
) );

do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
