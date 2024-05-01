<?php
/**
 * Plugin Name:       Filter Plus
 * Plugin URI:        https://woooplugin.com/filter-plus
 * Description:       Advanced Product Filter plugin that enable filter anything features like filter by by Ratings, Tags, Price Range on website. It allows users to filter anything based on different taxonomies.
 * Version:           1.0.50
 * Requires at least: 5.2
 * Requires PHP:      7.3
 * Author:            Woooplugin
 * Author URI:        https://woooplugin.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       filter-plus
 * Domain Path:       /languages
 * @package Filter Plus
 * @category Core
 * @author Filter Plus
 * @version 1.0.0
 */

use FilterPlus\Utils\Helper;

 // Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * The Main Plugin Requirements Checker
 *
 * @since 1.0.0
 */
final class FilterPlus {

	private static $instance;

	/**
     * Current  Version
     *
     * @return string
     */
    public static function get_version() {
        return '1.0.50';
    }

	/**
     * Singleton Instance
     *
     * @return Filter Plus
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

	/**
     * Setup Plugin Requirements
     *
     * @since 1.0.0
     */
    private function __construct() {
        // Load modules
		add_action( 'plugins_loaded', array( $this, 'initialize_modules' ) , 999 );
    }
	
	/**
	 * Initialize Modules
	 *
	 * @since 1.1.0
	 */
	public function initialize_modules() {
		do_action( 'filter-plus/before_load' );
		$this->load_text_domain();
		require_once plugin_dir_path( __FILE__ ) . 'autoloader.php';
		require_once plugin_dir_path( __FILE__ ) . 'wrapper.php';

		// Load Plugin modules and classes
		\FilterPlus\Wrapper::instance();

		do_action( 'filter-plus/after_load' );
	}

	/**
     * Load Localization Files
     *
     * @since 1.0.0
     * @return void
     */
	public function load_text_domain() {
		load_plugin_textdomain( 'filter-plus', false, self::plugin_dir() . 'languages/' );
    }

	/**
	 * Assets Directory Url
	 *
	 * @return void
	 */
	public static function assets_url() {
		return trailingslashit( self::plugin_url() . 'assets' );
	}

	/**
	 * Build Directory Url
	 *
	 * @return void
	 */
	public static function build_url() {
		return trailingslashit( self::plugin_url() . 'build' );
	}

	/**
	 * Assets Folder Directory Path
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function assets_dir() {
		return trailingslashit( self::plugin_dir() . 'assets' );
	}

	/**
	 * Plugin Core File Directory Url
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function core_url() {
		return trailingslashit( self::plugin_url() . 'core' );
	}

	/**
	 * Plugin Core File Directory Path
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function core_dir() {
		return trailingslashit( self::plugin_dir() . 'core' );
	}

	/**
	 * Plugin Url
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function plugin_url() {
		return trailingslashit( plugin_dir_url( self::plugin_file() ) );
	}

	/**
	 * Plugin Directory Path
	*
	* @since 1.0.0
	*
	* @return void
	*/
	public static function plugin_dir() {
		return trailingslashit( plugin_dir_path( self::plugin_file() ) );
	}

	/**
	 * Plugins Basename
	 *
	 * @since 1.0.0
	 */
	public static function plugins_basename(){
		return plugin_basename( self::plugin_file() );
	}

	/**
	 * Plugin File
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function plugin_file(){
		return __FILE__;
	}


}

// Initiate Plugin
FilterPlus::get_instance();

