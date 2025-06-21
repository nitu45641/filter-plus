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
                'title' => __( 'FilterPlus', 'filter-plus' ),
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

    $param = array_merge( $wp_editor, [ 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-compose', 'wp-server-side-render','wp-hooks', 'wp-editor' ] );

    // Register block editor script for backend.
    wp_register_script(
        'filter-plus-block-js',
        \FilterPlus::build_url() . 'index.js' ,
        $param,
        null,
        true
    );

    wp_localize_script(
        'filter-plus-block-js',
        'filterPlus',
        [
            'custom_post_type'  => \FilterPlus\Utils\Helper::custom_post_type('label_value'),
            'wp_cats'           => \FilterPlus\Utils\Helper::get_categories('','label_value',array('taxonomy'=>'category')),
            'post_tag'          => \FilterPlus\Utils\Helper::get_product_tags('post_tag','label_value'),
            'author_list'       =>  \FilterPlus\Utils\Helper::instance()->author_list('','label_value'),
            'woo_categories'    => \FilterPlus\Utils\Helper::get_categories('','label_value'),
            'tags'              => \FilterPlus\Utils\Helper::get_product_tags('product_tag','label_value'),
            'attributes'        => \FilterPlus\Utils\Helper::woo_attribute_list('label_value'),
			'is_pro_active'     => (( class_exists( 'FilterPlusPro' ) ) ? 0 : 1 ),
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
if ( file_exists( \FilterPlus::plugin_dir() . 'core/widgets/gutenburg-block/blocks/woo-filter.php' ) ) {
    include_once \FilterPlus::plugin_dir() . 'core/widgets/gutenburg-block/blocks/woo-filter.php';
}
// wp filter
if ( file_exists( \FilterPlus::plugin_dir() . 'core/widgets/gutenburg-block/blocks/wp-filter.php' ) ) {
    include_once \FilterPlus::plugin_dir() . 'core/widgets/gutenburg-block/blocks/wp-filter.php';
}
