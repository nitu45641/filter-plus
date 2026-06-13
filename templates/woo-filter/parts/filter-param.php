<!-- Filter By Size -->
<?php

if ( ! defined( 'ABSPATH' ) ) exit; 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Filter By Color */
if ( file_exists( \FilterPlus::locate_template( 'woo-filter/parts/filter-size.php' )) ) {
	include \FilterPlus::locate_template( 'woo-filter/parts/filter-size.php' );
}

/* Filter By Color */
if ( file_exists( \FilterPlus::locate_template( 'woo-filter/parts/filter-color.php' )) ) {
	include \FilterPlus::locate_template( 'woo-filter/parts/filter-color.php' );
}
