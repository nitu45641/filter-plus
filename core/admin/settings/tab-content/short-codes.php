
<div class="content-wrapper">
	<div class="shortcode-block" data-name="filter_products">
		<h1 class="font_bold font_20 mb-1"><?php esc_html_e("Available WooCommerce Filter Section","filter-plus"); ?></h1>
		<?php
			// templates
			$doc_url 	= '<a target="_blank" href="https://docs.woooplugin.com/?docs=filter-plus/gutenburg-block-elementor-widget-woocommercce-product-filter"> ['.__( "Documentation Link", "filter-plus" ).'] </a>';
			$docs 		= '<div class="documentation mb-1"><i class="doc">'.esc_html__('Gutenberg Block , Elementor widget is available for filter features. ','filter-plus') . $doc_url . '</i></div>';
			echo FilterPlus\Utils\Helper::kses( $docs );

			$args 		= array('label'=>esc_html__("Select Template:","filter-plus"),'id' => 'template',
			'data_label' => 'template','options'=>[1,2],'type'=>'template' );

			if ( $disable ) {
				$args['template_disable'] = 1;
			}
			filter_plus_select_field($args);

			// categories
			$get_categories = \FilterPlus\Utils\Helper::get_categories();

			$args = array('label'=>esc_html__("Category List:","filter-plus"),'id' => 'woo_pro_categories',
			'select_type'=>'multiple','data_label' => 'categories','options'=>$get_categories);
			filter_plus_select_field($args);

			// colors
			$args = array('label'=>esc_html__("Display Colors:","filter-plus"),'id' => 'show_colors','data_label' => 'colors');
			filter_plus_checkbox_field($args);

			// sizes
			$args = array('label'=>esc_html__("Display Size:","filter-plus"),'id' => 'show_size','data_label' => 'size');
		 	filter_plus_checkbox_field($args);
			
			// show tags
			$args = array('label'=>esc_html__("Display Tags:","filter-plus"),'id' => 'show_tags','data_label' => 'show_tags');
			filter_plus_checkbox_field($args);
			
			// get tag list
			$get_tags   = \FilterPlus\Utils\Helper::get_product_tags('product_tag');

			$args       = array('label'=>esc_html__("Tag List:","filter-plus"),'id' => 'woo_pro_tags',
			'data_label' => 'tags','options'=>$get_tags , 'select_type' => 'multiple',  'condition_class' => "show_tags d-none");

			filter_plus_select_field($args);

			// show attributes
			$args = array('label'=>esc_html__("Display Attributes:","filter-plus"),'id' => 'show_attributes','data_label' => 'show_attributes');
			filter_plus_checkbox_field($args);

			// get attributes list
			global $product;
			$get_attributes     = class_exists('WooCommerce') ? wc_get_attribute_taxonomies() : array();
			$args               = array('label'=>esc_html__("Attribute List:","filter-plus"),'id' => 'woo_pro_attributes',
			'data_label' => 'attributes', 'options'=>$get_attributes , 'select_type' => 'multiple', 'condition_class' => "show_attributes d-none" , 'type'=>'attributes');
			filter_plus_select_field($args);

			// show price range
			$args = array('label'=>esc_html__("Display Price Range:","filter-plus"),'id' => 'show_price_range','data_label' => 'show_price_range');
			filter_plus_checkbox_field($args);


			// show reviews
			$args = array('label'=>esc_html__("Display Reviews:","filter-plus"),'id' => 'show_reviews','data_label' => 'show_reviews',
			'disable' => $disable );
			filter_plus_checkbox_field($args);

			// filter by stock
			$args = array('label'=>esc_html__("Filter By Stock:","filter-plus"),'id' => 'stock','data_label' => 'stock',
			'disable' => $disable );
			filter_plus_checkbox_field($args);

			// filter by on sale
			$args = array('label'=>esc_html__("Filter By On Sale:","filter-plus"),'id' => 'on_sale','data_label' => 'on_sale',
			'disable' => $disable );
			filter_plus_checkbox_field($args);

		?>

		<h1 class="font_bold font_20 mt-1 mb-1"><?php esc_html_e("Filter Result Products","filter-plus"); ?></h1>
		
		<?php

			// show sorting
			$args = array('label'=>esc_html__("Display Sorting:","filter-plus"),'id' => 'sorting','data_label' => 'sorting',
			'disable' => $disable );
			filter_plus_checkbox_field($args);

			// show tags
			$args = array('label'=>esc_html__("Display Tags:","filter-plus"),'id' => 'product_tags','data_label' => 'product_tags',
			'disable' => $disable );
			filter_plus_checkbox_field($args);
			// show product categories
			$args = array('label'=>esc_html__("Display Categories:","filter-plus"),'id' => 'product_categories',
			'data_label' => 'product_categories', 'disable' => $disable );
			filter_plus_checkbox_field($args);
		?>
		<div class="single-block">
			<div class="generate-block"><button class="button button-primary"><?php esc_html_e("Copy Filer Shortcodes","filter-plus");?></button></div>
			<input type="text" class="full_input" id="result_shortcode" value="">
		</div>
	</div>
</div>