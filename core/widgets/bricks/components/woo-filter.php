<?php

namespace FilterPlus\Core\Widgets\Bricks;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use FilterPlus\Base\DataFactory;

class Woo_Filter extends \Bricks\Element {
	public $category     = 'filter plus';
	public $name         = 'fplus-woo';
	public $icon         = 'ti-filter';
	public $css_selector = '.fplus-woo-wrapper';

	// Return localised element label
	public function get_label() {
		return esc_html__( 'WooCommerce Product Filter', 'filter-plus' );
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

		// apply button mode
		$this->controls['apply_button_mode'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Apply Button Mode', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => false,
		);

		$this->controls['apply_button_label'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Apply Button Label', 'filter-plus' ),
			'type' => 'text',
			'default' => esc_html__( 'Apply', 'filter-plus' ),
			'required' => array( 'apply_button_mode', '=', true ),
		);

		$this->controls['reset_button_label'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Reset Button Label', 'filter-plus' ),
			'type' => 'text',
			'default' => esc_html__( 'Reset', 'filter-plus' ),
			'required' => array( 'apply_button_mode', '=', true ),
		);

		// templates
		$this->controls['template'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Style', 'filter-plus' ),
			'type' => 'select',
			'options' => \FilterPlus\Utils\Helper::widgets_templates(),
			'inline' => true,
			'placeholder' => esc_html__( 'Select Style', 'filter-plus' ),
			'single' => true,
			'searchable' => true,
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

		// Category
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
		);

		$this->controls['categories'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Categories', 'filter-plus' ),
			'type' => 'select',
			'options' => \FilterPlus\Utils\Helper::get_categories( '', 'widget' ),
			'inline' => true,
			'placeholder' => esc_html__( 'Select Categories', 'filter-plus' ),
			'multiple' => true,
			'searchable' => true,
			'clearable' => true,
			'default' => '',
		);

		// sub categories
		$this->controls['hide_empty_cat'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Hide Empty Category', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		// sub categories
		$this->controls['sub_categories'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Show Sub Categories', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		// product count
		$this->controls['product_count'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Show Product Count', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);
		
		// colors
		$this->controls['colors'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Show Color', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		$this->controls['color_template'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Select Color Filter Template', 'filter-plus' ),
			'type' => 'select',
			'options' => DataFactory::color_template('elementor')['template'],
			'inline' => true,
			'placeholder' => esc_html__( 'Select Template', 'filter-plus' ),
			'single' => true,
			'searchable' => true,
			'clearable' => true,
			'default' => '1',
			'required' => array( 'colors', '=', true ),
		);

		$this->controls['color_label'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Color Label', 'filter-plus' ),
			'type' => 'text',
			'default' => esc_html__( 'Place Color Label Here', 'filter-plus' ),
			'required' => array( 'colors', '=', true ),
		);

		// Size
		$this->controls['size'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Show Size', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		$this->controls['size_label'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Size Label', 'filter-plus' ),
			'type' => 'text',
			'default' => esc_html__( 'Place Size Label Here', 'filter-plus' ),
			'required' => array( 'size', '=', true ),
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
			'options' => \FilterPlus\Utils\Helper::get_product_tags( 'product_tag', 'assoc' ),
			'inline' => true,
			'placeholder' => esc_html__( 'Select Tag', 'filter-plus' ),
			'multiple' => true,
			'searchable' => true,
			'clearable' => true,
			'default' => '',
			'required' => array( 'show_tags', '=', true ),
		);

		// Attributes
		$this->controls['show_attributes'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Show Attributes', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		$this->controls['attribute_label'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Attribute Label', 'filter-plus' ),
			'type' => 'text',
			'default' => esc_html__( 'Place Attribute Label Here', 'filter-plus' ),
			'required' => array( 'show_attributes', '=', true ),
		);

		$this->controls['attributes'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Attributes', 'filter-plus' ),
			'type' => 'select',
			'options' => \FilterPlus\Utils\Helper::woo_attribute_list( 'assoc' ),
			'inline' => true,
			'placeholder' => esc_html__( 'Select Attributes', 'filter-plus' ),
			'multiple' => true,
			'searchable' => true,
			'clearable' => true,
			'default' => '',
			'required' => array( 'show_attributes', '=', true ),
		);

		// price range
		$this->controls['show_price_range'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Show Price Range', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		$this->controls['price_range_label'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Price Range Label', 'filter-plus' ),
			'type' => 'text',
			'default' => esc_html__( 'Place Price Range Label Here', 'filter-plus' ),
			'required' => array( 'show_price_range', '=', true ),
		);

		// review

		$this->controls['show_reviews'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Show Reviews', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		$this->controls['review_template'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Select Review Filter Template', 'filter-plus' ),
			'type' => 'select',
			'options' => DataFactory::review_template('elementor')['template'],
			'inline' => true,
			'placeholder' => esc_html__( 'Select Template', 'filter-plus' ),
			'single' => true,
			'searchable' => true,
			'clearable' => true,
			'default' => '1',
			'required' => array( 'show_reviews', '=', true ),
		);

		$this->controls['review_label'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Review Label', 'filter-plus' ),
			'type' => 'text',
			'default' => esc_html__( 'Place Review Label Here', 'filter-plus' ),
			'required' => array( 'show_reviews', '=', true ),
		);

		// stock

		$this->controls['stock'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Filter By Stock', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		$this->controls['stock_label'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Stock Label', 'filter-plus' ),
			'type' => 'text',
			'default' => esc_html__( 'Place Stock Label Here', 'filter-plus' ),
			'required' => array( 'stock', '=', true ),
		);

		// on sale

		$this->controls['on_sale'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'Sales', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		$this->controls['on_sale_label'] = array(
			'tab' => 'content',
			'group' => 'filter_options',
			'label' => esc_html__( 'On Sale Label', 'filter-plus' ),
			'type' => 'text',
			'default' => esc_html__( 'Place On Sale Label Here', 'filter-plus' ),
			'required' => array( 'on_sale', '=', true ),
		);

		// Filter Results

		$this->controls['hide_prod_title'] = array(
			'tab' => 'content',
			'group' => 'filter-result',
			'label' => esc_html__( 'Display Title', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		$this->controls['hide_prod_desc'] = array(
			'tab' => 'content',
			'group' => 'filter-result',
			'label' => esc_html__( 'Display Descrtiption', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);
		
		$this->controls['hide_prod_price'] = array(
			'tab' => 'content',
			'group' => 'filter-result',
			'label' => esc_html__( 'Display Price', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);
		$this->controls['hide_prod_add_cart'] = array(
			'tab' => 'content',
			'group' => 'filter-result',
			'label' => esc_html__( 'Display Add to Cart', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);
		$this->controls['hide_prod_rating'] = array(
			'tab' => 'content',
			'group' => 'filter-result',
			'label' => esc_html__( 'Display Rating', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);
		$this->controls['sorting'] = array(
			'tab' => 'content',
			'group' => 'filter-result',
			'label' => esc_html__( 'Display Sorting', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		$this->controls['product_categories'] = array(
			'tab' => 'content',
			'group' => 'filter-result',
			'label' => esc_html__( 'Display Categories', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);

		$this->controls['product_tags'] = array(
			'tab' => 'content',
			'group' => 'filter-result',
			'label' => esc_html__( 'Display Tags', 'filter-plus' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,
		);
	}

	// Enqueue element styles and scripts
	public function enqueue_scripts() {
		wp_enqueue_script( 'fplus-woo-script' );
	}

	// Render element HTML
	public function render() {
		$settings = $this->settings;

		$root_classes[] = 'fplus-woo-wrapper';
		if ( ! empty( $this->settings['type'] ) ) {
			$root_classes[] = "color-{$this->settings['type']}";
		}
		$this->set_attribute( '_root', 'class', $root_classes );

		echo "<div " . wp_kses_post( $this->render_attributes( '_root' ) ) . ">";
		echo wp_kses_post( \FilterPlus\Base\DataFactory::instance()->woo_render_html( $settings ) );
		echo '</div>';
	}
}
