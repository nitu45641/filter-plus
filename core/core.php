<?php

namespace FilterPlus\Core;

use FilterPlus\Utils\Singleton;
use FilterPlus\Core\Widgets\Elementor\Manifest as Elementor_Manifest;

/**
 * Base Class
 *
 * @since 1.0.0
 */
class Core {

    use Singleton;

    /**
     * Initialize all modules.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function init() {
      if ( is_admin() ) {
        // Load admin menus
        \FilterPlus\Core\Admin\Menus::instance()->init();
        // Ajax submit
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
          \FilterPlus\Core\Admin\Settings\Action::instance()->init();
        }
      }

      \FilterPlus\Core\Frontend\Shortcodes::instance()->init();

      //register gutenberg blocks.
      if ( file_exists( \FilterPlus::plugin_dir() . 'core/gutenburg-block/init.php' ) ) {
      	include_once \FilterPlus::plugin_dir() . 'core/gutenburg-block/init.php';
      }

      // load elementor
      add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'element_js' ) );
      Elementor_Manifest::instance()->init();
    }

    public function element_js() {
      
    }

    /**
	 * Enqueue Elementor Assets
	 *
	 * @return void
	 */
	public function elementor_js() {
		wp_enqueue_script( 'etn-elementor-inputs', \FilterPlus::assets_url() . 'js/elementor.js', array( 'elementor-frontend' ), \Wpeventin::version(), true );
	}

}
