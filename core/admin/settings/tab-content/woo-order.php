<h1 class="font_bold font_18"><?php esc_html_e("Woo Admin Order Filter","filter-plus"); ?></h1>

<?php
$doc_url 	= '<a target="_blank" href="https://docs.woooplugin.com/docs/filter-plus/woocommerce-admin-order-filter/filter-woo-order/"> ['.__( "Documentation Link", "filter-plus" ).'] </a>';
$docs 		= '<div class="documentation mb-1"><i class="doc">'.esc_html__('Filter Admin Order','filter-plus') . $doc_url . '</i></div>';
echo FilterPlus\Utils\Helper::kses( $docs );
// Woo order filter By Products
$args = array('label'=>esc_html__("Woo Order Filter By Products:","filter-plus"),
'id' => 'woo_order_filter_product' , 'data_label' => 'woo-order-filter-pro' ,  'checked'=> $woo_order_filter_product ,
'disable' => $disable );
filter_plus_checkbox_field($args);

// Woo order filter By Status
$args = array('label'=>esc_html__("Woo Order Filter By Status:","filter-plus"),
'id' => 'woo_order_filter_status' , 'data_label' => 'woo-order-filter-status' ,  'checked'=> $woo_order_filter_status ,
'disable' => $disable );
filter_plus_checkbox_field($args);