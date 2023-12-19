<?php
// Woo order filter By Products
$args = array('label'=>esc_html__("Woo Order Filter By Products:","filter-plus"),
'id' => 'woo_order_filter' , 'data_label' => 'woo-order-filter' , 'disable' => 'disable' );
filter_plus_checkbox_field($args);