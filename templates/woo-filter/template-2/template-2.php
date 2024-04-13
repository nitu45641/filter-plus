<?php

if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="shop-sidebar checkbox-style sidebar-style-<?php echo esc_attr($template);?>">
	<?php include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/left-side/title.php"; ?>
	<?php include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/left-side/product-search.php"; ?>
	<?php include_once \FilterPlus::plugin_dir() . "templates/woo-filter/parts/categories-checkbox.php"; ?>
	<?php 
		if (class_exists('FilterPlusPro')) {
			// reviews
			if ( 'yes'== $show_reviews &&
			file_exists(\FilterPlusPro::plugin_dir() . "templates/woo-filter/parts/rating.php")
			) {
				include_once \FilterPlusPro::plugin_dir() . "templates/woo-filter/parts/rating.php";
			}
			// price range
			if ( 'yes'== $show_price_range &&
			file_exists(\FilterPlusPro::plugin_dir() . "templates/woo-filter/parts/price-range.php")
			) {
				include_once \FilterPlusPro::plugin_dir() . "templates/woo-filter/parts/price-range.php";
			}
			$get_attr = \FilterPlus\Utils\Helper::array_data($tags);

			// custom tags
			if ( 'yes'== $show_tags && count($get_attr)> 0 &&
				file_exists(\FilterPlus::plugin_dir() . "templates/woo-filter/parts/filter-layout-grid.php")
			 ) {
				$title =  !empty( $tag_label ) ? $tag_label : esc_html__("Find Favorite Item","filter-plus");
				include \FilterPlus::plugin_dir() . "templates/woo-filter/parts/filter-layout-grid.php";
			}
			// custom attributes
			if ( 'yes'== $show_attributes &&
				file_exists(\FilterPlus::plugin_dir() . "templates/woo-filter/parts/filter-layout-attr-grid.php")
			 ) {
				$attributes = \FilterPlus\Utils\Helper::array_data($attributes);
				include \FilterPlus::plugin_dir() . "templates/woo-filter/parts/filter-layout-attr-grid.php";
			}
		}
	?>
	<?php 
		if ( file_exists(\FilterPlus::plugin_dir() . "templates/woo-filter/parts/filter-param.php") ) {
			include_once \FilterPlus::plugin_dir() . "templates/woo-filter/parts/filter-param.php";
		}
		if (!class_exists('FilterPlusPro')) { return; }
		// on sale
		if ( 'yes'== $on_sale &&
		file_exists(\FilterPlusPro::plugin_dir() . "templates/woo-filter/parts/on-sale.php")
		) {
			include_once \FilterPlusPro::plugin_dir() . "templates/woo-filter/parts/on-sale.php";
		}
		// stock
		if ( 'yes'== $stock  &&
		file_exists(\FilterPlusPro::plugin_dir() . "templates/woo-filter/parts/stock.php")
		) {
			include_once \FilterPlusPro::plugin_dir() . "templates/woo-filter/parts/stock.php";
		} 
	?>
</div>

<div class="row products-wrap">
	<?php include_once \FilterPlus::plugin_dir() . "templates/woo-filter/parts/filter-top.php"; ?>
	<?php include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/right-side/sort-bar.php"; ?>
	<div class="prods-grid-view grid-view-<?php echo esc_attr($template)?>"></div>
	<div class="message"></div>
	<?php include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/right-side/product-data.php"; ?>
	<!-- pagination -->
	<ul class="pagination"></ul>
</div>


