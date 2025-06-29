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
		$data_factory = \FilterPlus\Base\DataFactory::instance()->woo_default_data();
		// shortcode option
		$atts = extract( shortcode_atts( $data_factory , $atts ) );

		ob_start();
		$is_pro_active = $this->pro_template_check($template);
		if ($is_pro_active !== '' ) {
			echo $is_pro_active;
			return ob_get_clean();
		} 

		
		$this->custom_css($template , 'product' , array( 'masonry_style' => $masonry_style ));
		?>
			<div class="shopContainer <?php echo esc_attr($filter_position)?> shop-container-<?php echo esc_attr($template)?>"
			id="shopContainer"
			data-filter_type='product' 
			data-masonry_style="<?php echo esc_attr($masonry_style)?>"
			data-pagination_style="<?php echo esc_attr($pagination_style)?>"
			data-limit="<?php echo intval($no_of_items)?>"
			data-template="<?php echo esc_attr($template)?>"
			data-product_categories="<?php echo esc_attr($product_categories)?>"
			data-product_tags="<?php echo esc_attr($product_tags)?>"
			>
			<?php 
				$style = $template;
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
		return $template;
	}

	public function wp_filter_plus( $args ) {
		ob_start();
		$data_factory = \FilterPlus\Base\DataFactory::instance()->wp_default_data();
		$data = shortcode_atts( $data_factory , $args );
		extract( $data );

		$filtering_type = $filter_type == 'post' ? 'post' : $custom_post;
		$main_wrapper   = ($template == '3' || '2') ? 'mainWrapper' : 'shopContainer';
		$this->custom_css($template,'content-filter', array( 'masonry_style' => $masonry_style ) );
		?>
			<div class="<?php echo esc_attr($main_wrapper).' '. esc_attr($filter_position) ?>" id="shopContainer"
				data-pagination_style="<?php echo esc_html($pagination_style)?>"
				data-filter_type='<?php echo esc_html($filtering_type)?>'
				data-masonry_style="<?php echo esc_attr($masonry_style)?>"
				data-limit="<?php echo intval($no_of_items)?>"
				data-template="<?php echo esc_html($template)?>"
				data-product_categories="<?php echo esc_html($post_categories) ?>"
				data-product_tags="<?php echo esc_html($post_tags)?>"
				data-post_author="<?php echo esc_html($post_author)?>"
			>
				<?php $this->wp_filter_file($template, $data );?>
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
	public function custom_css($template = "1", $filter_type = "product" , $args=array() ) {
		global $filter_custom_css;
		$secondary_color = '#1164cb'; $primary_color ='#2d73e7';$tag_color ='';
		$blog_header = "#1164cb"; $cart_icon =  '#fff'; 
		$cart_content = '#2d73e7';$price_range = '#2d73e7';
		$param_direction = 'row';
		$tab_pan_item_color = '#fff'; $title_color = '#222';
		$readmore_color = $hover_color = 'hsla(242, 88.4%, 66.3%, 0.8)';
		$rating_color = '#FFCA27'; $rating_size = '13px';
		$badge_bg = '#E7272D'; $price_color = '#e3106e';
		$loadmore_bg = '#fff';
		$loadmore_bg_hover = '#000';

		if ( $template == "2" ) {
			$cart_icon =  '#fff'; 
			$secondary_color = $primary_color = '#17c6aa'; 
			$price_range = '#17c6aa'; 
			$cart_content = '#080808'; 
			$tag_color = '#ff1f25';
		}
		else if ( $template == "3" ) {
			$cart_icon = '#fff';
			$secondary_color = $filter_type !== "product" ? "#e82935" : "#5c5555"; 
			$readmore_color = $hover_color  = $filter_type !== "product" ? '#e82935' : 'hsla(242, 88.4%, 66.3%, 0.8)'; 
			$filter_type !== "product" ? "#ff0000" : "#ab1616"; 
			$blog_header 	 = $filter_type !== "product" ? "#ff0000" : "#000"; 
			$primary_color = $price_range = '#333'; 
		}
		else if ( $template == "4" ) {
			$primary_color = $price_range = $cart_content = '#ff69b4'; 
			$secondary_color = $tag_color = '#ff69b4'; 
			$cart_icon = '#fff'; 
			$blog_header = $filter_type !== "product" ? "#ff0000" : "#000"; 
		}
		else if( $filter_type == "product" && $template == "5" ){
			$hover_color = $secondary_color = '#EB662B';
			$loadmore_bg = '#fff';
			$price_range = $loadmore_bg_hover = '#000';
		}
		else if ( $template == "6" ) {
			$price_range = '#333'; 
			$cart_content = $rating_color = '#089ec7'; 
			$rating_size = '.875em'; 
			$badge_bg = '#fff'; 
		}
		else if ( $template == "7" ) {
			$price_range = '#333'; 
			$price_color =  $badge_bg = '#b3af54'; 
			$filter_border_color = '#eaeaea';
			$rating_color = '#007bff'; 
			$secondary_color = '#000'; 
		}

		$settings = \FilterPlus\Utils\Helper::instance()->get_settings();
		
        if ( ($settings['secondary_color'] !== '#ffffff') || ($settings['primary_color'] !== '#ffffff')  ) {
			$secondary_color = $settings['secondary_color'];
			$primary_color   = $settings['primary_color'];
		}

		$loader_color =  $secondary_color == "#fff" ? $primary_color : $secondary_color;
		$filter_border_color = 'rgb(225, 223, 223)';
		$filter_font_color = '#333';
		
		if ($args['masonry_style'] == 'yes' ) {
			$grid_style = '
			.product-style{
				margin-bottom: 20px;
				float: left;
				box-sizing: border-box;
			}
			.prods-grid-view .gutter-sizer {
			width: 20px;
			}
			.product-style,.grid-sizer{
			width: calc((100% - 40px) / 3); /* 2 gutters × 20px = 40px total space between items */
			}
			';
		}else{
			$grid_style = '
			.post-grid-view-3{
				display: grid;
				grid-template-columns: 345px 345px 345px;
				gap: 25px;
			}
			.grid-view-1 {
				display: grid;
				grid-template: auto / 24% 24% 24% 24%;
				gap: 15px 11px;
			}
			.grid-view-2 {
				display: grid;
				grid-template: auto / 255px 255px 255px;
				gap: 30px 15px;
				position: relative;
			}
			.post-grid-view-1{
				display: grid;
				grid-template: auto / 32.5% 32.5% 32%;
				gap: 30px 11px;
			}
			.grid-view-6{
				display: grid;
				grid-template: auto / 33% 33% 33%;
				gap: 30px 22px;
			}
			.grid-view-7{
				display: grid;
				grid-template-columns: 210px 210px 210px 210px;
				position: relative;
				column-gap: 20px;
				row-gap: 25px;
			}
			.grid-view-3{
				display: grid;
				grid-template-columns: 290px 290px 290px;
				column-gap: 20px;
			}
			.product-style-3 .vpcc-image img {
				width: 100%;
			}
			.tab-item.product-style-5{
				display: grid;
				grid-template-columns: 200px 200px 200px 200px;
				gap: 8px 20px;
			}
			.product-style-4{
				display: inline-flex;
				flex-direction: row;
				gap: 30px 15px;
			}
			.product-style-4 .product-thumbnail{
			    align-items: center;
    			display: flex;
			}

			@media screen and (max-width: 1024px) {
				.grid-view-1 {
					display: grid;
					grid-template-columns: 32% 32% 32%;
					gap: 15px 11px;
				}
				.grid-view-2,.grid-view-3,.grid-view-7 {
					grid-template: auto / 220px 220px 220px;
				}
				.product-style-5{
				    grid-template-columns: 220px 220px 220px !important;
				}
			}
			@media (max-width: 768px) {
				.post-grid-view-5{
					display: grid;
					grid-template-columns: auto auto auto !important;
					gap: 15px 10px;
				}
				.grid-view-3{
				    grid-template-columns: 320px 320px;
				}
				.post-grid-view-3 .hpcc-image{
				    display: inline-flex;
    				align-items: center;
				}
			}
			@media screen and (max-width: 425px) {
				.prods-grid-view,
				.tab-item
				{
					grid-template: auto / 100% !important;
				}
				.hpcc-image{
					display:block !important;
				}
				.horizontal-prod-card{
					display: grid;
					grid-template-columns: 105px auto 15% !important;
				}
				.shop-sidebar {
					width: 60%;
				}
				.prods-grid-view img{
					width: 100%;
					height: auto;
				}
			}
			';
		}

		$filter_custom_css = '
		:root {
			--filter-loadmore-bg: '.$loadmore_bg.';
			--filter-loadmore-bg-hover: '.$loadmore_bg_hover.';
			--filter-readmore-color: '.$readmore_color.';
			--filter-title-color: '.$title_color.';
			--filter-price-color: '.$price_color.';
			--filter-rating-color: '.$rating_color.';
			--filter-badge-bg: '.$badge_bg.';
			--filter-rating-size: '.$rating_size.';
			--filter-hover-color: '.$hover_color.';
			--filter-primary-color: '.$primary_color.';
			--filter-secondary-color : '.$secondary_color.';
			--filter-cart-icon-color : '.$cart_icon.';
			--filter-cart-content: '.$cart_content.';
			--filter-price-range : '.$price_range.';
			--filter-loader-color : '.$loader_color.';
			--filter-border-color: '.$filter_border_color.';
			--filter-font-color: '.$filter_font_color.';
			--filter-header-border: '.$primary_color.';
			--filter-tab-color: '.$tab_pan_item_color.';
			--filter-blog-header: '.$blog_header.';
			--filter-tag-color: '.$tag_color.';
			--filter-param-box-direction: '.$param_direction.';
		}
			'.$grid_style.'
		';

		wp_register_style( 'filter-plus-custom-css', false );
		wp_enqueue_style( 'filter-plus-custom-css' );
		wp_add_inline_style('filter-plus-custom-css',$filter_custom_css);
	}
}
