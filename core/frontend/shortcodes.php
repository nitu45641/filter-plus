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
					'category_label'    => esc_html__('Categories','filter-plus'),
					'categories'       	=> '',
					'sub_categories'	=> 'no',
					'colors'           	=> 'yes',
					'color_label'       => esc_html__('Colors','filter-plus'),
					'size'             	=> 'yes',
					'size_label'        => esc_html__('Size','filter-plus'),
					'tags'             	=> '',
					'tag_label'        	=> esc_html__('Tags','filter-plus'),
					'attributes'       	=> '',
					'attribute_label'   => esc_html__('Attributes','filter-plus'),
					'show_tags'        	=> '',
					'show_attributes'  	=> '',
					'review_label'   	=> esc_html__('Review','filter-plus'),
					'show_reviews'     	=> '',
					'show_price_range' 	=> '',
					'price_range_label' => esc_html__('Price Range','filter-plus'),
					'on_sale' 			=> '',
					'on_sale_label' 	=> esc_html__('Sale','filter-plus'),
					'stock' 			=> '',
					'stock_label' 		=> esc_html__('Stock','filter-plus'),
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



	public function wp_filter_plus( $short_atts ) {
		ob_start();

		$atts = 
			shortcode_atts(
				array(
					'filter_type'       => 'post',
					'custom_post'       => '',
					'template'         	=> '1',
					'show_categories'   => 'yes',
					'category_label'    => esc_html__('Categories','filter-plus-pro'),
					'categories'       	=> '',
					'sub_categories'	=> 'no',
					'show_tags'        	=> '',
					'tag_label'        	=> esc_html__('Tags','filter-plus-pro'),
					'tags'             	=> '',
					'author'            => '',
					'author_label'      => esc_html__('Authors','filter-plus-pro'),
					'author_list'       => '',
					'post_categories'	=> 'yes',
					'post_tags'      	=> 'yes',
					'post_author'      	=> 'yes',
					'custom_field_label' 	=> esc_html__('Custom Field','filter-plus-pro'),
					'custom_field'      	=> 'no',
					'meta_condition'     	=> 'OR',
					'custom_field_list'     => ''
				), $short_atts );
		extract($atts);		
		
		$filtering_type = $filter_type == 'post' ? 'post' : $custom_post;
		$main_wrapper   = $template == '3' ? 'mainWrapper' : 'shopContainer';
		$this->custom_css($template,$filter_type);
		?>
			<div class="<?php echo esc_attr($main_wrapper);?>" id="shopContainer"
				data-filter_type='<?php echo esc_attr($filtering_type)?>'
				data-template="<?php echo esc_attr($template)?>"
				data-product_categories="<?php echo esc_attr($post_categories)?>"
				data-product_tags="<?php echo esc_attr($post_tags)?>"
				data-post_author="<?php echo esc_attr($post_author)?>"
			>
				<?php $this->wp_filter_file($template,$atts);?>
			</div>
		<?php
				
		return ob_get_clean();
	}

	public function wp_filter_file($template,$atts) {
		extract($atts);
		if ( '1' == $template ) {
			include_once \FilterPlus::template_dir() . 'wp-filter/template-' . $template .'/template-' . $template . '.php';
		}else{
			$is_pro_active = $this->is_pro_active();
			if ($is_pro_active !== '' ) {
				echo $is_pro_active;
				return ob_get_clean();
			}
			if ( file_exists(\FilterPlusPro::plugin_dir() . "templates/wp-filter/template-".$template."/template-" . $template . ".php") ) {
				include_once \FilterPlusPro::plugin_dir() . "templates/wp-filter/template-".$template."/template-" . $template . ".php";
			}
		}
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
		$secondary_color = '#1164cb'; $primary_color ='#2d73e7';$tag_color ='';
		$blog_header = "#000"; $cart_icon =  '#fff'; 
		$cart_content = '#2d73e7';$price_range = '#2d73e7';
		$param_direction = 'row';
		$tab_pan_item_color = '#fff';$loading_icon_position = 'relative';

		if ( $template == "1" ) {
			$loading_icon_position = 'absolute';
		}
		else if ( $template == "2" ) {
			$cart_icon =  '#fff'; 
			$secondary_color = $primary_color = '#17c6aa'; 
			$price_range = '#2d0607'; 
			$cart_content = '#080808'; 
			$tag_color = '#ff1f25';
		}
		else if ( $template == "3" ) {
			$secondary_color = $filter_type !== "product" ? "#fff" : "#ab1616"; 
			$filter_type !== "product" ? "#ff0000" : "#ab1616"; 
			$blog_header 	 = $filter_type !== "product" ? "#ff0000" : "#000"; 
			$cart_icon 		 = $primary_color = $price_range = '#ab1616'; 
		}
		else if ( $template == "4" ) {
			$primary_color = $price_range = $cart_content = '#ff69b4'; 
			$secondary_color = $tag_color = '#ff69b4'; 
			$cart_icon = '#fff'; 
			$blog_header = $filter_type !== "product" ? "#ff0000" : "#000"; 
		}
		else if( $template == "5" ){
			$secondary_color = '#ab1616';
		}

		$settings = \FilterPlus\Utils\Helper::instance()->get_settings();
		
        if ( ($settings['secondary_color'] !== '#ffffff') || ($settings['primary_color'] !== '#ffffff')  ) {
			$secondary_color = $settings['secondary_color'];
			$primary_color   = $settings['primary_color'];
		}

		$loader_color =  $secondary_color == "#fff" ? $primary_color : $secondary_color;

		$custom_css = '
		:root {
			--filter-primary-color: '.$primary_color.';
			--filter-secondary-color : '.$secondary_color.';
			--filter-cart-icon-color : '.$cart_icon.';
			--filter-cart-content: '.$cart_content.';
			--filter-price-range : '.$price_range.';
			--filter-loader-color : '.$loader_color.';
			--filter-price-range: '.$secondary_color.';
			--filter-border-color: '.$secondary_color.';
			--filter-header-border: '.$primary_color.';
			--filter-tab-color: '.$tab_pan_item_color.';
			--filter-blog-header: '.$blog_header.';
			--filter-tag-color: '.$tag_color.';
			--filter-param-box-direction: '.$param_direction.';
			--filter-loading-icon-position: '.$loading_icon_position.';
		}';

		wp_register_style( 'filter-plus-custom-css', false );
		wp_enqueue_style( 'filter-plus-custom-css' );
		wp_add_inline_style('filter-plus-custom-css',$custom_css);
	}
}
