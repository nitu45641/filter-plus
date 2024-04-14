<?php

namespace FilterPlus\Utils;

defined( 'ABSPATH' ) || exit;

/**
 * Helper function
 */
class Helper {

	use Singleton;

	/**
	 * Html markup validation
	 */
	public static function kses( $raw ) {
		$allowed_tags = [
			'a'                             => [
				'class'  => [],
				'href'   => [],
				'rel'    => [],
				'title'  => [],
				'target' => [],
			],
			'input'                         => [
				'value'       => [],
				'type'        => [],
				'size'        => [],
				'name'        => [],
				'checked'     => [],
				'placeholder' => [],
				'id'          => [],
				'class'       => [],
				'data-label'  => [],
				'data-option'  => []
			],

			'select'                        => [
				'value'       => [],
				'type'        => [],
				'size'        => [],
				'name'        => [],
				'placeholder' => [],
				'id'          => [],
				'class'       => [],
				'multiple'    => [],
				'data-option' => []							
			],
			'option'      => [
				'selected'    	=> [],
				'value'   		=> [],
				'disabled'    	=> []
			],
			'textarea'                      => [
				'value'       => [],
				'type'        => [],
				'size'        => [],
				'name'        => [],
				'rows'        => [],
				'cols'        => [],
				'placeholder' => [],
				'id'          => [],
				'class'       => [],
			],
			'abbr'                          => [
				'title' => [],
			],
			'b'                             => [],
			'blockquote'                    => [
				'cite' => [],
			],
			'cite'                          => [
				'title' => [],
			],
			'code'                          => [],
			'del'                           => [
				'datetime' => [],
				'title'    => [],
			],
			'dd'                            => [],
			'div'                           => [
				'data'  => [],
				'class' => [],
				'title' => [],
				'style' => [],
			],
			'dl'                            => [],
			'dt'                            => [],
			'em'                            => [],
			'h1'                            => [
				'class' => [],
			],
			'h2'                            => [
				'class' => [],
			],
			'h3'                            => [
				'class' => [],
			],
			'h4'                            => [
				'class' => [],
			],
			'h5'                            => [
				'class' => [],
			],
			'h6'                            => [
				'class' => [],
			],
			'i'                             => [
				'class' => [],
			],
			'img'                           => [
				'alt'    => [],
				'class'  => [],
				'height' => [],
				'src'    => [],
				'width'  => [],
			],
			'li'                            => [
				'class' => [],
			],
			'ol'                            => [
				'class' => [],
			],
			'p'                             => [
				'class' => [],
			],
			'q'                             => [
				'cite'  => [],
				'title' => [],
			],
			'span'                          => [
				'class' => [],
				'title' => [],
				'style' => [],
			],
			'small'                          => [
				'class' => [],
				'title' => [],
				'style' => [],
			],
			'iframe'                        => [
				'width'       => [],
				'height'      => [],
				'scrolling'   => [],
				'frameborder' => [],
				'allow'       => [],
				'src'         => [],
			],
			'strike'                        => [],
			'br'                            => [],
			'strong'                        => [],
			'data-wow-duration'             => [],
			'data-wow-delay'                => [],
			'data-wallpaper-options'        => [],
			'data-stellar-background-ratio' => [],
			'ul'                            => [
				'class' => [],
			],
			'label'                         => [
				'class' => [],
				'for' => [],
			],
		];

		if ( function_exists( 'wp_kses' ) ) { // WP is here
			return wp_kses( $raw, $allowed_tags );
		} else {
			return $raw;
		}

	}

	/**
	 * Auto generate classname from path.
	 */
	public static function make_classname( $dirname ) {
		$dirname    = pathinfo( $dirname, PATHINFO_FILENAME );
		$class_name = explode( '-', $dirname );
		$class_name = array_map( 'ucfirst', $class_name );
		$class_name = implode( '_', $class_name );

		return $class_name;
	}

	/**
	 * Show Notices
	 */
	public static function push( $notice ) {

		$defaults = array(
			'id'               => '',
			'type'             => 'info',
			'show_if'          => true,
			'message'          => '',
			'class'            => 'active-notice',
			'dismissible'      => false,
			'btn'              => array(),
			'dismissible-meta' => 'user',
			'dismissible-time' => WEEK_IN_SECONDS,
			'data'             => '',
		);

		$notice = wp_parse_args( $notice, $defaults );

		$classes = array( 'notice', 'notice' );

		$classes[] = $notice['class'];

		if ( isset( $notice['type'] ) ) {
			$classes[] = 'notice-' . $notice['type'];
		}

		// Is notice dismissible?
		if ( true === $notice['dismissible'] ) {
			$classes[] = 'is-dismissible';

			// Dismissable time.
			$notice['data'] = ' dismissible-time=' . esc_attr( $notice['dismissible-time'] ) . ' ';
		}

		// Notice ID.
		$notice_id    = 'sites-notice-id-' . $notice['id'];
		$notice['id'] = $notice_id;

		if ( ! isset( $notice['id'] ) ) {
			$notice_id    = 'sites-notice-id-' . $notice['id'];
			$notice['id'] = $notice_id;
		} else {
			$notice_id = $notice['id'];
		}

		$notice['classes'] = implode( ' ', $classes );

		// User meta.
		$notice['data'] .= ' dismissible-meta=' . esc_attr( $notice['dismissible-meta'] ) . ' ';

		if ( 'user' === $notice['dismissible-meta'] ) {
			$expired = get_user_meta( get_current_user_id(), $notice_id, true );
		} elseif ( 'transient' === $notice['dismissible-meta'] ) {
			$expired = get_transient( $notice_id );
		}
		
		// Notice visible after transient expire.
		if ( isset( $notice['show_if'] ) ) {
			if ( true === $notice['show_if'] ) {
				// Is transient expired?
				if ( false === $expired || empty( $expired ) ) {
					self::markup( $notice );
				}
			}
		} else {
			self::markup( $notice );
		}
	}
	
	/**
	 * Markup Notice.
	 */
	public static function markup( $notice = [] ) {
		?>
		<div id="<?php echo esc_attr( $notice['id'] ); ?>" class="<?php echo esc_attr( $notice['classes'] ); ?>" <?php echo esc_html( $notice['data'] ); ?>>
			<p>
				<?php echo esc_html($notice['message']); ?>
			</p>

			<?php if ( !empty( $notice['btn'] ) ): ?>
				<p>
					<a href="<?php echo esc_url( $notice['btn']['url'] ); ?>" class="button-primary"><?php echo esc_html( $notice['btn']['label'] ); ?></a>
				</p>
			<?php endif;?>
		</div>
		<?php
	}

	/**
	 * Admin pages array
	 *
	 * @return array
	 */
	public static function admin_unique_id( ) {
		$admin_pages =  array(
			'filter-plus_page_filter-plus-settings',
			'toplevel_page_filter_plus',
			'filter-plus_page_filter-plus-overview',
			'filter-plus_page_filter-sets',
			'filter-plus_page_filter-plus-license'
		);

		return $admin_pages;
	}

	/**
	 * Get product tags 
	 *
	 * @param [type] $taxonomy
	 */
	public static function get_product_tags( $tag , $type = "" ) {
		if( !class_exists('WooCommerce')){
			return array();
		}
		$terms      = get_terms( array(
			'taxonomy'   => $tag,
			'hide_empty' => false,
		) );
		
		$result_terms = array();
		foreach ($terms as $key => $value) {
			if ($type == "assoc" ) {
				$result_terms[$value->term_id] = $value->name;
			}
			else if ($type == "label_value" ) {
				$result_terms[$key]['value'] = $value->term_id;
				$result_terms[$key]['label'] = $value->name;
			}
		}

		if ( $type == "" ) {
			$result_terms = $terms;
		} 
		
		return $result_terms;

	}

	public static function woo_attribute_list($type=""){
		$result = array();
		if( !class_exists('WooCommerce')){ return $result; }
		foreach ( wc_get_attribute_taxonomies()  as $key => $value) {
			if ($type == "assoc" ) {
				$result[$value->attribute_id] = $value->attribute_name;
			}
			else if ($type == "label_value" ) {
				$result[]['value'] = $value->attribute_id;
				$result[]['label'] = $value->attribute_name;
			}
		}

		if ( $type == "" ) {
			$result = wc_get_attribute_taxonomies();
		}

		return $result;
	}

	/**
	 * String to array
	 *
	 * @param [type] $tags
	 * @return array
	 */
	public static function array_data( $data ){
		$tag_arr = array();
		if ( !empty( $data ) ) {
			$tag_arr = explode( ',' , $data );
		}

		return $tag_arr;
	}



	/**
	 * Get attributes 
	 *
	 * @param [type] $taxonomy
	 * @return array
	 */
	public static function get_attributes( $taxonomy = "" , $type="" ) {
		$data       = array();
		$terms      = self::get_product_tags( $taxonomy );
		$data['label'] = wc_attribute_label( $taxonomy );
		$data['terms'] = $terms;

		return $data;
	}

	/**
	 * Get categories
	 *
	 */
	public static function get_categories( $categories = "" , $type = false , $args = array() ) {
		extract($args);
		$taxonomy = !empty($taxonomy) ? $taxonomy : 'product_cat';
		$args_cat = array(
			'taxonomy'     => $taxonomy,
			'number'       => 50,
			'hide_empty'   => 0,
		);
		if ( !empty($categories)) {
			$args_cat['include'] = explode(",",$categories);
		}
		if ( $type == "" ) {
			$category = get_term_by( 'slug' , 'uncategorized' , $taxonomy );
			$uncategorized 	= !empty($category) ? $category->term_id : null;
			$args_cat['exclude'] = array($uncategorized);
		}

		$cat = get_categories( $args_cat );
		$result_cat = array();
		foreach ($cat as $key => $value) {
			$sub_cats = self::get_sub_categories($value->term_id,$taxonomy , $type );
			if ( $type == "assoc" || $type == "" ) {
				$result_cat[$key]['term_id'] = $value->term_id;
				$result_cat[$key]['name'] = $value->name;
				$result_cat[$key]['slug'] = $value->slug;
				$result_cat[$key]['sub_categories'] = $sub_cats;
			} 
			else if ($type == "widget" ) {
				$result_cat[$value->term_id] 	= $value->name;
			}
			else if ($type == "label_value" ) {
				$result_cat[$key]['value'] 		= $value->term_id;
				$result_cat[$key]['label'] 		= $value->name;
				$result_cat[$key]['sub_categories'] = $sub_cats;
			} 
		}
		return $result_cat;
	}

	public static function get_sub_categories($parent_id,$taxonomy,$type) {
		$result_cat = array();
		$args = array('orderby' => 'name', 'parent' => $parent_id , 'taxonomy' => $taxonomy );
		$subcategories = get_categories( $args );
		foreach ($subcategories as $key => &$value) {			
			if ( $type == "assoc" || $type == "" ) {
				$result_cat[$key][$value->term_id] 	= $value->name;
				$result_cat[$key]['term_id'] = $value->term_id;
				$result_cat[$key]['name'] = $value->name;
				$result_cat[$key]['slug'] = $value->slug;
			} 
			else if ($type == "label_value" ) {
				$result_cat[$key]['value'] = $value->term_id;
				$result_cat[$key]['label'] = $value->name;
			} 
		}
		return $result_cat;
	}

	/**
	 * Get all custom post type
	 *
	 * @return array
	 */
	public static function custom_post_type($type='')  {
		$result_data = array();
		$args = array(
			'public'   => true,
			'_builtin' => false,
			);
		
		$output = 'names'; 
		$operator = 'and'; 
	
		$post_types = get_post_types( $args, $output, $operator ); 
		if ( !empty($post_types) ) {
			$first_index = array(''=>esc_html__('Select Custom Post Type','filter-Plus'));
		} else {
			$first_index = array(''=>esc_html__('No Custom Post Type Found','filter-Plus'));
		}
		$all_post_types = $first_index + $post_types;

		if ( $type == 'label_value' ) {
			foreach ($all_post_types as $key => $value) {
				$result_data[] = array('label'=>$value,'value'=>$value);
			} 
		}else{
			$result_data = $all_post_types;
		}

		return $result_data;
	}


	/**
	 * Product category and tag filtering
	 *
	 * @param [type] $param
	 * @param [type] $args
	 */
	public static function product_filter( $param , $args ) {
		if ( ! empty($param['cat_id']) ) {
			$cat_id = $param['cat_id'];
		}else{
			$cat_id = !empty($param['filter_param']) ? $param['filter_param']['product_cat'] : [];
		}

		if ( !empty( $param['taxonomy']) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => $param['taxonomy'],
					'field'    => 'id',
					'terms'    => $cat_id,
				),
			);
		}

		//filter by attributes
		if ( ! empty( $param['taxonomies'] ) ) {
			$args['tax_query'] = array('relation' => 'AND' );
			if ( ! empty( $param['cat_id'] ) ) {
				$product_cat = array(
					'taxonomy' => $param['taxonomy'],
					'field'    => 'id',
					'terms'    => $param['cat_id'],
				);
				array_push( $args['tax_query'] , $product_cat );
			}
			foreach ( $param['taxonomies'] as $key => $value ) {
				$taxonomy = array(
					'taxonomy' => $key,
					'field'    => 'id',
					'terms'    => $value,
				);
				array_push( $args['tax_query'] , $taxonomy );
			}
		}

		return $args;
	}
	
	/**
	 * Get products terms
	 *
	 * @param [type] $param
	 * @return array
	 */
	public static function get_single_product_tags($param) {
		if (empty($param['cat_id'])) {
			return array();
		}

		$args = array(
			'post_type'             => $param['filter_type'],
			'post_status'           => 'publish',
			'posts_per_page'        => '-1',
		);
		$args = self::product_filter( array('cat_id'=> $param['cat_id'] , 'taxonomy'=> $param['taxonomy'] ) , $args );
		$posts = get_posts( $args );
		$all_terms = array();
		if (!empty($posts)) {
			foreach ($posts as $key => $value) {
				if ( !empty( $param['filter_param']) ) {
					foreach ($param['filter_param'] as $key => $taxonomy) {
						$terms = wp_get_post_terms( $value->ID , $key );
						if ( !empty( $terms ) ) {
							foreach ($terms as $term) {
								$all_terms[$key][] = $term->term_id;
							}
						}
					}
				}
			}
		}

		$result        = self::get_product_term( $param['filter_param'] , $all_terms );

		return $result;
	}
	
	/**
	 * get product term
	 *
	 * @param [type] $id
	 * @param [type] $filter_param
	 * @return array
	 */
	public static function get_product_term( $filter_param , $all_terms ) {
		$disable_terms = array();
		foreach ($filter_param as $key => $value) {
			if (!empty($all_terms[$key])) {
				$disable_terms[$key] = array_values(array_diff($value,$all_terms[$key]));
			}
			else{
				$disable_terms[$key] = $filter_param[$key];
			}
		}

		return $disable_terms;
	}
	
	/**
	 * Currency with simple and position
	 *
	 * @param [type] $price
	 */
	public static function currency_position( $price ) {
        $price =  floatval($price);
        $currency_symbol = get_woocommerce_currency_symbol();
        $currency_pos    = get_option( 'woocommerce_currency_pos' );

        switch( $currency_pos ){
            case "left":
                $price_with_symbol = $currency_symbol . $price;
                break;
            case "right":
                $price_with_symbol = $price . $currency_symbol;
                break;
            case "left_space":
                $price_with_symbol = $currency_symbol . ' '. $price;
                break;
            case "right_space":
                $price_with_symbol = $price.' ' . $currency_symbol;
                break;

            default:
                $price_with_symbol = $currency_symbol . $price;
        }
        
        return $price_with_symbol;		
	}
	
	/**
	 * Get min max price off all products
	 *
	 * @return array
	 */
	public static function get_min_max_price() {
		$price  = array( 'min' => '' , 'max'=> '' );

		if( !class_exists('WooCommerce')){ return $price; }

		$min = PHP_FLOAT_MAX;
		$max = 0.00;
		 
		$all_ids = get_posts( array(
		   'post_type' => 'product',
		   'numberposts' => -1,
		   'post_status' => 'publish',
		   'fields' => 'ids',
		) );
		 
		foreach ( $all_ids as $id ) {
		   $product = wc_get_product( $id );
		   if ( $product->is_type( 'simple' ) ) {
			  $min = $product->get_price() < $min ? $product->get_price() : $min;
			  $max = $product->get_price() > $max ? $product->get_price() : $max;
		   } elseif ( $product->is_type( 'variable' ) ) {
			  $prices = $product->get_variation_prices();
			  $min = current( $prices['price'] ) < $min ? current( $prices['price'] ) : $min;
			  $max = end( $prices['price'] ) > $max ? end( $prices['price'] ) : $max;
		   } 
		}
		 
		$price  = array( 'min' => $min , 'max'=> $max );
		return $price;
	}

	/**
	 * Render html.
	 */
	public static function render( $content ) {
		if ( $content == "" ) {
			return "";
		}

		return $content;
	}

	/**
	 * Settings option
	 * 
	 */
	public static function get_settings_key() {
		$settings_key = array( 'woo_order_filter_product'=> 'no',
		'woo_order_filter_status'=> 'no','seo_elements'=> array(),
		'seo_elements_format'=> '' , 'nice_url'=> '', 'seo_slug_url'=> '',
		'min_price_range'=>'','max_price_range'=>'',

		'refresh_url'=> '', 'primary_color'=> '#ffffff', 'secondary_color'=> '#ffffff' 
		);

		return $settings_key;
	}

	/**
	 * Admin settings
	 */
	public static function get_settings() {
		$settings = array();
		$get_settings 				   = get_option('filter_plus_settings', true );
		$settings_key 				   = self::get_settings_key();
		foreach ($settings_key as $key => $value) {
			$settings[$key] = !empty($get_settings[$key]) ? $get_settings[$key] : $value;
		}
		
		return $settings;
	}

	/**
	 * check nonce
	 *
	 */
	public function verify_nonce($nonce_index,$nonce_value) {
		if ( is_null( $nonce_index ) || ! wp_verify_nonce( $nonce_value, $nonce_index ) ) {
			wp_send_json( array(
				'message'  	=> __( 'Security check failed', 'filter-plus' ),
				'code' 		=> 401
			) );
		}
	}

	/**
	 * Get author list
	 *
	 * @return array
	 */
	public function author_list($ids='',$type='') {
		$user_list = array();
		$user_ids = $ids == '' ? '' : explode(',',$ids);
		$args = [
			'include' => $user_ids,
			'fields'  => [ 'ID', 'display_name'],
		  ];
		$users = get_users($args);

		foreach ($users as $user)  {
			if ( $type == 'label_value' ) {
				$user_list[] = array('label'=> $user->display_name , 'value'=>$user->ID);
			} else {
				$user_list[$user->ID] = $user->display_name;
			}
			
		}

		return $user_list;
	}

		/**
	 * Admin pages array
	 *
	 */
	public static function rating_html($star,$template="1") {
		$rating = '
		<svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="15" height="15" viewBox="0 0 256 256" xml:space="preserve">
			<g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
				<path class="rating" d="M 47.755 3.765 l 11.525 23.353 c 0.448 0.907 1.313 1.535 2.314 1.681 l 25.772 3.745 c 2.52 0.366 3.527 3.463 1.703 5.241 L 70.42 55.962 c -0.724 0.706 -1.055 1.723 -0.884 2.72 l 4.402 25.667 c 0.431 2.51 -2.204 4.424 -4.458 3.239 L 46.43 75.47 c -0.895 -0.471 -1.965 -0.471 -2.86 0 L 20.519 87.588 c -2.254 1.185 -4.889 -0.729 -4.458 -3.239 l 4.402 -25.667 c 0.171 -0.997 -0.16 -2.014 -0.884 -2.72 L 0.931 37.784 c -1.824 -1.778 -0.817 -4.875 1.703 -5.241 l 25.772 -3.745 c 1.001 -0.145 1.866 -0.774 2.314 -1.681 L 42.245 3.765 C 43.372 1.481 46.628 1.481 47.755 3.765 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
			</g>
		</svg>
		';
		$rating_light = '
		<svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="15" height="15" viewBox="0 0 256 256" xml:space="preserve">
			<g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
				<path class="rating_light" d="M 47.755 3.765 l 11.525 23.353 c 0.448 0.907 1.313 1.535 2.314 1.681 l 25.772 3.745 c 2.52 0.366 3.527 3.463 1.703 5.241 L 70.42 55.962 c -0.724 0.706 -1.055 1.723 -0.884 2.72 l 4.402 25.667 c 0.431 2.51 -2.204 4.424 -4.458 3.239 L 46.43 75.47 c -0.895 -0.471 -1.965 -0.471 -2.86 0 L 20.519 87.588 c -2.254 1.185 -4.889 -0.729 -4.458 -3.239 l 4.402 -25.667 c 0.171 -0.997 -0.16 -2.014 -0.884 -2.72 L 0.931 37.784 c -1.824 -1.778 -0.817 -4.875 1.703 -5.241 l 25.772 -3.745 c 1.001 -0.145 1.866 -0.774 2.314 -1.681 L 42.245 3.765 C 43.372 1.481 46.628 1.481 47.755 3.765 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
			</g>
		</svg>
		';

		$html = "<li data-star=".$star."><span class='rating_block rate_".$template."'>";
		for($i=0; $i < 5; $i++) { 
			if ( $star == 5 ) {
				$html .= $rating;
			}
			if ( $star == 4 ) {
				if ( $i > 3 ) {
					$html .= $rating_light;
				}else{
					$html .= $rating;
				}
			}
			if ( $star == 3 ) {
				if ( $i > 2 ) {
					$html .= $rating_light;
				}else{
					$html .= $rating;
				}
			}
			if ( $star == 2 ) {
				if ( $i > 1 ) {
					$html .= $rating_light;
				}else{
					$html .= $rating;
				}
			}
			if ( $star == 1 ) {
				if ( $i > 0 ) {
					$html .= $rating_light;
				}else{
					$html .= $rating;
				}
			}
		}
		$html .= "</span>
		<span>".$star." Star</span>
		</li>";
		
		echo $html;
	}

	/**
	 * Get custom fields keys
	 *
	 * @return array
	 */
	public static function get_custom_fields_keys( $post_type = 'post' , $type='' ) {
		$all_keys  = array();

		$posts = get_posts(array('post_type'=> $post_type ));
		if (empty($posts)) {
			return $all_keys;
		}
		$meta_keys = get_post_meta($posts[0]->ID);

		foreach($meta_keys as $meta_key=>$meta_value) {
			if ( $type == '' ) {
				$all_keys[$meta_key] = $meta_key;
			}else{
				$all_keys[] = array('label'=>$meta_key,'value'=>$meta_key);
			}
		}

		return $all_keys;
	}

	/**
	 * Custom Field Condition
	 *
	 */
	public static function custom_field_condition() {
		return array('OR'=>esc_html__('OR','filter-plus'),'AND'=>esc_html__('AND','filter-plus'));
	}

	/**
	 * Custom Field Condition
	 *
	 */
	public static function pro_active_message($message='') {
		if ( !class_exists('FilterPlusPro')) {
			$pro_message = $message == '' ? esc_html__('Please Active Filter Plus Pro. It is Premium feature.','filter-plus') : $message;
			return $pro_message;
		}
		return true;
	}

	public static function get_price_range() {
		$settings = \FilterPlus\Utils\Helper::instance()->get_settings();;
		$get_price = \FilterPlus\Utils\Helper::instance()->get_min_max_price();
		$min = $settings['min_price_range'] == '' ? $get_price['min'] : $settings['min_price_range'];
		$max = $settings['max_price_range'] == '' ? $get_price['max'] : $settings['max_price_range'];
		
		return array('min'=>$min,'max'=>$max);
	}

	/**
	 * Templates for widgets
	 *
	 * @return array
	 */
	public static function widgets_templates($limit = 5 )  {
		$pro = '';
		if ( ! class_exists( 'FilterPlusPro' ) ) {
			$pro  = esc_html__( 'Pro', 'filter-plus' );
		}
		$templates = array( 1  => esc_html__( 'Template 1', 'filter-plus' ) );
		for ($i=1; $i <= $limit ; $i++) { 
			$pro_tag = $i == 1 ? '' : ' '. $pro;
			$templates[$i] = esc_html__( 'Template '.$i, 'filter-plus' ) . $pro_tag;
		}

		return $templates;
	}

}
