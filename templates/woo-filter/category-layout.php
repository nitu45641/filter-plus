<?php
/**
 * Category layout template.
 *
 * Renders the Filter Plus widget on WooCommerce product category archive pages
 * when "Enable Category Layout" is turned on.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header( 'shop' );

$filterplus_settings = get_option( 'filter_plus_category_settings', array() );
$filterplus_term     = get_queried_object();

// Pass the current category so the filter pre-selects it.
$filterplus_settings['current_cat_id'] = isset( $filterplus_term->term_id ) ? (int) $filterplus_term->term_id : '';

\FilterPlus\Base\DataFactory::instance()->woo_render_html( $filterplus_settings );

get_footer( 'shop' );
