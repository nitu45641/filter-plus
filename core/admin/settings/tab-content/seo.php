<?php

// SEO global settings

$args = array('label'=>esc_html__("Refresh Url when Filtering","filter-plus"),
'id' => 'refresh_url' , 'data_label' => 'refresh-url' ,  'checked'=> $refresh_url ,
'checkbox_label' => __('URL will be updated when filter option is selected/changed','filter-plus'),
'disable' => $disable );

filter_plus_checkbox_field($args);

$args = array(
'label'=>esc_html__("SEO elements:","filter-plus"),
'id' => 'seo_elements' , 'data_label' => 'seo-elements' , 
'type' => 'random',
'select_type' => 'multiple',
'options' => array(
    'title'         =>__("Title","filter-plus"),
    'header'        =>__("Header","filter-plus"),
    'description'   =>__("Description","filter-plus")
),
'selected' => $seo_elements,
'disable' => $disable 
);

filter_plus_select_field($args);

$args = array(
'label'=>esc_html__("SEO elements Format:","filter-plus"),
'id' => 'seo_elements_format' , 'data_label' => 'seo-elements-format' , 
'type' => 'random',
'options' => array(
    __("Select Option","filter-plus"),
    __("{title} with [attribute] [values] and [attribute] [values]","filter-plus"),
    __("{title} - [values] / [values]","filter-plus"),
    __("[attribute]:[values];[attribute]:[values] - {title}","filter-plus"),
    __("{title} [attribute]:[values];[attribute]:[values]","filter-plus"),
    __("[attribute 1 values] {title} with [attribute] [values] and [attribute] [values]","filter-plus")
),
'selected' => $seo_elements_format,
'disable' => $disable
);

filter_plus_select_field($args);

$args = array('label'=>esc_html__("Use slug in Url","filter-plus"),
'id' => 'seo_slug_url' , 'data_label' => 'seo-slug-url' ,  'checked'=> $seo_slug_url ,
'checkbox_label' => __('Use Slug in Url instead of ID','filter-plus'),
'disable' => $disable );

filter_plus_checkbox_field($args);
$nice_url_desc = '';
if (class_exists('FilterPlusPro')) {
    $nice_url_desc = __('SEO friendly URL. Wordpress permalink must be set to post name from (Settings=>Permalink)','filter-plus');
}
$args = array('label'=>esc_html__("Nice Url","filter-plus"),
'id' => 'nice_url' , 'data_label' => 'nice-url' ,  'checked'=> $nice_url ,
'checkbox_label' => $nice_url_desc,
'disable' => $disable );

filter_plus_checkbox_field($args);