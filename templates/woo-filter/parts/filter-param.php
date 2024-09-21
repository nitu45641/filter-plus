<!-- Filter By Size -->
<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Filter By Color */
if ( file_exists( \FilterPlus::plugin_dir() . 'templates/woo-filter/parts/filter-size.php') ) {
	include \FilterPlus::plugin_dir() . 'templates/woo-filter/parts/filter-size.php';
}

/* Filter By Color */
if ( file_exists( \FilterPlus::plugin_dir() . 'templates/woo-filter/parts/filter-color.php') ) {
	include \FilterPlus::plugin_dir() . 'templates/woo-filter/parts/filter-color.php';
}
?>