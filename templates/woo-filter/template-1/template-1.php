<?php

use FilterPlus\Base\DataFactory;

if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="shop-sidebar sidebar-style-<?php echo esc_attr($template);?>">

	<?php
		// apply/reset buttons at top
		if (file_exists(\FilterPlus::plugin_dir() . "templates/woo-filter/parts/filter-buttons.php")) {
			include_once \FilterPlus::plugin_dir() . "templates/woo-filter/parts/filter-buttons.php";
		}

		if (file_exists(\FilterPlus::plugin_dir() . "templates/woo-filter/parts/product-search.php")) {
			include_once \FilterPlus::plugin_dir() . "templates/woo-filter/parts/product-search.php";
		}
		
		// category template
		DataFactory::category_template_url(array(
			'template' => $template,
			'category_template' => $category_template,
			'category_label' => $category_label,
			'categories' => $categories,
			'hide_empty_cat' => $hide_empty_cat,
			'product_count' => $product_count,
			'sub_categories' => $sub_categories,
		));

		// reviews
		if ( 'yes'== $show_reviews ) {
			include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/rating.php";
		}
		// price range
		if ( 'yes'== $show_price_range ) {
			include_once \FilterPlus::plugin_dir() . "templates/woo-filter/parts/price-range.php";
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
<div class="products-wrap">
	<?php include_once \FilterPlus::plugin_dir() . "templates/woo-filter/parts/filter-top.php"; ?>
	<?php include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/right-side/sort-bar.php"; ?>
	<div class="prods-grid-view grid-view-<?php echo esc_attr($template)?>"></div>
	<div class="prods-list-view"></div>
	<div class="message"></div>
	<?php include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/right-side/product-template.php"; ?>
	<?php include_once \FilterPlus::plugin_dir() . "templates/parts/pagination.php"; ?>
</div>


