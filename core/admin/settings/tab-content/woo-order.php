<h1 class="font_bold font_18"><?php esc_html_e("Woo Admin Order Filter","filter-plus"); ?></h1>

<?php
$filterplus_doc_url 	= '<a target="_blank" href="https://wpbens.com/docs/filter-plus/woocommerce/order-filter/"> [' . esc_html__( 'Documentation Link', 'filter-plus' ) . '] </a>';
$filterplus_docs 		= '<div class="documentation mb-1"><i class="doc">' . esc_html__( 'Filter Admin Order', 'filter-plus' ) . $filterplus_doc_url . '</i></div>';
echo wp_kses_post( $filterplus_docs );
// Woo order filter By Products
$filterplus_args = array('label'=>esc_html__("Woo Order Filter By Products:","filter-plus"),
'id' => 'woo_order_filter_product' , 'data_label' => 'woo-order-filter-pro' ,  'checked'=> $woo_order_filter_product ,
'disable' => $filterplus_disable );
filterplus_checkbox_field($filterplus_args);

// Woo order filter By Status
$filterplus_args = array('label'=>esc_html__("Woo Order Filter By Status:","filter-plus"),
'id' => 'woo_order_filter_status' , 'data_label' => 'woo-order-filter-status' ,  'checked'=> $woo_order_filter_status ,
'disable' => $filterplus_disable );
filterplus_checkbox_field($filterplus_args);