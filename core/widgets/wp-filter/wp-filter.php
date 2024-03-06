<?php

namespace FilterPlus\Core\Widgets;

defined("ABSPATH") || exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Wp_Filter extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'filter-plus-wp';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__('Wordpress Filter', 'filter-plus');
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
				'label' => esc_html__('Filter Options', 'filter-plus'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$pro = "";
		if ( !class_exists('FilterPlusPro') ) {
			$pro  = esc_html__('Pro', 'filter-plus');
		}

		$templates = [
			1  => esc_html__('Template 1', 'filter-plus').' '.$pro,
		];
		$templates[2] = esc_html__('Template 2', 'filter-plus').' '.$pro;
		$templates[3] = esc_html__('Template 3', 'filter-plus').' '.$pro;
		$templates[4] = esc_html__('Template 4', 'filter-plus').' '.$pro;
		
		$this->add_control(
			'template',
			[
				'label' => esc_html__('Select Style', 'filter-plus'),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => $templates,
			]
		);
		$this->add_control(
			'filter_type',
			[
				'label' => esc_html__('Select Filter Type', 'filter-plus'),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array('post'=> esc_html__('Post', 'filter-plus'),
				'custom_post'=> esc_html__('Custom Post', 'filter-plus')),
			]
		);
		$this->add_control(
			'custom_post',
			[
				'label' => esc_html__('Select Custom Post', 'filter-plus'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => \FilterPlus\Utils\Helper::custom_post_type(''),
				'condition' => ['filter_type' => 'custom_post']
			]
		);
		$this->add_control(
			'show_categories',
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
			'category_label',
			[
				'label' 	=> esc_html__('Category Label', 'filter-plus'),
				'type' 		=> Controls_Manager::TEXT,
				'placeholder' => esc_html__('Place Category Label Here', 'filter-plus'),
				'condition' => ['show_categories' => 'yes']
			]
		);
		$this->add_control(
			'categories',
			[
				'label' => esc_html__('Categories', 'filter-plus'),
				'type' => Controls_Manager::SELECT2,
				'options' => \FilterPlus\Utils\Helper::get_categories('category','assoc',array('taxonomy'=>'category')),
				'multiple' => true,
				'condition' => ['show_categories' => 'yes']
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
			'tag_label',
			[
				'label' 	=> esc_html__('Tag Label', 'filter-plus'),
				'type' 		=> Controls_Manager::TEXT,
				'placeholder' => esc_html__('Place Tag Label Here', 'filter-plus'),
				'condition' => ['show_tags' => 'yes']
			]
		);

		$this->add_control(
			'tags',
			[
				'label' => esc_html__('Tags', 'filter-plus'),
				'type' => Controls_Manager::SELECT2,
				'options' => \FilterPlus\Utils\Helper::get_product_tags('post_tag','assoc'),
				'multiple' => true,
				'condition' => ['show_tags' => 'yes']
			]
		);

		$this->add_control(
			'author',
			[
				'label' => esc_html__('Display Authors', 'filter-plus'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'filter-plus'),
				'label_off' => esc_html__('Hide', 'filter-plus'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'author_label',
			[
				'label' 	=> esc_html__('Author Label', 'filter-plus'),
				'type' 		=> Controls_Manager::TEXT,
				'placeholder' => esc_html__('Place Author Label', 'filter-plus'),
				'condition' => ['author' => 'yes']
			]
		);

		$this->add_control(
			'author_list',
			[
				'label' => esc_html__('Author List', 'filter-plus'),
				'type' => Controls_Manager::SELECT2,
				'options' => \FilterPlus\Utils\Helper::instance()->author_list('',''),
				'multiple' => true,
				'condition' => ['author' => 'yes']
			]
		);
		$this->add_control(
			'custom_field',
			[
				'label' => esc_html__('Display Custom Field', 'filter-plus'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'filter-plus'),
				'label_off' => esc_html__('Hide', 'filter-plus'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'custom_field_label',
			[
				'label' 	=> esc_html__('Custom Field Label', 'filter-plus'),
				'type' 		=> Controls_Manager::TEXT,
				'placeholder' => esc_html__('Place Custom Field Label', 'filter-plus'),
				'desc' 		=> esc_html__('Enter Exact Custom Field Name', 'filter-plus'),
				'condition' => ['custom_field' => 'yes']
			]
		);

		$this->add_control(
			'custom_field_list',
			[
				'label' => esc_html__('Custom Field Name', 'filter-plus'),
				'type' => Controls_Manager::TEXT,
				'condition' => ['custom_field' => 'yes']
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'filter-result',
			[
				'label' => esc_html__('Filter Result Options', 'filter-plus'),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);

		// Right Side
		$this->add_control(
			'post_categories',
			[
				'label' => esc_html__('Display Categories in Filter Result', 'filter-plus'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'filter-plus'),
				'label_off' => esc_html__('Hide', 'filter-plus'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'post_tags',
			[
				'label' => esc_html__('Display Tags in Filter Result', 'filter-plus'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'filter-plus'),
				'label_off' => esc_html__('Hide', 'filter-plus'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'post_author',
			[
				'label' => esc_html__('Display Author in Filter Result', 'filter-plus'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'filter-plus'),
				'label_off' => esc_html__('Hide', 'filter-plus'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
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
		\FilterPlus\Utils\Helper::instance()->pro_active_message();
		$settings   = $this->get_settings();
        extract($settings);

		$custom_field_list = '';
		if (!empty($settings['custom_field_list'])) {
			$custom_field_list  = is_array($custom_field_list) ? implode(',',$custom_field_list) : $settings['custom_field_list'];
		}

		$filter_type        = !empty($settings['filter_type']) ? $settings['filter_type'] : 'post';
		$custom_post        = !empty($settings['custom_post']) ? $settings['custom_post'] : '';
		$template           = !empty($settings['template']) ? $settings['template'] : '1';
		$show_categories    = !empty($show_categories) ? $show_categories : 'yes';
		$category_label     = !empty($category_label) ? $category_label : esc_html__('Categories','filter-plus');
		$categories         = is_array($categories) ? implode(',',$categories) : '';
		$show_tags          = !empty($settings['show_tags']) && $settings['show_tags'] == true ? 'yes' : 'no';
		$tag_label 	        = !empty($tag_label) ? $tag_label : esc_html__('Tags','filter-plus');
		$tags               = is_array($tags) ? implode(',',$tags) : '';
		$author	            = !empty($author) ? $author : '';
		$author_label	    = !empty($author_label) ? $author_label : esc_html__('Authors','filter-plus');
		$author_list	    = is_array($author_list) ? implode(',',$author_list) : '';
		$custom_field	    = !empty($custom_field) ? $custom_field : 'no';
		$custom_field_label	= !empty($custom_field_label) ? $custom_field_label : esc_html__('Custom Field','filter-plus');
		$meta_condition	    = !empty($meta_condition) ? $meta_condition : 'OR';
		$post_categories    = !empty($settings['post_categories']) && $settings['post_categories'] == true ? 'yes' : 'no';
		$post_tags          = !empty($settings['post_tags']) && $settings['post_tags'] == true ? 'yes' : 'no';
		$post_author        = !empty($settings['post_author']) && $settings['post_author'] == true ? 'yes' : 'no';
		
		echo do_shortcode("[wp_filter_plus filter_type={$filter_type} custom_post={$custom_post} show_categories={$show_categories} category_label={$category_label} 
		categories='{$categories}' show_tags='{$show_tags}' tags='{$tags}' tag_label={$tag_label}
		template ={$template} author={$author} author_label={$author_label} author_list={$author_list} 
		custom_field={$custom_field} custom_field_label={$custom_field_label} meta_condition={$meta_condition}
		custom_field_list={$custom_field_list} post_tags='{$post_tags}'
		post_categories='{$post_categories} post_author={$post_author}']"); 

	}

}
