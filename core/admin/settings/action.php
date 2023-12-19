<?php

namespace FilterPlus\Core\Admin\Settings;

use FilterPlus\Utils\Singleton;
use \FilterPlus\Utils\Helper as Helper;
/**
 * Class Menu
 */
class Action{

    use Singleton;
    /**
     * Initialize
     */
    public function init() {
      $callback = ['filter_save_settings'];
      if ( ! empty( $callback ) ) {
        foreach ( $callback as $key => $value ) {
          add_action( 'wp_ajax_' . $value, [$this, $value] );
          add_action( 'wp_ajax_nopriv_' . $value, [$this, $value] );
        }
      }
	}

    public function filter_save_settings() {
        $post_data    = filter_input_array( INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS );
        $params       = !empty($post_data['params']) ? $post_data['params'] : [];

		$settings_key = Helper::get_settings_key();

		foreach ($settings_key as $key => $value) {
            $settings_key[$key] = !empty( $params[$key] ) ? $params[$key] : "no";
        }

		update_option( 'filter_plus_settings' , $settings_key );

        wp_send_json_success(
			array( 
			'message' => esc_html__('Settings Save Successfully...','quicker'),
			'data' => Helper::get_settings(),
		));

		wp_die();

    }
}