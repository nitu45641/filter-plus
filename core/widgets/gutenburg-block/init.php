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
        \FilterPlus::asset_version( 'css/public.css' )
    );
    wp_register_style(
        'filter-plus-swiper-css',
        \FilterPlus::assets_url() . 'css/filter-swiper-bundle.min.css',
        [],
        \FilterPlus::asset_version( 'css/filter-swiper-bundle.min.css' )
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
            'brands'            => array_values( \FilterPlus\Utils\Helper::get_brands( 'label_value', array( 'hide_empty' => 'no' ) ) ),
            'brand_templates'   => array_map( function( $value, $label ) { return array( 'value' => (string) $value, 'label' => $label ); }, array_keys( \FilterPlus\Base\DataFactory::brand_template()['template'] ), \FilterPlus\Base\DataFactory::brand_template()['template'] ),
            'has_brand_taxonomy' => '' !== \FilterPlus\Utils\Helper::brand_taxonomy(),
            'custom_fields'     => array_map( function( $value, $label ) { return array( 'value' => (string) $value, 'label' => $label ); }, array_keys( \FilterPlus\Core\Admin\FilterOptions\Helper::get_filter_options( -1, 'custom_field' ) ), \FilterPlus\Core\Admin\FilterOptions\Helper::get_filter_options( -1, 'custom_field' ) ),
            'image_sizes'       => \FilterPlus\Utils\Helper::product_image_sizes('label_value'),
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

// Add image display controls to the existing Woo filter block.
add_action( 'enqueue_block_editor_assets', function() {
    wp_enqueue_script(
        'filter-plus-gallery-image-controls',
        \FilterPlus::assets_url() . 'js/gallery-image-controls.js',
        array( 'wp-element', 'wp-components', 'wp-compose', 'wp-hooks', 'wp-block-editor', 'filter-plus-block-js' ),
        \FilterPlus::asset_version( 'js/gallery-image-controls.js' ),
        true
    );
} );

// Block sidebar controls (Filter Order drag & drop list).
add_action( 'enqueue_block_editor_assets', function() {
    wp_register_style( 'filter-plus-block-editor', false, array( 'wp-components' ), \FilterPlus::get_version() );
    wp_enqueue_style( 'filter-plus-block-editor' );
    wp_add_inline_style( 'filter-plus-block-editor', '
.fp-sortable-order{margin:0;padding:0;list-style:none;display:flex;flex-direction:column;gap:6px}
.fp-sortable-order__item{display:flex;align-items:center;gap:6px;margin:0;padding:2px 2px 2px 6px;min-height:36px;background:#fff;border:1px solid #ddd;border-radius:4px;cursor:grab;user-select:none}
.fp-sortable-order__item:hover{border-color:#949494}
.fp-sortable-order__item.is-dragging{opacity:.4}
.fp-sortable-order__item.is-over-before{box-shadow:inset 0 2px 0 var(--wp-admin-theme-color,#3858e9)}
.fp-sortable-order__item.is-over-after{box-shadow:inset 0 -2px 0 var(--wp-admin-theme-color,#3858e9)}
.fp-sortable-order__handle{display:flex;color:#757575}
.fp-sortable-order__label{flex:1 1 auto;min-width:0;font-size:13px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.fp-sortable-order__actions{display:flex}
.fp-sortable-order__actions .components-button{min-width:28px;width:28px;height:28px;padding:0;justify-content:center}
.fp-sortable-order.is-disabled .fp-sortable-order__item{cursor:not-allowed;opacity:.6}
.fp-sortable-order__reset{margin-top:8px}
.fp-sortable-order__pro{margin:0;padding:10px 12px;border-radius:4px;background:#f0f0f0;font-size:12px;color:#1e1e1e}
' );
} );

// Enqueue frontend styles in the block editor so previews match the frontend.
add_action( 'enqueue_block_editor_assets', function() {
    wp_enqueue_style( 'filter-plus-public-css' );
    wp_enqueue_style( 'filter-plus-swiper-css' );

    $default_css = \FilterPlus\Core\Frontend\Shortcodes::instance()->custom_css( '1', 'content-filter', array( 'masonry_style' => 'no' ) );
    if ( ! empty( $default_css ) ) {
        wp_add_inline_style( 'filter-plus-public-css', $default_css );
    }
} );

// The post editor canvas is an iframe. Styles added on
// enqueue_block_editor_assets stay in the outer admin document, so Pro
// template styles (templates 3-8) never reached the preview. Styles added on
// enqueue_block_assets are copied into the iframe. Admin only: the frontend
// already loads the Pro stylesheet through its own enqueue class.
add_action( 'enqueue_block_assets', function() {
    if ( ! is_admin() || ! class_exists( 'FilterPlusPro' ) ) {
        return;
    }
    wp_enqueue_style(
        'filter-plus-pro-public-css',
        \FilterPlusPro::assets_url() . 'css/public.css',
        array( 'filter-plus-public-css' ),
        \FilterPlusPro::asset_version( 'css/public.css' )
    );
    // Cards render a quick-view trigger when the module is on; style it too.
    if ( class_exists( '\FilterPlusPro\Core\Frontend\QuickView' ) && \FilterPlusPro\Core\Frontend\QuickView::is_enabled() ) {
        wp_enqueue_style(
            'filter-plus-pro-quick-view',
            \FilterPlusPro::assets_url() . 'css/quick-view.css',
            array( 'filter-plus-pro-public-css' ),
            \FilterPlusPro::asset_version( 'css/quick-view.css' )
        );
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
