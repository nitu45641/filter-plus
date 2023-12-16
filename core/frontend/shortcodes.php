<?php

namespace FilterPlus\Core\Frontend;

use FilterPlus\Utils\Singleton;

/**
 * Base Class
 *
 * @since 1.0.0
 */
class Shortcodes {

	use Singleton;

	/**
	 * Initialize all modules.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function init() {
		// [filter_products categories='']
		$shortcode_arr = array(
			'filter_products' => 'filter_plus',
		);

		// add shortcode
		if ( ! empty( $shortcode_arr ) ) {
			foreach ( $shortcode_arr as $key => $value ) {
				add_shortcode( $key, [$this, $value] );
			}
		}
	}

	/**
	 * Filter products
	 *
	 * @param [type] $atts
	 * @return void
	 */
	public function filter_plus( $atts ) {
		if ( ! class_exists( 'Woocommerce' ) ) {return;}
		// shortcode option
		$atts = extract(
			shortcode_atts(
				array(
					'template'         => '1',
					'categories'       => '',
					'colors'           => 'yes',
					'size'             => 'yes',
					'tags'             => '',
					'attributes'       => '',
					'show_tags'        => '',
					'show_attributes'  => '',
					'show_reviews'     => '',
					'show_price_range' => '',
					'product_categories' => '',
					'product_tags'       => '',
					'sorting'          => 'no',
				), $atts )
		);

		ob_start();
		$this->custom_css($template);

		if ( file_exists( \FilterPlus::plugin_dir() . "templates/search-filter/template-" . $template . "/template-" . $template . ".php" ) ) {
		?>
			<div class="shopContainer" 
			data-template="<?php echo esc_attr($template)?>"
			data-product_categories="<?php echo esc_attr($product_categories)?>"
			data-product_tags="<?php echo esc_attr($product_tags)?>"
			>
				<?php include_once \FilterPlus::plugin_dir() . "templates/search-filter/template-" . $template . "/template-" . $template . ".php";?>
			</div>
		<?php
		}

		return ob_get_clean();
	}

	/**
	 * Custom css
	 *
	 * @param string $template
	 * @return void
	 */
	public function custom_css($template = "1") {
		global $custom_css;
		if ( $template == "2" ) {
			$custom_css = '
			:root {
				--secondary-color: #17c6aa;
			}
			';
		}
		wp_register_style( 'filter-plus-custom-css', false );
		wp_enqueue_style( 'filter-plus-custom-css' );
		wp_add_inline_style('filter-plus-custom-css',$custom_css);
	}
}
