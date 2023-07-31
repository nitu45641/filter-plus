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
		// Load admin menus
		\FilterPlus\Core\Admin\Menus::instance()->init();
		
		// Load frontend shortcodes
		\FilterPlus\Core\Frontend\Shortcodes::instance()->init();
    }
}
