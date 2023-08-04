<?php

namespace FilterPlus\Utils;

defined( 'ABSPATH' ) || exit;

/**
 * Helper function
 */
class Helper {

	use Singleton;

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
	 * @return void
	 */
	public static function admin_pages_id( ) {
		$admin_pages =  array('toplevel_page_filter_plus');

		return $admin_pages;
	}

	/**
	 * Get product tags 
	 *
	 * @param [type] $taxonomy
	 * @return void
	 */
	public static function get_product_tags( $tag ) {
		$terms      = get_terms( array(
			'taxonomy'   => $tag,
			'hide_empty' => false,
		) );

		return $terms;
	}

	/**
	 * String to array
	 *
	 * @param [type] $tags
	 * @return void
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
	 * @return void
	 */
	public static function get_attributes( $taxonomy = "" ) {
		$data       = array();
		$terms      = self::get_product_tags( $taxonomy );
		$data['label'] = wc_attribute_label( $taxonomy );
		$data['terms'] = $terms;

		return $data;
	}

	/**
	 * Get categories
	 *
	 * @return void
	 */
	public static function get_categories( $categories = "" ) {

		$args_cat = array(
			'taxonomy'     => "product_cat",
			'number'       => 50,
			'hide_empty'   => 0,
		);
		if ( !empty($categories)) {
			$args_cat['include'] = explode(",",$categories);
		}

		return get_categories( $args_cat );
	}

	

	/**
	 * Get products
	 *
	 * @return void
	 */
    public static function get_products( $param = array() ) {
		$args = array(
			'post_type'             => 'product',
			'post_status'           => 'publish',
			'posts_per_page'        => '12',
			'paged'                 => $param['offset'],
			'paginate'              => true,
			'order'                 => 'DESC'
		);

		$args = self::add_search_value( $param , $args );
		$args = self::product_min_max_price( $param , $args );
		$args = self::product_filter( $param , $args );
		$args = self::product_reviews( $param , $args );
		
		$posts      = get_posts( $args );
		$products   = self::process_product_data( $posts , $param['template'] );

		$prod       = wc_get_products( $args );
		$total      = $prod->total;
		$pages      = $prod->max_num_pages;

		return array( 'products' => $products , 'total' => $total , 'pages' => $pages );
	}

	/**
	 * Product review
	 *
	 * @param [type] $param
	 * @param [type] $args
	 * @return void
	 */
	public static function product_reviews( $param , $args ) {
		if(!empty($param['star'])){
			$args['meta_query'] =array(
                array(
                   'key'     => '_wc_average_rating',
                   'value'   => intval($param['star']),
                   'compare' => '=',
				   'type'    => 'numeric'
                )
			);
		}

		return $args;
	}


	/**
	 * Add search value
	 *
	 * @param [type] $param
	 * @param [type] $args
	 * @return void
	 */
	public static function add_search_value( $param , $args ) {
		if(!empty($param['search_value'])){
			$search_data = trim( $param['search_value'] , " " );
			$args['s']   = $search_data;
		}

		return $args;
	}

	/**
	 * Product min max price
	 *
	 * @param [type] $param
	 * @param [type] $args
	 * @return void
	 */
	public static function product_min_max_price( $param , $args ) {
		if ( ! empty( $param['min'] ) && ! empty( $param['max'] ) ) {
			$args['meta_query'] = array(
				array(
				'key'       => '_regular_price',
				'value'     => array( $param['min'], $param['max'] ),
				'compare'   => 'BETWEEN',
				'type'      => 'NUMERIC'
				),
			);
		}

		return $args;
	}

	/**
	 * Product category and tag filtering
	 *
	 * @param [type] $param
	 * @param [type] $args
	 * @return void
	 */
	public static function product_filter( $param , $args ) {
		if ( ! empty( $param['cat_id'] ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'id',
					'terms'    => $param['cat_id'],
				),
			);
		}

		// filter by attributes

		if ( ! empty( $param['taxonomies'] ) ) {
			$args['tax_query'] = array('relation' => 'AND' );
			if ( ! empty( $param['cat_id'] ) ) {
				$product_cat = array(
					'taxonomy' => 'product_cat',
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
	 * @return void
	 */
	public static function get_single_product_tags($param) {
		$args = array(
			'post_type'             => 'product',
			'post_status'           => 'publish',
			'posts_per_page'        => '-1',
		);
		$args = self::product_filter( array('cat_id'=> $param['cat_id'] ) , $args );
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
	 * @return void
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
	 * @return void
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
		global $wpdb;
		$sql    = "SELECT MAX(meta_value) as max ,MIN(meta_value) as min from {$wpdb->prefix}postmeta where meta_key = '_price'";
		$result = $wpdb->get_results($sql);

		if ( !empty($result) ) {
			$price = array( 'min' => $result[0]->min , 'max'=> $result[0]->max );
		}

		return $price;
	}

	/**
	 * Process product data
	 *
	 * @param [type] $param
	 * @param [type] $args
	 * @return void
	 */
	public static function process_product_data( $posts  , $template ) {
		$products = array();
		if ( !empty($posts) ) {
			foreach ( $posts as $key => $post ):
				if(has_post_thumbnail($post->ID)){
					$image = wp_get_attachment_image( get_post_thumbnail_id( $post->ID ), 'medium', '', '' );
				} else {
					$image_url = wc_placeholder_img_src( 'woocommerce_single' );
					$image = '<img src="'.esc_url($image_url).'" alt="'.esc_attr__('single image blank','filter-plus').'">';
				}
				$product_instance = wc_get_product($post->ID);

				$products[$key]['id'] = $post->ID;
				$products[$key]['post_title']       = get_the_title( $post->ID );
				$products[$key]['rating']           = class_exists('FilterPlusPro') ? self::rating_html( $product_instance ) : "";
				$products[$key]['post_permalink']   = get_permalink( $post->ID );
				$products[$key]['post_description'] = $product_instance->get_short_description();
				$products[$key]['post_image']       = $image;
				$products[$key]['post_image_alt']   = esc_html__('product image', 'filter-plus');
				$products[$key]['post_price']       = $product_instance->get_price_html();
				$products[$key]['cart_btn']         = self::cart_btn_html( $product_instance , $template );
				$products[$key]['categories']       = [];
				$products[$key]['tags']             = [ 'name' => '' ];

			endforeach;
		}

		return $products;
	}
	
	/**
	 * Cart Btn Html
	 *
	 * @param [type] $product_instance
	 * @param [type] $template
	 * @return void
	 */
	public static function cart_btn_html( $product_instance , $template ) {
		// show cart button
		$cart_args = array(
			'product'       => $product_instance,
			'cart_button'   => 'yes',
			'btn_text'      => $template == "2" ? esc_html__('Add to cart' , 'filter-plus') : "",
			'customize_btn' => '',
			'widget_id'     => '',
			'icon'          => '<svg width="20" class="cart-icon" height="20" fill="#fff" viewBox="0 0 256 256" xml:space="preserve">
				<g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
					<path class="cart-icon-path" d="M 72.975 58.994 H 31.855 c -1.539 0 -2.897 -1.005 -3.347 -2.477 L 15.199 13.006 H 3.5 c -1.933 0 -3.5 -1.567 -3.5 -3.5 s 1.567 -3.5 3.5 -3.5 h 14.289 c 1.539 0 2.897 1.005 3.347 2.476 l 13.309 43.512 h 36.204 l 10.585 -25.191 h -6.021 c -1.933 0 -3.5 -1.567 -3.5 -3.5 s 1.567 -3.5 3.5 -3.5 H 86.5 c 1.172 0 2.267 0.587 2.915 1.563 s 0.766 2.212 0.312 3.293 L 76.201 56.85 C 75.655 58.149 74.384 58.994 72.975 58.994 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
					<circle class="cart-icon-path" cx="28.88" cy="74.33" r="6.16" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
					<circle class="cart-icon-path" cx="74.59" cy="74.33" r="6.16" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
					<path class="cart-icon-path" d="M 62.278 19.546 H 52.237 V 9.506 c 0 -1.933 -1.567 -3.5 -3.5 -3.5 s -3.5 1.567 -3.5 3.5 v 10.04 h -10.04 c -1.933 0 -3.5 1.567 -3.5 3.5 s 1.567 3.5 3.5 3.5 h 10.04 v 10.04 c 0 1.933 1.567 3.5 3.5 3.5 s 3.5 -1.567 3.5 -3.5 v -10.04 h 10.041 c 1.933 0 3.5 -1.567 3.5 -3.5 S 64.211 19.546 62.278 19.546 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
				</g>
			</svg>',
		);

		return self::cart_btn( $cart_args );
	}

	/**
	 * Rating Html
	 *
	 * @param [type] $product_instance
	 * @return void
	 */
	public static function rating_html( $product_instance ){
		$average      = $product_instance->get_average_rating();
		$rating_count = $product_instance->get_rating_count();
		$review_count = $product_instance->get_review_count();

		$rating = '<div class="rating"><div class="woocommerce">';
		if ( $rating_count > 0 ) :
		$rating .= '<div class="woocommerce-product-rating">';
		$rating .= wc_get_rating_html( $average, $rating_count ).'('.$review_count.' reviews)';
		$rating .= '</div>';
		endif;
		$rating .= '</div></div>';

		return $rating;
	}
	
	/**
	 * Get cart template
	 *
	 * @param [type] $args
	 * @return void
	 */
	public static function cart_btn ( $args ) {
		extract( $args );
		$cart_html = "";

		switch ( $product->get_type() ) {
			case ($product->get_type() == 'simple' ) && ($cart_button == 'yes' ) && $product->is_in_stock() == true :
				$cart_html = '
				<a href="'.$product->add_to_cart_url().'" value="'.esc_attr( $product->get_id() ).'"
				 class="ajax_add_to_cart add_to_cart_button"
				 data-product_id="'. $product->get_id().'"
				 data-product_sku="'.esc_attr($product->get_sku()).'"
				 aria-label="Add “'.the_title_attribute().'” to your cart"> 
					'. $icon . $btn_text .'
				</a>
				';

				break;
			case ($product->get_type() !== 'simple' ) && ($cart_button == 'yes' ) && $product->is_in_stock() == true :
				$cart_html .= '<a href="'.$product->get_permalink().'" class="">'.$icon . $btn_text .'</a>';

				break;

		}

		return $cart_html;
	}
}
