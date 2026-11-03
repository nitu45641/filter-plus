<!-- Filter By Size -->
<?php

if ( ! defined( 'ABSPATH' ) ) exit; 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Filter By Color */
if ( file_exists( \FilterPlus::locate_template( 'woo-filter/parts/filter-size.php' )) ) {
	\FilterPlus\Base\SidebarSections::start( 'size' );
	include \FilterPlus::locate_template( 'woo-filter/parts/filter-size.php' );
	\FilterPlus\Base\SidebarSections::end();
}

/* Filter By Color */
if ( file_exists( \FilterPlus::locate_template( 'woo-filter/parts/filter-color.php' )) ) {
	\FilterPlus\Base\SidebarSections::start( 'color' );
	include \FilterPlus::locate_template( 'woo-filter/parts/filter-color.php' );
	\FilterPlus\Base\SidebarSections::end();
}
