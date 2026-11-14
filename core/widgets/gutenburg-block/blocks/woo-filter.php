<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

//register woo filter block
function product_filter_block() {
    register_block_type(
        'filter-plus/woo-filter',
        [
            'editor_script'   => 'filter-plus-block-js',
            'style_handles'   => [ 'filter-plus-public-css', 'filter-plus-swiper-css' ],
            'render_callback' => 'product_filter_callback',
            'attributes'      => array(
                'template' => array(
                    'type' => 'string',
                    'default' => '1'
                ),
                'title' => array(
                    'type' => 'string',
                    'default' => __( 'Filters', 'filter-plus' )
                ),
                'no_of_items' => array(
                    'type' => 'number',
                    'default' => 9
                ),
                'filter_position' => array(
                    'type' => 'string',
                    'default' => 'left'
                ),
                'pagination_style' => array(
                    'type' => 'string',
                    'default' => 'numbers'
                ),
                'category_template' => array(
                    'type' => 'string',
                    'default' => '1'
                ),
                'category_label' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'categories' => array(
                    'type' => 'array',
                    'default' => array()
                ),
                'exclude_categories' => array(
                    'type' => 'array',
                    'default' => array()
                ),
                'hide_empty_cat' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'sub_categories' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'wrap_sub_categories' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'product_count' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'colors' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'color_template' => array(
                    'type' => 'string',
                    'default' => '1'
                ),
                'color_label' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'size' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'size_label' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'show_tags' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'tag_label' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'tags' => array(
                    'type' => 'array',
                    'default' => array()
                ),
                'show_brands' => array(
                    'type' => 'boolean',
                    'default' => false
                ),
                'brand_template' => array(
                    'type' => 'string',
                    'default' => '1'
                ),
                'brand_label' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'brands' => array(
                    'type' => 'array',
                    'default' => array()
                ),
                'brand_orderby' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'hide_empty_brand' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'brand_count' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'show_attributes' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'attribute_label' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'attributes' => array(
                    'type' => 'array',
                    'default' => array()
                ),
                'show_price_range' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'price_range_label' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'show_reviews' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'review_template' => array(
                    'type' => 'string',
                    'default' => '1'
                ),
                'review_label' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'stock' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'stock_label' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'stock_template' => array(
                    'type' => 'string',
                    'default' => '1'
                ),
                'on_sale' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'on_sale_label' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'on_sale_template' => array(
                    'type' => 'string',
                    'default' => '1'
                ),
                'hide_prod_title' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'hide_prod_desc' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'hide_prod_price' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'hide_prod_add_cart' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'add_to_cart_text' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'product_image_size' => array(
                    'type' => 'string',
                    'default' => 'woocommerce_thumbnail'
                ),
                'image_width' => array(
                    'type' => 'number',
                    'default' => 0
                ),
                'image_height' => array(
                    'type' => 'number',
                    'default' => 0
                ),
                'rollover_image' => array( 'type' => 'boolean', 'default' => false ),
                'rollover_image_number' => array( 'type' => 'number', 'default' => 1 ),
                'rollover_effect' => array( 'type' => 'string', 'default' => 'fade' ),
                'gallery_slider' => array( 'type' => 'boolean', 'default' => false ),
                'show_product_attributes' => array( 'type' => 'boolean', 'default' => false ),
                'product_attributes' => array( 'type' => 'array', 'default' => array() ),
                'hide_prod_rating' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'sorting' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'product_categories' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'show_sale_badge' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'product_tags' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'masonry_style' => array(
                    'type' => 'boolean',
                    'default' => false
                ),
                'apply_button_mode' => array(
                    'type' => 'boolean',
                    'default' => false
                ),
                'apply_button_label' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'reset_button_label' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'grid_columns_desktop' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'grid_columns_tablet' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'grid_columns_mobile' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'category_orderby' => array(
                    'type'    => 'string',
                    'default' => ''
                ),
                'filter_order' => array(
                    'type'    => 'array',
                    'default' => array(),
                    'items'   => array( 'type' => 'string' ),
                ),
            ),
        ]
    );
}
add_action( 'init', 'product_filter_block' );


function product_filter_callback( $settings ) {
    // Convert arrays to comma-separated strings (use is_array only — !empty([]) is false for empty arrays)
    foreach ( ['categories', 'exclude_categories', 'tags', 'attributes', 'brands', 'filter_order', 'product_attributes'] as $field ) {
        if ( isset( $settings[$field] ) && is_array( $settings[$field] ) ) {
            $settings[$field] = implode( ',', $settings[$field] );
        }
    }

    // Convert boolean values (1/0 or true/false) to 'yes'/'no' strings
    $boolean_fields = [
        'masonry_style', 'hide_empty_cat', 'sub_categories', 'wrap_sub_categories', 'product_count',
        'colors', 'size', 'show_tags', 'show_attributes', 'show_price_range',
        'show_reviews', 'stock', 'on_sale', 'hide_prod_title', 'hide_prod_desc',
        'hide_prod_price', 'hide_prod_add_cart', 'hide_prod_rating', 'sorting',
        'rollover_image', 'gallery_slider', 'show_product_attributes',
        'product_categories', 'show_sale_badge', 'product_tags', 'apply_button_mode',
        'show_brands', 'hide_empty_brand', 'brand_count'
    ];

    foreach ($boolean_fields as $field) {
        if (isset($settings[$field])) {
            $settings[$field] = $settings[$field] ? 'yes' : 'no';
        }
    }

    // Masonry is initialized by search-filter.js, which does not run in the
    // server-rendered editor preview. Use the standard grid in both the shell
    // and the pre-rendered cards so Gutenberg does not create a broken layout.
    $render_settings = $settings;
    if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
        $render_settings['masonry_style'] = 'no';
    }

    $html = \FilterPlus\Core\Frontend\Shortcodes::instance()->filter_plus( $render_settings );

    // In the block editor (REST preview), search-filter.js is not loaded.
    // Pre-render products into the grid/list divs so they show immediately.
    if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
        $rendered = [ 'grid' => '', 'list' => '' ];
        $template = ! empty( $settings['template'] ) ? $settings['template'] : '1';

        ob_start(); // capture any stray PHP warnings so they don't corrupt REST JSON
        try {
            $actions = \FilterPlus\Core\Frontend\SearchFilter\Actions::instance();
            $preview = $actions->get_products( [
                'filter_type'        => 'product',
                'limit'              => ! empty( $settings['no_of_items'] ) ? absint( $settings['no_of_items'] ) : 9,
                'offset'             => 1,
                'template'           => $template,
                'masonry_style'      => 'no',
                'product_categories' => ! empty( $settings['product_categories'] ) ? 'yes' : 'no',
                'product_tags'       => ! empty( $settings['product_tags'] ) ? 'yes' : 'no',
                'show_sale_badge'    => ! empty( $settings['show_sale_badge'] ) ? 'yes' : 'no',
                'order_by'           => '',
                'cat_id'             => '',
                'taxonomies'         => [],
                'search_value'       => '',
                'min'                => '',
                'max'                => '',
                'rating'             => '',
                'stock'              => '',
                'on_sale'            => '',
                'filter_param'       => [],
                'cf_list'            => [],
                'author'             => '',
                'pagination_style'   => ! empty( $settings['pagination_style'] ) ? sanitize_key( $settings['pagination_style'] ) : 'numbers',
                'taxonomy'           => 'product_cat',
                'exclude_cat_id'     => '',
                'add_to_cart_text'   => ! empty( $settings['add_to_cart_text'] ) ? $settings['add_to_cart_text'] : '',
                'product_image_size' => ! empty( $settings['product_image_size'] ) ? $settings['product_image_size'] : 'woocommerce_thumbnail',
                'image_width'        => ! empty( $settings['image_width'] )  ? $settings['image_width']  : '',
                'image_height'       => ! empty( $settings['image_height'] ) ? $settings['image_height'] : '',
                'hide_prod_title'    => ! empty( $settings['hide_prod_title'] ) ? 'yes' : 'no',
                'hide_prod_desc'     => ! empty( $settings['hide_prod_desc'] ) ? 'yes' : 'no',
                'hide_prod_price'    => ! empty( $settings['hide_prod_price'] ) ? 'yes' : 'no',
                'hide_prod_add_cart' => ! empty( $settings['hide_prod_add_cart'] ) ? 'yes' : 'no',
                'hide_prod_rating'   => ! empty( $settings['hide_prod_rating'] ) ? 'yes' : 'no',
                'rollover_image'     => ! empty( $settings['rollover_image'] ) ? 'yes' : 'no',
                'rollover_image_number' => isset( $settings['rollover_image_number'] ) ? max( 1, min( 5, absint( $settings['rollover_image_number'] ) ) ) : 1,
                'rollover_effect'    => isset( $settings['rollover_effect'] ) ? sanitize_key( $settings['rollover_effect'] ) : 'fade',
                'gallery_slider'     => ! empty( $settings['gallery_slider'] ) ? 'yes' : 'no',
                'show_product_attributes' => ! empty( $settings['show_product_attributes'] ) ? 'yes' : 'no',
                'product_attributes' => isset( $settings['product_attributes'] ) ? $settings['product_attributes'] : '',
            ] );

            // Use the selected template exactly as the front end does. A
            // template 1 fallback makes the editor misleading for Pro layouts.
            $preview_render_settings = array(
                'hide_prod_add_cart' => ! empty( $settings['hide_prod_add_cart'] ) ? 'yes' : 'no',
                'hide_prod_title' => ! empty( $settings['hide_prod_title'] ) ? 'yes' : 'no',
                'hide_prod_desc' => ! empty( $settings['hide_prod_desc'] ) ? 'yes' : 'no',
                'hide_prod_rating' => ! empty( $settings['hide_prod_rating'] ) ? 'yes' : 'no',
                'hide_prod_price' => ! empty( $settings['hide_prod_price'] ) ? 'yes' : 'no',
                'rollover_image' => ! empty( $settings['rollover_image'] ) ? 'yes' : 'no',
                'rollover_image_number' => isset( $settings['rollover_image_number'] ) ? max( 1, min( 5, absint( $settings['rollover_image_number'] ) ) ) : 1,
                'rollover_effect' => isset( $settings['rollover_effect'] ) ? sanitize_key( $settings['rollover_effect'] ) : 'fade',
                'gallery_slider' => ! empty( $settings['gallery_slider'] ) ? 'yes' : 'no',
                'show_product_attributes' => ! empty( $settings['show_product_attributes'] ) ? 'yes' : 'no',
                'product_attributes' => isset( $settings['product_attributes'] ) ? $settings['product_attributes'] : '',
            );
            $rendered = $actions->render_products_html( $preview['products'], 'product', $template, $preview_render_settings );
        } catch ( \Throwable $e ) { // phpcs:ignore -- silently skip on any error
        }
        ob_end_clean(); // discard any PHP warnings / notices

        if ( ! empty( $rendered['grid'] ) ) {
            $html = preg_replace(
                '/(<div[^>]*class="prods-grid-view[^"]*")([^>]*>)/',
                '$1 data-editor-products="1"$2' . $rendered['grid'],
                $html,
                1
            );
        }
        if ( ! empty( $rendered['list'] ) ) {
            $html = preg_replace(
                '/(<div[^>]*class="prods-list-view"[^>]*>)/',
                '$1' . $rendered['list'],
                $html,
                1
            );
        }
    }

    return $html;
}
