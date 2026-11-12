<?php

namespace FilterPlus\Base;

use FilterPlus\Utils\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue all css and js file class
 */
class DataFactory {

    use Singleton;
    public static $disable;

    public function __construct() { 
        self::$disable = !class_exists( 'FilterPlusPro' ) ? true : false;
    }

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
            'category_template' => '1',
            'color_template'    => '1',
            'review_template'   => '1',
            'show_categories'   => 'yes',
            'category_label'    => esc_html__('Categories','filter-plus'),
            'categories'       	=> '',
            'exclude_categories'=> '',
            'hide_empty_cat'	=> 'yes',
            'apply_button_mode'	=> 'no',
            'apply_button_label'=> esc_html__('Apply','filter-plus'),
            'reset_button_label'=> esc_html__('Reset','filter-plus'),
            'masonry_style'	    => 'no',
            'sub_categories'	=> 'no',
            'wrap_sub_categories' => 'yes',
            'colors'           	=> 'yes',
            'color_label'       => esc_html__('Colors','filter-plus'),
            'size'             	=> 'yes',
            'size_label'        => esc_html__('Size','filter-plus'),
            'tags'             	=> '',
            'tag_label'        	=> esc_html__('Tags','filter-plus'),
            'attributes'       	=> '',
            'attribute_label'   => '',
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
            'product_categories'=> 'yes',
            'product_tags'      => 'yes',
            'show_sale_badge'   => 'yes',
            'sorting'          	=> 'yes',
            'filter_position'   => 'left',
            'pagination_style'  => 'numbers',
            'product_count'     => 'yes',
            'hide_prod_title'        => 'yes',
            'hide_prod_desc'         => 'yes',
            'hide_prod_price'        => 'yes',
            'hide_prod_add_cart'     => 'yes',
            'add_to_cart_text'       => esc_html__('Add to cart','filter-plus'),
            'product_image_size'     => 'woocommerce_thumbnail',
            'image_width'            => '',
            'image_height'           => '',
            'hide_prod_rating'       => 'yes',
            'enable_category_layout' => 'no',
            'current_cat_id'         => '',
            'grid_columns_desktop'   => '',
            'grid_columns_tablet'    => '',
            'grid_columns_mobile'    => '',
            'category_orderby'       => '',
            // sidebar section order (Pro) - see \FilterPlus\Base\SidebarSections
            'filter_order'           => '',
            'show_search'            => 'yes',
            // brand filter
            'show_brands'            => '',
            'brand_label'            => esc_html__('Brands','filter-plus'),
            'brands'                 => '',
            'brand_template'         => '1',
            'brand_orderby'          => '',
            'hide_empty_brand'       => 'yes',
            'brand_count'            => 'yes',
        );
    }

    /**
     * Normalize the legacy singular default while preserving a deliberately blank title.
     *
     * @param string $title Filter heading.
     * @return string
     */
    public static function normalize_filter_title( $title ) {
        $title = sanitize_text_field( (string) $title );

        return 0 === strcasecmp( trim( $title ), 'Filter' )
            ? esc_html__( 'Filters', 'filter-plus' )
            : $title;
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
            'filter_order'      => '',
            'show_search'       => 'yes',
            'template'         	=> '1',
            'hide_empty_cat'    => 'yes',
            'product_count'     => 'yes',
            'category_template' => '1',
            'title'         	=> esc_html__('Filters','filter-plus'),
            'no_of_items'       => 9,
            'show_categories'   => 'yes',
            'category_label'    => esc_html__('Categories','filter-plus'),
            'categories'       	=> '',
            'sub_categories'	=> 'yes',
            'wrap_sub_categories' => 'yes',
            'apply_button_mode'	=> 'no',
            'apply_button_label'=> esc_html__('Apply','filter-plus'),
            'reset_button_label'=> esc_html__('Reset','filter-plus'),
            'masonry_style'	    => 'no',
            'hide_wp_title'	    => 'yes',
            'hide_wp_desc'	    => 'yes',
            'show_tags'         	=> '',
            'tag_label'        	=> esc_html__('Tags','filter-plus'),
            'tags'             	=> '',
            'author'            => '',
            'author_label'      => esc_html__('Authors','filter-plus'),
            'author_list'       => '',
            'post_categories'	=> 'yes',
            'post_tags'      	=> 'yes',
            'post_author'      	=> 'yes',
            'custom_field_label' 	=> esc_html__('Custom Field','filter-plus'),
            'custom_field'      	=> 'no',
            'meta_condition'     	=> 'OR',
            'custom_field_list'     => '',
            'filter_position'   => 'left',
            'pagination_style'  => 'numbers'
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
        $default_data['review_template']    = ! empty( $settings['review_template'] ) ? $settings['review_template'] : '1';
        $default_data['color_template']     = ! empty( $settings['color_template'] ) ? $settings['color_template'] : '1';
        $default_data['category_template']  = ! empty( $settings['category_template'] ) ? $settings['category_template'] : '1';
        $default_data['show_categories']    = ( isset( $settings['show_categories'] ) && ( $settings['show_categories'] === 'no' || $settings['show_categories'] === false ) ) ? 'no' : 'yes';
        $default_data['category_label']     = ! empty( $category_label ) ? $category_label : esc_html__( 'Categories', 'filter-plus' );
		$default_data['categories']         = ( ! empty( $categories ) && is_array( $categories ) ) ? implode( ',', $categories ) : '';
		// section order: plain "a,b" string or an Elementor repeater ( [ ['section' => 'a'], ... ] )
		$default_data['filter_order']       = isset( $settings['filter_order'] ) ? implode( ',', \FilterPlus\Base\SidebarSections::parse_order( $settings['filter_order'] ) ) : '';
		$default_data['exclude_categories'] = ( class_exists( 'FilterPlusPro' ) && isset( $settings['exclude_categories'] ) )
			? ( is_array( $settings['exclude_categories'] ) ? implode( ',', $settings['exclude_categories'] ) : $settings['exclude_categories'] )
			: '';
		$default_data['tags']               = ! empty( $tags ) && is_array( $tags ) ? implode( ',', $tags ) : '';
		$default_data['show_tags']          = ! empty( $show_tags ) ? $show_tags : '';
		$default_data['tag_label']          = ! empty( $tag_label ) ? $tag_label : esc_html__( 'Tags', 'filter-plus' );
		$default_data['color_label'] = ! empty( $color_label ) ? $color_label : esc_html__( 'Colors', 'filter-plus' );
		$default_data['product_count'] = ( isset( $settings['product_count'] ) && ( $settings['product_count'] === true || $settings['product_count'] === 'yes' || $settings['product_count'] === '1' || $settings['product_count'] == 1 ) ) ? 'yes' : 'no';
		$default_data['hide_empty_cat'] = ( isset( $settings['hide_empty_cat'] ) && ( $settings['hide_empty_cat'] === true || $settings['hide_empty_cat'] === 'yes' || $settings['hide_empty_cat'] === '1' || $settings['hide_empty_cat'] == 1 ) ) ? 'yes' : 'no';
		$default_data['sub_categories'] = ( isset( $settings['sub_categories'] ) && ( $settings['sub_categories'] === true || $settings['sub_categories'] === 'yes' || $settings['sub_categories'] === '1' || $settings['sub_categories'] == 1 ) ) ? 'yes' : 'no';
		$default_data['wrap_sub_categories'] = ( isset( $settings['wrap_sub_categories'] ) && ( $settings['wrap_sub_categories'] === true || $settings['wrap_sub_categories'] === 'yes' || $settings['wrap_sub_categories'] === '1' || $settings['wrap_sub_categories'] == 1 ) ) ? 'yes' : 'no';
		$default_data['masonry_style'] = ( isset( $settings['masonry_style'] ) && ( $settings['masonry_style'] === true || $settings['masonry_style'] === 'yes' || $settings['masonry_style'] === '1' || $settings['masonry_style'] == 1 ) ) ? 'yes' : 'no';
		$default_data['colors'] = ( isset( $settings['colors'] ) && ( $settings['colors'] === true || $settings['colors'] === 'yes' || $settings['colors'] === '1' || $settings['colors'] == 1 ) ) ? 'yes' : 'no';
		$default_data['size'] = ( isset( $settings['size'] ) && ( $settings['size'] === true || $settings['size'] === 'yes' || $settings['size'] === '1' || $settings['size'] == 1 ) ) ? 'yes' : 'no';
		$default_data['size_label'] = ! empty( $size_label ) ? $size_label : esc_html__( 'Size', 'filter-plus' );
		$default_data['product_categories'] = ( isset( $settings['product_categories'] ) && ( $settings['product_categories'] === true || $settings['product_categories'] === 'yes' || $settings['product_categories'] === '1' || $settings['product_categories'] == 1 ) ) ? 'yes' : 'no';
		$default_data['attributes'] = ! empty( $attributes ) ? implode( ',', $attributes ) : '';
		$default_data['show_attributes'] = ( isset( $settings['show_attributes'] ) && ( $settings['show_attributes'] === true || $settings['show_attributes'] === 'yes' || $settings['show_attributes'] === '1' || $settings['show_attributes'] == 1 ) ) ? 'yes' : 'no';
		$default_data['attribute_label'] = ! empty( $attribute_label ) ? $attribute_label : '';
		$default_data['show_reviews'] = ( isset( $settings['show_reviews'] ) && ( $settings['show_reviews'] === true || $settings['show_reviews'] === 'yes' || $settings['show_reviews'] === '1' || $settings['show_reviews'] == 1 ) ) ? 'yes' : 'no';
		$default_data['review_label'] = ! empty( $review_label ) ? $review_label : esc_html__( 'Review', 'filter-plus' );
		$default_data['show_price_range'] = ( isset( $settings['show_price_range'] ) && ( $settings['show_price_range'] === true || $settings['show_price_range'] === 'yes' || $settings['show_price_range'] === '1' || $settings['show_price_range'] == 1 ) ) ? 'yes' : 'no';
		$default_data['price_range_label'] = ! empty( $price_range_label ) ? $price_range_label : esc_html__( 'Price Range', 'filter-plus' );
		$default_data['stock'] = ( isset( $settings['stock'] ) && ( $settings['stock'] === true || $settings['stock'] === 'yes' || $settings['stock'] === '1' || $settings['stock'] == 1 ) ) ? 'yes' : 'no';
		$default_data['stock_label'] = ! empty( $stock_label ) ? $stock_label : esc_html__( 'Stock', 'filter-plus' );
		$default_data['on_sale'] = ( isset( $settings['on_sale'] ) && ( $settings['on_sale'] === true || $settings['on_sale'] === 'yes' || $settings['on_sale'] === '1' || $settings['on_sale'] == 1 ) ) ? 'yes' : 'no';
		$default_data['on_sale_label'] = ! empty( $on_sale_label ) ? $on_sale_label : esc_html__( 'Sale', 'filter-plus' );
		$default_data['hide_prod_title']    = ! empty( $hide_prod_title ) && ( $hide_prod_title == true ||  $hide_prod_title == 'yes' )  ?  'yes' : 'no';
		$default_data['hide_prod_desc']     = ! empty( $hide_prod_desc ) && ( $hide_prod_desc == true ||  $hide_prod_desc == 'yes' )  ?  'yes' : 'no';
		$default_data['hide_prod_price']    = ! empty( $hide_prod_price ) && ( $hide_prod_price == true || $hide_prod_price == 'yes' ) ?  'yes' : 'no';
		$default_data['hide_prod_add_cart'] = ! empty( $hide_prod_add_cart ) && ( $hide_prod_add_cart == true || $hide_prod_add_cart == 'yes' ) ?  'yes' : 'no';
		$default_data['add_to_cart_text']   = ! empty( $settings['add_to_cart_text'] ) ? sanitize_text_field( $settings['add_to_cart_text'] ) : esc_html__( 'Add to cart', 'filter-plus' );
		// Image Size is a Pro feature — free users always get the WooCommerce thumbnail size.
		$default_data['product_image_size'] = ( class_exists( 'FilterPlusPro' ) && ! empty( $settings['product_image_size'] ) ) ? sanitize_text_field( $settings['product_image_size'] ) : 'woocommerce_thumbnail';
		$default_data['image_width']        = ( class_exists( 'FilterPlusPro' ) && ! empty( $settings['image_width'] ) )  ? intval( $settings['image_width'] )  : '';
		$default_data['image_height']       = ( class_exists( 'FilterPlusPro' ) && ! empty( $settings['image_height'] ) ) ? intval( $settings['image_height'] ) : '';
		$default_data['hide_prod_rating']   = ! empty( $hide_prod_rating ) && ( $hide_prod_rating == true || $hide_prod_rating == 'yes' ) ?  'yes' : 'no';
		$default_data['sorting']            = ! empty( $sorting ) && ( $sorting == true || $sorting == 'yes') ?  'yes' : 'no';
		$default_data['enable_category_layout'] = ( isset( $settings['enable_category_layout'] ) && $settings['enable_category_layout'] === 'yes' ) ? 'yes' : 'no';
		$default_data['current_cat_id']     = ! empty( $settings['current_cat_id'] ) ? intval( $settings['current_cat_id'] ) : '';
		$default_data['product_tags'] = ( isset( $settings['product_tags'] ) && ( $settings['product_tags'] === true || $settings['product_tags'] === 'yes' || $settings['product_tags'] === '1' || $settings['product_tags'] == 1 ) ) ? 'yes' : 'no';
		$default_data['show_sale_badge']       = ( isset( $settings['show_sale_badge'] ) && ( $settings['show_sale_badge'] === true || $settings['show_sale_badge'] === 'yes' || $settings['show_sale_badge'] === '1' || $settings['show_sale_badge'] == 1 ) ) ? 'yes' : ( ! isset( $settings['show_sale_badge'] ) ? 'yes' : 'no' );
		$default_data['grid_columns_desktop']  = ! empty( $grid_columns_desktop ) ? intval( $grid_columns_desktop ) : '';
		$default_data['grid_columns_tablet']   = ! empty( $grid_columns_tablet ) ? intval( $grid_columns_tablet ) : '';
		$default_data['grid_columns_mobile']   = ! empty( $grid_columns_mobile ) ? intval( $grid_columns_mobile ) : '';
		$default_data['category_orderby']      = ! empty( $category_orderby ) ? sanitize_text_field( $category_orderby ) : '';
		$default_data['template'] 			   = ! empty( $template ) ? $template : '1';
		$default_data['title'] 				= array_key_exists( 'title', $settings ) ? self::normalize_filter_title( $settings['title'] ) : $default_data['title'];
		$default_data['filter_position'] 	= ! empty( $filter_position ) ? $filter_position : 'left';
		$default_data['pagination_style'] 	= ! empty( $pagination_style ) ? $pagination_style : 'numbers';
		$default_data['no_of_items']        = ! empty( $settings['no_of_items'] ) ? intval( $settings['no_of_items'] ) : 9;
		$default_data['apply_button_mode']  = ! empty( $settings['apply_button_mode'] ) ? $settings['apply_button_mode'] : 'no';
		$default_data['apply_button_label'] = ! empty( $settings['apply_button_label'] ) ? $settings['apply_button_label'] : esc_html__( 'Apply', 'filter-plus' );
		$default_data['reset_button_label'] = ! empty( $settings['reset_button_label'] ) ? $settings['reset_button_label'] : esc_html__( 'Reset', 'filter-plus' );

		// brand filter
		$default_data['show_brands']      = \FilterPlus\Utils\Helper::is_brand_filter_available() ? self::to_yes_no( $settings, 'show_brands', 'no' ) : 'no';
		$default_data['brand_label']      = ! empty( $settings['brand_label'] ) ? sanitize_text_field( $settings['brand_label'] ) : esc_html__( 'Brands', 'filter-plus' );
		$default_data['brands']           = ! empty( $settings['brands'] ) ? implode( ',', array_filter( array_map( 'absint', is_array( $settings['brands'] ) ? $settings['brands'] : explode( ',', $settings['brands'] ) ) ) ) : '';
		$default_data['brand_template']   = ! empty( $settings['brand_template'] ) && array_key_exists( (string) $settings['brand_template'], self::brand_template()['template'] ) ? (string) $settings['brand_template'] : '1';
		$default_data['brand_orderby']    = ! empty( $settings['brand_orderby'] ) ? sanitize_key( $settings['brand_orderby'] ) : '';
		$default_data['hide_empty_brand'] = self::to_yes_no( $settings, 'hide_empty_brand', 'no' );
		$default_data['brand_count']      = self::to_yes_no( $settings, 'brand_count', 'no' );

        return $default_data;
    }

    /**
     * Normalize a switcher/checkbox/toggle value to 'yes' / 'no'.
     *
     * @param array  $settings Raw settings.
     * @param string $key      Setting key.
     * @param string $default  Value when the key is missing.
     *
     * @return string
     */
    public static function to_yes_no( $settings, $key, $default = 'no' ) {
        if ( ! isset( $settings[ $key ] ) ) {
            return $default;
        }
        $v = $settings[ $key ];

        return ( true === $v || 1 === $v || in_array( $v, array( 'yes', '1', 'true', 'on' ), true ) ) ? 'yes' : 'no';
    }

    /**
     * Woo render html
     * 
     * @param array $settings
     */
    public function woo_render_html($settings) {
        $process_data = $this->woo_process_data( $settings );
        extract( $process_data );
		// Build shortcode with escaped attributes so checkbox values are passed reliably
		$attrs = array(
			'show_categories' => $show_categories,
			'category_label' => $category_label,
            'sub_categories' => $sub_categories,
			'wrap_sub_categories' => $wrap_sub_categories,
			'title' => $title,
			'no_of_items' => $no_of_items,
			'tag_label' => $tag_label,
			'category_template' => $category_template,
			'color_template' => $color_template,
			'review_template' => $review_template,
			'color_label' => $color_label,
			'apply_button_mode' => $apply_button_mode,
			'apply_button_label' => $apply_button_label,
			'reset_button_label' => $reset_button_label,
			'hide_prod_title' => $hide_prod_title,
			'hide_prod_desc' => $hide_prod_desc,
			'hide_prod_price' => $hide_prod_price,
			'hide_prod_add_cart' => $hide_prod_add_cart,
			'add_to_cart_text' => $add_to_cart_text,
			'product_image_size' => $product_image_size,
			'image_width' => $image_width,
			'image_height' => $image_height,
			'hide_prod_rating' => $hide_prod_rating,
			'size_label' => $size_label,
			'attribute_label' => $attribute_label,
			'review_label' => $review_label,
			'price_range_label' => $price_range_label,
			'stock_label' => $stock_label,
			'on_sale_label' => $on_sale_label,
			'product_count' => $product_count,
			'hide_empty_cat' => $hide_empty_cat,
			'masonry_style' => $masonry_style,
			'stock' => $stock,
			'on_sale' => $on_sale,
			'template' => $template,
			'filter_position' => $filter_position,
			'pagination_style' => $pagination_style,
			'categories' => $categories,
			'exclude_categories' => $exclude_categories,
			'tags' => $tags,
			'attributes' => $attributes,
			'colors' => $colors,
			'size' => $size,
			'show_tags' => $show_tags,
			'show_attributes' => $show_attributes,
			'show_reviews' => $show_reviews,
			'show_price_range' => $show_price_range,
			'sorting'                => $sorting,
			'product_tags'           => $product_tags,
			'product_categories'     => $product_categories,
			'show_sale_badge'        => $show_sale_badge,
			'enable_category_layout' => $enable_category_layout,
			'current_cat_id'         => $current_cat_id,
			'grid_columns_desktop'   => $grid_columns_desktop,
			'grid_columns_tablet'    => $grid_columns_tablet,
			'grid_columns_mobile'    => $grid_columns_mobile,
			'category_orderby'       => $category_orderby,
			'filter_order'           => $filter_order,
			'show_search'            => $show_search,
			'show_brands'            => $show_brands,
			'brand_label'            => $brand_label,
			'brands'                 => $brands,
			'brand_template'         => $brand_template,
			'brand_orderby'          => $brand_orderby,
			'hide_empty_brand'       => $hide_empty_brand,
			'brand_count'            => $brand_count,
		);

		// Skip option update when rendering from inside category-layout.php to avoid circular saves.
		if ( ! defined( 'FP_CATEGORY_LAYOUT_RENDERING' ) ) {
			if ( $enable_category_layout === 'yes' ) {
				update_option( 'filter_plus_category_settings', $process_data, false );
			} else {
				delete_option( 'filter_plus_category_settings' );
			}
		}

		$shortcode_parts = array();
		foreach ( $attrs as $k => $v ) {
			$shortcode_parts[] = $k . "='" . esc_attr( $v ) . "'";
		}

		$shortcode = '[filter_products ' . implode( ' ', $shortcode_parts ) . ']';
		echo do_shortcode( $shortcode );  
    }

    function wp_process_data( $settings ) {
        $default_data = $this->wp_default_data();

        $default_data['custom_fields'] = '';
		if (!empty($custom_field_list)) {
			$default_data['custom_fields']  = is_array($custom_field_list) ? implode(',',$custom_field_list) : $custom_field_list;
		}

        $default_data['filter_order']       = isset( $settings['filter_order'] ) ? implode( ',', SidebarSections::parse_order( $settings['filter_order'] ) ) : '';
        $default_data['show_search']        = ( isset( $settings['show_search'] ) && ( 'no' === $settings['show_search'] || '' === $settings['show_search'] ) ) ? 'no' : 'yes';
        $default_data['category_template']  = ! empty( $settings['category_template'] ) ? $settings['category_template'] : '1';
		$default_data['filter_type']        = !empty($settings['filter_type']) ? $settings['filter_type'] : 'post';
		$default_data['custom_post']        = !empty($settings['custom_post']) ? $settings['custom_post'] : '';
		$default_data['template']           = !empty($settings['template']) ? $settings['template'] : '1';
		$default_data['title']           	= !empty($settings['title']) ? $settings['title'] : esc_html__('Filters','filter-plus');
		$default_data['no_of_items'] 		= ! empty( $settings['no_of_items'] ) ? $settings['no_of_items'] : 9;
		// Normalize boolean-like settings to 'yes' / 'no' when provided
		$bool_keys = array(
			'masonry_style','product_count','hide_empty_cat','show_categories','sub_categories','wrap_sub_categories','show_tags',
			'hide_wp_title','hide_wp_desc','post_categories','post_tags','post_author','on_sale','stock','author','show_reviews','show_price_range'
		);
		foreach ( $bool_keys as $k ) {
			if ( isset( $settings[ $k ] ) ) {
				$v = $settings[ $k ];
				$default_data[ $k ] = ( $v === true || $v === 'yes' || $v === '1' || $v === 1 || $v === 'true' ) ? 'yes' : 'no';
			}
		}

		$default_data['category_label']     = ! empty( $settings['category_label'] ) ? $settings['category_label'] : esc_html__('Categories','filter-plus');
		$default_data['categories']         = ( ! empty( $settings['categories'] ) && is_array($settings['categories']) ) ? implode(',',$settings['categories']) : ( ! empty( $settings['categories'] ) ? $settings['categories'] : '' );
		$default_data['tag_label'] 	        = ! empty( $settings['tag_label'] ) ? $settings['tag_label'] : esc_html__('Tags','filter-plus');
		$default_data['tags']               = ( ! empty( $settings['tags'] ) && is_array($settings['tags']) ) ? implode(',',$settings['tags']) : ( ! empty( $settings['tags'] ) ? $settings['tags'] : '' );
		$default_data['author']		    = ! empty( $settings['author'] ) && $settings['author'] !== '0' ? $settings['author'] : '';
		$default_data['author_label']	    = ! empty( $settings['author_label'] ) ? $settings['author_label'] : esc_html__('Authors','filter-plus');
		$default_data['author_list']	    = ( ! empty( $settings['author_list'] ) && is_array($settings['author_list']) ) ? implode(',',$settings['author_list']) : ( ! empty( $settings['author_list'] ) ? $settings['author_list'] : '' );
		$default_data['custom_field']	    = ! empty( $settings['custom_field'] ) ? $settings['custom_field'] : 'no';
		$default_data['custom_field_label']	= ! empty( $settings['custom_field_label'] ) ? $settings['custom_field_label'] : esc_html__('Custom Field','filter-plus');
		$default_data['meta_condition']	    = ! empty( $settings['meta_condition'] ) ? $settings['meta_condition'] : 'OR';
		$default_data['filter_position'] 	= ! empty( $settings['filter_position'] ) ? $settings['filter_position'] : 'left';
		$default_data['pagination_style'] 	= ! empty( $settings['pagination_style'] ) ? $settings['pagination_style'] : 'numbers';
		$default_data['no_of_items'] 		= ! empty( $settings['no_of_items'] ) ? $settings['no_of_items'] : 9;
		$default_data['show_categories']    = isset( $default_data['show_categories'] ) ? $default_data['show_categories'] : 'yes';
		$default_data['category_label']     = !empty($settings['category_label']) ? $settings['category_label'] : esc_html__('Categories','filter-plus');
		$default_data['categories']         = ( ! empty( $categories ) && is_array($categories) ) ? implode(',',$categories) : '';
		$default_data['sub_categories']     = !empty($settings['sub_categories']) && $settings['sub_categories'] == true ? 'yes' : 'no';
		$default_data['wrap_sub_categories'] = !empty($settings['wrap_sub_categories']) && $settings['wrap_sub_categories'] == true ? 'yes' : 'no';
		$default_data['show_tags']          = !empty($settings['show_tags']) && $settings['show_tags'] == true ? 'yes' : 'no';
		$default_data['tag_label'] 	        = !empty($tag_label) ? $tag_label : esc_html__('Tags','filter-plus');
		$default_data['tags']               = ( ! empty( $tags ) && is_array($tags) ) ? implode(',',$tags) : '';
		$default_data['author']	            = !empty($author) ? $author : '';
		$default_data['author_label']	    = !empty($author_label) ? $author_label : esc_html__('Authors','filter-plus');
		$default_data['author_list']	    = ( ! empty( $author_list ) && is_array($author_list) ) ? implode(',',$author_list) : '';
		$default_data['custom_field']	    = !empty($custom_field) ? $custom_field : 'no';
		$default_data['custom_field_label']	= !empty($custom_field_label) ? $custom_field_label : esc_html__('Custom Field','filter-plus');
		$default_data['meta_condition']	    = !empty($meta_condition) ? $meta_condition : 'OR';
		$default_data['hide_wp_title']      = !empty($settings['hide_wp_title']) && $settings['hide_wp_title'] == true ? 'yes' : 'no';
		$default_data['hide_wp_desc']       = !empty($settings['hide_wp_desc']) && $settings['hide_wp_desc'] == true ? 'yes' : 'no';
		$default_data['post_tags']          = !empty($settings['post_tags']) && $settings['post_tags'] == true ? 'yes' : 'no';
		$default_data['post_author']        = !empty($settings['post_author']) && $settings['post_author'] == true ? 'yes' : 'no';
		$default_data['filter_position'] 	= ! empty( $filter_position ) ? $filter_position : 'left';
		$default_data['pagination_style'] 	= ! empty( $pagination_style ) ? $pagination_style : 'numbers';

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

		echo do_shortcode("[wp_filter_plus filter_type='{$filter_type}' custom_post='{$custom_post}' 
        show_categories='{$show_categories}' 
        category_template='".$category_template."' 
        category_label='".$category_label."' 
		sub_categories='{$sub_categories}'
		wrap_sub_categories='{$wrap_sub_categories}'
		hide_wp_desc='{$hide_wp_desc}'
		hide_wp_title='{$hide_wp_title}'
        categories='{$categories}' show_tags='{$show_tags}' tags='{$tags}' tag_label='".$tag_label."'
        template='{$template}' title='{$title}' no_of_items='{$no_of_items}' 
		author='{$author}' author_label='".$author_label."' 
        author_list='{$author_list}' 
        custom_field='{$custom_field}' custom_field_label='".$custom_field_label."' 
        meta_condition='{$meta_condition}'
        custom_field_list='{$custom_fields}' post_tags='{$post_tags}'
        filter_position='{$filter_position}' pagination_style='{$pagination_style}'
        post_categories='{$post_categories}' post_author='{$post_author}'
        filter_order='{$filter_order}' show_search='{$show_search}']"); 
    }

    /**
     * Category template data
     * 
     * @return array
     */

    public static function category_template($type='shortcode') {
        $pro = class_exists( 'FilterPlusPro' ) ? '' : ' ' . '(' . esc_html__( 'Pro', 'filter-plus' ) . ')';

        $args = array(
            "template" => array(
                1 => esc_html__( 'List', 'filter-plus' ),
                2 => esc_html__( 'Checkbox', 'filter-plus' ),
                3 => esc_html__( 'Dropdown', 'filter-plus' ) . $pro,
                4 => esc_html__( 'Radio', 'filter-plus' ) . $pro,
                5 => esc_html__( 'Image', 'filter-plus' ) . $pro,
                6 => esc_html__( 'Text', 'filter-plus' ) . $pro,
            ),
        );

        if ( ! class_exists( 'FilterPlusPro' ) ) {
            $args['template_disable'] = 2;
        }else{
            $args['template_disable'] = '';
        }

        return $args;
    }

    public static function category_template_url( $args ) {
        extract( $args );
        $taxonomy           = ! empty( $args['taxonomy'] ) ? $args['taxonomy'] : 'product_cat';
        $product_count      = ! empty( $args['product_count'] ) ? $args['product_count'] : 'no';
        $hide_empty_cat     = ! empty( $args['hide_empty_cat'] ) ? $args['hide_empty_cat'] : 'no';
        $categories         = ! empty( $args['categories'] ) ? $args['categories'] : '';
        $exclude_categories = ! empty( $args['exclude_categories'] ) ? $args['exclude_categories'] : '';
        $sub_categories     = ! empty( $args['sub_categories'] ) ? $args['sub_categories'] : 'yes';
        $wrap_sub_categories = isset( $args['wrap_sub_categories'] ) && $args['wrap_sub_categories'] === 'no' ? 'no' : 'yes';
        $category_orderby   = ! empty( $args['category_orderby'] ) ? $args['category_orderby'] : '';
        $category_label = ! empty( $args['category_label'] ) ? $args['category_label'] : esc_html__('Categories','filter-plus');
        $category_template = ! empty( $args['category_template'] ) ? $args['category_template'] : '1';
        $template       = ! empty( $args['template'] ) ? $args['template'] : '1';

        $url = \FilterPlus::plugin_dir() . "templates/woo-filter/parts/category/categories-list.php";

        switch ( $category_template ) {
            case 1:
                $url = \FilterPlus::plugin_dir() . "templates/woo-filter/parts/category/categories-list.php";
                break;
            case 2:
                $url = \FilterPlus::plugin_dir() . "templates/woo-filter/parts/category/categories-checkbox.php";
                break;
            case 3:
                $url = \FilterPlus::plugin_dir() . "templates/woo-filter/parts/category/categories-select.php";
                break;
            case 4:
                $url = \FilterPlus::plugin_dir() . "templates/woo-filter/parts/category/categories-radio.php";
                break;
            case 5:
                $url = \FilterPlus::plugin_dir() . "templates/woo-filter/parts/category/categories-image.php";
                break;
            case 6:
                $url = \FilterPlus::plugin_dir() . "templates/woo-filter/parts/category/categories-text.php";
                break;
            default:
                $url = \FilterPlus::plugin_dir() . "templates/woo-filter/parts/category/categories-checkbox.php";
                break;

        }
        
		if (file_exists( $url )) {
			SidebarSections::start( 'category' );
			include $url ;
			SidebarSections::end();
		}
    }

    /**
     * Brand filter template list.
     *
     * @return array
     */
    public static function brand_template() {
        return array(
            'template' => array(
                '1' => esc_html__( 'Checkbox', 'filter-plus' ),
                '2' => esc_html__( 'Radio', 'filter-plus' ),
                '3' => esc_html__( 'Image', 'filter-plus' ),
            ),
            'template_disable' => '',
        );
    }

    /**
     * Render the brand filter section.
     *
     * Template overridable from the theme: filter-plus/templates/woo-filter/parts/brand/brands-{checkbox|radio|image}.php
     *
     * @param array $args Shortcode values (show_brands, brand_label, brands, brand_template, ...).
     *
     * @return void
     */
    public static function brand_template_url( $args ) {
        $brand_taxonomy = \FilterPlus\Utils\Helper::brand_taxonomy();
        if ( ! \FilterPlus\Utils\Helper::is_brand_filter_available() || empty( $args['show_brands'] ) || 'yes' !== $args['show_brands'] || '' === $brand_taxonomy ) {
            return;
        }

        $template         = ! empty( $args['template'] ) ? $args['template'] : '1';
        $brand_label      = ! empty( $args['brand_label'] ) ? $args['brand_label'] : esc_html__( 'Brands', 'filter-plus' );
        $brand_template   = ! empty( $args['brand_template'] ) ? (string) $args['brand_template'] : '1';
        $brand_count      = isset( $args['brand_count'] ) && 'no' === $args['brand_count'] ? 'no' : 'yes';
        $filterplus_brands = \FilterPlus\Utils\Helper::get_brands( '', array(
            'include'    => ! empty( $args['brands'] ) ? $args['brands'] : '',
            'hide_empty' => isset( $args['hide_empty_brand'] ) ? $args['hide_empty_brand'] : 'yes',
            'orderby'    => ! empty( $args['brand_orderby'] ) ? $args['brand_orderby'] : '',
        ) );

        if ( empty( $filterplus_brands ) ) {
            // Shoppers see nothing; builders/previews explain why the section is missing.
            if ( self::is_builder_preview() && current_user_can( 'edit_posts' ) ) {
                $all = \FilterPlus\Utils\Helper::get_brands( 'assoc', array( 'hide_empty' => 'no' ) );
                $msg = empty( $all )
                    ? esc_html__( 'Brand filter: no brands found. Add brands under Products > Brands.', 'filter-plus' )
                    : esc_html__( 'Brand filter: the selected brands have no products, so the section is hidden. Assign brands to products or turn off "Hide Empty Brands".', 'filter-plus' );
                echo '<div class="sidebar-row fp-brands-wrap fp-brand-notice">' . $msg . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above
            }
            return;
        }

        $files = array(
            '1' => 'brands-checkbox.php',
            '2' => 'brands-radio.php',
            '3' => 'brands-image.php',
        );
        $file = isset( $files[ $brand_template ] ) ? $files[ $brand_template ] : $files['1'];
        $url  = \FilterPlus::locate_template( 'woo-filter/parts/brand/' . $file );

        if ( file_exists( $url ) ) {
            include $url;
        }
    }

    /**
     * Are we rendering inside a page builder / editor preview?
     *
     * @return bool
     */
    public static function is_builder_preview() {
        if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
            return true; // Gutenberg ServerSideRender
        }
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only flag check
        if ( isset( $_GET['filterplus_preview'] ) || isset( $_GET['elementor-preview'] ) ) {
            return true;
        }
        if ( wp_doing_ajax() && isset( $_REQUEST['action'] ) && 'elementor_ajax' === $_REQUEST['action'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            return true;
        }
        if ( class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->editor ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            return true;
        }
        if ( function_exists( 'bricks_is_builder' ) && ( bricks_is_builder() || ( function_exists( 'bricks_is_builder_call' ) && bricks_is_builder_call() ) ) ) {
            return true;
        }

        return false;
    }

    public static function tempalte_arr( $args , $type = 'shortcode' , $count = 3 ) {
        $pro = class_exists( 'FilterPlusPro' ) ? '' : ' ' . '(' . esc_html__( 'Pro', 'filter-plus' ) . ')';
        $template_length = array();

        if ($type === 'elementor') {
            for ($i=0; $i < $count ; $i++) {
                /* translators: %d: template number */
                $template_length[$i+1] = sprintf( esc_html__( 'Template %d', 'filter-plus' ), $i + 1 ) . $pro;
            }
            $args['template'] = $template_length;
        }

        return $args;
    }

    /**
     * Color template data
     * 
     * @return array
     */

    public static function color_template( $type = 'shortcode' ) {
        $args = array(
            "template" => array(1,2,3),
        );

        $args = self::tempalte_arr( $args , $type , 3 );

        if ( ! class_exists( 'FilterPlusPro' ) ) {
            $args['template_disable'] = 1;
        }else{
            $args['template_disable'] = '';
        }

        return $args;
    }

    /**
     * Review template data
     * 
     * @return array
     */

    public static function review_template( $type = 'shortcode' ) {
        $args = array(
            "template" => array(1,2,3),
        );

        $args = self::tempalte_arr( $args , $type , 3 );

        if ( ! class_exists( 'FilterPlusPro' ) ) {
            $args['template_disable'] = 1;
        }else{
            $args['template_disable'] = '';
        }

        return $args;
    }

}
