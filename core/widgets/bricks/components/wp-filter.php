<?php

namespace FilterPlus\Core\Widgets\Bricks;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use \FilterPlus\Core\Admin\FilterOptions\Helper as OptionHelper;

class Wp_Filter extends \Bricks\Element {
	// Element properties
	public $category     = 'filter plus';
	public $name         = 'fplus-wp';
	public $icon         = 'ti-filter';
	public $css_selector = '.fplus-wp-wrapper';

	// Return localised element label
	public function get_label() {
		return esc_html__( 'Wordpress Filter', 'filter-plus' );
	}

	// Set builder control groups
	public function set_control_groups() {

		$this->control_groups['filter_options'] = array(
			'title' => esc_html__( 'Filter Options', 'filter-plus' ),
			'tab' => 'content',
		);

		$this->control_groups['filter-result'] = array(
			'title' => esc_html__( 'Filter Result Options', 'filter-plus' ),
			'tab' => 'content',
		);
	}

	// Set builder controls
	public function set_controls() {
		// templates
		$this->controls['template'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Style', 'filter-plus' ),
			'type' => 'select',
			'options' => \FilterPlus\Utils\Helper::widgets_templates(3),
			'inline' => true,
			'placeholder' => esc_html__( 'Select Style', 'filter-plus' ),
			'single' => true,
			'searchable' => false,
			'clearable' => true,
			'default' => '1',
		);
		//filter type
		$this->controls['filter_type'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Select Filter Type', 'filter-plus' ),
			'type' => 'select',
			'options' => array(
				'post' => __( 'Post', 'filter-plus' ) ,
				'custom_post' => __( 'Custom Post', 'filter-plus' ),
			),
			'inline' => true,
			'placeholder' => esc_html__( 'Select Filter Type', 'filter-plus' ),
			'single' => true,
			'searchable' => true,
			'clearable' => true,
			'default' => 'post',
		);
		$this->controls['custom_post'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Select Custom Post Type', 'filter-plus' ),
			'type' => 'select',
			'options' => \FilterPlus\Utils\Helper::custom_post_type(),
			'inline' => true,
			'placeholder' => esc_html__( 'Select Custom Post Type', 'filter-plus' ),
			'single' => true,
			'searchable' => true,
			'clearable' => true,
			'default' => '1',
			'required' => array( 'filter_type', '=', 'custom_post' )
		);
		// Category
		$this->controls['show_categories'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Display Categories', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);
		$this->controls['category_label'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Category Label', 'filter-plus' ),
			'type' => 'text',
			'default' => esc_html__( 'Place Category Label Here', 'filter-plus' ),
			'required' => array( 'show_categories', '=', true )
		);

		$this->controls['categories'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Categories', 'filter-plus' ),
			'type' => 'select',
			'options' => \FilterPlus\Utils\Helper::get_categories( '', 'widget' , array('taxonomy'=>'category') ),
			'inline' => true,
			'placeholder' => esc_html__( 'Select Categories', 'filter-plus' ),
			'multiple' => true,
			'searchable' => true,
			'clearable' => true,
			'default' => '',
			'required' => array( 'show_categories', '=', true )
		);

		// Sub Categories
		$this->controls['sub_categories'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Show Sub Categories', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		// Tags
		$this->controls['show_tags'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Show Tags', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		$this->controls['tag_label'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Tag Label', 'filter-plus' ),
			'type' => 'text',
			'default' => esc_html__( 'Place Tag Label Here', 'filter-plus' ),
			'required' => array( 'show_tags', '=', true ),
		);

		$this->controls['tags'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Tags', 'filter-plus' ),
			'type' => 'select',
			'options' => \FilterPlus\Utils\Helper::get_product_tags( 'post_tag', 'assoc' ),
			'inline' => true,
			'placeholder' => esc_html__( 'Select Tag', 'filter-plus' ),
			'multiple' => true,
			'searchable' => true,
			'clearable' => true,
			'default' => '',
			'required' => array( 'show_tags', '=', true ),
		);

		// Authors
		$this->controls['author'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Display Authors', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		$this->controls['author_label'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Author Label', 'filter-plus' ),
			'type' => 'text',
			'default' => esc_html__( 'Place Author Label Here', 'filter-plus' ),
			'required' => array( 'author', '=', true ),
		);

		$this->controls['author_list'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Author List', 'filter-plus' ),
			'type' => 'select',
			'options' => \FilterPlus\Utils\Helper::instance()->author_list( '','assoc' ),
			'inline' => true,
			'placeholder' => esc_html__( 'Select Authors', 'filter-plus' ),
			'multiple' => true,
			'searchable' => true,
			'clearable' => true,
			'default' => '',
			'required' => array( 'author', '=', true ),
		);

		// Custom Field
		$this->controls['custom_field'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Display Custom Field', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		$custom_fields	= OptionHelper::instance()->get_filter_options(-1,'custom_field');

		$this->controls['custom_field_list'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Custom Field List', 'filter-plus' ),
			'type' => 'select',
			'options' => $custom_fields,
			'inline' => true,
			'placeholder' => esc_html__( 'Select Custom Field List', 'filter-plus' ),
			'multiple' => true,
			'searchable' => true,
			'clearable' => true,
			'default' => '',
			'required' => array( 'custom_field', '=', true )
		);

		// Filter Results

		$this->controls['post_categories'] = array(
			'tab' => 'content',
			'group' => 'filter-result',
			'label' => esc_html__( 'Display Categories', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		$this->controls['post_tags'] = array(
			'tab' => 'content',
			'group' => 'filter-result',
			'label' => esc_html__( 'Display Tags', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		$this->controls['post_author'] = array(
			'tab' => 'content',
			'group' => 'filter-result',
			'label' => esc_html__( 'Display Author', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);
	}

	// Enqueue element styles and scripts
	public function enqueue_scripts() {
		wp_enqueue_script( 'fplus-wp-script' );
	}

	// Render element HTML
	public function render() {

		extract( $this->settings );

		$custom_fields = '';
		if (!empty($custom_field_list)) {
			$custom_fields  = is_array($custom_field_list) ? implode(',',$custom_field_list) : $custom_field_list;
		}

		$filter_type        = !empty($filter_type) ? $filter_type : 'post';
		$custom_post        = !empty($custom_post) ? $custom_post : '';
		$template           = !empty($template) ? $template[0] : '1';
		$show_categories    = !empty($show_categories) ? $show_categories : 'yes';
		$category_label     = !empty($category_label) ? $category_label : esc_html__('Categories','filter-plus');
		$categories         = !empty($categories) && is_array($categories) ? implode(',',$categories) : '';
		$sub_categories     = !empty($sub_categories) && $sub_categories == true ? 'yes' : 'no';
		$show_tags          = !empty($show_tags) && $show_tags == true ? 'yes' : 'no';
		$tag_label 	        = !empty($tag_label) ? $tag_label : esc_html__('Tags','filter-plus');
		$tags               = !empty($tags) && is_array($tags) ? implode(',',$tags) : '';
		$author	            = !empty($author) && $author == true ? 'yes' : 'no';
		$author_label	    = !empty($author_label) ? $author_label : esc_html__('Authors','filter-plus');
		$author_list	    = !empty($author_list) && is_array($author_list) ? implode(',',$author_list) : '';
		$custom_field	    = !empty($custom_field) && $custom_field == true ? 'yes' : 'no';
		$custom_field_label	= !empty($custom_field_label) ? $custom_field_label : esc_html__('Custom Field','filter-plus');
		$meta_condition	    = !empty($meta_condition) ? $meta_condition : 'OR';
		$post_categories    = !empty($post_categories) && $post_categories == true ? 'yes' : 'no';
		$post_tags          = !empty($post_tags) && $post_tags == true ? 'yes' : 'no';
		$post_author        = !empty($post_author) && $post_author == true ? 'yes' : 'no';

		$root_classes[] = 'fplus-wp-wrapper';
		if ( ! empty( $this->settings['type'] ) ) {
			$root_classes[] = "color-{$this->settings['type']}";
		}
		$this->set_attribute( '_root', 'class', $root_classes );

		echo "<div {$this->render_attributes( '_root' )}>";

        echo do_shortcode("[wp_filter_plus filter_type={$filter_type} custom_post={$custom_post} show_categories={$show_categories} 
        category_label='".$category_label."' 
		sub_categories='".$sub_categories."' 
        categories='{$categories}' show_tags='{$show_tags}' tags='{$tags}' tag_label='".$tag_label."'
        template ={$template} author={$author} author_label='".$author_label."' author_list={$author_list} 
        custom_field={$custom_field} custom_field_label='".$custom_field_label."' meta_condition={$meta_condition}
        custom_field_list={$custom_fields} post_tags='{$post_tags}'
        post_categories='{$post_categories} post_author={$post_author}']");  

		echo '</div>';
	}
}
