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
		$merged_atts = shortcode_atts( $data_factory , $atts );
		$merged_atts['title'] = \FilterPlus\Base\DataFactory::normalize_filter_title( $merged_atts['title'] );

		extract( $merged_atts );

		ob_start();
		$is_pro_active = $this->pro_template_check($template);
		if ($is_pro_active !== '' ) {
			echo wp_kses_post( $is_pro_active );
			return ob_get_clean();
		} 

		
		$_fp_custom_css = $this->custom_css($template , 'product' , array(
			'masonry_style'        => $masonry_style,
			'grid_columns_desktop' => $grid_columns_desktop,
			'grid_columns_tablet'  => $grid_columns_tablet,
			'grid_columns_mobile'  => $grid_columns_mobile,
		));

		$col_desktop = ! empty( $grid_columns_desktop ) ? max( 1, intval( $grid_columns_desktop ) ) : 0;
		$col_tablet  = ! empty( $grid_columns_tablet )  ? max( 1, intval( $grid_columns_tablet ) )  : 0;
		$col_mobile  = ! empty( $grid_columns_mobile )  ? max( 1, intval( $grid_columns_mobile ) )  : 0;

		$grid_col_style  = '';
		$grid_col_class  = '';
		if ( $col_desktop > 0 || $col_tablet > 0 || $col_mobile > 0 ) {
			$grid_col_class = ' has-grid-cols';
			$vars = '';
			if ( $col_desktop > 0 ) { $vars .= '--fp-cols-desktop:' . $col_desktop . ';'; }
			if ( $col_tablet > 0 )  { $vars .= '--fp-cols-tablet:'  . $col_tablet  . ';'; }
			if ( $col_mobile > 0 )  { $vars .= '--fp-cols-mobile:'  . $col_mobile  . ';'; }
			$grid_col_style = ' style="' . esc_attr( $vars ) . '"';
		}
		?>
			<div class="shopContainer <?php echo esc_attr($filter_position)?> shop-container-<?php echo esc_attr($template) . esc_attr($grid_col_class); ?>"<?php echo $grid_col_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- value built with esc_attr() ?>
			id="shopContainer"
			data-filter_type='product'
			data-apply_button_mode="<?php echo esc_attr($apply_button_mode)?>"
			data-apply_button_label="<?php echo esc_attr($apply_button_label)?>"
			data-reset_button_label="<?php echo esc_attr($reset_button_label)?>"
			data-masonry_style="<?php echo esc_attr($masonry_style)?>"
			data-pagination_style="<?php echo esc_attr($pagination_style)?>"
			data-limit="<?php echo intval($no_of_items)?>"
			data-template="<?php echo esc_attr($template)?>"
			data-product_categories="<?php echo esc_attr($product_categories)?>"
			data-product_tags="<?php echo esc_attr($product_tags)?>"
			data-show_sale_badge="<?php echo esc_attr($show_sale_badge)?>"
			data-exclude_categories="<?php echo esc_attr($exclude_categories)?>"
			data-hide_prod_add_cart="<?php echo esc_attr($hide_prod_add_cart)?>"
			data-add_to_cart_text="<?php echo esc_attr($add_to_cart_text)?>"
			data-product_image_size="<?php echo esc_attr($product_image_size)?>"
			data-image_width="<?php echo esc_attr($image_width)?>"
			data-image_height="<?php echo esc_attr($image_height)?>"
			data-rollover_image="<?php echo esc_attr($rollover_image)?>"
			data-rollover_image_number="<?php echo esc_attr($rollover_image_number)?>"
			data-rollover_effect="<?php echo esc_attr($rollover_effect)?>"
			data-gallery_slider="<?php echo esc_attr($gallery_slider)?>"
			data-hide_prod_title="<?php echo esc_attr($hide_prod_title)?>"
			data-hide_prod_desc="<?php echo esc_attr($hide_prod_desc)?>"
			data-hide_prod_price="<?php echo esc_attr($hide_prod_price)?>"
			data-hide_prod_rating="<?php echo esc_attr($hide_prod_rating)?>"
			data-show_product_attributes="<?php echo esc_attr($show_product_attributes)?>"
			data-product_attributes="<?php echo esc_attr($product_attributes)?>"
			data-attributes="<?php echo esc_attr($attributes)?>"
			data-enable_category_layout="<?php echo esc_attr($enable_category_layout)?>"
			data-current_cat_id="<?php echo esc_attr($current_cat_id)?>"
			>
			<?php
				$style = $template;
				$_fp_relative = "woo-filter/template-{$template}/template-{$template}.php";
				$_fp_free_tpl = \FilterPlus::locate_template( $_fp_relative );
				if ( file_exists( $_fp_free_tpl ) ) {
					include_once $_fp_free_tpl;
				} elseif ( class_exists( 'FilterPlusPro' ) ) {
					$_fp_pro_tpl = \FilterPlusPro::locate_template( $_fp_relative );
					if ( file_exists( $_fp_pro_tpl ) ) {
						include_once $_fp_pro_tpl;
					}
				}

			?>
			</div>
		<?php

		$_fp_html = ob_get_clean();
		// Pro templates 5+ do not all include the shared product-search partial.
		// Add it at the common renderer boundary so every integration gets the
		// same search control without changing the installed Pro plugin files.
		if ( 'no' !== $show_search && false === strpos( $_fp_html, 'class="search-form' ) ) {
			$_fp_search_html = '<div class="sidebar-row search-wrap"><div class="search-form search-form-' . esc_attr( $template ) . '"><input type="text" value="" class="sidebar-input" placeholder="' . esc_attr__( 'Search here', 'filter-plus' ) . '" /><button type="button" class="search-button search-button' . esc_attr( $template ) . '" aria-label="' . esc_attr__( 'Search', 'filter-plus' ) . '"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.3-9.4 9.3-24.6 0-33.9zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.8-57.3 128-128 128z"/></svg></button></div><span class="reset d-none reset-' . esc_attr( $template ) . '">' . esc_html__( 'Reset', 'filter-plus' ) . '</span></div>';
			$_fp_html = preg_replace_callback(
				'/(<h3\b[^>]*class="[^"]*\bshop-sidebar-title\b[^"]*"[^>]*>.*?<\/h3>)/s',
				static function ( $matches ) use ( $_fp_search_html ) {
					return $matches[1] . $_fp_search_html;
				},
				$_fp_html,
				1
			);
			if ( false === strpos( $_fp_html, 'class="search-form' ) ) {
				$_fp_html = preg_replace_callback(
					'/(<div\b[^>]*class="[^"]*\bshop-sidebar\b[^"]*"[^>]*>)/',
					static function ( $matches ) use ( $_fp_search_html ) {
						return $matches[1] . $_fp_search_html;
					},
					$_fp_html,
					1
				);
			}
		}
		if ( defined( 'REST_REQUEST' ) && REST_REQUEST && ! empty( $_fp_custom_css ) ) {
			$_fp_html = '<style>' . $_fp_custom_css . '</style>' . $_fp_html;
		}
		return $_fp_html;
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
		$main_wrapper   = 'shopContainer';
		$_fp_custom_css = $this->custom_css($template,'content-filter', array( 'masonry_style' => $masonry_style ) );
		?>
			<div class="<?php echo esc_attr($main_wrapper).' '. esc_attr($filter_position) ?> shop-container-<?php echo esc_attr($template)?>" id="shopContainer"
				data-apply_button_mode="<?php echo esc_attr($apply_button_mode)?>"
				data-apply_button_label="<?php echo esc_attr($apply_button_label)?>"
				data-reset_button_label="<?php echo esc_attr($reset_button_label)?>"	
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

		$_fp_html = ob_get_clean();
		if ( defined( 'REST_REQUEST' ) && REST_REQUEST && ! empty( $_fp_custom_css ) ) {
			$_fp_html = '<style>' . $_fp_custom_css . '</style>' . $_fp_html;
		}
		return $_fp_html;
	}

	public function wp_filter_file($template,$atts) {
		extract($atts);
		if ( '1' == $template ) {
			include \FilterPlus::locate_template( 'wp-filter/template-' . $template . '/template-' . $template . '.php' );
		}else{
			$is_pro_active = $this->is_pro_active();
			if ($is_pro_active !== '' ) {
				echo wp_kses_post( $is_pro_active );
				return;
			}
			if ( class_exists( 'FilterPlusPro' ) ) {
				$_fp_pro_tpl = \FilterPlusPro::locate_template( "wp-filter/template-{$template}/template-{$template}.php" );
				if ( file_exists( $_fp_pro_tpl ) ) {
					include $_fp_pro_tpl;
				}
			}
		}
	}


	/**
	 * Check pro template
	 *
	 * @param [type] $template
	 */
	public function pro_template_check($template) {
		$pro_template 	= [2,3,8];
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
		global $filter_plus_custom_css;
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
			$secondary_color = $filter_type !== "product" ? "#e82935" : "#17c6aa";
			$readmore_color = $hover_color  = $filter_type !== "product" ? '#e82935' : '#17c6aa';
			$blog_header 	 = $filter_type !== "product" ? "#ff0000" : "#000";
			$primary_color = $price_range = '#333';
			$cart_content = '#17c6aa';
		}
		else if ( $template == "4" ) {
			$primary_color = $price_range = $cart_content = '#ff69b4'; 
			$secondary_color = $tag_color = '#ff69b4'; 
			$cart_icon = '#fff'; 
			$blog_header = $filter_type !== "product" ? "#ff0000" : "#000"; 
		}
		else if( $filter_type == "product" && $template == "5" ){
			$hover_color = $secondary_color = '#EB662B';
			$loadmore_bg = '#EB662B';
			$price_range = $loadmore_bg_hover = '#d94d17';
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
			if ( $settings['primary_color'] !== '#ffffff' ) {
				$rating_color = $settings['primary_color'];
			}
		}

		$loader_color =  $secondary_color == "#fff" ? $primary_color : $secondary_color;
		$filter_border_color = 'rgb(225, 223, 223)';
		$filter_font_color = '#333';
		
		$masonry_cols        = ! empty( $args['grid_columns_desktop'] ) ? max( 1, intval( $args['grid_columns_desktop'] ) ) : 3;
		$masonry_cols_tablet = ! empty( $args['grid_columns_tablet'] )  ? max( 1, intval( $args['grid_columns_tablet'] ) )  : $masonry_cols;
		$masonry_cols_mobile = ! empty( $args['grid_columns_mobile'] )  ? max( 1, intval( $args['grid_columns_mobile'] ) )  : 1;

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
				width: calc((100% - ' . ( ( $masonry_cols - 1 ) * 20 ) . 'px) / ' . $masonry_cols . ');
			}
			@media (max-width: 1024px) {
				.product-style,.grid-sizer{
					width: calc((100% - ' . ( ( $masonry_cols_tablet - 1 ) * 20 ) . 'px) / ' . $masonry_cols_tablet . ');
				}
			}
			@media (max-width: 480px) {
				.product-style,.grid-sizer{
					width: calc((100% - ' . ( ( $masonry_cols_mobile - 1 ) * 20 ) . 'px) / ' . $masonry_cols_mobile . ');
				}
			}
			';
		}else{
			$grid_style = '
			.product-style-3 .hpcc-image img{
				width: 340px;
			}
			.grid-view-1 {
				display: grid;
				grid-template-columns: repeat(3, minmax(0, 1fr));
				gap: 15px 11px;
			}
			.grid-view-2 {
				display: grid;
				grid-template-columns: repeat(3, minmax(0, 1fr));
				gap: 15px;
				position: relative;
			}
			.post-grid-view-1{
				display: grid;
				grid-template-columns: repeat(3, minmax(0, 1fr));
				gap: 15px 11px;
			}
			.grid-view-6{
				display: grid;
				grid-template-columns: repeat(3, minmax(0, 1fr));
				gap: 15px 22px;
			}
			.grid-view-3{
				display: grid;
				grid-template-columns: repeat(auto-fit, minmax(min(100%, 360px), 1fr));
				gap: 20px;
			}
			.shop-container-3 .prods-grid-view.grid-view-3 {
				grid-template-columns: repeat(auto-fit, minmax(min(100%, 360px), 1fr));
			}
			.grid-view-4 {
				display: grid;
				grid-template-columns: repeat(auto-fit, minmax(min(100%, 420px), 1fr));
				gap: 15px;
			}
			.shop-container-4 .prods-grid-view.grid-view-4 {
				grid-template-columns: repeat(auto-fit, minmax(min(100%, 420px), 1fr));
			}
			.product-style-4 {
				display: flex;
				flex-direction: row;
				gap: 18px;
				align-items: flex-start;
				padding: 16px;
				border-radius: 12px;
				background: #fff;
				border: 1px solid rgba(0,0,0,0.07);
			}
			.product-style-4 .product-thumbnail {
				flex-shrink: 0;
				width: 130px;
				height: 130px;
				border-radius: 10px;
				overflow: hidden;
				background: #f5f5f5;
			}
			.product-style-4 .product-thumbnail .vpcc-image {
				width: 100%;
				height: 100%;
				position: relative;
			}
			.product-style-4 .product-thumbnail .vpcc-image img {
				width: 100%;
				height: 100%;
				object-fit: cover;
				display: block;
			}

			@media screen and (max-width: 1024px) {
				.grid-view-1 {
					display: grid;
					grid-template-columns: 32% 32% 32%;
					gap: 15px 11px;
				}
				.grid-view-2,.grid-view-3 {
					grid-template-columns: repeat(3, minmax(0, 1fr));
				}
				.shop-container-3 .prods-grid-view.grid-view-3 {
					grid-template-columns: repeat(auto-fit, minmax(min(100%, 320px), 1fr));
				}
				.color-style-2{
					gap: 8px !important;
				}
			}
			@media (max-width: 768px) {
				.post-grid-view-5{
					display: grid;
					grid-template-columns: auto auto auto !important;
					gap: 15px 10px;
				}
				.grid-view-3{
				    grid-template-columns: repeat(2, 1fr);
				}
			}
			@media screen and (max-width: 425px) {
				.prods-grid-view,
				.tab-item
				{
					grid-template: auto / 100% !important;
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

		$filterplus_custom_css = '
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
			--filter-fplus-cart-icon-color : '.$cart_icon.';
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

		wp_register_style( 'filter-plus-custom-css', false, array(), \FilterPlus::get_version() );
		wp_enqueue_style( 'filter-plus-custom-css' );
		wp_add_inline_style( 'filter-plus-custom-css', $filterplus_custom_css );

		return $filterplus_custom_css;
	}
}
