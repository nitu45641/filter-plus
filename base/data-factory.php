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
            'filter_position'   => 'left',
            'pagination_style'  => 'numbers'
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
     * Woo filter precess data
     * @param mixed $settings
     * @return array
     */
    public function woo_process_data( $settings ) {
        extract($settings);
        $default_data = $this->woo_default_data();

        $default_data['category_label'] = ! empty( $category_label ) ? $category_label : esc_html__( 'Categories', 'filter-plus' );
		$default_data['categories'] = is_array( $categories ) ? implode( ',', $categories ) : '';
		$default_data['tags']       = ! empty( $tags ) && is_array( $tags ) ? implode( ',', $tags ) : '';
		$default_data['show_tags']  = ! empty( $show_tags ) ? $show_tags : '';
		$default_data['tag_label']  = ! empty( $tag_label ) ? $tag_label : esc_html__( 'Tags', 'filter-plus' );
		$default_data['color_label'] = ! empty( $color_label ) ? $color_label : esc_html__( 'Colors', 'filter-plus' );
		$default_data['sub_categories']     = !empty($settings['sub_categories']) && $settings['sub_categories'] == true ? 'yes' : 'no';
		$default_data['colors']             = ! empty( $colors ) ? $colors : '';
		$default_data['size']               = ! empty( $size ) ? $size : '';
		$default_data['size_label']         = ! empty( $size_label ) ? $size_label : esc_html__( 'Size', 'filter-plus' );
		$default_data['product_categories'] = ! empty( $product_categories ) ? $product_categories : '';
		$default_data['attributes']         = ! empty( $attributes ) ? implode( ',', $attributes ) : '';
		$default_data['show_attributes']    = ! empty( $show_attributes ) ? $show_attributes : '';
		$default_data['attribute_label']    = ! empty( $attribute_label ) ? $attribute_label : esc_html__( 'Attributes', 'filter-plus' );
		$default_data['show_reviews']       = ! empty( $show_reviews ) ? $show_reviews : '';
		$default_data['review_label']       = ! empty( $review_label ) ? $review_label : esc_html__( 'Review', 'filter-plus' );
		$default_data['show_price_range']   = ! empty( $show_price_range ) ? $show_price_range : '';
		$default_data['price_range_label']  = ! empty( $price_range_label ) ? $price_range_label : esc_html__( 'Price Range', 'filter-plus' );
		$default_data['stock']              = ! empty( $stock ) ? $stock : 'yes';
		$default_data['stock_label']        = ! empty( $stock_label ) ? $stock_label : esc_html__( 'Stock', 'filter-plus' );
		$default_data['on_sale']            = ! empty( $on_sale ) ? $on_sale : 'yes';
		$default_data['on_sale_label']      = ! empty( $on_sale_label ) ? $on_sale_label : esc_html__( 'Sale', 'filter-plus' );
		$default_data['sorting']            = ! empty( $sorting ) ? $sorting : '';
		$default_data['product_tags']       = ! empty( $product_tags ) ? $product_tags : '';
		$default_data['product_categories'] = ! empty( $product_categories ) ? $product_categories : '';
		$default_data['template'] 			= ! empty( $template ) ? $template : '';
		$default_data['title'] 				= ! empty( $title ) ? $title : esc_html__( 'Filters', 'filter-plus' );
		$default_data['no_of_items'] 		= ! empty( $no_of_items ) ? $no_of_items : 9;

        return $default_data;
    }

    /**
     * Woo render html
     * 
     * @param array $settings
     */
    public function woo_render_html($settings) {
        $process_data = $this->woo_process_data( $settings );
        extract( $process_data );
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

    function wp_process_data( $settings ) {
        extract($settings);
        $default_data = $this->wp_default_data();

        $default_data['custom_fields'] = '';
		if (!empty($custom_field_list)) {
			$default_data['custom_fields']  = is_array($custom_field_list) ? implode(',',$custom_field_list) : $custom_field_list;
		}

		$default_data['filter_type']        = !empty($settings['filter_type']) ? $settings['filter_type'] : 'post';
		$default_data['custom_post']        = !empty($settings['custom_post']) ? $settings['custom_post'] : '';
		$default_data['template']           = !empty($settings['template']) ? $settings['template'] : '1';
		$default_data['title']           	= !empty($settings['title']) ? $settings['title'] : esc_html__('Filters','filter-plus');
		$default_data['no_of_items'] 		= ! empty( $settings['no_of_items'] ) ? $settings['no_of_items'] : 9;
		$default_data['show_categories']    = !empty($show_categories) ? $show_categories : 'yes';
		$default_data['category_label']     = !empty($category_label) ? $category_label : esc_html__('Categories','filter-plus');
		$default_data['categories']         = is_array($categories) ? implode(',',$categories) : '';
		$default_data['sub_categories']     = !empty($settings['sub_categories']) && $settings['sub_categories'] == true ? 'yes' : 'no';
		$default_data['show_tags']          = !empty($settings['show_tags']) && $settings['show_tags'] == true ? 'yes' : 'no';
		$default_data['tag_label'] 	        = !empty($tag_label) ? $tag_label : esc_html__('Tags','filter-plus');
		$default_data['tags']               = is_array($tags) ? implode(',',$tags) : '';
		$default_data['author']	            = !empty($author) ? $author : '';
		$default_data['author_label']	    = !empty($author_label) ? $author_label : esc_html__('Authors','filter-plus');
		$default_data['author_list']	    = is_array($author_list) ? implode(',',$author_list) : '';
		$default_data['custom_field']	    = !empty($custom_field) ? $custom_field : 'no';
		$default_data['custom_field_label']	= !empty($custom_field_label) ? $custom_field_label : esc_html__('Custom Field','filter-plus');
		$default_data['meta_condition']	    = !empty($meta_condition) ? $meta_condition : 'OR';
		$default_data['post_categories']    = !empty($settings['post_categories']) && $settings['post_categories'] == true ? 'yes' : 'no';
		$default_data['post_tags']          = !empty($settings['post_tags']) && $settings['post_tags'] == true ? 'yes' : 'no';
		$default_data['post_author']        = !empty($settings['post_author']) && $settings['post_author'] == true ? 'yes' : 'no';

        return $default_data;
    }
    /**
     * Wp render html
     * 
     * @param array $settings
     */
    public function wp_render_html($settings) {
		\FilterPlus\Utils\Helper::instance()->pro_active_message();
        $process_data = $this->wp_process_data( $settings );
        extract( $process_data );

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