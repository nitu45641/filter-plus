<?php

/**
 * Plugin Name:       Filter Plus – WordPress & WooCommerce AJAX Filter Plugin
 * Plugin URI:        https://wpbens.com/filter-plus/
 * Description:       Advanced Product Filter plugin that enable filter anything features like filter by by Ratings, Tags, Price Range on website. It allows users to filter anything based on different taxonomies.
 * Version:           1.1.46
 * Requires at least: 5.8
 * Requires PHP:      7.4
 * Author:            Wpbens
 * Author URI:        https://wpbens.com/
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

// Another copy of Filter Plus is already loaded (e.g. duplicate plugin folder). Bail to avoid a fatal redeclare.
// Uses a constant, not class_exists(): the top-level class below is declared at compile time,
// so class_exists( 'FilterPlus' ) is already true on the first (only) load and would skip booting.
if ( defined( 'FILTERPLUS_BOOTSTRAP_FILE' ) ) {
	return;
}
define( 'FILTERPLUS_BOOTSTRAP_FILE', __FILE__ );

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
    	if( ! function_exists('get_plugin_data') ){
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		$plugin_data = get_plugin_data( __FILE__, false, false  );
		
		return !empty($plugin_data['Version']) ? $plugin_data['Version'] : '';
    }

	/**
     * Cache-busting version for an asset file.
     *
     * Uses the file's own last-modified time instead of the plugin
     * version, so an updated JS/CSS file is picked up by the browser
     * as soon as it's uploaded — no plugin version bump required.
     *
     * @param string $relative_path Path relative to the assets/ folder, e.g. 'js/search-filter.js'.
     * @return string
     */
    public static function asset_version( $relative_path ) {
    	$file = self::assets_dir() . ltrim( $relative_path, '/' );

    	if ( ! file_exists( $file ) ) {
    		return self::get_version();
    	}
    	// Timestamp + content hash: the URL changes whenever the file content changes,
    	// even if a zip upload keeps old file timestamps (busts browser/CDN caches).
    	static $versions = array();
    	if ( ! isset( $versions[ $file ] ) ) {
    		$versions[ $file ] = filemtime( $file ) . '-' . substr( md5_file( $file ), 0, 8 );
    	}
    	return $versions[ $file ];
    }

	/**
     * Singleton Instance
     *
     * @return FilterPlus
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
		do_action( 'filter-plus/before_load' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
		require_once plugin_dir_path( __FILE__ ) . 'autoloader.php';
		require_once plugin_dir_path( __FILE__ ) . 'wrapper.php';

		// Load Plugin modules and classes
		\FilterPlus\Wrapper::instance();

		do_action( 'filter-plus/after_load' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
	}

	/**
	 * Assets Directory Url
	 */
	public static function assets_url() {
		return trailingslashit( self::plugin_url() . 'assets' );
	}

	/**
	 * Build Directory Url
	 *
	 */
	public static function build_url() {
		return trailingslashit( self::plugin_url() . 'build' );
	}

	/**
	 * Assets Folder Directory Path
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function assets_dir() {
		return trailingslashit( self::plugin_dir() . 'assets' );
	}

	/**
	 * Assets Folder Directory Path
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function base_dir() {
		return trailingslashit( self::plugin_dir() . 'base' );
	}

	/**
	 * Template Folder Directory Path
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function template_dir() {
		return trailingslashit( self::plugin_dir() . 'templates' );
	}

	/**
	 * Locate a template file: child theme → parent theme → plugin fallback.
	 *
	 * @param string $relative_path  Path relative to the plugin's templates/ dir.
	 * @return string  Absolute path to the resolved file.
	 */
	public static function locate_template( string $relative_path ): string {
		$child  = get_stylesheet_directory() . '/filter-plus/templates/' . $relative_path;
		$parent = get_template_directory()   . '/filter-plus/templates/' . $relative_path;
		if ( file_exists( $child ) )  { return $child; }
		if ( file_exists( $parent ) ) { return $parent; }
		return self::plugin_dir() . 'templates/' . $relative_path;
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

