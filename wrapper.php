<?php

namespace FilterPlus;

use FilterPlus;

Class Wrapper {

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
	 * @return array
	 */
	public function add_action_links( $actions ) {
		$this->custom_css();
		$actions[] = '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=filter_plus') ) .'">'.
		esc_html__('Settings','filter-plus').'</a>';
		if ( !class_exists('FilterPlusPro') ) {
			$actions[] = '<a href="https://wpbens.com/filter-plus/" class="filter-go-pro" target="_blank">'.esc_html__('Go To Premium','filter-plus').'</a>';
		}

		return $actions;
	}
	
	/**
	 * Custom css
	 *
	 * @param string $template
	 * @return void
	 */
	public function custom_css() {
		$custom_css = '
			.filter-go-pro {
				color: #086808;
				font-weight: bold;
			}
		';

		wp_register_style( 'filter-go-pro', false );
		wp_enqueue_style( 'filter-go-pro' );
		wp_add_inline_style( 'filter-go-pro', $custom_css );
	}

	/**
	 * Singleton Instance
	 *
	 * @return Wrapper
	 */
	public static function instance() {

		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}