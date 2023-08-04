<?php

namespace FilterPlus;

Class Bootstrap{

	private static $instance;

	
	/**
	 * __construct function
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Load autoload method.
		Autoloader::run();
		
		// Core files
		\FilterPlus\Core\Core::instance()->init();
		// Enqueue Assets
		\FilterPlus\Base\Enqueue::instance()->init();

		// Ajax submit
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			\FilterPlus\Core\Frontend\SearchFilter\Actions::instance()->init();
		}
				
	}

		/**
	 * Singleton Instance
	 *
	 * @return Bootstrap
	 */
	public static function instance() {

		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}