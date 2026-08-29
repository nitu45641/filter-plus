<?php

namespace FilterPlus\Core\Admin\FilterSets;

use FilterPlus\Utils\Singleton;
use FilterPlus\Utils\Helper as UtilsHelper;

defined( 'ABSPATH' ) || exit;

/**
 * Ajax actions for saving/deleting Filter Sets.
 *
 * @since 1.0.0
 */
class Action {

	use Singleton;

	/**
	 * Initialize
	 *
	 * @return void
	 */
	public function init() {
		$callback = array( 'save_filter_set', 'delete_filter_set' );
		foreach ( $callback as $value ) {
			// Only registered for authenticated users - these are admin-only actions.
			add_action( 'wp_ajax_' . $value, array( $this, $value ) );
		}
	}

	/**
	 * Capability + nonce check shared by every action here.
	 *
	 * @param array $post_data
	 *
	 * @return void
	 */
	private function check_permission( $post_data ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error(
				array( 'message' => esc_html__( 'You do not have permission to perform this action.', 'filter-plus' ) ),
				403
			);
		}

		UtilsHelper::instance()->verify_nonce( 'filter_plus_nonce', ! empty( $post_data['filter_plus_nonce'] ) ? $post_data['filter_plus_nonce'] : '' );
	}

	/**
	 * Save (insert/update) a filter set.
	 *
	 * @return void
	 */
	public function save_filter_set() {
		$post_data = filter_input_array( INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS );
		$post_data = ! empty( $post_data ) ? $post_data : array();
		$this->check_permission( $post_data );

		$id   = ! empty( $post_data['id'] ) ? absint( $post_data['id'] ) : 0;
		$name = ! empty( $post_data['name'] ) ? sanitize_text_field( wp_unslash( $post_data['name'] ) ) : '';
		$type = ! empty( $post_data['type'] ) ? sanitize_key( $post_data['type'] ) : '';

		if ( empty( $name ) ) {
			wp_send_json_error( array( 'message' => esc_html__( 'Please enter a filter set name.', 'filter-plus' ) ) );
		}

		if ( ! in_array( $type, array( 'filter_products', 'wp_filter_plus' ), true ) ) {
			wp_send_json_error( array( 'message' => esc_html__( 'Invalid filter type.', 'filter-plus' ) ) );
		}

		// The shortcode/params carry quotes and brackets that FILTER_SANITIZE_SPECIAL_CHARS
		// would mangle above, so read those two fields straight off $_POST (nonce already
		// verified in check_permission()) and sanitize them ourselves.
		$raw_post  = wp_unslash( $_POST ); // phpcs:ignore WordPress.Security.NonceVerification.Missing -- verified above via verify_nonce().
		$shortcode = ! empty( $raw_post['shortcode'] ) ? sanitize_text_field( $raw_post['shortcode'] ) : '';
		$params    = ( ! empty( $raw_post['params'] ) && is_array( $raw_post['params'] ) ) ? $this->sanitize_params( $raw_post['params'] ) : array();

		$post_id = Helper::save_filter_set( $id, $name, $type, $shortcode, $params );

		if ( empty( $post_id ) ) {
			wp_send_json_error( array( 'message' => esc_html__( 'Could not save the filter set.', 'filter-plus' ) ) );
		}

		wp_send_json_success(
			array(
				'message' => esc_html__( 'Filter Set Saved', 'filter-plus' ),
				'data'    => Helper::get_filter_set( $post_id ),
			)
		);
	}

	/**
	 * Delete a filter set.
	 *
	 * @return void
	 */
	public function delete_filter_set() {
		$post_data = filter_input_array( INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS );
		$post_data = ! empty( $post_data ) ? $post_data : array();
		$this->check_permission( $post_data );

		$id = ! empty( $post_data['id'] ) ? absint( $post_data['id'] ) : 0;

		if ( empty( $id ) || ! Helper::delete_filter_set( $id ) ) {
			wp_send_json_error( array( 'message' => esc_html__( 'Could not delete the filter set.', 'filter-plus' ) ) );
		}

		wp_send_json_success( array( 'message' => esc_html__( 'Filter Set Deleted', 'filter-plus' ) ) );
	}

	/**
	 * Sanitize the raw field-value map stored against a filter set.
	 *
	 * @param array $params
	 *
	 * @return array
	 */
	private function sanitize_params( $params ) {
		$clean = array();

		foreach ( $params as $key => $value ) {
			$key = sanitize_key( $key );

			if ( is_array( $value ) ) {
				$clean[ $key ] = array_map( 'sanitize_text_field', $value );
			} else {
				$clean[ $key ] = sanitize_text_field( $value );
			}
		}

		return $clean;
	}
}
