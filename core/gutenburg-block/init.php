<?php

// Exit if accessed directly.

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

global $wp_version;

//register FilterPlus  block category
function filter_plus_category( $categories, $post ) {
    return array_merge(
        $categories,
        [
            [
                'slug'  => 'filter-plus-blocks',
                'title' => __( 'Filter Plus', 'filter-plus' ),
            ],
        ]
    );
}

//register block assets
function filter_plus_block_assets() {
    global $wp_version;
    
    if( version_compare($wp_version, '5.8') >= 0){
        $wp_editor = [ 'wp-block-editor'];
    } else{
        $wp_editor = [ 'wp-editor'];
    }

    // Register block editor script for backend.
    wp_register_script(
        'filter-plus-block-js',
        \FilterPlus::build_url() . 'index.js' ,
        array_merge( $wp_editor, [ 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-compose', 'wp-server-side-render','wp-hooks', 'wp-editor' ] ),
        null,
        true
    );

    // WP Localized globals. Use dynamic PHP stuff in JavaScript via `cgbGlobal` object.
    wp_localize_script(
        'filter-plus-block-js',
        'filterPlus',
        [
            'woo_categories'    => \FilterPlus\Utils\Helper::get_categories('','label_value'),
            'tags'              => \FilterPlus\Utils\Helper::get_product_tags('product_tag','label_value'),
            'attributes'        => \FilterPlus\Utils\Helper::woo_attribute_list('label_value'),
			'is_pro_active'     => (( class_exists( 'FilterPlusPro' ) ) ? true : false),
        ]
    );

}


if( version_compare($wp_version, '5.8') >= 0){
	add_filter( 'block_categories_all', 'filter_plus_category', 10, 2 );
} else{
	add_filter( 'block_categories', 'filter_plus_category', 10, 2 );
}

// Hook: Block assets.
add_action( 'init', 'filter_plus_block_assets' );


// woo filter
if ( file_exists( \FilterPlus::plugin_dir() . 'core/gutenburg-block/woo-filter/woo-filter.php' ) ) {
    include_once \FilterPlus::plugin_dir() . 'core/gutenburg-block/woo-filter/woo-filter.php';
}
