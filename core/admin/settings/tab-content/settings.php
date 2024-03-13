<h1 class="font_bold font_20 mb-1"><?php esc_html_e("Style","filter-plus"); ?></h1>

<?php
$doc_url 	= '<a target="_blank" href="https://docs.woooplugin.com/docs/filter-plus/settings/change-color/"> ['.__( "Documentation Link", "filter-plus" ).'] </a>';
$docs 		= '<div class="documentation mb-1"><i class="doc">'.esc_html__('Set Color for Templates','filter-plus') . $doc_url . '</i></div>';
echo FilterPlus\Utils\Helper::kses( $docs );


$args = array('label'=>esc_html__("Primary Color:","filter-plus"),
'id' => 'primary_color' , 'field_type'=>'color', 'data_label' => 'primary_color' ,  'value'=> $primary_color ,
'disable' => $disable );
filter_plus_number_input_field($args);

$args = array('label'=>esc_html__("Secondary Color:","filter-plus"),
'id' => 'secondary_color' , 'field_type'=>'color', 'data_label' => 'secondary_color' ,  'value'=> $secondary_color ,
'disable' => $disable );
filter_plus_number_input_field($args);

