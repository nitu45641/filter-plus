<?php

namespace FilterPlus\Core\Widgets\Elementor;

defined( 'ABSPATH' ) || exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use FilterPlus\Base\DataFactory;
use FilterPlus\Utils\Helper as Helper;
class Woo_Filter extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'filter-plus-woo';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'WooCommerce Product Filter', 'filter-plus' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-menu-card';
	}

	/**
	 * Retrieve the widget category.
	 *
	 * @return array Widget category.
	 */
	public function get_categories() {
		return array( 'filter-plus' );
	}

	protected function register_controls() {
		// Start of event section
		$this->start_controls_section(
			'section_tab',
			array(
				'label' => esc_html__( 'Filter Options', 'filter-plus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			)
		);

		// masonry style
		$this->add_control(
			'masonry_style',
			array(
				'label' => esc_html__( 'Masonry Style', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);

		// apply button mode
		$this->add_control(
			'apply_button_mode',
			array(
				'label' => esc_html__( 'Apply Button Mode', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => '',
			)
		);

		$this->add_control(
			'apply_button_label',
			array(
				'label'     => esc_html__( 'Apply Button Label', 'filter-plus' ),
				'type'      => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Apply', 'filter-plus' ),
				'condition' => array( 'apply_button_mode' => 'yes' ),
			)
		);

		$this->add_control(
			'reset_button_label',
			array(
				'label'     => esc_html__( 'Reset Button Label', 'filter-plus' ),
				'type'      => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Reset', 'filter-plus' ),
				'condition' => array( 'apply_button_mode' => 'yes' ),
			)
		);

		$this->add_control(
			'template',
			array(
				'label' => esc_html__( 'Select Style', 'filter-plus' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => Helper::widgets_templates(7),
			)
		);
		$this->add_control(
			'title',
			array(
				'label'     => esc_html__( 'Title', 'filter-plus' ),
				'type'      => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Place Title', 'filter-plus' ),
			)
		);

		$this->add_control(
			'no_of_items',
			array(
				'label'     => esc_html__( 'No of Items Per Page', 'filter-plus' ),
				'type'      => Controls_Manager::NUMBER,
				'placeholder' => esc_html__( 'Place No of Items Per Page', 'filter-plus' ),
			)
		);

		$this->add_control(
			'filter_position',
			array(
				'label' => esc_html__( 'Filter Position', 'filter-plus' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Helper::filter_position(),
				'multiple' => false,
				'default' => 'left'
			)
		);

		$this->add_control(
			'pagination_style',
			array(
				'label' => esc_html__( 'Pagination Style', 'filter-plus' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Helper::pagination_style(),
				'multiple' => false,
				'default' => 'numbers'
			)
		);
		$this->add_control(
			'category_template',
			array(
				'label' => esc_html__( 'Select Category Filter Template', 'filter-plus' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => DataFactory::category_template('elementor')['template'],
			)
		);
		$this->add_control(
			'category_label',
			array(
				'label'     => esc_html__( 'Category Label', 'filter-plus' ),
				'type'      => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Place Category Label Here', 'filter-plus' ),
			)
		);
		$this->add_control(
			'categories',
			array(
				'label' => esc_html__( 'Categories', 'filter-plus' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Helper::get_categories( '', 'widget' ),
				'multiple' => true,
			)
		);
		$this->add_control(
			'hide_empty_cat',
			array(
				'label' => esc_html__( 'Hide Empty Category', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control(
			'sub_categories',
			array(
				'label' => esc_html__( 'Show Sub Categories', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		
		$this->add_control(
			'product_count',
			array(
				'label' => esc_html__( 'Show Product Count', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);

		$this->add_control(
			'colors',
			array(
				'label' => esc_html__( 'Show Color', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control(
			'color_template',
			array(
				'label' => esc_html__( 'Select Color Filter Template', 'filter-plus' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => DataFactory::color_template('elementor')['template'],
				'condition' => array( 'colors' => 'yes' )
			)
		);
		$this->add_control(
			'color_label',
			array(
				'label'     => esc_html__( 'Color Label', 'filter-plus' ),
				'type'      => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Place Color Label Here', 'filter-plus' ),
				'condition' => array( 'colors' => 'yes' ),
			)
		);

		$this->add_control(
			'size',
			array(
				'label' => esc_html__( 'Show Size', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control(
			'size_label',
			array(
				'label'     => esc_html__( 'Size Label', 'filter-plus' ),
				'type'      => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Place Size Label Here', 'filter-plus' ),
				'condition' => array( 'size' => 'yes' ),
			)
		);

		$this->add_control(
			'show_tags',
			array(
				'label' => esc_html__( 'Show Tags', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);

		$this->add_control(
			'tag_label',
			array(
				'label'     => esc_html__( 'Tag Label', 'filter-plus' ),
				'type'      => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Place Tag Label Here', 'filter-plus' ),
				'condition' => array( 'show_tags' => 'yes' ),
			)
		);

		$this->add_control(
			'tags',
			array(
				'label' => esc_html__( 'Tags', 'filter-plus' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Helper::get_product_tags( 'product_tag', 'assoc' ),
				'multiple' => true,
				'condition' => array( 'show_tags' => 'yes' ),
			)
		);

		$this->add_control(
			'show_attributes',
			array(
				'label' => esc_html__( 'Show Attributes', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);

		$this->add_control(
			'attribute_label',
			array(
				'label'     => esc_html__( 'Attribute Label', 'filter-plus' ),
				'type'      => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Place Attribute Label Here', 'filter-plus' ),
				'condition' => array( 'show_attributes' => 'yes' ),
			)
		);

		$this->add_control(
			'attributes',
			array(
				'label'     => esc_html__( 'Attributes', 'filter-plus' ),
				'type'      => Controls_Manager::SELECT2,
				'options'   => Helper::woo_attribute_list( 'assoc' ),
				'multiple'  => true,
				'condition' => array( 'show_attributes' => 'yes' ),
			)
		);

		$this->add_control(
			'show_price_range',
			array(
				'label' => esc_html__( 'Show Price Range', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);

		$this->add_control(
			'price_range_label',
			array(
				'label'     => esc_html__( 'Price Range Label', 'filter-plus' ),
				'type'      => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Place Price Range Label Here', 'filter-plus' ),
				'condition' => array( 'show_price_range' => 'yes' ),
			)
		);

		$this->add_control(
			'show_reviews',
			array(
				'label' => esc_html__( 'Show Reviews', 'filter-plus' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control(
			'review_template',
			array(
				'label' => esc_html__( 'Select Review Filter Template', 'filter-plus' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => DataFactory::review_template('elementor')['template'],
				'condition' => array( 'show_reviews' => 'yes' )
			)
		);
		$this->add_control(
			'review_label',
			array(
				'label'     => esc_html__( 'Review Label', 'filter-plus' ),
				'type'      => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Place Review Label Here', 'filter-plus' ),
				'condition' => array( 'show_reviews' => 'yes' ),
			)
		);

		$this->add_control(
			'stock',
			array(
				'label' => esc_html__( 'Filter By Stock', 'filter-plus' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);

		$this->add_control(
			'stock_label',
			array(
				'label'     => esc_html__( 'Stock Label', 'filter-plus' ),
				'type'      => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Place Stock Label Here', 'filter-plus' ),
				'condition' => array( 'stock' => 'yes' ),
			)
		);

		$this->add_control(
			'on_sale',
			array(
				'label' => esc_html__( 'Sales', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);

		$this->add_control(
			'on_sale_label',
			array(
				'label'     => esc_html__( 'On Sale Label', 'filter-plus' ),
				'type'      => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Place On Sale Label Here', 'filter-plus' ),
				'condition' => array( 'on_sale' => 'yes' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'filter-result',
			array(
				'label' => esc_html__( 'Filter Result Options', 'filter-plus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			)
		);

		// Right Side
		$this->add_control('hide_prod_title',
			array(
				'label' => esc_html__( 'Display Title', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control('hide_prod_desc',
			array(
				'label' => esc_html__( 'Display Descrtiption', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control('hide_prod_price',
			array(
				'label' => esc_html__( 'Display Price', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control('hide_prod_add_cart',
			array(
				'label' => esc_html__( 'Display Add to Cart', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control('hide_prod_rating',
			array(
				'label' => esc_html__( 'Display Rating', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control('sorting',
			array(
				'label' => esc_html__( 'Display Sorting', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control(
			'product_categories',
			array(
				'label' => esc_html__( 'Display Categories', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);

		$this->add_control(
			'product_tags',
			array(
				'label' => esc_html__( 'Display Tags', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_style',
			array(
				'label' => esc_html__( 'Title Style', 'filter-plus' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'titlte_color',
			array(
				'label'         => esc_html__( 'Title Color', 'filter-plus' ),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => array(
					'{{WRAPPER}} .category-title a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_bg_color',
			array(
				'label'         => esc_html__( 'Title BG Color', 'filter-plus' ),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => array(
					'{{WRAPPER}} .category-title a' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'         => 'title_typo',
				'label'         => esc_html__( 'Typography', 'filter-plus' ),
				'selector'     => '{{WRAPPER}} .category-title',
			)
		);
		$this->add_responsive_control(
			'title_padding',
			array(
				'label' => esc_html__( 'Padding', 'filter-plus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors' => array(
					'{{WRAPPER}} .category-title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'readmore_btn_style',
			array(
				'label' => esc_html__( 'Button Style', 'filter-plus' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => array( 'food_cat_style' => 'style-4' ),
			)
		);
		$this->add_control(
			'btn_color',
			array(
				'label'         => esc_html__( 'Button Color', 'filter-plus' ),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => array(
					'{{WRAPPER}} .readmore-link' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn_hover_color',
			array(
				'label'         => esc_html__( 'Button Hover Color', 'filter-plus' ),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => array(
					'{{WRAPPER}} .single-cat-item:hover .readmore-link' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn_bg_color',
			array(
				'label'         => esc_html__( 'Button BG Color', 'filter-plus' ),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => array(
					'{{WRAPPER}} .readmore-link' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'btn_bg_hover_color',
			array(
				'label'         => esc_html__( 'Button BG Hover Color', 'filter-plus' ),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => array(
					'{{WRAPPER}} .single-cat-item:hover .readmore-link' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'         => 'btn_typo',
				'label'         => esc_html__( 'Typography', 'filter-plus' ),
				'selector'     => '{{WRAPPER}} .readmore-link',
			)
		);
		$this->add_responsive_control(
			'btn_width',
			array(
				'label' => esc_html__( 'Width', 'filter-plus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .readmore-link' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'btn_height',
			array(
				'label' => esc_html__( 'Height', 'filter-plus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .readmore-link' => 'min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'thumbnail_style',
			array(
				'label' => esc_html__( 'Thumbnail Style', 'filter-plus' ),
				'tab' => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'img_width',
			array(
				'label' => esc_html__( 'Width', 'filter-plus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .cat-thumb' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'img_height',
			array(
				'label' => esc_html__( 'Height', 'filter-plus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .cat-thumb' => 'min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'advance_style',
			array(
				'label' => esc_html__( 'Advance Style', 'filter-plus' ),
				'tab' => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'box_bg_color',
			array(
				'label'         => esc_html__( 'Box Background Color', 'filter-plus' ),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => array(
					'{{WRAPPER}} .category-list-style4 .single-cat-item' => 'background-color: {{VALUE}};',
				),
				'condition' => array( 'food_cat_style' => array( 'style-4' ) ),
			)
		);

		$this->add_control(
			'box_bg_hover_color',
			array(
				'label'         => esc_html__( 'Box Hover Bacground Color', 'filter-plus' ),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => array(
					'{{WRAPPER}} .category-list-style4 .single-cat-item:hover' => 'background-color: {{VALUE}};',
				),
				'condition' => array( 'food_cat_style' => array( 'style-4' ) ),
			)
		);

		$this->add_responsive_control(
			'box_border_radius',
			array(
				'label' => esc_html__( 'Border Radius', 'filter-plus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors' => array(
					'{{WRAPPER}} .single-cat-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'box_margin',
			array(
				'label' => esc_html__( 'Margin', 'filter-plus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors' => array(
					'{{WRAPPER}} .single-cat-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget
	 */
	protected function render() {
		$settings   = $this->get_settings();
		echo wp_kses_post( \FilterPlus\Base\DataFactory::instance()->woo_render_html( $settings ) );
	}

}

