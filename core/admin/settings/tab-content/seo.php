<?php

// SEO global settings
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
        __("[attribute]:[values];[attribute]:[values] - {title}","filter-plus")
    ),
    'disable' => $disable 
    );
    
    filter_plus_select_field($args);