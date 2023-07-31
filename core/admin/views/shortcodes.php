<?php include_once \FilterPlus::core_dir() . "admin/views/shortocdes-fields.php"; ?>

<h2 class="content-header"><?php esc_html_e("ShortCodes","filter-plus");?></h2>

<div class="content-wrapper">
	<div class="shortcode-block" data-name="filter_products">

		<?php
			// templates
			$args = array('label'=>esc_html__("Select Template:","filter-plus"),'id' => 'template',
			'data_label' => 'template','options'=>[1,2],'type'=>'template');
			select_field($args);

			// categories
			$get_categories = \FilterPlus\Utils\Helper::get_categories();

			$args = array('label'=>esc_html__("Category List:","filter-plus"),'id' => 'woo_pro_categories',
			'data_label' => 'categories','options'=>$get_categories);
			select_field($args);

			// colors
			$args = array('label'=>esc_html__("Display Colors:","filter-plus"),'id' => 'show_colors','data_label' => 'colors');
			checkbox_field($args);

			// sizes
			$args = array('label'=>esc_html__("Display Size:","filter-plus"),'id' => 'show_size','data_label' => 'size');
		 	checkbox_field($args);

			if (class_exists('FilterPlusPro')) {
				// show tags
				$args = array('label'=>esc_html__("Display Tags:","filter-plus"),'id' => 'show_tags','data_label' => 'show_tags');
				checkbox_field($args);
				
				// get tag list
				$get_tags   = \FilterPlus\Utils\Helper::get_product_tags('product_tag');
				$args       = array('label'=>esc_html__("Tag List:","filter-plus"),'id' => 'woo_pro_tags',
				'data_label' => 'tags','options'=>$get_tags , 'condition_class' => "show_tags");
				select_field($args);

				// show attributes
				$args = array('label'=>esc_html__("Display Attributes:","filter-plus"),'id' => 'show_attributes','data_label' => 'show_attributes');
				checkbox_field($args);

				// get attributes list
				global $product;
				$get_attributes = wc_get_attribute_taxonomies();
				$args               = array('label'=>esc_html__("Attribute List:","filter-plus"),'id' => 'woo_pro_attributes',
				'data_label' => 'attributes','options'=>$get_attributes , 'condition_class' => "show_attributes" , 'type'=>'attributes');
				select_field($args);

				// show reviews
				$args = array('label'=>esc_html__("Display Reviews:","filter-plus"),'id' => 'show_reviews','data_label' => 'show_reviews');
				checkbox_field($args);

				// show price range
				$args = array('label'=>esc_html__("Display Price Range:","filter-plus"),'id' => 'show_price_range','data_label' => 'show_price_range');
				checkbox_field($args);
			}
		?>

		<div class="generate-section">
			<div class="generate-block"><button class="button button-primary admin-button"><?php esc_html_e("Copy Filer Shortcodes","filter-plus");?></button></div>
			<input type="text" class="full_input" id="result_shortcode" value="">
		</div>
	</div>
</div>