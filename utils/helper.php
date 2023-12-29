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
				'data-label'  => []
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
			'filter-plus_page_settings',
			'toplevel_page_filter_plus',
			'filter-plus_page_overview',
			'filter-plus_page_filter-set'
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
				$result[$key]['value'] = $value->attribute_id;
				$result[$key]['label'] = $value->attribute_name;
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
			if ($type == "assoc" ) {
				$result_cat[$value->term_id] = $value->name;
			} 
			else if ($type == "label_value" ) {
				$result_cat[$key]['value'] = $value->term_id;
				$result_cat[$key]['label'] = $value->name;
			} 
		}

		if ( $type == "" ) {
			$result_cat = $cat;
		} 

		return $result_cat;
	}

	/**
	 * Get all custom post type
	 *
	 * @return array
	 */
	public static function custom_post_type()  {
		$args = array(
			'public'   => true,
			'_builtin' => false,
			);
		
		$output = 'names'; 
		$operator = 'and'; 
	
		$post_types = get_post_types( $args, $output, $operator ); 
	
		return $post_types;
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

		$args['tax_query'] = array(
			array(
				'taxonomy' => $param['taxonomy'],
				'field'    => 'id',
				'terms'    => $cat_id,
			),
		);

		// filter by attributes

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
	 * @return void
	 */
	public static function get_min_max_price() {
		$price  = array( 'min' => '' , 'max'=> '' );

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
		'refresh_url'=> '',  );

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
	public function author_list($ids) {
		$user_list = array();
		$args = [
			'include' => explode(',',$ids),
			'fields'  => [ 'ID', 'display_name'],
		  ];
		$users = get_users($args);

		foreach ($users as $user)  {
			$user_list[$user->ID] = $user->display_name;
		}

		return $user_list;
	}
}
