<?php

namespace FilterPlus\Core\Widgets;

defined("ABSPATH") || exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Filters extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'filter-plus-woo';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__('Filter Woo Products', 'filter-plus');
	}

	/**
	 * Retrieve the widget icon.
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-menu-card';
	}

	/**
	 * Retrieve the widget category.
	 * @return string Widget category.
	 */
	public function get_categories() {
		return ['filter-plus'];
	}

	protected function register_controls() {
		// Start of event section 
		$this->start_controls_section(
			'section_tab',
			[
				'label' => esc_html__('Category List', 'filter-plus'),
			]
		);
		$templates = [
			1  => esc_html__('Template 1', 'filter-plus'),
		];
		if ( class_exists('FilterPlusPro') ) {
			$templates[2] = esc_html__('Template 2', 'filter-plus');
		}
		$this->add_control(
			'template',
			[
				'label' => esc_html__('Category Style', 'filter-plus'),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => $templates,
			]
		);

		$this->add_control(
			'categories',
			[
				'label' => esc_html__('Categories', 'filter-plus'),
				'type' => Controls_Manager::SELECT2,
				'options' => \FilterPlus\Utils\Helper::get_categories('','assoc'),
				'multiple' => true,
			]
		);

		$this->add_control(
			'colors',
			[
				'label' => esc_html__('Show Color', 'filter-plus'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'filter-plus'),
				'label_off' => esc_html__('Hide', 'filter-plus'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
			'size',
			[
				'label' => esc_html__('Show Size', 'filter-plus'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'filter-plus'),
				'label_off' => esc_html__('Hide', 'filter-plus'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_tags',
			[
				'label' => esc_html__('Show Tags', 'filter-plus'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'filter-plus'),
				'label_off' => esc_html__('Hide', 'filter-plus'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'tags',
			[
				'label' => esc_html__('Tags', 'filter-plus'),
				'type' => Controls_Manager::SELECT2,
				'options' => \FilterPlus\Utils\Helper::get_product_tags('product_tag','assoc'),
				'multiple' => true,
				'condition' => ['show_tags' => 'yes']
			]
		);

		$this->add_control(
			'show_attributes',
			[
				'label' => esc_html__('Show Attributes', 'filter-plus'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'filter-plus'),
				'label_off' => esc_html__('Hide', 'filter-plus'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'attributes',
			[
				'label' 	=> esc_html__('Attributes', 'filter-plus'),
				'type' 		=> Controls_Manager::SELECT2,
				'options' 	=> \FilterPlus\Utils\Helper::woo_attribute_list("assoc"),
				'multiple' 	=> true,
				'condition' => ['show_attributes' => 'yes']
			]
		);

		$this->add_control(
			'show_price_range',
			[
				'label' => esc_html__('Display Price Range', 'filter-plus'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'filter-plus'),
				'label_off' => esc_html__('Hide', 'filter-plus'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		// Pro
		if (class_exists('FilterPlusPro')) {

			$this->add_control(
				'show_reviews',
				[
					'label' => esc_html__('Show Reviews', 'filter-plus'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Show', 'filter-plus'),
					'label_off' => esc_html__('Hide', 'filter-plus'),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'stock',
				[
					'label' => esc_html__('Filter By Stock', 'filter-plus'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Show', 'filter-plus'),
					'label_off' => esc_html__('Hide', 'filter-plus'),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'on_sale',
				[
					'label' => esc_html__('Sales', 'filter-plus'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Show', 'filter-plus'),
					'label_off' => esc_html__('Hide', 'filter-plus'),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'sorting',
				[
					'label' => esc_html__('Display Sorting:', 'filter-plus'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Show', 'filter-plus'),
					'label_off' => esc_html__('Hide', 'filter-plus'),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);
			// Right Side
			$this->add_control(
				'product_categories',
				[
					'label' => esc_html__('Display Categories', 'filter-plus'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Show', 'filter-plus'),
					'label_off' => esc_html__('Hide', 'filter-plus'),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'product_tags',
				[
					'label' => esc_html__('Display Tags', 'filter-plus'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Show', 'filter-plus'),
					'label_off' => esc_html__('Hide', 'filter-plus'),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);
		}
		$this->end_controls_section();

		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__('Title Style', 'filter-plus'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'titlte_color',
			[
				'label'         => esc_html__('Title Color', 'filter-plus'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .category-title a' => 'color: {{VALUE}};',
				],
			]
		);

	
		$this->add_control(
			'titlte_bg_color',
			[
				'label'         => esc_html__('Title BG Color', 'filter-plus'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .category-title a' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'         => 'title_typo',
				'label'         => esc_html__('Typography', 'filter-plus'),
				'selector'     => '{{WRAPPER}} .category-title',
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'filter-plus'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .category-title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'readmore_btn_style',
			[
				'label' => esc_html__('Button Style', 'filter-plus'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => ['food_cat_style' => 'style-4']
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label'         => esc_html__('Button Color', 'filter-plus'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .readmore-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_hover_color',
			[
				'label'         => esc_html__('Button Hover Color', 'filter-plus'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .single-cat-item:hover .readmore-link' => 'color: {{VALUE}};',
				],
			]
		);

	
		$this->add_control(
			'btn_bg_color',
			[
				'label'         => esc_html__('Button BG Color', 'filter-plus'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .readmore-link' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_bg_hover_color',
			[
				'label'         => esc_html__('Button BG Hover Color', 'filter-plus'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .single-cat-item:hover .readmore-link' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'         => 'btn_typo',
				'label'         => esc_html__('Typography', 'filter-plus'),
				'selector'     => '{{WRAPPER}} .readmore-link',
			]
		);
		$this->add_responsive_control(
			'btn_width',
			[
				'label' => esc_html__('Width', 'filter-plus'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .readmore-link' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_height',
			[
				'label' => esc_html__('Height', 'filter-plus'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .readmore-link' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'thumbnail_style',
			[
				'label' => esc_html__('Thumbnail Style', 'filter-plus'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'img_width',
			[
				'label' => esc_html__('Width', 'filter-plus'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cat-thumb' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'img_height',
			[
				'label' => esc_html__('Height', 'filter-plus'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .cat-thumb' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'advance_style',
			[
				'label' => esc_html__('Advance Style', 'filter-plus'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label'         => esc_html__('Box Bacground Color', 'filter-plus'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .category-list-style4 .single-cat-item' => 'background-color: {{VALUE}};',
				],
				'condition' => ['food_cat_style' => ['style-4']],
			]
		);

		$this->add_control(
			'box_bg_hover_color',
			[
				'label'         => esc_html__('Box Hover Bacground Color', 'filter-plus'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .category-list-style4 .single-cat-item:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => ['food_cat_style' => ['style-4']],
			]
		);

		$this->add_responsive_control(
			'box_border_radius',
			[
				'label' => esc_html__('Border Radius', 'filter-plus'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .single-cat-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_margin',
			[
				'label' => esc_html__('Margin', 'filter-plus'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .single-cat-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

    /**
     * Render widget
     *
     */
	protected function render() {
		$settings   = $this->get_settings();
        extract($settings);
		$categories = is_array($categories) ? implode(',',$categories) : '';
		$tags 		= !empty($tags) && is_array($tags) ? implode(',',$tags) : '';
		$show_tags 			= !empty($show_tags) ? $show_tags : '';
		$product_categories = !empty($product_categories) ? $product_categories : '';
		$attributes			= !empty($attributes) ? implode(',',$attributes) : '';
		$show_attributes	= !empty($show_attributes) ? $show_attributes : '';
		$show_reviews 		= !empty($show_reviews) ? $show_reviews : '';
		$show_price_range 	= !empty($show_price_range) ? $show_price_range : '';
		$stock 				= !empty($stock) ? $stock : 'yes';
		$on_sale 			= !empty($on_sale) ? $on_sale : 'yes';
		$sorting 			= !empty($sorting) ? $sorting : '';
		$product_tags 		= !empty($product_tags) ? $product_tags : '';
		$product_categories = !empty($product_categories) ? $product_categories : '';

        echo do_shortcode("[filter_products stock={$stock} on_sale={$on_sale} template ={$template} categories='{$categories}' tags='{$tags}' attributes='{$attributes}' colors='{$colors}' size='{$size}' show_tags='{$show_tags}' show_attributes='{$show_attributes}' show_reviews='{$show_reviews}' show_price_range='{$show_price_range}' sorting='{$sorting}' product_tags='{$product_tags}' product_categories='{$product_categories}']");

	}

}
