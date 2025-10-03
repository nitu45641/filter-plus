<?php

//register woo filter block
function content_filter_block() {
    register_block_type(
        'filter-plus/wp-filter',
        [
            'editor_script'   => 'filter-plus-wp-filter',
            'render_callback' => 'content_filter_callback',
            'attributes'      => array(),
        ]
    );
}
add_action( 'init', 'content_filter_block' );


function content_filter_callback( $settings ) {

    \FilterPlus\Utils\Helper::instance()->pro_active_message();

    extract($settings);
    $filter_type        = !empty($settings['filter_type']) ? $settings['filter_type'] : 'post';
    $custom_post        = !empty($settings['custom_post']) ? $settings['custom_post'] : '';
    $template           = !empty($settings['template']) ? $settings['template'] : '1';
    $show_categories    = !empty($show_categories) ? $show_categories : 'yes';
    $category_label     = !empty($category_label) ? $category_label : esc_html__('Categories','filter-plus');
    $categories         = !empty($settings['categories']) ? $settings['categories'] : '';
    $sub_categories     = !empty($settings['sub_categories']) && $settings['sub_categories'] == true ? 'yes' : 'no';
    $show_tags          = !empty($settings['show_tags']) && $settings['show_tags'] == true ? 'yes' : 'no';
    $tag_label 	        = !empty($tag_label) ? $tag_label : esc_html__('Tags','filter-plus');
    $tags               = !empty($settings['tags']) ? $settings['tags'] : '';
    $author	            = !empty($author) && $author == true ? 'yes' : 'no';
    $author_label	    = !empty($author_label) ? $author_label : esc_html__('Authors','filter-plus');
    $author_list	    = !empty($author_list) ? $author_list : '';
    $custom_field	    = !empty($custom_field) && $custom_field == true ? 'yes' : 'no';
    $custom_field_label	= !empty($custom_field_label) ? $custom_field_label : esc_html__('Custom Field','filter-plus');
    $meta_condition	    = !empty($meta_condition) ? $meta_condition : 'OR';
    $custom_field_list  = !empty($settings['custom_field_list']) ? $custom_field_list : '';
    $post_categories    = !empty($settings['post_categories']) && $settings['post_categories'] == true ? 'yes' : 'no';
    $post_tags          = !empty($settings['post_tags']) && $settings['post_tags'] == true ? 'yes' : 'no';
    $post_author        = !empty($settings['post_author']) && $settings['post_author'] == true ? 'yes' : 'no';
    $hide_wp_title      = !empty($settings['hide_wp_title']) && $settings['hide_wp_title'] == true ? 'yes' : 'no';
    $hide_wp_desc       = !empty($settings['hide_wp_desc']) && $settings['hide_wp_desc'] == true ? 'yes' : 'no';
    $title           	= !empty($settings['title']) ? $settings['title'] : esc_html__('Filters','filter-plus');
    $no_of_items 		= ! empty( $settings['no_of_items'] ) ? $settings['no_of_items'] : 9;

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

    if ( ( did_action( 'get_header' ) || did_action( 'get_footer' ) ) == 1 ) {

        echo do_shortcode("[wp_filter_plus filter_type={$filter_type} custom_post={$custom_post} show_categories={$show_categories}
        category_label='".$category_label."' title={$title} no_of_items={$no_of_items}
        sub_categories='".$sub_categories."'
        categories='{$categories}' show_tags='{$show_tags}' tags='{$tags}' tag_label='".$tag_label."'
        template ={$template} author={$author} author_label='".$author_label."' author_list={$author_list}
        custom_field={$custom_field} custom_field_label='".$custom_field_label."' meta_condition={$meta_condition}
        custom_field_list={$custom_field_list} post_tags='{$post_tags}'
        post_categories='{$post_categories} post_author={$post_author} hide_wp_title={$hide_wp_title} hide_wp_desc={$hide_wp_desc}']"); 

    }
}
