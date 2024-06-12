<h1 class="font_bold font_20"><?php esc_html_e('Style','filter-plus'); ?></h1>

<?php
$doc_url 	= '<a target="_blank" href="https://docs.woooplugin.com/docs/filter-plus/settings/change-color/"> ['.__( "Documentation Link", "filter-plus" ).'] </a>';
$docs 		= '<div class="documentation mb-1"><i class="doc">'.esc_html__('Set Color for Templates','filter-plus') . $doc_url . '</i></div>';
echo FilterPlus\Utils\Helper::kses( $docs );


$args = array('label'=>esc_html__("Primary Color:","filter-plus"),
'id' => 'primary_color' , 'field_type'=>'color', 'data_label' => 'primary_color' ,  'value'=> $primary_color
);
filter_plus_number_input_field($args);

$args = array('label'=>esc_html__("Secondary Color:","filter-plus"),
'id' => 'secondary_color' , 'field_type'=>'color', 'data_label' => 'secondary_color' ,  'value'=> $secondary_color );
filter_plus_number_input_field($args);
?>
<h1 class="font_bold font_20"><?php esc_html_e('WooCommerce Product Filter Control','filter-plus'); ?></h1>
<?php
$doc_url 	= '<a target="_blank" href="https://docs.woooplugin.com/docs/filter-plus/woocommerce-filter/add-filter-by-price-range/"> ['.__( "Documentation Link", "filter-plus" ).'] </a>';
$docs 		= '<div class="documentation mb-1"><i class="doc">'.esc_html__('WooCommerce Product Filter Default Control','filter-plus') . $doc_url . '</i></div>';
echo FilterPlus\Utils\Helper::kses( $docs );

$args = array('label'=>esc_html__("Minimum Price Range:","filter-plus"),
'id' => 'min_price_range' , 'field_type'=>'number', 'data_label' => 'min_price_range' ,  'value'=> $min_price_range ,
'disable' => $disable );
filter_plus_number_input_field($args);

$args = array('label'=>esc_html__("Maximum Price Range:","filter-plus"),
'id' => 'max_price_range' , 'field_type'=>'number', 'data_label' => 'max_price_range' ,  'value'=> $max_price_range ,
'disable' => $disable );
filter_plus_number_input_field($args);


