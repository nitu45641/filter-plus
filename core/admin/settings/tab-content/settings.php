<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<h1 class="font_bold font_18"><?php esc_html_e('Style','filter-plus'); ?></h1>

<?php
$filterplus_doc_url 	= '<a target="_blank" href="https://docs.woooplugin.com/docs/filter-plus/settings/change-color/"> [' . esc_html__( 'Documentation Link', 'filter-plus' ) . '] </a>';
$filterplus_docs 		= '<div class="documentation mb-1"><i class="doc">' . esc_html__( 'Set Color for Templates', 'filter-plus' ) . $filterplus_doc_url . '</i></div>';
echo wp_kses_post( $filterplus_docs );


$filterplus_args = array('label'=>esc_html__("Primary Color:","filter-plus"),
'id' => 'primary_color' , 'field_type'=>'color', 'data_label' => 'primary_color' ,  'value'=> $primary_color
);
filterplus_number_input_field($filterplus_args);

$filterplus_args = array('label'=>esc_html__("Secondary Color:","filter-plus"),
'id' => 'secondary_color' , 'field_type'=>'color', 'data_label' => 'secondary_color' ,  'value'=> $secondary_color );
filterplus_number_input_field($filterplus_args);
?>
<h1 class="font_bold font_18"><?php esc_html_e('WooCommerce Product Filter Control','filter-plus'); ?></h1>
<?php
$filterplus_doc_url 	= '<a target="_blank" href="https://wpbens.com/docs/filter-plus/woocommerce/filter-by-price/"> [' . esc_html__( 'Documentation Link', 'filter-plus' ) . '] </a>';
$filterplus_docs 		= '<div class="documentation mb-1"><i class="doc">' . esc_html__( 'WooCommerce Product Filter Default Control', 'filter-plus' ) . $filterplus_doc_url . '</i></div>';
echo wp_kses_post( $filterplus_docs );

$filterplus_args = array('label'=>esc_html__("Minimum Price Range:","filter-plus"),
'id' => 'min_price_range' , 'field_type'=>'number', 'data_label' => 'min_price_range' ,  'value'=> $min_price_range ,
'disable' => $filterplus_disable );
filterplus_number_input_field($filterplus_args);

$filterplus_args = array('label'=>esc_html__("Maximum Price Range:","filter-plus"),
'id' => 'max_price_range' , 'field_type'=>'number', 'data_label' => 'max_price_range' ,  'value'=> $max_price_range ,
'disable' => $filterplus_disable );
filterplus_number_input_field($filterplus_args);


