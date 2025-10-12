<?php

namespace FilterPlus\Core\Widgets\Elementor;

defined("ABSPATH") || exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use FilterPlus\Base\DataFactory;
use \FilterPlus\Core\Admin\FilterOptions\Helper as OptionHelper;
use FilterPlus\Utils\Helper as Helper;

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
		return esc_html__('WordPress Content Filter', 'filter-plus');
	}

	/**
	 * Retrieve the widget icon.
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-filter';
	}

	/**
	 * Retrieve the widget category.
	 * @return array
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

		$pro = "";
		if ( !class_exists('FilterPlusPro') ) {
			$pro  = esc_html__('Pro', 'filter-plus');
		}

		$templates = [
			1  => esc_html__('Template 1', 'filter-plus'),
		];
		$templates[2] = esc_html__('Template 2', 'filter-plus').' '.$pro;
		$templates[3] = esc_html__('Template 3', 'filter-plus').' '.$pro;
		
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
			'filter_type',
			[
				'label' => esc_html__('Select Filter Type', 'filter-plus'),
				'type' => Controls_Manager::SELECT,
				'default' => 'post',
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
				'options' => Helper::custom_post_type(''),
				'condition' => ['filter_type' => 'custom_post']
			]
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
			'show_categories',
			[
				'label' => esc_html__('Display Categories', 'filter-plus'),
				'type' => Controls_Manager::SWITCHER,
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
				'options' => Helper::get_categories('category','widget',array('taxonomy'=>'category')),
				'multiple' => true,
				'condition' => ['show_categories' => 'yes']
			]
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
			'show_tags',
			[
				'label' => esc_html__('Show Tags', 'filter-plus'),
				'type' => Controls_Manager::SWITCHER,
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
				'options' => Helper::get_product_tags('post_tag','assoc'),
				'multiple' => true,
				'condition' => ['show_tags' => 'yes']
			]
		);

		$this->add_control(
			'author',
			[
				'label' => esc_html__('Display Authors', 'filter-plus'),
				'type' => Controls_Manager::SWITCHER,
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
				'options' => Helper::instance()->author_list('',''),
				'multiple' => true,
				'condition' => ['author' => 'yes']
			]
		);
		$this->add_control(
			'custom_field',
			[
				'label' => esc_html__('Display Custom Field', 'filter-plus'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'filter-plus'),
				'label_off' => esc_html__('Hide', 'filter-plus'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		if ( !class_exists('FilterPlusPro') ) {
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
		}else{
			$custom_fields	= OptionHelper::instance()->get_filter_options(-1,'custom_field');
			$desc = esc_html__('Select Custom Field','filter-plus');
			if (count($custom_fields) == 0 ) {
				$desc = esc_html__('Create New Custom Field From','filter-plus') .' '.'<a href='.esc_url(admin_url().'admin.php?page=filter-options>').' target="_blank">'.
				 esc_html__('Filter Options','filter-plus').'</a>';
			}
			$this->add_control(
				'custom_field_list',
				[
					'label' => esc_html__('Custom Field List', 'filter-plus'),
					'description' => $desc,
					'type' => Controls_Manager::SELECT2,
					'options' => $custom_fields,
					'multiple' => true,
					'condition' => ['custom_field' => 'yes']
				]
			);
		}

		$this->end_controls_section();

		$this->start_controls_section(
			'filter-result',
			[
				'label' => esc_html__('Filter Result Options', 'filter-plus'),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);

		// Right Side
		$this->add_control('hide_wp_title',
			array(
				'label' => esc_html__( 'Hide Title', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control('hide_wp_desc',
			array(
				'label' => esc_html__( 'Hide Descrtiption', 'filter-plus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'filter-plus' ),
				'label_off' => esc_html__( 'Hide', 'filter-plus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
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
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
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
				'tab' => Controls_Manager::TAB_STYLE,
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
				'tab' => Controls_Manager::TAB_STYLE,
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
				'tab' => Controls_Manager::TAB_STYLE,
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
		echo \FilterPlus\Base\DataFactory::instance()->wp_render_html( $settings );
	}
}

