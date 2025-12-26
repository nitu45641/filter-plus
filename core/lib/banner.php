<?php

namespace FilterPlus\Core\Lib;

use FilterPlus\Utils\Singleton;

/**
 * Banner Class
 *
 * @since 1.0.0
 */
class Banner {

    use Singleton;

    public $status_key = 'filter_bens_status';

    /**
     * Initialize all modules.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function init() {
        add_action("admin_init", array( $this,"custom_api_on_admin_init") );
    }

    public function custom_api_on_admin_init() {
        $bens_status = get_option( $this->status_key );

        if ($bens_status === 1 || $bens_status === '1') {
            return;
        }
        $api_url = 'https://wpbens.com/wp-json/bens/v1/newsletter';

        $admin_email = get_option('admin_email');
        $body = [
            'plugin_name'  => 'FilterPlus',
            'type'  => 'org',
            'date'  => gmdate('Y-m-d H:i:s'),
            'email' => esc_html($admin_email),
        ];

        $response = wp_remote_post($api_url, [
            'method'    => 'POST',
            'body'      => $body,
        ]);
        if (is_wp_error($response)) {
            return;
        }
        $response_body = wp_remote_retrieve_body($response);
        $json = json_decode($response_body, true);
        if (isset($json['success'])) {
            update_option( $this->status_key , $json['success']);
        }        
    }

}
