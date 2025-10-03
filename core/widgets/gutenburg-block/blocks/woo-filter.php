<?php

//register woo filter block
function product_filter_block() {
    register_block_type(
        'filter-plus/woo-filter',
        [
            // Enqueue blocks.build.js in the editor only.
            'editor_script'   => 'filter-plus-block-js',
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
                'product_tags' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
                'masonry_style' => array(
                    'type' => 'boolean',
                    'default' => true
                ),
            ),
        ]
    );
}
add_action( 'init', 'product_filter_block' );


function product_filter_callback( $settings ) {
    // Convert arrays to comma-separated strings
    if ( !empty($settings['categories']) && is_array($settings['categories']) ) {
        $settings['categories'] = implode(',', $settings['categories']);
    }
    if ( !empty($settings['tags']) && is_array($settings['tags']) ) {
        $settings['tags'] = implode(',', $settings['tags']);
    }
    if ( !empty($settings['attributes']) && is_array($settings['attributes']) ) {
        $settings['attributes'] = implode(',', $settings['attributes']);
    }

    // Convert boolean values (1/0 or true/false) to 'yes'/'no' strings
    $boolean_fields = [
        'masonry_style', 'hide_empty_cat', 'sub_categories', 'product_count',
        'colors', 'size', 'show_tags', 'show_attributes', 'show_price_range',
        'show_reviews', 'stock', 'on_sale', 'hide_prod_title', 'hide_prod_desc',
        'hide_prod_price', 'hide_prod_add_cart', 'hide_prod_rating', 'sorting',
        'product_categories', 'product_tags'
    ];

    foreach ($boolean_fields as $field) {
        if (isset($settings[$field])) {
            $settings[$field] = $settings[$field] ? 'yes' : 'no';
        }
    }

    if ( ( did_action( 'get_header' ) || did_action( 'get_footer' ) ) == 1 ) {
        echo \FilterPlus\Core\Frontend\Shortcodes::instance()->filter_plus( $settings );
    }
}
