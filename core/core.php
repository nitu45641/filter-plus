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

        \FilterPlus\Core\Lib\Banner::instance()->init();
        // Load admin menus
        \FilterPlus\Core\Admin\Menus::instance()->init();
        // Ajax submit
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
          \FilterPlus\Core\Admin\Settings\Action::instance()->init();
        }
      }

      \FilterPlus\Core\Frontend\Shortcodes::instance()->init();

      // Category layout: replace WooCommerce category archive with the filter template (Pro only).
      add_filter( 'template_include', array( $this, 'category_page_template' ), 99 );

      //register gutenberg blocks.
      if ( file_exists( \FilterPlus::plugin_dir() . 'core/widgets/gutenburg-block/init.php' ) ) {
      	include_once \FilterPlus::plugin_dir() . 'core/widgets/gutenburg-block/init.php';
      }
      // Discountify Compatibility Added
      \FilterPlus\Core\Compatibility\Hooks::instance()->init();

      // load elementor
      add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'element_js' ) );
      Elementor_Manifest::instance()->init();
    }

    /**
     * Override the WooCommerce category archive template with the filter template.
     */
    public function category_page_template( $template ) {
        if ( ! function_exists( 'is_product_category' ) || ! is_product_category() ) {
            return $template;
        }
        if ( ! class_exists( 'FilterPlusPro' ) ) {
            return $template;
        }
        $settings = get_option( 'filter_plus_category_settings', array() );
        if ( empty( $settings['enable_category_layout'] ) || $settings['enable_category_layout'] !== 'yes' ) {
            return $template;
        }
        $custom = \FilterPlus::plugin_dir() . 'templates/woo-filter/category-layout.php';
        return file_exists( $custom ) ? $custom : $template;
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

