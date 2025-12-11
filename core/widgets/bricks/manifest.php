<?php

namespace FilterPlus\Core\Widgets\Bricks;

use FilterPlus\Utils\Singleton;

/**
 * Base Class
 *
 * @since 1.0.0
 */
class Manifest {

    use Singleton;

    /**
     * Initialize all modules.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function init() {
        add_action( 'init', function() {
            $element_files = array(
                \FilterPlus::plugin_dir() . 'core/widgets/bricks/components/woo-filter.php',
                \FilterPlus::plugin_dir() . 'core/widgets/bricks/components/wp-filter.php',
            );
        
            foreach ( $element_files as $file ) {
                \Bricks\Elements::register_element( $file );
            }
        }, 11 );
    }
}