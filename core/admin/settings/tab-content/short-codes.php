<?php
/**
 * Filter Plus Shortcodes
 *
 * @package Filter_Plus
 * @since 1.0.0
 */
defined( 'ABSPATH' ) || exit;

use \FilterPlus\Base\DataFactory;
use \FilterPlus\Utils\Helper as Helper;
?>
<div class="content-wrapper">
	<div class="shortcode-block" data-name="filter_products">
		<h1 class="mt-1 mb-0 font_bold font_18"><?php esc_html_e("Available WooCommerce Filter Section","filter-plus"); ?></h1>
		<?php
			// templates
			$filterplus_doc_url 	= '<a target="_blank" href="https://wpbens.com/docs/filter-plus/woocommerce/product-filter/"> [' . esc_html__( 'Documentation Link', 'filter-plus' ) . '] </a>';
			$filterplus_docs 		= '<div class="documentation mb-1"><div class="doc">' . esc_html__( 'Gutenberg Block,Elementor widget is available for filter features.', 'filter-plus' ) . ' ' . $filterplus_doc_url . '</div></div>';
			echo wp_kses_post( $filterplus_docs );

			// apply button mode
			$filterplus_args = array('label'=>esc_html__("Apply Button Mode:","filter-plus"),'id' => 'apply_button_mode','data_label' => 'apply_button_mode');
			filterplus_checkbox_field($filterplus_args);

			// apply button label
			$filterplus_args = array('label'=>esc_html__("Apply Button Label:","filter-plus"),'id' => 'apply_button_label',
			'placeholder'=>esc_html__("Apply","filter-plus"),
			'data_label' => 'apply_button_label','condition_class' => 'apply_button_mode d-none');
			filterplus_number_input_field($filterplus_args);

			// reset button label
			$filterplus_args = array('label'=>esc_html__("Reset Button Label:","filter-plus"),'id' => 'reset_button_label',
			'placeholder'=>esc_html__("Reset","filter-plus"),
			'data_label' => 'reset_button_label','condition_class' => 'apply_button_mode d-none');
			filterplus_number_input_field($filterplus_args);

			// masonry style
			$filterplus_args = array('label'=>esc_html__("Masonry Style:","filter-plus"),'id' => 'masonry_style','data_label' => 'masonry_style');
			filterplus_checkbox_field($filterplus_args);

			$filterplus_args 		= array('label'=>esc_html__("Select Template:","filter-plus"),'id' => 'template',
			'data_label' => 'template','options'=>[1,2,3,4,5,6,7],'type'=>'template' );

			if ( $filterplus_disable ) {
				$filterplus_args['template_disable'] = 1;
			}
			filterplus_select_field($filterplus_args);

			// Title
			$filterplus_args        = array('label'=>esc_html__("Title:","filter-plus"),'id' => 'title',
			'placeholder'=>esc_html__("Place Title","filter-plus"),
			'data_label' => 'title');

			filterplus_number_input_field($filterplus_args);

			$filterplus_args 		= array('label'=>esc_html__("Filter Position:","filter-plus"),'id' => 'filter_position',
			'data_label' => 'filter_position','options'=> Helper::filter_position(),'type'=>'random' );
			filterplus_select_field($filterplus_args);

			$filterplus_args 		= array('label'=>esc_html__("Pagination Style:","filter-plus"),'id' => 'pagination_style',
			'data_label' => 'pagination_style','options'=> Helper::pagination_style(),'type'=>'random' );
			filterplus_select_field($filterplus_args);

			// Limit
			$filterplus_args        = array('label'=>esc_html__("No of Items Per Page:","filter-plus"),'id' => 'no_of_items',
			'placeholder'=>esc_html__("Place No of Items Per Page","filter-plus"), 'field_type'=> 'number',
			'data_label' => 'no_of_items');
			filterplus_number_input_field($filterplus_args);

			// categories template
			$filterplus_args 		= array('label'=>esc_html__("Select Category Filter Template:","filter-plus"),'id' => 'category_template',
			'data_label' => 'category_template','options'=> DataFactory::category_template()['template'],
			'type'=>'template' , 'template_disable' => DataFactory::category_template()['template_disable'] );
			filterplus_select_field($filterplus_args);

			// categories
			$filterplus_args        = array('label'=>esc_html__("Category Label:","filter-plus"),'id' => 'category_label',
			'placeholder'=>esc_html__("Place Category Label Here","filter-plus"),
			'data_label' => 'category_label');
			filterplus_number_input_field($filterplus_args);

			$filterplus_get_categories = Helper::get_categories();

			$filterplus_args = array('label'=>esc_html__("Category List:","filter-plus"),'id' => 'woo_pro_categories',
			'select_type'=>'multiple','data_label' => 'categories','options'=>$filterplus_get_categories);
			filterplus_select_field($filterplus_args);
			// hide empty categories
			$filterplus_args = array('label'=>esc_html__("Hide Empty Category:","filter-plus"),'id' => 'hide_empty_cat','data_label' => 'hide_empty_cat');
			filterplus_checkbox_field($filterplus_args);
			// sub categories
			$filterplus_args = array('label'=>esc_html__("Display Sub Categories:","filter-plus"),'id' => 'woo_sub_categories','data_label' => 'sub_categories');
			filterplus_checkbox_field($filterplus_args);

			$filterplus_args = array('label'=>esc_html__("Display Product Count:","filter-plus"),'id' => 'woo_product_count','data_label' => 'product_count');
			filterplus_checkbox_field($filterplus_args);

			// colors
			$filterplus_args = array('label'=>esc_html__("Display Colors:","filter-plus"),'id' => 'show_colors','data_label' => 'colors');
			filterplus_checkbox_field($filterplus_args);

			// color template
			$filterplus_args 		= array(
			'label'=>esc_html__("Select Color Filter Template:","filter-plus"),'id' => 'color_template',
			'data_label' => 'color_template','options'=> DataFactory::color_template()['template'],'type'=>'template',
			'condition_class' => "show_colors d-none", 'template_disable' => DataFactory::color_template()['template_disable']
			);
			filterplus_select_field($filterplus_args);

			$filterplus_args        = array('label'=>esc_html__("Color Label:","filter-plus"),
			'id' => 'color_label',
			'condition_class' => "show_colors d-none",
			'placeholder'=>esc_html__("Place Color Label Here","filter-plus"),
			'data_label' => 'color_label');
			filterplus_number_input_field($filterplus_args);


			// sizes
			$filterplus_args = array('label'=>esc_html__("Display Size:","filter-plus"),'id' => 'show_size','data_label' => 'size');
		 	filterplus_checkbox_field($filterplus_args);

			$filterplus_args        = array('label'=>esc_html__("Size Label:","filter-plus"),
			'id' => 'size_label',
			'condition_class' => "show_size d-none",
			'placeholder'=>esc_html__("Place Size Label Here","filter-plus"),
			'data_label' => 'size_label');
			filterplus_number_input_field($filterplus_args);

			// show tags
			$filterplus_args = array('label'=>esc_html__("Display Tags:","filter-plus"),'id' => 'show_tags','data_label' => 'show_tags');
			filterplus_checkbox_field($filterplus_args);

			$filterplus_args = array('label'=>esc_html__("Tag Label:","filter-plus"),'id' => 'tag_label',
			'placeholder'=>esc_html__("Place Tag Label Here","filter-plus"),
			'data_label' => 'tag_label','condition_class' => "show_tags d-none",
			'value' => '');
			filterplus_number_input_field($filterplus_args);

			// get tag list
			$filterplus_get_tags   = Helper::get_product_tags('product_tag');

			$filterplus_args       = array('label'=>esc_html__("Tag List:","filter-plus"),'id' => 'woo_pro_tags',
			'data_label' => 'tags','options'=>$filterplus_get_tags , 'select_type' => 'multiple',  'condition_class' => "show_tags d-none");

			filterplus_select_field($filterplus_args);

			// show attributes
			$filterplus_args = array('label'=>esc_html__("Display Attributes:","filter-plus"),'id' => 'show_attributes','data_label' => 'show_attributes');
			filterplus_checkbox_field($filterplus_args);
			$filterplus_args = array('label'=>esc_html__("Attribute Label:","filter-plus"),'id' => 'attribute_label',
			'placeholder'=>esc_html__("Place Attribute Label Here","filter-plus"),
			'data_label' => 'attribute_label',
			'condition_class' => "show_attributes d-none");
			filterplus_number_input_field($filterplus_args);

			// get attributes list
			global $product;
			$filterplus_get_attributes     = class_exists('WooCommerce') ? wc_get_attribute_taxonomies() : array();
			$filterplus_args               = array('label'=>esc_html__("Attribute List:","filter-plus"),'id' => 'woo_pro_attributes',
			'data_label' => 'attributes', 'options'=>$filterplus_get_attributes , 'select_type' => 'multiple', 'condition_class' => "show_attributes d-none" , 'type'=>'attributes');
			filterplus_select_field($filterplus_args);

			// show price range
			$filterplus_args = array('label'=>esc_html__("Display Price Range:","filter-plus"),'id' => 'show_price_range','data_label' => 'show_price_range');
			filterplus_checkbox_field($filterplus_args);
			$filterplus_args = array('label'=>esc_html__("Price Range Label:","filter-plus"),
			'placeholder'=>esc_html__("Place Price Range Label Here","filter-plus"),
			'id' => 'price_range_label','data_label' => 'price_range_label',
			'condition_class' => "show_price_range d-none");
			filterplus_number_input_field($filterplus_args);


			// show reviews
			$filterplus_args = array('label'=>esc_html__("Display Reviews:","filter-plus"),'id' => 'show_reviews','data_label' => 'show_reviews');
			filterplus_checkbox_field($filterplus_args);

			// review template
			$filterplus_args 		= array(
			'label'=>esc_html__("Select Review Filter Template:","filter-plus"),'id' => 'review_template',
			'data_label' => 'review_template','options'=> DataFactory::review_template()['template'],'type'=>'template',
			'condition_class' => "show_reviews d-none", 'template_disable' => DataFactory::review_template()['template_disable']
			);
			filterplus_select_field($filterplus_args);

			$filterplus_args = array('label'=>esc_html__("Review Label:","filter-plus"),
			'placeholder'=>esc_html__("Place Review Label Here","filter-plus"),
			'id' => 'review_label','data_label' => 'review_label',
			'condition_class' => "show_reviews d-none");
			filterplus_number_input_field($filterplus_args);


			// filter by stock
			$filterplus_args = array('label'=>esc_html__("Filter By Stock:","filter-plus"),'id' => 'stock','data_label' => 'stock');
			filterplus_checkbox_field($filterplus_args);

			$filterplus_args = array('label'=>esc_html__("Stock Label:","filter-plus"),'id' => 'stock_label',
			'placeholder'=>esc_html__("Place Stock Label Here","filter-plus"),
			'data_label' => 'stock_label','condition_class' => 'stock d-none' );
			filterplus_number_input_field($filterplus_args);

			// filter by on sale
			$filterplus_args = array('label'=>esc_html__("Filter By On Sale:","filter-plus"),'id' =>'on_sale','data_label' => 'on_sale');
			filterplus_checkbox_field($filterplus_args);

			$filterplus_args = array('label'=>esc_html__("On Sale Label:","filter-plus"),
			'placeholder'=>esc_html__("Place On Sale Label Here","filter-plus"),
			'id' => 'on_sale_label','data_label' => 'on_sale_label',
			'condition_class' => "on_sale d-none");

			filterplus_number_input_field($filterplus_args);


		?>

		<h1 class="font_bold font_18 mb-1"><?php esc_html_e("Filter Result Products","filter-plus"); ?></h1>

		<?php

			// show title
			$filterplus_args = array('label'=>esc_html__("Display Title:","filter-plus"),'id' => 'hide_prod_title',
			'data_label' => 'hide_prod_title','checked' => 'yes');
			filterplus_checkbox_field($filterplus_args);

			// show descrtiption
			$filterplus_args = array('label'=>esc_html__("Display Descrtiption:","filter-plus"),'id' => 'hide_prod_desc',
			'data_label' => 'hide_prod_desc','checked' => 'yes');
			filterplus_checkbox_field($filterplus_args);

			// show price
			$filterplus_args = array('label'=>esc_html__("Display Price:","filter-plus"),'id' => 'hide_prod_price',
			'data_label' => 'hide_prod_price','checked' => 'yes');
			filterplus_checkbox_field($filterplus_args);

			// show Add to Cart
			$filterplus_args = array('label'=>esc_html__("Display Add to Cart:","filter-plus"),'id' => 'hide_prod_add_cart',
			'data_label' => 'hide_prod_add_cart','checked' => 'yes');
			filterplus_checkbox_field($filterplus_args);

			// show Rating
			$filterplus_args = array('label'=>esc_html__("Display Rating:","filter-plus"),'id' => 'hide_prod_rating',
			'data_label' => 'hide_prod_rating','checked' => 'yes');
			filterplus_checkbox_field($filterplus_args);

			// show sorting
			$filterplus_args = array('label'=>esc_html__("Display Sorting:","filter-plus"),'id' => 'sorting','data_label' => 'sorting');
			filterplus_checkbox_field($filterplus_args);

			// show tags
			$filterplus_args = array('label'=>esc_html__("Display Tags:","filter-plus"),'id' => 'product_tags','data_label' => 'product_tags');
			filterplus_checkbox_field($filterplus_args);
			// show product categories
			$filterplus_args = array('label'=>esc_html__("Display Categories:","filter-plus"),'id' => 'product_categories',
			'data_label' => 'product_categories');
			filterplus_checkbox_field($filterplus_args);

		?>
		<div class="single-block">
			<div class="generate-block"><button class="button button-primary"><?php esc_html_e("Copy Filter Shortcodes","filter-plus");?></button></div>
			<input type="text" class="full_input" id="result_shortcode" value="">
		</div>
	</div>
</div>
