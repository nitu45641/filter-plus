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
    $tags               = '';
    $attributes         = '';
    $show_tags          = '';
    $show_attributes    = '';
    $show_reviews       = '';
    $show_price_range   = '';
    $product_categories = '';
    $product_tags       = '';
    $sorting            = 'no';
    if ( is_array($categories) ) {
        $categories     =  join(", ",$categories);
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
