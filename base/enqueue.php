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
        add_action( 'admin_enqueue_scripts', [$this, 'admin_enqueue_assets'] );
        // frontend asset
        add_action( 'wp_enqueue_scripts', [$this, 'frontend_enqueue_assets'] );
    }
  

    /**
     * all admin js files function
     */
    public function admin_get_scripts() {
        $script_arr =  array(
			'admin-js'     => array(
                'src'     => \FilterPlus::assets_url() . 'js/admin.js',
                'version' => \FilterPlus::get_version(),
                'deps'    => ['jquery','select2'],
            ),
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
            'admin' => array(
                'src'     => \FilterPlus::assets_url() . 'css/admin.css',
                'version' => \FilterPlus::get_version(),
            ),
			'select2' => array(
                'src'     => \FilterPlus::assets_url() . 'css/select2.css',
                'version' => \FilterPlus::get_version(),
            ),
        );
    }

    /**
     * Enqueue admin js and css function
     *
     * @param  $var
     */
    public function admin_enqueue_assets() {
        $screen = get_current_screen();
        $pages  = \FilterPlus\Utils\Helper::admin_pages_id();

        // load js in specific pages

        if ( is_admin() && ( in_array( $screen->id , $pages ) ) ) {

                foreach ( $this->admin_get_scripts() as $key => $value ) {
                    $deps       = !empty( $value['deps'] ) ? $value['deps'] : false;
                    $version    = !empty( $value['version'] ) ? $value['version'] : false;
                    wp_enqueue_script( $key, $value['src'], $deps, $version, true );
                }

                // css

                foreach ( $this->admin_get_styles() as $key => $value ) {
                    $deps       = isset( $value['deps'] ) ? $value['deps'] : false;
                    $version    = !empty( $value['version'] ) ? $value['version'] : false;
                    wp_enqueue_style( $key, $value['src'], $deps, $version, 'all' );
                }

                // localize for admin
                $form_data                          = array();
                $form_data['ajax_url']              = admin_url( 'admin-ajax.php' );
                
                wp_localize_script( 'search-plus-data', 'admin_data', [ $form_data ] );
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
                'deps'      => ['jquery'],
            ),
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
			'search-filter' => array(
                'src'     => \FilterPlus::assets_url() . 'css/search-filter.css',
                'version' => \FilterPlus::get_version(),
            ),
        );

        return $enqueue;
    }

    /**
     * Enqueue admin js and css function
     */
    public function frontend_enqueue_assets() {
        // js
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

        // localize for frontend
        $form_data                        = array();
        $form_data['ajax_url']        = admin_url( 'admin-ajax.php' );

        wp_localize_script( 'filter-js', 'client_data', $form_data  ); 
    }

}


