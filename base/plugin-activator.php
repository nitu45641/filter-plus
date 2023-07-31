<?php

namespace FilterPlus\Base;

defined('ABSPATH') || exit;

/**
 * Plugin Activator Class
 *
 * @since 1.0.0
 * 
 */
class PluginActivator {
    /**
     * Store plugin slug.
     *
     * @var string $slug
     */
    private $slug = 'http://woooplugin.com/wp-content/uploads/2023/07/filter-plus.zip';

    /**
     * Install plugin if not exists.
     *
     * @since 1.0.0
     * 
     * @return void
     */
    public function install() {

        // Download the plugin.
        $this->download();

        // Unzip the plugin.
        $this->unzip();

        // Delete the plugin zip file.
        $this->delete();
    }

    /**
     * Activate the plugin if not already active
     *
     * @since 1.0.0
     * 
     * @return void
     */
    public function activate() {
        if ( ! $this->plugin_exists() ) {
            $this->install();
        }

        if ( ! is_plugin_active( $this->slug . '/' . $this->slug . '.php' ) ) {

            // Activate the plugin.
            $result = activate_plugin( $this->slug . '/' . $this->slug . '.php' );

            if ( is_wp_error( $result ) ) {
                return false;
            }
        }

        return true;
    }

    /**
     * Download the plugin
     *
     * @return void
     */
    private function download() {
        $plugin_slug        = $this->slug;
        $plugin_zip         = $plugin_slug;
        $plugin_destination = WP_PLUGIN_DIR . '/' . $plugin_slug . '.zip';

        $file = file_get_contents( $plugin_zip );
        file_put_contents( $plugin_destination, $file );
    }

    /**
     * Delete the plugin zip
     *
     * @return bool
     */
    private function delete() {
        $destination = $this->get_plugin_destination();

        return unlink( $destination );
    }

    /**
     * Unzip the plugin file
     *
     * @return void
     */
    private function unzip() {
        $destination = $this->get_plugin_destination();
        $zip         = new \ZipArchive();

        if ( $zip->open( $destination ) ) {
            $zip->extractTo( WP_PLUGIN_DIR );
            $zip->close();
        }
    }

    /**
     * Get plugin destination
     *
     * @return string
     */
    private function get_plugin_destination() {
        return WP_PLUGIN_DIR . '/' . $this->slug . '.zip';
    }

    /**
     * Check plugin exists or not
     *
     * @since 1.0.0
     * 
     * @param string $slug
     * 
     * @return bool
     */
    private function plugin_exists( $slug = null ) {
        $installed_plugins  = get_plugins();
        $slug               = $slug ?? $this->slug;

        return ! empty( $installed_plugins[ $slug . '/' . $slug . '.php' ] );
    }
}
