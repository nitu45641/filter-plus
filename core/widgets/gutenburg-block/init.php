<?php

// Exit if accessed directly.

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

//register FilterPlus  block category
function filterplus_category( $categories, $post ) {
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
function filterplus_block_assets() {
    $asset_file = \FilterPlus::plugin_dir() . 'build/index.asset.php';
    $asset      = file_exists( $asset_file ) ? require $asset_file : array( 'dependencies' => array(), 'version' => \FilterPlus::get_version() );

    // Register block editor script for backend.
    wp_register_script(
        'filter-plus-block-js',
        \FilterPlus::build_url() . 'index.js',
        $asset['dependencies'],
        $asset['version'],
        true
    );

    // Register frontend styles so they can be loaded in the block editor.
    wp_register_style(
        'filter-plus-public-css',
        \FilterPlus::assets_url() . 'css/public.css',
        [],
        \FilterPlus::get_version()
    );
    wp_register_style(
        'filter-plus-swiper-css',
        \FilterPlus::assets_url() . 'css/filter-swiper-bundle.min.css',
        [],
        \FilterPlus::get_version()
    );

    wp_localize_script(
        'filter-plus-block-js',
        'filterPlus',
        [
            'custom_post_type'  => array_values( \FilterPlus\Utils\Helper::custom_post_type('label_value') ),
            'wp_cats'           => array_values( \FilterPlus\Utils\Helper::get_categories('','label_value',array('taxonomy'=>'category')) ),
            'post_tag'          => array_values( \FilterPlus\Utils\Helper::get_product_tags('post_tag','label_value') ),
            'author_list'       => array_values( \FilterPlus\Utils\Helper::instance()->author_list('','label_value') ),
            'woo_categories'    => array_values( \FilterPlus\Utils\Helper::get_categories('','label_value') ),
            'tags'              => array_values( \FilterPlus\Utils\Helper::get_product_tags('product_tag','label_value') ),
            'attributes'        => array_values( \FilterPlus\Utils\Helper::woo_attribute_list('label_value') ),
			'is_pro_active'     => (( class_exists( 'FilterPlusPro' ) ) ? 0 : 1 ),
        ]
    );

}


if( version_compare( get_bloginfo('version'), '5.8') >= 0){
	add_filter( 'block_categories_all', 'filterplus_category', 10, 2 );
} else{
	add_filter( 'block_categories', 'filterplus_category', 10, 2 );
}

// Hook: Block assets — late priority so all CPTs from other plugins are registered first.
add_action( 'init', 'filterplus_block_assets', 99 );

// Enqueue frontend styles in the block editor so previews match the frontend.
add_action( 'enqueue_block_editor_assets', function() {
    wp_enqueue_style( 'filter-plus-public-css' );
    wp_enqueue_style( 'filter-plus-swiper-css' );

    $default_css = \FilterPlus\Core\Frontend\Shortcodes::instance()->custom_css( '1', 'content-filter', array( 'masonry_style' => 'no' ) );
    if ( ! empty( $default_css ) ) {
        wp_add_inline_style( 'filter-plus-public-css', $default_css );
    }
} );

// woo filter
if ( file_exists( \FilterPlus::plugin_dir() . 'core/widgets/gutenburg-block/blocks/woo-filter.php' ) ) {
    include_once \FilterPlus::plugin_dir() . 'core/widgets/gutenburg-block/blocks/woo-filter.php';
}
// wp filter
if ( file_exists( \FilterPlus::plugin_dir() . 'core/widgets/gutenburg-block/blocks/wp-filter.php' ) ) {
    include_once \FilterPlus::plugin_dir() . 'core/widgets/gutenburg-block/blocks/wp-filter.php';
}
