<?php

namespace FilterPlus\Core\Frontend\SearchFilter;

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
		$post_arr     = ! empty( $post_data['params'] ) ? $post_data['params'] : [];
		$search_value = ! empty( $post_arr['search_value'] ) ? $post_arr['search_value'] : '';
		$order_by     = ! empty( $post_arr['order_by'] ) ? $post_arr['order_by'] : '';
		$cat_id       = ! empty( $post_arr['cat_id'] ) ? $post_arr['cat_id'] : '';
		$taxonomies   = ! empty( $post_arr['taxonomies'] ) ? $post_arr['taxonomies'] : [];
		$star         = ! empty( $post_arr['star'] ) ? $post_arr['star'] : '';
		$max          = ! empty( $post_arr['max'] ) ? $post_arr['max'] : '';
		$min          = ! empty( $post_arr['min'] ) ? $post_arr['min'] : '';
		$filter_param = ! empty( $post_arr['filter_param'] ) ? $post_arr['filter_param'] : array();
		$template     = ! empty( $post_data['template'] ) ? $post_data['template'] : 1;
		$product_categories = ! empty( $post_data['product_categories'] ) ? $post_data['product_categories'] : 'yes';
		$product_tags = ! empty( $post_data['product_tags'] ) ? $post_data['product_tags'] : 'yes';
		$offset       = ! empty( $post_arr['offset'] ) ? $post_arr['offset'] : 1;
		$default_call = ! empty( $post_arr['default_call'] ) ? $post_arr['default_call'] : false;

		$args = array(
			'template'      => $template,
			'offset'        => $offset,
			'filter_param'  => $filter_param,
			'cat_id'        => $cat_id,
			'taxonomies'    => $taxonomies,
			'search_value'  => $search_value,
			'min'           => $min,
			'max'           => $max,
			'star'          => $star,
			'product_tags'  => $product_tags,
			'order_by'      => $order_by,
			'product_categories'  => $product_categories,
		);

		$get_products   = \FilterPlus\Utils\Helper::get_products( $args );
		$disable_terms  = \FilterPlus\Utils\Helper::get_single_product_tags( array( 'cat_id' => $cat_id, 'filter_param' => $filter_param ,'default_call' =>$default_call) );
		$message = $get_products['total'] == 0  ? esc_html__( 'No Product Found', 'filter-plus' ) : '';
		$response = array(
			'success'        => true,
			'message'        => $message,
			'data'           => $get_products,
			'disable_terms'  => $disable_terms,
		);

		wp_send_json_success( $response );

		wp_die();
	}

}
