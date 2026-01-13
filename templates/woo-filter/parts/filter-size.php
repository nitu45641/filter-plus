<?php

if ( ! defined( 'ABSPATH' ) ) exit; 
if ( 'yes' !== $size ) {
	return;
}

/* Filter Size */
$filterplus_attrs      = \FilterPlus\Utils\Helper::get_attributes( 'pa_size' );
$title      = ! empty( $size_label ) ? $size_label : esc_html__( 'Best Match Item', 'filter-plus' );
$filterplus_get_attr   = array();
foreach ( $filterplus_attrs['terms'] as $filterplus_key => $filterplus_value ) {
	if ( ! empty( $filterplus_value->term_id ) ) {
		$filterplus_get_attr[ $filterplus_key ]  = $filterplus_value->term_id;
	}
}
if ( file_exists( \FilterPlus::plugin_dir() . 'templates/woo-filter/parts/filter-layout-grid.php' ) ) {
	include \FilterPlus::plugin_dir() . 'templates/woo-filter/parts/filter-layout-grid.php';
}
