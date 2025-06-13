<?php
/**
 * Filter Plus Shortcodes
 *
 * @package Filter_Plus
 * @since 1.0.0
 */
defined( 'ABSPATH' ) || exit;

use \FilterPlus\Utils\Helper as Helper;
?>
<div class="content-wrapper">
	<div class="shortcode-block" data-name="filter_products">
		<h1 class="mt-1 mb-0 font_bold font_18"><?php esc_html_e("Available WooCommerce Filter Section","filter-plus"); ?></h1>
		<?php
			// templates
			$doc_url 	= '<a target="_blank" href="https://docs.woooplugin.com/docs/filter-plus/show-woocommerce-product-filter/"> ['.__( "Documentation Link", "filter-plus" ).'] </a>';
			$docs 		= '<div class="documentation mb-1"><div class="doc">'.esc_html__('Gutenberg Block,Elementor widget is available for filter features. ','filter-plus') . $doc_url . '</div></div>';
			echo Helper::kses( $docs );

			$args 		= array('label'=>esc_html__("Select Template:","filter-plus"),'id' => 'template',
			'data_label' => 'template','options'=>[1,2,3,4,5,6,7],'type'=>'template' );

			if ( $disable ) {
				$args['template_disable'] = 1;
			}
			filter_plus_select_field($args);

			// Title
			$args        = array('label'=>esc_html__("Title:","filter-plus"),'id' => 'title',
			'placeholder'=>esc_html__("Place Title","filter-plus"),
			'data_label' => 'title');
			
			filter_plus_number_input_field($args);

			$args 		= array('label'=>esc_html__("Filter Position:","filter-plus"),'id' => 'filter_position',
			'data_label' => 'filter_position','options'=> Helper::filter_position(),'type'=>'random' );
			filter_plus_select_field($args);

			$args 		= array('label'=>esc_html__("Pagination Style:","filter-plus"),'id' => 'pagination_style',
			'data_label' => 'pagination_style','options'=> Helper::pagination_style(),'type'=>'random' );
			filter_plus_select_field($args);

			// Limit
			$args        = array('label'=>esc_html__("No of Items Per Page:","filter-plus"),'id' => 'no_of_items',
			'placeholder'=>esc_html__("Place No of Items Per Page","filter-plus"), 'field_type'=> 'number',
			'data_label' => 'no_of_items');
			filter_plus_number_input_field($args);

			// categories
			$args        = array('label'=>esc_html__("Category Label:","filter-plus"),'id' => 'category_label',
			'placeholder'=>esc_html__("Place Category Label Here","filter-plus"),
			'data_label' => 'category_label');
			filter_plus_number_input_field($args);

			$get_categories = Helper::get_categories();

			$args = array('label'=>esc_html__("Category List:","filter-plus"),'id' => 'woo_pro_categories',
			'select_type'=>'multiple','data_label' => 'categories','options'=>$get_categories);
			filter_plus_select_field($args);
			// hide empty categories
			$args = array('label'=>esc_html__("Hide Empty Category:","filter-plus"),'id' => 'hide_empty_cat','data_label' => 'hide_empty_cat');
			filter_plus_checkbox_field($args);
			// sub categories
			$args = array('label'=>esc_html__("Display Sub Categories:","filter-plus"),'id' => 'woo_sub_categories','data_label' => 'sub_categories');
			filter_plus_checkbox_field($args);

			$args = array('label'=>esc_html__("Display Product Count:","filter-plus"),'id' => 'woo_product_count','data_label' => 'product_count');
			filter_plus_checkbox_field($args);
			// colors
			$args = array('label'=>esc_html__("Display Colors:","filter-plus"),'id' => 'show_colors','data_label' => 'colors');
			filter_plus_checkbox_field($args);
			
			$args        = array('label'=>esc_html__("Color Label:","filter-plus"),
			'id' => 'color_label',
			'condition_class' => "show_colors d-none",
			'placeholder'=>esc_html__("Place Color Label Here","filter-plus"),
			'data_label' => 'color_label');
			filter_plus_number_input_field($args);

			// sizes
			$args = array('label'=>esc_html__("Display Size:","filter-plus"),'id' => 'show_size','data_label' => 'size');
		 	filter_plus_checkbox_field($args);
			
			$args        = array('label'=>esc_html__("Size Label:","filter-plus"),
			'id' => 'size_label',
			'condition_class' => "show_size d-none",
			'placeholder'=>esc_html__("Place Size Label Here","filter-plus"),
			'data_label' => 'size_label');
			filter_plus_number_input_field($args);
			
			// show tags
			$args = array('label'=>esc_html__("Display Tags:","filter-plus"),'id' => 'show_tags','data_label' => 'show_tags');
			filter_plus_checkbox_field($args);

			$args = array('label'=>esc_html__("Tag Label:","filter-plus"),'id' => 'tag_label',
			'placeholder'=>esc_html__("Place Tag Label Here","filter-plus"),
			'data_label' => 'tag_label','condition_class' => "show_tags d-none",
			'value' => '');
			filter_plus_number_input_field($args);
			
			// get tag list
			$get_tags   = Helper::get_product_tags('product_tag');

			$args       = array('label'=>esc_html__("Tag List:","filter-plus"),'id' => 'woo_pro_tags',
			'data_label' => 'tags','options'=>$get_tags , 'select_type' => 'multiple',  'condition_class' => "show_tags d-none");

			filter_plus_select_field($args);

			// show attributes
			$args = array('label'=>esc_html__("Display Attributes:","filter-plus"),'id' => 'show_attributes','data_label' => 'show_attributes');
			filter_plus_checkbox_field($args);
			$args = array('label'=>esc_html__("Attribute Label:","filter-plus"),'id' => 'attribute_label',
			'placeholder'=>esc_html__("Place Attribute Label Here","filter-plus"),
			'data_label' => 'attribute_label',
			'condition_class' => "show_attributes d-none");
			filter_plus_number_input_field($args);

			// get attributes list
			global $product;
			$get_attributes     = class_exists('WooCommerce') ? wc_get_attribute_taxonomies() : array();
			$args               = array('label'=>esc_html__("Attribute List:","filter-plus"),'id' => 'woo_pro_attributes',
			'data_label' => 'attributes', 'options'=>$get_attributes , 'select_type' => 'multiple', 'condition_class' => "show_attributes d-none" , 'type'=>'attributes');
			filter_plus_select_field($args);

			// show price range
			$args = array('label'=>esc_html__("Display Price Range:","filter-plus"),'id' => 'show_price_range','data_label' => 'show_price_range');
			filter_plus_checkbox_field($args);
			$args = array('label'=>esc_html__("Price Range Label:","filter-plus"),
			'placeholder'=>esc_html__("Place Price Range Label Here","filter-plus"),
			'id' => 'price_range_label','data_label' => 'price_range_label',
			'condition_class' => "show_price_range d-none");
			filter_plus_number_input_field($args);


			// show reviews
			$args = array('label'=>esc_html__("Display Reviews:","filter-plus"),'id' => 'show_reviews','data_label' => 'show_reviews');
			filter_plus_checkbox_field($args);

			$args = array('label'=>esc_html__("Review Label:","filter-plus"),
			'placeholder'=>esc_html__("Place Review Label Here","filter-plus"),
			'id' => 'review_label','data_label' => 'review_label',
			'condition_class' => "show_reviews d-none");
			filter_plus_number_input_field($args);

			// filter by stock
			$args = array('label'=>esc_html__("Filter By Stock:","filter-plus"),'id' => 'stock','data_label' => 'stock');
			filter_plus_checkbox_field($args);

			$args = array('label'=>esc_html__("Stock Label:","filter-plus"),'id' => 'stock_label',
			'placeholder'=>esc_html__("Place Stock Label Here","filter-plus"),
			'data_label' => 'stock_label','condition_class' => 'stock d-none' );
			filter_plus_number_input_field($args);

			// filter by on sale
			$args = array('label'=>esc_html__("Filter By On Sale:","filter-plus"),'id' =>'on_sale','data_label' => 'on_sale');
			filter_plus_checkbox_field($args);

			$args = array('label'=>esc_html__("On Sale Label:","filter-plus"),
			'placeholder'=>esc_html__("Place On Sale Label Here","filter-plus"),
			'id' => 'on_sale_label','data_label' => 'on_sale_label',
			'condition_class' => "on_sale d-none");

			filter_plus_number_input_field($args);


		?>

		<h1 class="font_bold font_18 mb-1"><?php esc_html_e("Filter Result Products","filter-plus"); ?></h1>
		
		<?php

			// show sorting
			$args = array('label'=>esc_html__("Display Sorting:","filter-plus"),'id' => 'sorting','data_label' => 'sorting');
			filter_plus_checkbox_field($args);

			// show tags
			$args = array('label'=>esc_html__("Display Tags:","filter-plus"),'id' => 'product_tags','data_label' => 'product_tags');
			filter_plus_checkbox_field($args);
			// show product categories
			$args = array('label'=>esc_html__("Display Categories:","filter-plus"),'id' => 'product_categories',
			'data_label' => 'product_categories');
			
			filter_plus_checkbox_field($args);
		?>
		<div class="single-block">
			<div class="generate-block"><button class="button button-primary"><?php esc_html_e("Copy Filter Shortcodes","filter-plus");?></button></div>
			<input type="text" class="full_input" id="result_shortcode" value="">
		</div>
	</div>
</div>