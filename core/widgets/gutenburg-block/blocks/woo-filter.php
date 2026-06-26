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
                    'default' => ''
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
                'on_sale' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'on_sale_label' => array(
                    'type' => 'string',
                    'default' => ''
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
                    'default' => true
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
            ),
        ]
    );
}
add_action( 'init', 'product_filter_block' );


function product_filter_callback( $settings ) {
    // Convert arrays to comma-separated strings (use is_array only — !empty([]) is false for empty arrays)
    foreach ( ['categories', 'exclude_categories', 'tags', 'attributes'] as $field ) {
        if ( isset( $settings[$field] ) && is_array( $settings[$field] ) ) {
            $settings[$field] = implode( ',', $settings[$field] );
        }
    }

    // Convert boolean values (1/0 or true/false) to 'yes'/'no' strings
    $boolean_fields = [
        'masonry_style', 'hide_empty_cat', 'sub_categories', 'product_count',
        'colors', 'size', 'show_tags', 'show_attributes', 'show_price_range',
        'show_reviews', 'stock', 'on_sale', 'hide_prod_title', 'hide_prod_desc',
        'hide_prod_price', 'hide_prod_add_cart', 'hide_prod_rating', 'sorting',
        'product_categories', 'show_sale_badge', 'product_tags', 'apply_button_mode'
    ];

    foreach ($boolean_fields as $field) {
        if (isset($settings[$field])) {
            $settings[$field] = $settings[$field] ? 'yes' : 'no';
        }
    }

    $html = \FilterPlus\Core\Frontend\Shortcodes::instance()->filter_plus( $settings );

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
                'limit'              => 6,
                'offset'             => 1,
                'template'           => $template,
                'masonry_style'      => isset( $settings['masonry_style'] ) ? $settings['masonry_style'] : 'no',
                'product_categories' => 'yes',
                'product_tags'       => 'yes',
                'show_sale_badge'    => 'yes',
                'post_author'        => 'yes',
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
                'pagination_style'   => 'numbers',
                'taxonomy'           => 'product_cat',
                'exclude_cat_id'     => '',
            ] );

            // Try selected template first; fall back to template 1 if Pro template not renderable
            $rendered = $actions->render_products_html( $preview['products'], 'product', $template );
            if ( empty( $rendered['grid'] ) && $template !== '1' ) {
                $rendered = $actions->render_products_html( $preview['products'], 'product', '1' );
            }
        } catch ( \Throwable $e ) { // phpcs:ignore -- silently skip on any error
        }
        ob_end_clean(); // discard any PHP warnings / notices

        if ( ! empty( $rendered['grid'] ) ) {
            $grid_style = ' style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;"';
            $html = preg_replace(
                '/(<div[^>]*class="prods-grid-view[^"]*")([^>]*>)/',
                '$1 data-editor-products="1"' . $grid_style . '$2' . $rendered['grid'],
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
