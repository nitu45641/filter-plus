<?php

namespace FilterPlus\Core\Widgets\Bricks;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use FilterPlus\Base\DataFactory;
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
		// masonry style
		$this->controls['masonry_style'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Masonry Style', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);
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


		//title
		$this->controls['title'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Title', 'filter-plus' ),
			'type' => 'text',
			'default' => esc_html__( 'Place Title Here', 'filter-plus' ),
		);

		//limit
		$this->controls['no_of_items'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'No of Items Per Page', 'filter-plus' ),
			'type' => 'text',
			'default' => esc_html__( 'Place No of Items Per Page', 'filter-plus' ),
		);

		// filter position
		$this->controls['filter_position'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Filter Position', 'filter-plus' ),
			'type' => 'select',
			'options' => \FilterPlus\Utils\Helper::filter_position(),
			'inline' => true,
			'placeholder' => esc_html__( 'Select Filter Position', 'filter-plus' ),
			'single' => true,
			'searchable' => true,
			'clearable' => true,
			'default' => 'left',
		);

		// pagination style
		$this->controls['pagination_style'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Pagination Style', 'filter-plus' ),
			'type' => 'select',
			'options' => \FilterPlus\Utils\Helper::pagination_style(),
			'inline' => true,
			'placeholder' => esc_html__( 'Select Pagination Style', 'filter-plus' ),
			'single' => true,
			'searchable' => true,
			'clearable' => true,
			'default' => 'numbers',
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

		$this->controls['category_template'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Select Category Filter Template', 'filter-plus' ),
			'type' => 'select',
			'options' => DataFactory::category_template('elementor')['template'],
			'inline' => true,
			'placeholder' => esc_html__( 'Select Template', 'filter-plus' ),
			'single' => true,
			'searchable' => true,
			'clearable' => true,
			'default' => '1',
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
		$desc = esc_html__('Select Custom Field','filter-plus');
		if (count($custom_fields) == 0 ) {
			$desc = esc_html__('Create New Custom Field From','filter-plus') .' '.'<a href='.esc_url(admin_url().'admin.php?page=filter-options>').' target="_blank">'.
			 esc_html__('Filter Options','filter-plus').'</a>';
		}
		$this->controls['custom_field_list'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Custom Field List', 'filter-plus' ),
			'description' => $desc,
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
		$this->controls['hide_wp_title'] = array(
			'tab' => 'content',
			'group' => 'filter-result',
			'label' => esc_html__( 'Display Title', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		$this->controls['hide_wp_desc'] = array(
			'tab' => 'content',
			'group' => 'filter-result',
			'label' => esc_html__( 'Display Descrtiption', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);
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
		$settings = $this->settings;
		$root_classes[] = 'fplus-wp-wrapper';
		if ( ! empty( $this->settings['type'] ) ) {
			$root_classes[] = "color-{$this->settings['type']}";
		}
		$this->set_attribute( '_root', 'class', $root_classes );

		echo "<div {$this->render_attributes( '_root' )}>";
		echo \FilterPlus\Base\DataFactory::instance()->wp_render_html( $settings );
		echo '</div>';
	}
}
