<?php

namespace FilterPlus\Core\Widgets\Elementor;

defined( "ABSPATH" ) || exit;

use FilterPlus\Utils\Helper as Helper;

Class Manifest {

    use \FilterPlus\Utils\Singleton;

    private $categories = ['plus' => 'FilterPlus'];

    public function init() {
        add_action( 'elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories'] );
        add_action( 'elementor/widgets/register', [$this, 'register_widgets'] );
    }

    public function get_input_widgets() {
        return array(
            'woo-filter',
            'wp-filter'
        );
    }

    public function includes() {

    }

    /**
     * Register all elementor widgets dynamically
     */
    public function register_widgets() {

        foreach ( $this->get_input_widgets() as $v ):
          $files = plugin_dir_path( __FILE__ ) . $v . '/' . $v . '.php';
          if ( file_exists( $files ) ) {
                require_once $files;
				$class_name = 'FilterPlus\\Core\\Widgets\\Elementor\\' . Helper::make_classname( $v );
                \Elementor\Plugin::instance()->widgets_manager->register( new $class_name() );
            }

        endforeach;
    }
    
    /**
     * Register all elementor widgets categories dynamically
     */
	public function add_elementor_widget_categories( $elements_manager ) {
        foreach ( $this->categories as $k => $v ) {
            $elements_manager->add_category(
                'filter-' . $k,
                [
                    'title' => esc_html( $v ),
                    'icon'  => 'fa fa-plug',
                ]
            );
        }

    }

}
