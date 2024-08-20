<?php

namespace FilterPlus\Base;

use FilterPlus\Utils\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue all css and js file class
 */
class DataFactory {

    use Singleton;

    /**
     * Woo filter default data
     * 
     * @return array
     */
    public function woo_default_data() {
        return array(
            'title'         	=> esc_html__('Filters','filter-plus'),
            'no_of_items'       => 9,
            'template'         	=> '1',
            'category_label'    => esc_html__('Categories','filter-plus'),
            'categories'       	=> '',
            'sub_categories'	=> 'no',
            'colors'           	=> 'yes',
            'color_label'       => esc_html__('Colors','filter-plus'),
            'size'             	=> 'yes',
            'size_label'        => esc_html__('Size','filter-plus'),
            'tags'             	=> '',
            'tag_label'        	=> esc_html__('Tags','filter-plus'),
            'attributes'       	=> '',
            'attribute_label'   => esc_html__('Attributes','filter-plus'),
            'show_tags'        	=> '',
            'show_attributes'  	=> '',
            'review_label'   	=> esc_html__('Review','filter-plus'),
            'show_reviews'     	=> '',
            'show_price_range' 	=> '',
            'price_range_label' => esc_html__('Price Range','filter-plus'),
            'on_sale' 			=> '',
            'on_sale_label' 	=> esc_html__('Sale','filter-plus'),
            'stock' 			=> '',
            'stock_label' 		=> esc_html__('Stock','filter-plus'),
            'product_categories'=> '',
            'product_tags'      => '',
            'sorting'          	=> 'yes',
        );
    }

    /**
     * Wp filter default data
     * 
     * @return array
     */
    public function wp_default_data() {
        return array(
            'filter_type'       => 'post',
            'custom_post'       => '',
            'template'         	=> '1',
            'title'         	=> esc_html__('Filters','filter-plus'),
            'no_of_items'       => 9,
            'show_categories'   => 'yes',
            'category_label'    => esc_html__('Categories','filter-plus-pro'),
            'categories'       	=> '',
            'sub_categories'	=> 'no',
            'show_tags'        	=> '',
            'tag_label'        	=> esc_html__('Tags','filter-plus-pro'),
            'tags'             	=> '',
            'author'            => '',
            'author_label'      => esc_html__('Authors','filter-plus-pro'),
            'author_list'       => '',
            'post_categories'	=> 'yes',
            'post_tags'      	=> 'yes',
            'post_author'      	=> 'yes',
            'custom_field_label' 	=> esc_html__('Custom Field','filter-plus-pro'),
            'custom_field'      	=> 'no',
            'meta_condition'     	=> 'OR',
            'custom_field_list'     => ''
        );
    }

    /**
     * Woo render html
     * 
     * @param array $settings
     */
    public function woo_render_html($settings) {
        extract( $settings );
		$category_label = ! empty( $category_label ) ? $category_label : esc_html__( 'Categories', 'filter-plus' );
		$categories = is_array( $categories ) ? implode( ',', $categories ) : '';
		$tags       = ! empty( $tags ) && is_array( $tags ) ? implode( ',', $tags ) : '';
		$show_tags  = ! empty( $show_tags ) ? $show_tags : '';
		$tag_label  = ! empty( $tag_label ) ? $tag_label : esc_html__( 'Tags', 'filter-plus' );
		$color_label        = ! empty( $color_label ) ? $color_label : esc_html__( 'Colors', 'filter-plus' );
		$sub_categories     = !empty($settings['sub_categories']) && $settings['sub_categories'] == true ? 'yes' : 'no';
		$colors             = ! empty( $colors ) ? $colors : '';
		$size               = ! empty( $size ) ? $size : '';
		$size_label         = ! empty( $size_label ) ? $size_label : esc_html__( 'Size', 'filter-plus' );
		$product_categories = ! empty( $product_categories ) ? $product_categories : '';
		$attributes         = ! empty( $attributes ) ? implode( ',', $attributes ) : '';
		$show_attributes    = ! empty( $show_attributes ) ? $show_attributes : '';
		$attribute_label    = ! empty( $attribute_label ) ? $attribute_label : esc_html__( 'Attributes', 'filter-plus' );
		$show_reviews       = ! empty( $show_reviews ) ? $show_reviews : '';
		$review_label       = ! empty( $review_label ) ? $review_label : esc_html__( 'Review', 'filter-plus' );
		$show_price_range   = ! empty( $show_price_range ) ? $show_price_range : '';
		$price_range_label  = ! empty( $price_range_label ) ? $price_range_label : esc_html__( 'Price Range', 'filter-plus' );
		$stock              = ! empty( $stock ) ? $stock : 'yes';
		$stock_label        = ! empty( $stock_label ) ? $stock_label : esc_html__( 'Stock', 'filter-plus' );
		$on_sale            = ! empty( $on_sale ) ? $on_sale : 'yes';
		$on_sale_label      = ! empty( $on_sale_label ) ? $on_sale_label : esc_html__( 'Sale', 'filter-plus' );
		$sorting            = ! empty( $sorting ) ? $sorting : '';
		$product_tags       = ! empty( $product_tags ) ? $product_tags : '';
		$product_categories = ! empty( $product_categories ) ? $product_categories : '';
		$template 			= ! empty( $template ) ? $template : '';
		$title 				= ! empty( $title ) ? $title : esc_html__( 'Filters', 'filter-plus' );
		$no_of_items 		= ! empty( $no_of_items ) ? $no_of_items : 9;

		echo do_shortcode("[filter_products category_label='".$category_label."' 
		sub_categories='".$sub_categories."' title ={$title} no_of_items={$no_of_items} 
		tag_label='".$tag_label."' 
		color_label='".$color_label."' 
		size_label='".$size_label."' attribute_label='".$attribute_label."' 
		review_label='".$review_label."' price_range_label='".$price_range_label."'
		stock_label='".$stock_label."' on_sale_label='".$on_sale_label."' 
		stock={$stock} on_sale={$on_sale} template ={$template} 
		categories='{$categories}' tags='{$tags}' attributes='{$attributes}' colors='{$colors}' size='{$size}' show_tags='{$show_tags}' show_attributes='{$show_attributes}' show_reviews='{$show_reviews}' show_price_range='{$show_price_range}' sorting='{$sorting}' product_tags='{$product_tags}' product_categories='{$product_categories}']");  
    }

    /**
     * Wp render html
     * 
     * @param array $settings
     */
    public function wp_render_html($settings) {
        extract($settings);
		\FilterPlus\Utils\Helper::instance()->pro_active_message();
		$custom_fields = '';
		if (!empty($custom_field_list)) {
			$custom_fields  = is_array($custom_field_list) ? implode(',',$custom_field_list) : $custom_field_list;
		}

		$filter_type        = !empty($settings['filter_type']) ? $settings['filter_type'] : 'post';
		$custom_post        = !empty($settings['custom_post']) ? $settings['custom_post'] : '';
		$template           = !empty($settings['template']) ? $settings['template'] : '1';
		$title           	= !empty($settings['title']) ? $settings['title'] : esc_html__('Filters','filter-plus');
		$no_of_items 		= ! empty( $settings['no_of_items'] ) ? $settings['no_of_items'] : 9;
		$show_categories    = !empty($show_categories) ? $show_categories : 'yes';
		$category_label     = !empty($category_label) ? $category_label : esc_html__('Categories','filter-plus');
		$categories         = is_array($categories) ? implode(',',$categories) : '';
		$sub_categories     = !empty($settings['sub_categories']) && $settings['sub_categories'] == true ? 'yes' : 'no';
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

		echo do_shortcode("[wp_filter_plus filter_type={$filter_type} custom_post={$custom_post} show_categories={$show_categories} 
        category_label='".$category_label."' 
		sub_categories='{$sub_categories}'
        categories='{$categories}' show_tags='{$show_tags}' tags='{$tags}' tag_label='".$tag_label."'
        template ={$template} title={$title} no_of_items={$no_of_items} 
		author={$author} author_label='".$author_label."' author_list={$author_list} 
        custom_field={$custom_field} custom_field_label='".$custom_field_label."' meta_condition={$meta_condition}
        custom_field_list={$custom_fields} post_tags='{$post_tags}'
        post_categories='{$post_categories} post_author={$post_author}']"); 
    }

}