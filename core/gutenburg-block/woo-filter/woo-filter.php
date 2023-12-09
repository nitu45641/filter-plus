<?php

//register woo filter block
function woo_filter_block() {
    register_block_type(
        'filter-plus/woo-filter',
        [
            // Enqueue blocks.build.js in the editor only.
            'editor_script'   => 'filter-plus-block-js',
            'render_callback' => 'woo_filter_callback',
            'attributes'      => array(),
        ]
    );
}
add_action( 'init', 'woo_filter_block' );


function woo_filter_callback( $settings ) {
    $template           = !empty($settings['template']) ? $settings['template'] : '1';
    $categories         = !empty($settings['categories']) ? $settings['categories'] : '';
    $colors             = !empty($settings['colors']) && $settings['colors'] == true  ? 'yes' : 'no';
    $size               = !empty($settings['size']) && $settings['size'] == true ? 'yes' : 'no';
    $show_tags          = !empty($settings['show_tags']) && $settings['show_tags'] == true ? 'yes' : 'no';
    $tags               = !empty($settings['tags']) ? $settings['tags'] : '';
    $show_attributes    = !empty($settings['show_attributes']) && $settings['show_attributes'] == true ? 'yes' : 'no';
    $attributes         = !empty($settings['attribute_list']) ? $settings['attribute_list'] : '';
    $show_reviews       = !empty($settings['show_reviews']) && $settings['show_reviews'] == true ? 'yes' : 'no';
    $show_price_range   = !empty($settings['show_price_range']) && $settings['show_price_range'] == true ? 'yes' : 'no';
    $sorting            = !empty($settings['sorting']) && $settings['sorting'] == true ? 'yes' : 'no';
    $product_categories = !empty($settings['product_categories']) && $settings['product_categories'] == true ? 'yes' : 'no';
    $product_tags       = !empty($settings['product_tags']) && $settings['product_tags'] == true ? 'yes' : 'no';
    
    if ( is_array($categories) ) {
        $categories     =  join(", ",$categories);
    }
    if ( is_array($tags) ) {
        $tags     =  join(", ",$tags);
    }
    if ( is_array($attributes) ) {
        $attributes     =  join(", ",$attributes);
    }

    ob_start();
    ?>
	<div class="woo-filter">
		<?php
            echo do_shortcode("[filter_products template ={$template} categories='{$categories}' tags='{$tags}' attributes='{$attributes}' colors='{$colors}' size='{$size}' show_tags='{$show_tags}' show_attributes='{$show_attributes}' show_reviews='{$show_reviews}' show_price_range='{$show_price_range}' sorting='{$sorting}' product_tags='{$product_tags}' product_categories='{$product_categories}']");
     	?>
	</div>
	<?php

    return ob_get_clean();
}
