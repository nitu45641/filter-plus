<?php

namespace FilterPlus\Core;

use FilterPlus\Utils\Singleton;

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
      } 

      \FilterPlus\Core\Frontend\Shortcodes::instance()->init();

      //register gutenberg blocks.
      if ( file_exists( \FilterPlus::plugin_dir() . 'core/gutenburg-block/init.php' ) ) {
      	include_once \FilterPlus::plugin_dir() . 'core/gutenburg-block/init.php';
      }

    }

}
