<?php

namespace FilterPlus\Core\Widgets\Bricks;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Woo_Filter extends \Bricks\Element {
	// Element properties
	public $category     = 'filter-plus';
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
		// Category
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
			'options' => \FilterPlus\Utils\Helper::get_categories( '', 'assoc' ),
			'inline' => true,
			'placeholder' => esc_html__( 'Select Categories', 'filter-plus' ),
			'multiple' => true,
			'searchable' => true,
			'clearable' => true,
			'default' => '',
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
		extract( $this->settings );
        $template           = !empty($template) ? $template[0] : '1';
        $category_label     = !empty($category_label) ? $category_label : esc_html__('Categories','filter-plus');
        $categories         = !empty($categories) ? $categories : '';
        $color_label 		= !empty($color_label) ? $color_label : esc_html__('Colors','filter-plus');
        $colors             = !empty($colors) && $colors == true  ? 'yes' : 'no';
        $size_label			= !empty($size_label) ? $size_label : esc_html__('Size','filter-plus');
        $size               = !empty($size) && $size == true ? 'yes' : 'no';
        $tag_label 	        = !empty($tag_label) ? $tag_label : esc_html__('Tags','filter-plus');
        $show_tags          = !empty($show_tags) && $show_tags == true ? 'yes' : 'no';
        $tags               = !empty($tags) ? $tags : '';
        $attribute_label	= !empty($attribute_label) ? $attribute_label : esc_html__('Attributes','filter-plus');
        $show_attributes    = !empty($show_attributes) && $show_attributes == true ? 'yes' : 'no';
        $attributes         = !empty($attributes) ? $attributes : '';
        $review_label 		= !empty($review_label) ? $review_label : esc_html__('Review','filter-plus');
        $show_reviews       = !empty($show_reviews) && $show_reviews == true ? 'yes' : 'no';
        $price_range_label 	= !empty($price_range_label) ? $price_range_label :  esc_html__('Price Range','filter-plus');
        $show_price_range   = !empty($show_price_range) && $show_price_range == true ? 'yes' : 'no';
        $stock_label 		= !empty($stock_label) ? $stock_label : esc_html__('Stock','filter-plus');
        $stock              = !empty($stock) && $stock == true ? 'yes' : 'no';
        $on_sale_label 		= !empty($on_sale_label) ? $on_sale_label :  esc_html__('Sale','filter-plus');
        $on_sale            = !empty($on_sale) && $on_sale == true ? 'yes' : 'no';
        $sorting            = !empty($sorting) && $sorting == true ? 'yes' : 'no';
        $product_categories = !empty($product_categories) && $product_categories == true ? 'yes' : 'no';
        $product_tags       = !empty($product_tags) && $product_tags == true ? 'yes' : 'no';
        
        if ( is_array($categories) ) {
            $categories     =  join(", ",$categories);
        }
        if ( is_array($tags) ) {
            $tags     =  join(", ",$tags);
        }
        if ( is_array($attributes) ) {
            $attributes     =  join(", ",$attributes);
        }

		$root_classes[] = 'fplus-woo-wrapper';
		if ( ! empty( $this->settings['type'] ) ) {
			$root_classes[] = "color-{$this->settings['type']}";
		}
		$this->set_attribute( '_root', 'class', $root_classes );

		echo "<div {$this->render_attributes( '_root' )}>";
		echo do_shortcode(
			"[filter_products category_label={$category_label} tag_label={$tag_label} color_label={$color_label}
            size_label={$size_label} attribute_label={$attribute_label} review_label={$review_label} price_range_label={$price_range_label}
            stock_label={$stock_label} on_sale_label={$on_sale_label}
            stock={$stock} on_sale={$on_sale} template ={$template} categories='{$categories}' tags='{$tags}' attributes='{$attributes}' colors='{$colors}' size='{$size}' show_tags='{$show_tags}' show_attributes='{$show_attributes}' show_reviews='{$show_reviews}' show_price_range='{$show_price_range}' sorting='{$sorting}' product_tags='{$product_tags}' product_categories='{$product_categories}']"
		);
		echo '</div>';
	}
}
