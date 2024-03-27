<?php

if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="shop-sidebar sidebar-style-<?php echo esc_attr($template);?>">
	<?php include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/left-side/product-search.php"; ?>
	<?php include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/left-side/categories.php"; 
		// reviews
		if ( 'yes'== $show_reviews ) {
			include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/rating.php";
		}
		// price range
		if ( 'yes'== $show_price_range ) {
			include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/left-side/price-range.php";
		}
		// custom tags
		if ( 'yes'== $show_tags ) {
			$get_attr = \FilterPlus\Utils\Helper::array_data($tags);
			if (count($get_attr)>0) {
				$title =  !empty( $tag_label ) ? $tag_label : esc_html__("Filter By Brand","filter-plus");
				include \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/left-side/filter-layout-grid.php";
			}
		}
		// custom attributes
		if ( 'yes'== $show_attributes ) {
			$attributes = \FilterPlus\Utils\Helper::array_data($attributes);
			include \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/left-side/filter-layout-attr-grid.php";
		}
		include_once \FilterPlus::plugin_dir() . "templates/woo-filter/parts/filter-param.php"; 

		// on sale
		if ( 'yes'== $on_sale ) {
			include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/on-sale.php";
		}
		// stock
		if ( 'yes'== $stock ) {
			include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/stock.php";
		} 
	?>
</div>
<div class="row products-wrap">
	<?php include_once \FilterPlus::plugin_dir() . "templates/woo-filter/parts/filter-top.php"; ?>
	<?php include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/right-side/sort-bar.php"; ?>
	<div class="prods-grid-view grid-view-<?php echo esc_attr($template)?>"></div>
	<div class="prods-list-view"></div>
	<div class="message"></div>
	<?php include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/right-side/product-data.php"; ?>
	<!-- pagination -->
	<ul class="pagination pagination-1"></ul>
</div>


