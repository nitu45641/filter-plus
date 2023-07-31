<div class="shop-sidebar">
	<?php include_once \FilterPlus::plugin_dir() . "templates/search-filter/template-".$template."/left-side/product-search.php"; ?>
	<?php include_once \FilterPlus::plugin_dir() . "templates/search-filter/template-".$template."/left-side/categories.php"; ?>
	<?php 
		if (class_exists('FilterPlusPro')) {
			// reviews
			if ( 'yes'== $show_reviews ) {
				include_once \FilterPlusPro::plugin_dir() . "templates/search-filter/template-".$template."/rating.php";
			}
			// price range
			if ( 'yes'== $show_price_range ) {
				include_once \FilterPlusPro::plugin_dir() . "templates/search-filter/template-".$template."/price-range.php";
			}
			// custom tags
			if ( 'yes'== $show_tags ) {
				$title = esc_html__("Filter By Brand","filter-plus");
				$get_attr = \FilterPlus\Utils\Helper::array_data($tags);
				include \FilterPlus::plugin_dir() . "templates/search-filter/template-".$template."/left-side/filter-layout-grid.php";
			}
			// custom attributes
			if ( 'yes'== $show_attributes ) {
				$attributes = \FilterPlus\Utils\Helper::array_data($attributes);
				include \FilterPlus::plugin_dir() . "templates/search-filter/template-".$template."/left-side/filter-layout-attr-grid.php";
			}
		}
	?>
	<?php include_once \FilterPlus::plugin_dir() . "templates/search-filter/template-".$template."/left-side/filter-param.php"; ?>
</div>

<div class="row products-wrap">
	<?php include_once \FilterPlus::plugin_dir() . "templates/search-filter/template-".$template."/right-side/sort-bar.php"; ?>
	<div class="prods-grid-view"></div>
	<div class="prods-list-view"></div>
	<div class="message"></div>
	<?php include_once \FilterPlus::plugin_dir() . "templates/search-filter/template-".$template."/right-side/product-data.php"; ?>
	<!-- pagination -->
	<ul class="pagination"></ul>
</div>


