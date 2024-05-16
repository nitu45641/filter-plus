
<?php

    if ( ! defined( 'ABSPATH' ) ) exit; 

    use \FilterPlus\Core\Admin\FilterOptions\Helper as FilterOptionsHelper;
    use \FilterPlus\Utils\Helper as Helper;
?>
<div class="content-wrapper">
	<div class="shortcode-block" data-name="wp_filter_plus">
		<h1 class="font_bold font_16 mb-1"><?php esc_html_e("Available Wordpress Filter Section","filter-plus"); ?></h1>
		<?php
			$doc_url 	= '<a target="_blank" href="https://docs.woooplugin.com/docs/filter-plus/wordpress-filter/show-wordpress-filter/"> ['.__( "Documentation Link", "filter-plus" ).'] </a>';
			$docs 		= '<div class="documentation mb-1"><i class="doc">'.esc_html__('Gutenberg Block , Elementor widget is available for filter features. ','filter-plus') . $doc_url . '</i></div>';
			echo FilterPlus\Utils\Helper::kses( $docs );
			// templates
			$args 		= array('label'=>esc_html__("Select Template:","filter-plus"),'id' => 'post_template',
			'data_label' => 'template','options'=>[1,2,3],'type'=>'template' );
			if ( $disable ) {
				$args['template_disable'] = 1;
			}
			filter_plus_select_field($args);

			// categories
			$args        = array('label'=>esc_html__("Category Label:","filter-plus"),'id' => 'category_label',
			'wrapper_type'=>'fwp','placeholder'=>esc_html__("Place Category Label Here","filter-plus"),
			'data_label' => 'category_label');
			filter_plus_number_input_field($args);

			$get_categories = \FilterPlus\Utils\Helper::get_categories('',false,array('taxonomy'=>'category'));
			$args = array('label'=>esc_html__("Category List:","filter-plus"),'id' => 'wp_categories',
			'select_type'=>'multiple','data_label' => 'categories','options'=>$get_categories);
			filter_plus_select_field($args);
			// sub categories
			$args = array('label'=>esc_html__("Display Sub Categories:","filter-plus"),'id' => 'wp_sub_categories','data_label' => 'sub_categories');
			filter_plus_checkbox_field($args);
			
			// post type
			$args = array('label'=>esc_html__("Select Type:","filter-plus"),'id' => 'filter_type',
				'data_label' => 'filter_type','options'=>
				array('post'=>esc_html__("Post","filter-plus"),'custom_post'=>esc_html__("Custom Post","filter-plus")),'type'=>'random',
				'select_type' => 'single');

			filter_plus_select_field($args);

			// custom post type
			$get_custom_post = Helper::custom_post_type();
			
			$args 		= array('label'=>esc_html__("Custom Post:","filter-plus"),'id' => 'custom_post',
			'data_label' => 'custom_post','options'=>$get_custom_post,'type'=>'random',
			'condition_class' => "filter_type d-none", );
			filter_plus_select_field($args);

			// show tags
			$args = array('label'=>esc_html__("Tags:","filter-plus"),'id' => 'show_wp_tags','data_label' => 'show_tags' );
			filter_plus_checkbox_field($args) ;

			$args        = array('label'=>esc_html__("Tag Label:","filter-plus"), 
			'wrapper_type'=>'fwp', 'id' => 'tag_label',
			'data_label' => 'tag_label','condition_class' => "show_wp_tags d-none",
			'placeholder'=>esc_html__("Place Tag Label Here","filter-plus"));
			filter_plus_number_input_field($args);
			
			// get tag list
			$get_tags   = Helper::get_product_tags('post_tag');

			$args       = array('label'=>esc_html__("Tag List:","filter-plus"),'id' => 'post_tags',
			'data_label' => 'tags','options'=>$get_tags , 'select_type' => 'multiple',  'condition_class' => "show_wp_tags d-none");

			filter_plus_select_field($args);

			// show author
			$args = array( 'label'=>esc_html__("Author:","filter-plus"),'id' => 'author',
			'data_label' => 'author');
			filter_plus_checkbox_field($args);

			// author list
			$author_list = Helper::instance()->author_list();
			$meta_keys = Helper::instance()->get_custom_fields_keys();
			$conditions = Helper::instance()->custom_field_condition();

			$args        = array('label'=>esc_html__("Author Label:","filter-plus"),'id' => 'author_label',
			'data_label' => 'author_label','condition_class' => "author d-none",
			'placeholder'=>esc_html__('Place Author Label Here','filter-plus') );
			filter_plus_number_input_field($args);

			$args        = array('label'=>esc_html__('Author List:','filter-plus'),'id' => 'author_list',
			'data_label' => 'author_list','options'=>$author_list , 'type' => 'random',
			'select_type' => 'multiple',  'condition_class' => "author d-none" );
			filter_plus_select_field($args);

			// show custom field
			$args = array( 'label'=>esc_html__('Show Custom Field:','filter-plus'),'id' => 'custom_field','data_label' => 'custom_field');
			filter_plus_checkbox_field($args);
			if ( !class_exists('FilterPlusPro') ) {
				$args        = array('label'=>esc_html__('Custom Field Label:','filter-plus'),'id' => 'custom_field_label',
				'data_label' => 'custom_field_label','condition_class' => "custom_field d-none",
				'placeholder'=>esc_html__('Place Custom Field Here','filter-plus'));
				filter_plus_number_input_field($args);
				
				$args        = array('label'=>esc_html__("Custom Field List:","filter-plus"),'id' => 'custom_field_list',
				'data_label' => 'custom_field_list','options'=>$meta_keys , 'type' => 'random',
				'select_type' => 'single',  'condition_class' => "custom_field d-none");
				filter_plus_select_field($args);
			}
			else{
				$get_data = FilterOptionsHelper::instance()->get_filter_options(-1,'custom_field');
				
				$args        = array('label'=>esc_html__("Custom Field List:","filter-plus"),'id' => 'custom_field_list',
				'data_label' => 'custom_field_list','options'=>$get_data , 'type' => 'random',
				'select_type' => 'multiple',  'condition_class' => "custom_field d-none");

				filter_plus_select_field($args);
			}


		?>

		<h1 class="font_bold font_20 mt-1 mb-1"><?php esc_html_e("Filter Result","filter-plus"); ?></h1>
		
		<?php
			// show tags
			$args = array('label'=>esc_html__("Display Tags:","filter-plus"),'id' => 'post_tags','data_label' => 'post_tags');
			filter_plus_checkbox_field($args);
			// show post categories
			$args = array('label'=>esc_html__("Display Categories:","filter-plus"),'id' => 'post_categories',
			'data_label' => 'post_categories');
			filter_plus_checkbox_field($args);
			// show post author
			$args = array('label'=>esc_html__("Display Author:","filter-plus"),'id' => 'post_author',
			'data_label' => 'post_author');
			filter_plus_checkbox_field($args);
		?>
		<div class="single-block">
			<div class="generate-block"><button class="button button-primary"><?php esc_html_e("Copy Filter Shortcodes","filter-plus");?></button></div>
			<input type="text" class="full_input" id="wp_filter_shortcode" value="">
		</div>
	</div>
</div>