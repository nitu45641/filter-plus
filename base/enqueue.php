<?php

namespace FilterPlus\Base;

use FilterPlus\Utils\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue all css and js file class
 */
class Enqueue {

    use Singleton;


    /**
     * Main calling function
     */
    public function init() {
        // backend asset
        add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_assets') );
        // frontend asset
        add_action( 'wp_enqueue_scripts', array($this, 'frontend_enqueue_assets') );
    }
  

    /**
     * all admin js files function
     */
    public function admin_get_scripts() {
        $script_arr =  array(
            'filter-plus-select2'  => array(
                'src'     => \FilterPlus::assets_url() . 'js/filter-plus-select2.js',
                'version' => \FilterPlus::get_version(),
                'deps'    => ['jquery'],
            ),
			'filter-plus-admin'     => array(
                'src'     => \FilterPlus::assets_url() . 'js/admin.js',
                'version' => \FilterPlus::get_version(),
                'deps'    => ['jquery','filter-plus-select2'],
            )
		);
        
        return $script_arr;
    }

    /**
     * all admin css files function
     *
     * @param Type $var
     */
    public function admin_get_styles() {
        return array(
            'filter-plus-admin-css' => array(
                'src'     => \FilterPlus::assets_url() . 'css/admin.css',
                'version' => \FilterPlus::get_version(),
            ),
			'select2' => array(
                'src'     => \FilterPlus::assets_url() . 'css/select2.css',
                'version' => \FilterPlus::get_version(),
            )
        );
    }

    /**
     * Enqueue admin js and css function
     *
     * @param  $var
     */
    public function admin_enqueue_assets() {
        $screen = get_current_screen();
        $pages  = \FilterPlus\Utils\Helper::admin_unique_id();

        // load js in specific pages
        if ( is_admin() && ( in_array( $screen->id , $pages ) ) ) {
            wp_enqueue_script( 'wp-color-picker' );

            foreach ( $this->admin_get_scripts() as $key => $value ) {
                $deps       = !empty( $value['deps'] ) ? $value['deps'] : false;
                $version    = !empty( $value['version'] ) ? $value['version'] : false;
                wp_enqueue_script( $key, $value['src'], $deps, $version, true );
            }

            // css
            wp_enqueue_style( 'wp-color-picker' );
            foreach ( $this->admin_get_styles() as $key => $value ) {
                $deps       = isset( $value['deps'] ) ? $value['deps'] : false;
                $version    = !empty( $value['version'] ) ? $value['version'] : false;
                wp_enqueue_style( $key, $value['src'], $deps, $version, 'all' );
            }

            // localize for admin
            $form_data                          = array();
            $form_data['ajax_url']              = admin_url( 'admin-ajax.php' );
            $form_data['filter_plus_nonce']     = wp_create_nonce( 'filter_plus_nonce' );
            wp_localize_script( 'filter-plus-admin', 'filter_admin', $form_data );
        }

    }



    /**
     * all js files function
     */
    public function frontend_get_scripts() {
        $script_arr = array(
			'tmpl-js'     => array(
                'src'     => \FilterPlus::assets_url() . 'js/jquery.tmpl.min.js',
                'version' => \FilterPlus::get_version(),
                'deps'    => ['jquery'],
            ),
			'filter-js'     => array(
                'src'       => \FilterPlus::assets_url() . 'js/search-filter.js',
                'version'   => \FilterPlus::get_version(),
                'deps'      => ['jquery', 'masonry', 'imagesloaded','filter-option','filter-swiper-bundle'],
            ),
            'filter-option'     => array(
                'src'       => \FilterPlus::assets_url() . 'js/filter-option.js',
                'version'   => \FilterPlus::get_version(),
                'deps'      => ['jquery'],
            ),
			'jquery-range-min'     => array(
                'src'     => \FilterPlus::assets_url() . 'js/jquery.range-min.js',
                'version' => \FilterPlus::get_version(),
                'deps'    => ['jquery'],
            ),
            'filter-swiper-bundle'     => array(
                'src'     => \FilterPlus::assets_url() . 'js/filter-swiper-bundle.min.js',
                'version' => \FilterPlus::get_version(),
                'deps'    => ['jquery'],
            )
        );

        return $script_arr;
    }

    /**
     * all css files function
     */
    public function frontend_get_styles() {
        $enqueue =  array(
			'filter-public-free' => array(
                'src'     => \FilterPlus::assets_url() . 'css/public.css',
                'version' => \FilterPlus::get_version(),
            ),
			'jquery.range-min' => array(
                'src'     => \FilterPlus::assets_url() . 'css/jquery.range.css',
                'version' => \FilterPlus::get_version(),
            ),
            'filter-swiper-bundle' => array(
                'src'     => \FilterPlus::assets_url() . 'css/filter-swiper-bundle.min.css',
                'version' => \FilterPlus::get_version(),
            )
        );

        return $enqueue;
    }

    /**
     * Enqueue frontend js and css function
     */
    public function frontend_enqueue_assets() {
        // js
        wp_enqueue_script('masonry');
        wp_enqueue_script('imagesloaded');
        
        $scripts = $this->frontend_get_scripts();

        foreach ( $scripts as $key => $value ) {
            $deps       = isset( $value['deps'] ) ? $value['deps'] : false;
            $version    = !empty( $value['version'] ) ? $value['version'] : false;
            wp_enqueue_script( $key, $value['src'], $deps, $version, true );
        }

        // css
        $styles = $this->frontend_get_styles();

        foreach ( $styles as $key => $value ) {
            $deps = isset( $value['deps'] ) ? $value['deps'] : false;
            $version    = !empty( $value['version'] ) ? $value['version'] : false;
            wp_enqueue_style( $key, $value['src'], $deps, $version, 'all' );
        }

        $settings = \FilterPlus\Utils\Helper::instance()->get_settings();;
        extract($settings);
        // localize for frontend
        $form_data                          = array();
        $form_data['ajax_url']              = admin_url( 'admin-ajax.php' );
        $form_data['localize']              = $this->translate_data();
        $form_data['filter_plus_nonce']     = wp_create_nonce( 'filter_plus_nonce' );
        $form_data['with']                  = esc_html__('with','filter-plus');
        $form_data['and']                   = esc_html__('and','filter-plus');
        $form_data['refresh_url']           = $settings['refresh_url'];
        $form_data['seo_elements']          = $settings['seo_elements'];
        $form_data['seo_elements_format']   = $settings['seo_elements_format'];
        $form_data['seo_slug_url']          = $settings['seo_slug_url'];
        $form_data['is_pro_active']         = class_exists('FilterPlusPro') ? true : false;

        wp_localize_script( 'filter-js', 'filter_client', $form_data  ); 
    }

    /**
     * Localize data
     *
     * @return array
     */
    public function translate_data() {
        $localize = array();
        $localize['price'] = esc_html__( 'Price','filter-plus');
        $localize['rating'] = esc_html__( 'Rating','filter-plus');
        $localize['search'] = esc_html__( 'Search','filter-plus');
        $localize['clear_all'] = esc_html__( 'Clear All','filter-plus');

        return $localize;
    }

}


