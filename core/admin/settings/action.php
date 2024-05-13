<?php

namespace FilterPlus\Core\Admin\Settings;

use FilterPlus;
use FilterPlus\Utils\Singleton;
use FilterPlus\Utils\Helper;
/**
 * Class Menu
 */
class Action {

	use Singleton;

	/**
	 * Initialize
	 */
	public function init() {
		$callback = array( 'filter_save_settings','add_filter_options' );
		if ( ! empty( $callback ) ) {
			foreach ( $callback as $key => $value ) {
				add_action( 'wp_ajax_' . $value, array( $this, $value ) );
				add_action( 'wp_ajax_nopriv_' . $value, array( $this, $value ) );
			}
		}
	}

	public function add_filter_options() {
		$post_data    = filter_input_array( INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS );
		FilterPlus\Utils\Helper::instance()->verify_nonce( 'filter_plus_nonce', $post_data['filter_plus_nonce'] );
		if (!empty($post_data['params'])) {
			$this->insert_filter_options( $post_data['params'] );
			$message = esc_html__( 'New Filter Options Added', 'filter-plus' );
		}else{
			$message = esc_html__( 'Data missing', 'filter-plus' );
		}
		wp_send_json_success(
			array(
				'message' => $message,
				'data' => array(),
			)
		);

		wp_die();
	}

	/**
     * insert new filter
     */
    public function insert_filter_options( $params ) {
		$label = !empty( $params['label'] ) ? $params['label'] : esc_html__('Custom Field','filter-plus');
		$ID = !empty( $params['id'] ) ? $params['id'] : '';

		if ( $ID == "" ) {
		  $id = wp_insert_post(array(
			  'post_title'=> $label  , 
			  'post_type'=>'filter_plus_option', 
			  'post_content'=>'',
			  'post_status' => 'publish'
		  ));
		}else{
		  $post_update = array(
			  'ID'         => $ID,
			  'post_title' => $label 
			);
		  
			wp_update_post( $post_update );
			$id = $ID;
		}
  
		if (!empty( $id ) ) {
		  foreach ($params as $meta_key => $value) {
			update_post_meta( $id, $meta_key, $value );
		  }
		}
	}
  

	/**
	 * Filter Settings
	 */
	public function filter_save_settings() {
		$post_data    = filter_input_array( INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS );
		FilterPlus\Utils\Helper::instance()->verify_nonce( 'filter_plus_nonce', $post_data['filter_plus_nonce'] );
		$params       = ! empty( $post_data['params'] ) ? $post_data['params'] : array();
		$settings_key = Helper::get_settings_key();

		foreach ( $settings_key as $key => $value ) {
			$settings_key[ $key ] = ! empty( $params[ $key ] ) ? $params[ $key ] : '';
		}

		update_option( 'filter_plus_settings', $settings_key );

		wp_send_json_success(
			array(
				'message' => esc_html__( 'Settings Save Successfully...', 'filter-plus' ),
				'data' => Helper::get_settings(),
			)
		);

		wp_die();
	}
}
