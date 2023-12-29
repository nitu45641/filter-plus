
<div class="content-wrapper">
	<div class="shortcode-block" data-name="wp_filter_plus">
		<h1 class="font_bold font_20 mb-1"><?php esc_html_e("Available Wordpress Filter Section","filter-plus"); ?></h1>
		<?php
			
			$doc_url 	= '<a target="_blank" href="https://docs.woooplugin.com/?docs=filter-plus/gutenburg-block-elementor-widget-woocommercce-product-filter"> ['.__( "Documentation Link", "filter-plus" ).'] </a>';
			$docs 		= '<div class="documentation mb-1"><i class="doc">'.esc_html__('Gutenberg Block , Elementor widget is available for filter features. ','filter-plus') . $doc_url . '</i></div>';
			echo FilterPlus\Utils\Helper::kses( $docs );
			// templates
			$args 		= array('label'=>esc_html__("Select Template:","filter-plus"),'id' => 'post_template',
			'data_label' => 'template','options'=>[1],'type'=>'template', 'disable' => $disable );
			filter_plus_select_field($args);

			// categories
			$get_categories = \FilterPlus\Utils\Helper::get_categories('',false,array('taxonomy'=>'category'));
			$args = array('label'=>esc_html__("Category List:","filter-plus"),'id' => 'wp_categories',
			'select_type'=>'multiple','data_label' => 'categories','options'=>$get_categories, 'disable' => $disable );
			filter_plus_select_field($args);
			
			// post type
			$args = array('label'=>esc_html__("Select Type","filter-plus"),'id' => 'filter_type',
				'data_label' => 'filter_type','options'=>
				array('post'=>esc_html__("Post","filter-plus"),'custom_post'=>esc_html__("Custom Post","filter-plus")),'type'=>'random',
				'select_type' => 'single' , 'disable' => $disable
			);

			filter_plus_select_field($args);

			// custom post type
			$get_custom_post = \FilterPlus\Utils\Helper::custom_post_type();
			
			$args 		= array('label'=>esc_html__("Custom Post:","filter-plus"),'id' => 'custom_post',
			'data_label' => 'custom_post','options'=>$get_custom_post,'type'=>'random', 'disable' => $disable ,
			'condition_class' => "filter_type d-none", );
			filter_plus_select_field($args);

			// show tags
			$args = array('label'=>esc_html__("Tags:","filter-plus"),'id' => 'show_wp_tags','data_label' => 'show_tags'
			, 'disable' => $disable);
			filter_plus_checkbox_field($args) ;
			
			// get tag list
			$get_tags   = \FilterPlus\Utils\Helper::get_product_tags('post_tag');

			$args       = array('label'=>esc_html__("Tag List:","filter-plus"),'id' => 'post_tags',
			'data_label' => 'tags','options'=>$get_tags , 'select_type' => 'multiple',  'condition_class' => "show_wp_tags d-none",
			'disable' => $disable);

			filter_plus_select_field($args);

			// show author
			$args = array( 'label'=>esc_html__("Author:","filter-plus"),'id' => 'author','data_label' => 'author',
			'disable' => $disable );
			filter_plus_checkbox_field($args);

			// author list
			$author_list = \FilterPlus\Utils\Helper::instance()->author_list();

			$args        = array('label'=>esc_html__("Author List:","filter-plus"),'id' => 'author_list',
			'data_label' => 'author_list','options'=>$author_list , 'type' => 'random',
			'select_type' => 'multiple',  'condition_class' => "author d-none",
			'disable' => $disable);

			filter_plus_select_field($args);

		?>

		<h1 class="font_bold font_20 mt-1 mb-1"><?php esc_html_e("Filter Result","filter-plus"); ?></h1>
		
		<?php

			// show sorting
			$args = array('label'=>esc_html__("Display Sorting:","filter-plus"),'id' => 'post_sorting','data_label' => 'sorting',
			'disable' => $disable );
			filter_plus_checkbox_field($args);

			// show tags
			$args = array('label'=>esc_html__("Display Tags:","filter-plus"),'id' => 'post_tags','data_label' => 'post_tags',
			'disable' => $disable );
			filter_plus_checkbox_field($args);
			// show post categories
			$args = array('label'=>esc_html__("Display Categories:","filter-plus"),'id' => 'post_categories',
			'data_label' => 'post_categories', 'disable' => $disable );
			filter_plus_checkbox_field($args);
		?>
		<div class="single-block">
			<div class="generate-block"><button class="button button-primary"><?php esc_html_e("Copy Filer Shortcodes","filter-plus");?></button></div>
			<input type="text" class="full_input" id="wp_filter_shortcode" value="">
		</div>
	</div>
</div>