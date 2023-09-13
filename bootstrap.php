<?php

namespace FilterPlus;

use FilterPlus;

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

		//pro & others menu
		add_filter( 'plugin_action_links_'.FilterPlus::plugins_basename(), array( $this , 'add_action_links' ) );

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
	 * Add required links
	 *
	 * @param [type] $actions
	 * @return void
	 */
	public function add_action_links( $actions ) {
		$actions[] = '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=filter_plus') ) .'">'.
		esc_html__('Settings','filter-plus').'</a>';
		if ( !class_exists('FilterPlusPro') ) {
			$actions[] = '<a href="https://woooplugin.com/filter-plus/" target="_blank">'.esc_html__('Go To Premium','filter-plus').'</a>';
		}

		return $actions;
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
	
	/**
	 * Plugin start menus
	 *
	 * @return void
	 */
	public function initial_menus() {
		
	}
}