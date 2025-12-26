
<?php

    if ( ! defined( 'ABSPATH' ) ) exit;

    use \FilterPlus\Core\Admin\FilterOptions\Helper as OptionHelper;
    use \FilterPlus\Utils\Helper as Helper;
?>
<div class="content-wrapper">
	<div class="shortcode-block" data-name="wp_filter_plus">
		<h1 class="mt-1 mb-0 font_bold font_20"><?php esc_html_e("Available Wordpress Filter Section","filter-plus"); ?></h1>
		<?php
			$filterplus_doc_url = '<a target="_blank" href="https://wpbens.com/docs/filter-plus/wordpress/display-filter/"> [' . esc_html__( 'Documentation Link', 'filter-plus' ) . '] </a>';
			$filterplus_docs    = '<div class="documentation mb-1"><div class="doc">' . esc_html__( 'Gutenberg Block , Elementor widget is available for filter features.', 'filter-plus' ) . ' ' . $filterplus_doc_url . '</div></div>';
			echo wp_kses_post( $filterplus_docs );

			// apply button mode
			$filterplus_args = array('label'=>esc_html__("Apply Button Mode:","filter-plus"),'id' => 'wp_apply_button_mode','data_label' => 'apply_button_mode');
			filterplus_checkbox_field($filterplus_args);

			// apply button label
			$filterplus_args = array('label'=>esc_html__("Apply Button Label:","filter-plus"),'id' => 'wp_apply_button_label',
			'placeholder'=>esc_html__("Apply","filter-plus"),
			'data_label' => 'apply_button_label','condition_class' => 'wp_apply_button_mode d-none');
			filterplus_number_input_field($filterplus_args);

			// reset button label
			$filterplus_args = array('label'=>esc_html__("Reset Button Label:","filter-plus"),'id' => 'wp_reset_button_label',
			'placeholder'=>esc_html__("Reset","filter-plus"),
			'data_label' => 'reset_button_label','condition_class' => 'wp_apply_button_mode d-none');
			filterplus_number_input_field($filterplus_args);

			// masonry style
			$filterplus_args = array('label'=>esc_html__("Masonry Style:","filter-plus"),'id' => 'masonry_style','data_label' => 'masonry_style');
			filterplus_checkbox_field($filterplus_args);

			// templates
			$filterplus_args = array('label'=>esc_html__("Select Template:","filter-plus"),'id' => 'post_template',
			'data_label' => 'template','options'=>[1,2,3],'type'=>'template' );
			if ( $disable ) {
				$filterplus_args['template_disable'] = 1;
			}
			filterplus_select_field($filterplus_args);

			// Title
			$filterplus_args = array('label'=>esc_html__("Title:","filter-plus"),'id' => 'title',
			'placeholder'=>esc_html__("Place Title","filter-plus"),
			'data_label' => 'title');
			filterplus_number_input_field($filterplus_args);

			// Limit
			$filterplus_args = array('label'=>esc_html__("No of Items Per Page:","filter-plus"),'id' => 'no_of_items',
			'placeholder'=>esc_html__("Place No of Items Per Page","filter-plus"), 'field_type'=> 'number',
			'data_label' => 'no_of_items');
			filterplus_number_input_field($filterplus_args);

			$filterplus_args = array('label'=>esc_html__("Filter Position:","filter-plus"),'id' => 'filter_position',
			'data_label' => 'filter_position','options'=> Helper::filter_position(),'type'=>'random' );
			filterplus_select_field($filterplus_args);

			$filterplus_args = array('label'=>esc_html__("Pagination Style:","filter-plus"),'id' => 'pagination_style',
			'data_label' => 'pagination_style','options'=> Helper::pagination_style(),'type'=>'random' );
			filterplus_select_field($filterplus_args);

			// categories
			$filterplus_args = array('label'=>esc_html__("Category Label:","filter-plus"),'id' => 'category_label',
			'wrapper_type'=>'fwp','placeholder'=>esc_html__("Place Category Label Here","filter-plus"),
			'data_label' => 'category_label');
			filterplus_number_input_field($filterplus_args);

			$filterplus_categories = Helper::get_categories('',false,array('taxonomy'=>'category'));
			$filterplus_args = array('label'=>esc_html__("Category List:","filter-plus"),'id' => 'wp_categories',
			'select_type'=>'multiple','data_label' => 'categories','options'=>$filterplus_categories);
			filterplus_select_field($filterplus_args);
			// sub categories
			$filterplus_args = array('label'=>esc_html__("Display Sub Categories:","filter-plus"),'id' => 'wp_sub_categories','data_label' => 'sub_categories');
			filterplus_checkbox_field($filterplus_args);

			// post type
			$filterplus_args = array('label'=>esc_html__("Select Type:","filter-plus"),'id' => 'filter_type',
				'data_label' => 'filter_type','options'=>
				array('post'=>esc_html__("Post","filter-plus"),'custom_post'=>esc_html__("Custom Post","filter-plus")),'type'=>'random',
				'select_type' => 'single');

			filterplus_select_field($filterplus_args);

			// custom post type
			$filterplus_custom_post = Helper::custom_post_type();

			$filterplus_args = array('label'=>esc_html__("Custom Post:","filter-plus"),'id' => 'custom_post',
			'data_label' => 'custom_post','options'=>$filterplus_custom_post,'type'=>'random',
			'condition_class' => "filter_type d-none", );
			filterplus_select_field($filterplus_args);

			// show tags
			$filterplus_args = array('label'=>esc_html__("Tags:","filter-plus"),'id' => 'show_wp_tags','data_label' => 'show_tags' );
			filterplus_checkbox_field($filterplus_args) ;

			$filterplus_args = array('label'=>esc_html__("Tag Label:","filter-plus"),
			'wrapper_type'=>'fwp', 'id' => 'tag_label',
			'data_label' => 'tag_label','condition_class' => "show_wp_tags d-none",
			'placeholder'=>esc_html__("Place Tag Label Here","filter-plus"));
			filterplus_number_input_field($filterplus_args);

			// get tag list
			$filterplus_tags = Helper::get_product_tags('post_tag');

			$filterplus_args = array('label'=>esc_html__("Tag List:","filter-plus"),'id' => 'post_tags',
			'data_label' => 'tags','options'=>$filterplus_tags , 'select_type' => 'multiple',  'condition_class' => "show_wp_tags d-none");

			filterplus_select_field($filterplus_args);

			// show author
			$filterplus_args = array( 'label'=>esc_html__("Author:","filter-plus"),'id' => 'author',
			'data_label' => 'author');
			filterplus_checkbox_field($filterplus_args);

			// author list
			$filterplus_author_list = Helper::instance()->author_list();
			$filterplus_meta_keys = Helper::instance()->get_custom_fields_keys();
			$filterplus_conditions = Helper::instance()->custom_field_condition();

			$filterplus_args = array('label'=>esc_html__("Author Label:","filter-plus"),'id' => 'author_label',
			'data_label' => 'author_label','condition_class' => "author d-none",
			'placeholder'=>esc_html__('Place Author Label Here','filter-plus') );
			filterplus_number_input_field($filterplus_args);

			$filterplus_args = array('label'=>esc_html__('Author List:','filter-plus'),'id' => 'author_list',
			'data_label' => 'author_list','options'=>$filterplus_author_list , 'type' => 'random',
			'select_type' => 'multiple',  'condition_class' => "author d-none" );
			filterplus_select_field($filterplus_args);

			// show custom field
			$filterplus_args = array( 'label'=>esc_html__('Show Custom Field:','filter-plus'),'id' => 'custom_field','data_label' => 'custom_field');
			filterplus_checkbox_field($filterplus_args);
			if ( !class_exists('FilterPlusPro') ) {
				$filterplus_args = array('label'=>esc_html__('Custom Field Label:','filter-plus'),'id' => 'custom_field_label',
				'data_label' => 'custom_field_label','condition_class' => "custom_field d-none",
				'placeholder'=>esc_html__('Place Custom Field Here','filter-plus'));
				filterplus_number_input_field($filterplus_args);

				$filterplus_args = array('label'=>esc_html__("Custom Field List:","filter-plus"),'id' => 'custom_field_list',
				'data_label' => 'custom_field_list','options'=>$filterplus_meta_keys , 'type' => 'random',
				'select_type' => 'single',  'condition_class' => "custom_field d-none");
				filterplus_select_field($filterplus_args);
			}
			else{
				$filterplus_custom_fields = OptionHelper::instance()->get_filter_options(-1,'custom_field');
				$filterplus_args = array('label'=>esc_html__("Custom Field List:","filter-plus"),'id' => 'custom_field_list',
				'data_label' => 'custom_field_list','options'=>$filterplus_custom_fields , 'type' => 'random',
				'select_type' => 'multiple',  'condition_class' => "custom_field d-none");

				filterplus_select_field($filterplus_args);
				if ( count( $filterplus_custom_fields ) == 0 ) {
					$filterplus_opt_link = '<a href="' . esc_url( admin_url() . 'admin.php?page=filter-options' ) . '" target="_blank">' . esc_html__( 'Filter Option', 'filter-plus' ) . '</a>';
					echo esc_html__( 'Create New Custom Field', 'filter-plus' ) . ' ' . wp_kses_post( $filterplus_opt_link );
				}
			}

		?>

		<h1 class="font_bold font_20 mb-1"><?php esc_html_e("Filter Result","filter-plus"); ?></h1>

		<?php
			// show title
			$filterplus_args = array('label'=>esc_html__("Hide Title:","filter-plus"),'id' => 'hide_wp_title',
			'data_label' => 'hide_wp_title','checked' => 'yes',);
			filterplus_checkbox_field($filterplus_args);

			// show descrtiption
			$filterplus_args = array('label'=>esc_html__("Hide Descrtiption:","filter-plus"),
			'id' => 'hide_wp_desc','checked' => 'yes',
			'data_label' => 'hide_wp_desc');
			filterplus_checkbox_field($filterplus_args);

			// show tags
			$filterplus_args = array('label'=>esc_html__("Display Tags:","filter-plus"),'id' => 'post_tags','data_label' => 'post_tags');
			filterplus_checkbox_field($filterplus_args);
			// show post categories
			$filterplus_args = array('label'=>esc_html__("Display Categories:","filter-plus"),'id' => 'post_categories',
			'data_label' => 'post_categories');
			filterplus_checkbox_field($filterplus_args);
			// show post author
			$filterplus_args = array('label'=>esc_html__("Display Author:","filter-plus"),'id' => 'post_author',
			'data_label' => 'post_author');
			filterplus_checkbox_field($filterplus_args);
		?>
		<div class="single-block">
			<div class="generate-block"><button class="button button-primary"><?php esc_html_e("Copy Filter Shortcodes","filter-plus");?></button></div>
			<input type="text" class="full_input" id="wp_filter_shortcode" value="">
		</div>
	</div>
</div>
