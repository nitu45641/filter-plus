<?php

//register woo filter block
function product_filter_block() {
    register_block_type(
        'filter-plus/woo-filter',
        [
            // Enqueue blocks.build.js in the editor only.
            'editor_script'   => 'filter-plus-block-js',
            'render_callback' => 'product_filter_callback',
            'attributes'      => array(),
        ]
    );
}
add_action( 'init', 'product_filter_block' );


function product_filter_callback( $settings ) {
    extract($settings);
    $template           = !empty($settings['template']) ? $settings['template'] : '1';
    $category_label     = !empty($category_label) ? $category_label : esc_html__('Categories','filter-plus');
    $categories         = !empty($settings['categories']) ? $settings['categories'] : '';
    $sub_categories     = !empty($settings['sub_categories']) && $settings['sub_categories'] == true ? 'yes' : 'no';
    $color_label 		= !empty($color_label) ? $color_label : esc_html__('Colors','filter-plus');
    $colors             = !empty($settings['colors']) && $settings['colors'] == true  ? 'yes' : 'no';
    $size_label			= !empty($size_label) ? $size_label : esc_html__('Size','filter-plus');
    $size               = !empty($settings['size']) && $settings['size'] == true ? 'yes' : 'no';
    $tag_label 	        = !empty($tag_label) ? $tag_label : esc_html__('Tags','filter-plus');
    $show_tags          = !empty($settings['show_tags']) && $settings['show_tags'] == true ? 'yes' : 'no';
    $tags               = !empty($settings['tags']) ? $settings['tags'] : '';
    $attribute_label	= !empty($attribute_label) ? $attribute_label : esc_html__('Attributes','filter-plus');
    $show_attributes    = !empty($settings['show_attributes']) && $settings['show_attributes'] == true ? 'yes' : 'no';
    $attributes         = !empty($settings['attribute_list']) ? $settings['attribute_list'] : '';
    $review_label 		= !empty($review_label) ? $review_label : esc_html__('Review','filter-plus');
    $show_reviews       = !empty($settings['show_reviews']) && $settings['show_reviews'] == true ? 'yes' : 'no';
    $price_range_label 	= !empty($price_range_label) ? $price_range_label :  esc_html__('Price Range','filter-plus');
    $show_price_range   = !empty($settings['show_price_range']) && $settings['show_price_range'] == true ? 'yes' : 'no';
    $sorting            = !empty($settings['sorting']) && $settings['sorting'] == true ? 'yes' : 'no';
    $stock_label 		= !empty($stock_label) ? $stock_label : esc_html__('Stock','filter-plus');
    $stock              = !empty($settings['stock']) && $settings['stock'] == true ? 'yes' : 'no';
    $on_sale_label 		= !empty($on_sale_label) ? $on_sale_label :  esc_html__('Sale','filter-plus');
    $on_sale            = !empty($settings['on_sale']) && $settings['on_sale'] == true ? 'yes' : 'no';
    $product_categories = !empty($settings['product_categories']) && $settings['product_categories'] == true ? 'yes' : 'no';
    $product_tags       = !empty($settings['product_tags']) && $settings['product_tags'] == true ? 'yes' : 'no';
    $title           	= !empty($settings['title']) ? $settings['title'] : esc_html__('Filters','filter-plus');
    $no_of_items 		= ! empty( $settings['no_of_items'] ) ? $settings['no_of_items'] : 9;

    if ( is_array($categories) ) {
        $categories     =  join(", ",$categories);
    }
    if ( is_array($tags) ) {
        $tags     =  join(", ",$tags);
    }
    if ( is_array($attributes) ) {
        $attributes     =  join(", ",$attributes);
    }

    if ( ( did_action( 'get_header' ) || did_action( 'get_footer' ) ) == 1 ) {
        ?>
        <div class="woo-filter">
            <?php
                echo do_shortcode("[filter_products category_label='".$category_label."' 
                tag_label='".$tag_label."' title={$title} no_of_items={$no_of_items} 
                sub_categories='".$sub_categories."' 
                color_label='".$color_label."' 
                size_label='".$size_label."' attribute_label='".$attribute_label."' 
                review_label='".$review_label."' price_range_label='".$price_range_label."'
                stock_label='".$stock_label."' on_sale_label='".$on_sale_label."' 
                stock={$stock} on_sale={$on_sale} template ={$template} categories='{$categories}' tags='{$tags}' attributes='{$attributes}' colors='{$colors}' size='{$size}' show_tags='{$show_tags}' show_attributes='{$show_attributes}' show_reviews='{$show_reviews}' show_price_range='{$show_price_range}' sorting='{$sorting}' product_tags='{$product_tags}' product_categories='{$product_categories}']");     	
            ?>
        </div>
        <?php
    }
}
