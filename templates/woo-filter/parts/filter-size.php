<?php
/* Filter Size */
if ( 'yes' == $size ) {
	$attrs      = \FilterPlus\Utils\Helper::get_attributes( 'pa_size' );
	$title      = ! empty( $size_label ) ? $size_label : esc_html__( 'Best Match Item', 'filter-plus' );
	$get_attr   = array();
	foreach ( $attrs['terms'] as $key => $value ) {
		if ( ! empty( $value->term_id ) ) {
			$get_attr[ $key ]  = $value->term_id;
		}
	}
	if ( file_exists( \FilterPlus::plugin_dir() . 'templates/woo-filter/parts/filter-layout-grid.php' ) ) {
		include \FilterPlus::plugin_dir() . 'templates/woo-filter/parts/filter-layout-grid.php';
	}
}