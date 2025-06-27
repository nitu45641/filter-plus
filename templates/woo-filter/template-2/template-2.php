<?php

use FilterPlus\Base\DataFactory;

if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="shop-sidebar checkbox-style sidebar-style-<?php echo esc_attr($template);?>">
	<div class="side-cart-close">
	<svg width="30px" height="30px" viewBox="0 0 24 24">
		<g id="grid_system"/>
		<g id="_icons">
		<path d="M5.3,18.7C5.5,18.9,5.7,19,6,19s0.5-0.1,0.7-0.3l5.3-5.3l5.3,5.3c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3   c0.4-0.4,0.4-1,0-1.4L13.4,12l5.3-5.3c0.4-0.4,0.4-1,0-1.4s-1-0.4-1.4,0L12,10.6L6.7,5.3c-0.4-0.4-1-0.4-1.4,0s-0.4,1,0,1.4   l5.3,5.3l-5.3,5.3C4.9,17.7,4.9,18.3,5.3,18.7z"/>
		</g>
	</svg>
	</div>
	<div>
		<?php
			include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/left-side/title.php"; 
			if (file_exists(\FilterPlus::plugin_dir() . "templates/woo-filter/parts/product-search.php")) {
				include_once \FilterPlus::plugin_dir() . "templates/woo-filter/parts/product-search.php";
			}

			// category template
			DataFactory::category_template_url(array(
				'template' => $template,
				'category_template' => $category_template,
				'categories' => $categories,
				'hide_empty_cat' => $hide_empty_cat,
				'product_count' => $product_count,
				'sub_categories' => $sub_categories,
			));

		?>
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
</div>

<div class="products-wrap">
	<?php include_once \FilterPlus::plugin_dir() . "templates/woo-filter/parts/filter-top.php"; ?>
	<?php include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/right-side/sort-bar.php"; ?>
	<div class="prods-grid-view grid-view-<?php echo esc_attr($template)?>"></div>
	<div class="message"></div>
	<?php include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/right-side/product-data.php"; ?>
	<?php include_once \FilterPlus::plugin_dir() . "templates/parts/pagination.php"; ?>

</div>
<div class="filter-mb filter-bar-mb-search">
	<svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 48 48" id="filter" fill="#fff"><path fill="#fff" d="M4 10h7.09a6 6 0 0 0 11.82 0H44a1 1 0 0 0 0-2H22.91A6 6 0 0 0 11.09 8H4a1 1 0 0 0 0 2zM17 5a4 4 0 1 1-4 4A4 4 0 0 1 17 5zM44 23H36.91a6 6 0 0 0-11.82 0H4a1 1 0 0 0 0 2H25.09a6 6 0 0 0 11.82 0H44a1 1 0 0 0 0-2zM31 28a4 4 0 1 1 4-4A4 4 0 0 1 31 28zM44 38H22.91a6 6 0 0 0-11.82 0H4a1 1 0 0 0 0 2h7.09a6 6 0 0 0 11.82 0H44a1 1 0 0 0 0-2zM17 43a4 4 0 1 1 4-4A4 4 0 0 1 17 43z" data-name="Layer 15"></path></svg>
	<span><?php esc_html_e('Filter and sort','filter-plus')?></span>
</div>



