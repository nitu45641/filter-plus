<?php

namespace FilterPlus\Core\Compatibility;

use FilterPlus\Utils\Singleton;

/**
 * Base Class
 *
 * @since 1.0.0
 */
class Hooks {
    use Singleton;
    public function init() {
        if (!class_exists('Discountify')) {
            return;
        }

        $obj = \Discountify\Core\Frontend\Frontend::instance();
        add_filter( 'woocommerce_get_price_suffix', array( $obj, 'custom_dynamic_sale_price_html' ), 20, 4 );
    }
}