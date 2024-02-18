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
			'filter_products' 	=> 'filter_plus',
			'wp_filter_plus' 	=> 'wp_filter_plus',
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
	 */
	public function filter_plus( $atts ) {
		if ( ! class_exists( 'Woocommerce' ) ) {return;}
		// shortcode option
		$atts = extract(
			shortcode_atts(
				array(
					'template'         	=> '1',
					'categories'       	=> '',
					'colors'           	=> 'yes',
					'size'             	=> 'yes',
					'tags'             	=> '',
					'attributes'       	=> '',
					'show_tags'        	=> '',
					'show_attributes'  	=> '',
					'show_reviews'     	=> '',
					'show_price_range' 	=> '',
					'on_sale' 			=> '',
					'stock' 			=> '',
					'product_categories'=> '',
					'product_tags'      => '',
					'sorting'          	=> 'yes',
				), $atts )
		);

		ob_start();
		$is_pro_active = $this->pro_template_check($template);
		if ($is_pro_active !== '' ) {
			echo $is_pro_active;
			return ob_get_clean();
		} 
		
		$this->custom_css($template);

		?>
			<div class="shopContainer shop-container-<?php echo esc_attr($template)?>"
			id="shopContainer"
			data-filter_type='product' 
			data-template="<?php echo esc_attr($template)?>"
			data-product_categories="<?php echo esc_attr($product_categories)?>"
			data-product_tags="<?php echo esc_attr($product_tags)?>"
			>
			<?php 
				$style = $template;
				$template = $this->select_template($template);
				if ( file_exists( \FilterPlus::plugin_dir() . "templates/woo-filter/template-" . $template . "/template-" . $template . ".php" ) ) {
					include_once \FilterPlus::plugin_dir() . "templates/woo-filter/template-" . $template . "/template-" . $template . ".php";
				}
				else if ( file_exists( \FilterPlusPro::plugin_dir() . "templates/woo-filter/template-" . $template . "/template-" . $template . ".php" ) ) {
					include_once \FilterPlusPro::plugin_dir() . "templates/woo-filter/template-" . $template . "/template-" . $template . ".php";
				}

			?>
			</div>
		<?php
		

		return ob_get_clean();
	}

	/**
	 * Select Template
	 *
	 */
	public function select_template($template) {
		if ($template == 4) {
			$template = 2;
		}
		
		return $template;
	}



	public function wp_filter_plus( $atts ) {
		ob_start();
		$is_pro_active = $this->is_pro_active();
		if ($is_pro_active !== '' ) {
			echo $is_pro_active;
			return ob_get_clean();
		} 

		apply_filters('filter_pro_pro/wp_filter',$atts);
		
		return ob_get_clean();
	}

	/**
	 * Check pro template
	 *
	 * @param [type] $template
	 */
	public function pro_template_check($template) {
		$pro_template 	= [2,3];
		$html 			= '';
		if ( in_array((int)$template,$pro_template) && !class_exists('FilterPlusPro') ) {
			$html = '<div class="row"><div class="woocommerce-error">'.esc_html__('Please Active FilterPlus Pro','filter-plus').'</div></div>';
		}

		return $html;
	}

	/**
	 * Check filter pro 
	 *
	 * @param [type] $template
	 */
	public function is_pro_active() {
		$html 			= '';
		if ( !class_exists('FilterPlusPro') ) {
			$html = '<div class="row"><div class="woocommerce-error">'.esc_html__('Please Active FilterPlus Pro','filter-plus').'</div></div>';
		}

		return $html;
	}

	/**
	 * Custom css
	 *
	 * @param string $template
	 * @return void
	 */
	public function custom_css($template = "1", $filter_type = "product") {
		global $custom_css;
		if ( $template == "2" ) {
			$cart_icon =  '#fff'; 
			$secondary_color = $primary_color = '#17c6aa'; 
			$price_range = '#2d0607'; 
			$cart_content = '#080808'; 
			$tag_color = '#ff1f25';
		}
		else if ( $template == "3" ) {
			$secondary_color = $filter_type !== "product" ? "#fff" : "#ab1616"; 
			$blog_header = $filter_type !== "product" ? "#ff0000" : "#000"; 
			$cart_icon = $primary_color = $price_range = '#ab1616'; 
		}
		else if ( $template == "4" ) {
			$primary_color = $price_range = $cart_content = '#ff69b4'; 
			$secondary_color = $tag_color = '#ff69b4'; 
			$cart_icon = '#fff'; 
			$blog_header = $filter_type !== "product" ? "#ff0000" : "#000"; 
		}

		$custom_css = '
		:root {
			--filter-cart-icon-color : '.$cart_icon.';
			--filter-cart-content: '.$cart_content.';
			--filter-price-range : '.$price_range.';
			--filter-secondary-color : '.$secondary_color.';
			--filter-price-range: '.$primary_color.';
			--filter-border-color: '.$primary_color.';
			--filter-header-border: '.$primary_color.';
			--filter-tab-color: '.$secondary_color.';
			--filter-blog-header: '.$blog_header.';
			--filter-tag-color: '.$tag_color.';
		}';

		wp_register_style( 'filter-plus-custom-css', false );
		wp_enqueue_style( 'filter-plus-custom-css' );
		wp_add_inline_style('filter-plus-custom-css',$custom_css);
	}
}
