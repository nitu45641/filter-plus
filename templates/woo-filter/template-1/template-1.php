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
			'exclude_categories' => isset($exclude_categories) ? $exclude_categories : '',
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
		if ( 'yes' == $show_tags ) {
			$filterplus_get_attr = \FilterPlus\Utils\Helper::array_data( $tags );
			if ( count( $filterplus_get_attr ) > 0 ) {
				$title = ! empty( $tag_label ) ? $tag_label : esc_html__( 'Filter By Brand', 'filter-plus' );
				include \FilterPlus::plugin_dir() . "templates/woo-filter/template-" . $template . "/left-side/filter-layout-grid.php";
			}
		}
		// custom attributes
		if ( 'yes' == $show_attributes ) {
			$filterplus_attributes = \FilterPlus\Utils\Helper::array_data( $attributes );
			include \FilterPlus::plugin_dir() . "templates/woo-filter/template-" . $template . "/left-side/filter-layout-attr-grid.php";
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
	<?php include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/right-side/product-template.php"; ?>
	<div class="prods-grid-view grid-view-<?php echo esc_attr($template)?>">
		<?php
		if ( defined( 'ELEMENTOR_VERSION' ) && isset( \Elementor\Plugin::$instance->editor ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			$_editor_products = \FilterPlus\Core\Frontend\SearchFilter\Actions::instance()->get_products( array(
				'filter_type'        => 'product',
				'limit'              => ! empty( $no_of_items ) ? $no_of_items : 9,
				'template'           => $template,
				'offset'             => 1,
				'filter_param'       => array(),
				'cat_id'             => '',
				'taxonomies'         => array(),
				'search_value'       => '',
				'min'                => '',
				'max'                => '',
				'rating'             => '',
				'product_tags'       => ! empty( $product_tags ) ? $product_tags : 'yes',
				'post_author'        => 'no',
				'order_by'           => '',
				'product_categories' => ! empty( $product_categories ) ? $product_categories : 'yes',
				'stock'              => '',
				'on_sale'            => '',
				'cf_list'            => array(),
				'masonry_style'      => ! empty( $masonry_style ) ? $masonry_style : 'no',
				'taxonomy'           => 'product_cat',
				'pagination_style'   => ! empty( $pagination_style ) ? $pagination_style : 'numbers',
				'author'             => '',
			) );
			foreach ( $_editor_products['products'] as $_editor_product ) {
				if ( function_exists( 'filterplus_render_grid_product' ) ) {
					filterplus_render_grid_product(
						$_editor_product,
						isset( $hide_prod_add_cart ) ? $hide_prod_add_cart : 'yes',
						isset( $hide_prod_title )    ? $hide_prod_title    : 'yes',
						isset( $hide_prod_desc )     ? $hide_prod_desc     : 'yes',
						isset( $hide_prod_rating )   ? $hide_prod_rating   : 'yes',
						isset( $hide_prod_price )    ? $hide_prod_price    : 'yes'
					);
				}
			}
		}
		?>
	</div>
	<div class="prods-list-view"></div>
	<div class="message"></div>
	<?php include_once \FilterPlus::plugin_dir() . "templates/parts/pagination.php"; ?>
</div>


