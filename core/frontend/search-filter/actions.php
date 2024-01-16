<?php

namespace FilterPlus\Core\Frontend\SearchFilter;

use FilterPlus;
use FilterPlus\Utils\Singleton;

/**
 * Ajax action
 *
 * @since 1.0.0
 */
class Actions {

	use Singleton;

	/**
	 * Initialize all modules.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function init() {
		$callback = ['get_filtered_data'];
		if ( ! empty( $callback ) ) {
			foreach ( $callback as $key => $value ) {
				add_action( 'wp_ajax_' . $value, [$this, $value] );
				add_action( 'wp_ajax_nopriv_' . $value, [$this, $value] );
			}
		}
	}

	/**
	 * Get filtered product data
	 *
	 * @return void
	 */
	public function get_filtered_data() {
		$post_data    = filter_input_array( INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS );
		FilterPlus\Utils\Helper::instance()->verify_nonce('filter_plus_nonce', $post_data['filter_plus_nonce'] );
		$post_arr     = ! empty( $post_data['params'] ) ? $post_data['params'] : [];
		$search_value = ! empty( $post_arr['search_value'] ) ? $post_arr['search_value'] : '';
		$order_by     = ! empty( $post_arr['order_by'] ) ? $post_arr['order_by'] : '';
		$cat_id       = ! empty( $post_arr['cat_id'] ) ? $post_arr['cat_id'] : '';
		$taxonomies   = ! empty( $post_arr['taxonomies'] ) ? $post_arr['taxonomies'] : [];
		$rating       = ! empty( $post_arr['rating'] ) ? $post_arr['rating'] : '';
		$max          = ! empty( $post_arr['max'] ) ? $post_arr['max'] : '';
		$min          = ! empty( $post_arr['min'] ) ? $post_arr['min'] : '';
		$filter_param = ! empty( $post_arr['filter_param'] ) ? $post_arr['filter_param'] : array();
		$template     = ! empty( $post_data['template'] ) ? $post_data['template'] : 1;
		$product_categories = ! empty( $post_data['product_categories'] ) ? $post_data['product_categories'] : 'yes';
		$product_tags = ! empty( $post_data['product_tags'] ) ? $post_data['product_tags'] : 'yes';
		$stock        = ! empty( $post_arr['stock'] ) ? $post_arr['stock'] : '';
		$on_sale      = ! empty( $post_arr['on_sale'] ) ? $post_arr['on_sale'] : '';
		$offset       = ! empty( $post_arr['offset'] ) ? $post_arr['offset'] : 1;
		$default_call = ! empty( $post_arr['default_call'] ) ? $post_arr['default_call'] : false;
		$filter_type  = ! empty( $post_arr['filter_type'] ) ? $post_arr['filter_type'] : 'woo-filter';
		$author  	  = ! empty( $post_arr['author'] ) ? $post_arr['author'] : '';
		$taxonomy	  = $filter_type == 'product' ? 'product_cat' : 'category';

		$args = array(
			'author'   		=> $author,
			'filter_type'   => $filter_type,
			'template'      => $template,
			'offset'        => $offset,
			'filter_param'  => $filter_param,
			'cat_id'        => $cat_id,
			'taxonomies'    => $taxonomies,
			'search_value'  => $search_value,
			'min'           => $min,
			'max'           => $max,
			'rating'        => $rating,
			'product_tags'  => $product_tags,
			'order_by'      => $order_by,
			'product_categories'  => $product_categories,
			'stock'  		=> $stock,
			'on_sale'  		=> $on_sale,
			'taxonomy'  	=> $taxonomy
		);

		$get_products   = $this->get_products( $args );
		$disable_terms  = \FilterPlus\Utils\Helper::get_single_product_tags( array( 'cat_id' => $cat_id,
		'filter_param' => $filter_param ,'default_call' => $default_call , 'filter_type' => $filter_type ,
		'taxonomy' => $taxonomy ) );

		$message = $get_products['total'] == 0  ? esc_html__( 'No Matching Result Found', 'filter-plus' ) : '';
		$response = array(
			'success'        => true,
			'message'        => $message,
			'data'           => $get_products,
			'disable_terms'  => $disable_terms,
		);

		wp_send_json_success( $response );

		wp_die();
	}

	/**
	 * Get products
	 *
	 * @return array
	 */
    public function get_products( $param = array() ) {
		$limit = 9;
		$args = array(
			'post_type'             => $param['filter_type'],
			'post_status'           => 'publish',
			'paged'                 => $param['offset'],
			'posts_per_page'        => $limit,
			'paginate'              => true
		);

		if ($param['author'] !== '' ) {
			$args['author__in'] = array($param['author']);
		}
		// by category
		$args = \FilterPlus\Utils\Helper::product_filter( $param , $args );
		// search
		$args = $this->add_search_value( $param , $args );

		if ( $param['filter_type'] == "product") {
			$args = $this->product_order_by( $param , $args );
			$args = $this->product_min_max_price( $param , $args );
			$args = $this->product_reviews( $param , $args );
			$args = $this->product_on_stock( $param , $args );
			$args = $this->product_on_sale( $param , $args );
		}

		$posts = get_posts( $args );

		// total products
		$args['posts_per_page'] = -1;
		$posts_count            = count(get_posts($args));
		if ( $param['filter_type'] == "product") {
			$products   = $this->process_product_data( $posts , $param );
		}else{
			$products   = $this->process_wp_data( $posts , $param );
		}

		return array( 'products' => $products , 'total' => $posts_count , 'pages' => ceil($posts_count / $limit) );
	}

	/**
	 * Filter by stock
	 *
	 * @return array
	 */
	public function product_on_stock( $param , $args ) {
		if(!empty($param['stock'])){
			$args['meta_query'] =array(
                array(
                   'key'     => '_stock_status',
                   'value'   => $param['stock'],
				)
			);
		}

		return $args;
	}

	/**
	 * Filter by sale
	 *
	 * @return array
	 */
	public function product_on_sale( $param , $args ) {
		if ( empty($param['on_sale']) ) {
			return $args;
		}
		if( $param['on_sale'] == "true" ){
			$args['post__in'] = wc_get_product_ids_on_sale();
		}
		else if($param['on_sale'] == "false" ){
			$args['post__not__in'] = wc_get_product_ids_on_sale();
		}

		return $args;
	}

	/**
	 * Product order by
	 *
	 * @param [type] $args
	 * @param [type] $param
	 * @return array
	 */
	public function product_order_by( $param , $args ) {
		if(!empty($param['order_by'])){
			switch ($param['order_by']) {
				case 'date':
					$args['order']      = 'DESC';
					$args['orderby']    = $param['order_by'];
					break;
				case 'price':
					$args['order']      = 'ASC';
					$args['orderby']    = 'meta_value_num';
					$args['meta_key']   = '_price';
					break;
				case 'price-desc':
					$args['order']      = 'DESC';
					$args['orderby']    = 'meta_value_num';
					$args['meta_key']   = '_price';
					break;
				case 'rating':
					$args['order']      = 'DESC';
					$args['orderby']    = 'rating';
					break;
				case 'popularity':
					$args['orderby']  = ['menu_order' => 'DESC', 'meta_value_num' => 'DESC'];
					$args['meta_key'] = 'total_sales';
					break;
				default:
					$args['order']      = 'DESC';
					$args['orderby']    = $param['order_by'];
					break;
			}
		}

		return $args;
	}
	

	/**
	 * Product review
	 *
	 * @param [type] $param
	 * @param [type] $args
	 * @return array
	 */
	public function product_reviews( $param , $args ) {
		if(!empty($param['rating'])){
			$args['meta_query'] =array(
                array(
                   'key'     => '_wc_average_rating',
                   'value'   => $param['rating'],
                   'compare' => '=',
				   'type'    => 'NUMERIC'
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
	 * @return array
	 */
	public function add_search_value( $param , $args ) {
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
	 * @return array
	 */
	public function product_min_max_price( $param , $args ) {
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
	 * Process product data
	 *
	 * @param [type] $param
	 * @param [type] $args
	 * @return array
	 */
	public static function process_product_data( $posts  , $param ) {
		$products = self::process_wp_data( $posts , $param );
		if ( !empty($posts) ) {
			foreach ( $posts as $key => $post ):
				$product_instance = wc_get_product($post->ID);
				$products[$key]['rating']           = class_exists('FilterPlusPro') ? self::rating_html( $product_instance ) : "";
				$products[$key]['post_description'] = $product_instance->get_short_description();
				$products[$key]['post_image_alt']   = esc_html__('product image', 'filter-plus');
				$products[$key]['post_price']       = $product_instance->get_price_html();
				$products[$key]['cart_btn']         = self::cart_btn_html( $product_instance , $param['template'] );
			endforeach;
		}

		return $products;
	}

	/**
	 * format wp data
	 *
	 * @return array
	 */
	public static function process_wp_data( $posts , $param ) {
		$products 	= array();
		$size  		= $param['filter_type'] == "product" ? self::product_size($param['template']) : 'full';
		$cats  		= $param['filter_type'] == "product" ? 'product_cat' : 'category';
		$tags 		= $param['filter_type'] == "product" ? 'product_tag' : 'post_tag';
		if ( !empty($posts) ) {
			foreach ( $posts as $key => $post ):
				if(has_post_thumbnail($post->ID)){
					$image = wp_get_attachment_image( get_post_thumbnail_id( $post->ID ), $size  , '', '' );
				} else {
					$image_url = wc_placeholder_img_src( 'woocommerce_single' );
					$image = '<img src="'.esc_url($image_url).'" alt="'.esc_attr__('single image blank','filter-plus').'">';
				}
				
				$products[$key]['id'] = $post->ID;
				$products[$key]['post_title']       = get_the_title( $post->ID );
				$products[$key]['post_image']       = $image;
				$products[$key]['post_description'] = apply_filters('the_content', $post->post_content);
				$products[$key]['post_permalink']   = get_permalink( $post->ID );
				$products[$key]['author']   		= esc_html__('By','filter-plus').' '. get_the_author_meta( 'display_name',$post->post_author );
				$products[$key]['categories_label'] =  ( $param['product_categories'] == "yes" && !empty( get_the_terms ( $post->ID , $cats ) ) ) ? esc_html__('Category:','filter-plus') : '';
				$products[$key]['tag_label'] 		=  ( $param['product_tags'] == "yes" && !empty( get_the_terms ( $post->ID , $tags ) ) ) ? esc_html__('Tag:','filter-plus') : '';
				$products[$key]['categories']       =  $param['product_categories'] == "yes" ? get_the_terms ( $post->ID , $cats ) : [];
				$products[$key]['tags']             =  $param['product_tags'] == "yes" ? get_the_terms ( $post->ID , $tags  ) : [];
			endforeach;
		}

		return $products;
	}

	/**
	 * Cart Btn Html
	 *
	 * @param [type] $product_instance
	 * @param [type] $template
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

	/**
	 * Product image size
	 *
	 * @param [type] $template
	 * @return array
	 */
	public static function product_size($template){
		switch ($template) {
			case 1:
				$size = array(255,255);
				break;
			case 2:
				$size = array(255,315);
				break;
			default:
				$size = array(255,255);
			break;
		}

		return $size;
	}

}
