<?php

//register woo filter block
function wp_filter_block() {
    register_block_type(
        'filter-plus/wp-filter',
        [
            'editor_script'   => 'filter-plus-wp-filter',
            'render_callback' => 'wp_filter_callback',
            'attributes'      => array(),
        ]
    );
}
add_action( 'init', 'wp_filter_block' );


function wp_filter_callback( $settings ) {

    \FilterPlus\Utils\Helper::instance()->pro_active_message();

    extract($settings);
    $filter_type        = !empty($settings['filter_type']) ? $settings['filter_type'] : 'post';
    $custom_post        = !empty($settings['custom_post']) ? $settings['custom_post'] : '';
    $template           = !empty($settings['template']) ? $settings['template'] : '1';
    $show_categories    = !empty($show_categories) ? $show_categories : 'yes';
    $category_label     = !empty($category_label) ? $category_label : esc_html__('Categories','filter-plus');
    $categories         = !empty($settings['categories']) ? $settings['categories'] : '';
    $show_tags          = !empty($settings['show_tags']) && $settings['show_tags'] == true ? 'yes' : 'no';
    $tag_label 	        = !empty($tag_label) ? $tag_label : esc_html__('Tags','filter-plus');
    $tags               = !empty($settings['tags']) ? $settings['tags'] : '';
    $author	            = !empty($author) ? $author : '';
    $author_label	    = !empty($author_label) ? $author_label : esc_html__('Authors','filter-plus');
    $author_list	    = !empty($author_list) ? $author_list : '';
    $custom_field	    = !empty($custom_field) ? $custom_field : 'no';
    $custom_field_label	= !empty($custom_field_label) ? $custom_field_label : esc_html__('Custom Field','filter-plus');
    $meta_condition	    = !empty($meta_condition) ? $meta_condition : 'OR';
    $custom_field_list    = !empty($settings['custom_field_list']) ? $custom_field_list : '';
    $post_categories    = !empty($settings['post_categories']) && $settings['post_categories'] == true ? 'yes' : 'no';
    $post_tags          = !empty($settings['post_tags']) && $settings['post_tags'] == true ? 'yes' : 'no';
    $post_author        = !empty($settings['post_author']) && $settings['post_author'] == true ? 'yes' : 'no';
    
    if ( is_array($custom_field_list) ) {
        $custom_field_list     =  join(", ",$custom_field_list);
    }
    if ( is_array($author_list) ) {
        $author_list     =  join(", ",$author_list);
    }
    if ( is_array($categories) ) {
        $categories     =  join(", ",$categories);
    }
    if ( is_array($tags) ) {
        $tags     =  join(", ",$tags);
    }

    ob_start();

    echo do_shortcode("[wp_filter_plus filter_type={$filter_type} custom_post={$custom_post} show_categories={$show_categories} category_label={$category_label} 
    categories='{$categories}' show_tags='{$show_tags}' tags='{$tags}' tag_label={$tag_label}
    template ={$template} author={$author} author_label={$author_label} author_list={$author_list} 
    custom_field={$custom_field} custom_field_label={$custom_field_label} meta_condition={$meta_condition}
    custom_field_list={$custom_field_list} post_tags='{$post_tags}'
    post_categories='{$post_categories} post_author={$post_author}']"); 

    return ob_get_clean();
}
