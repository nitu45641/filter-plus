<?php

/**
 * Menu class
 *
 */

namespace FilterPlus\Core\Admin;

use FilterPlus\Utils\Singleton;

/**
 * Class Menu
 */
class Menus
{

    use Singleton;

    /**
     * Initialize
     *
     * @return void
     */
    public function init()
    {
        add_action('admin_menu', array($this, 'register_admin_menu'));
    }


    /**
     * Register admin menu
     *
     * @return void
     */

    public function register_admin_menu() {
        $capability = 'read';
        $slug       = 'filter_plus';

		// Add main page
		if ( empty ( $GLOBALS['admin_page_hooks'][$slug] ) ) {
			add_menu_page(
				esc_html__('Shortcodes', 'filter-plus'),
				esc_html__('Filter Plus', 'filter-plus'),
				$capability,
				$slug,
				array($this,'filter_plus_view'),
				'data:image/svg+xml;base64,' . base64_encode(
					'<svg width="35" height="45" viewBox="0 0 35 45" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M17.0691 28.1402C21.2212 28.1402 24.5743 24.7462 24.5743 20.5754C24.5743 16.4046 21.2212 13.0106 17.0691 13.0106C12.9171 13.0106 9.56395 16.4046 9.56395 20.5754C9.56395 24.7462 12.9171 28.1402 17.0691 28.1402ZM17.0691 34.5343C24.71 34.5343 30.9042 28.2847 30.9042 20.5754C30.9042 12.8661 24.71 6.61646 17.0691 6.61646C9.42824 6.61646 3.23407 12.8661 3.23407 20.5754C3.23407 28.2847 9.42824 34.5343 17.0691 34.5343Z" fill="url(#paint0_linear_56_17)"/>
					<path d="M33.0326 4.469C33.0326 6.8411 31.1267 8.76406 28.7756 8.76406C26.4246 8.76406 24.5187 6.8411 24.5187 4.469C24.5187 2.09691 26.4246 0.17395 28.7756 0.17395C31.1267 0.17395 33.0326 2.09691 33.0326 4.469Z" fill="url(#paint1_linear_56_17)"/>
					<path fill-rule="evenodd" clip-rule="evenodd" d="M0.952719 32.3183C2.16428 31.0456 4.16782 31.006 5.42776 32.2298C9.49124 36.1769 13.5424 37.8137 17.2657 37.7793C20.9941 37.7448 24.9067 36.0297 28.6785 32.2612C29.9213 31.0196 31.9252 31.0307 33.1544 32.2861C34.3835 33.5414 34.3725 35.5657 33.1298 36.8073C28.4802 41.4528 23.0692 44.12 17.3236 44.1731C11.5729 44.2263 5.9997 41.6561 1.04031 36.8388C-0.219628 35.6149 -0.258843 33.591 0.952719 32.3183Z" fill="#273DC9"/>
					<defs>
					<linearGradient id="paint0_linear_56_17" x1="17.0691" y1="6.61646" x2="17.0691" y2="34.5343" gradientUnits="userSpaceOnUse">
					<stop stop-color="#3B72E0"/>
					<stop offset="1" stop-color="#415AD4"/>
					</linearGradient>
					<linearGradient id="paint1_linear_56_17" x1="28.7756" y1="0.17395" x2="28.7756" y2="8.76406" gradientUnits="userSpaceOnUse">
					<stop stop-color="#B847D1"/>
					<stop offset="1" stop-color="#4066E3"/>
					</linearGradient>
					</defs>
					</svg>'),
				10
			);
		}

		// Add submenu pages
		if (count( $this->sub_menu_pages() ) > 0 ) {
			foreach ( $this->sub_menu_pages() as $key => $value ) {
				add_submenu_page( $value['parent_slug'], $value['page_title'], $value['menu_title'],
				$value['capability'], $value['menu_slug'], $value['cb_function'] , $value['position'] );
			}
		}

		if ( !empty ( $GLOBALS['admin_page_hooks'][$slug] ) ) {
			unset($GLOBALS['submenu']['filter_plus'][0]);
		}

    }

	/**
	 * Create menu page
	 * @param [type] $cb_function
	 */
	public function sub_menu_pages() {
		$sub_pages  = array(
			array(
				"parent_slug" => 'filter_plus',
				"page_title"  => esc_html__('Settings','filter-plus'),
				"menu_title"  => esc_html__('Settings','filter-plus'),
				"capability"  => 'read',
				"menu_slug"   => 'settings',
				"cb_function" => array($this,'filter_plus_view'),
				"position"    => 11
			)
		);

		if ( !class_exists('FilterPlusPro') ) {
			$premium_link = array(
				"parent_slug" => 'filter_plus',
				"page_title"  => '',
				"menu_title"  => esc_html__('Upgrade To Premium','filter-plus'),
				"capability"  => 'read',
				"menu_slug"   => 'https://woooplugin.com/filter-plus/',
				"cb_function" => null,
				"position"    => 11
			);

			array_push($sub_pages, $premium_link );
		}

		return $sub_pages;
	}

    /**
     * Admin view
     *
     * @return void
     */
    public function filter_plus_view() {
	?>
        <div class="wrap">
			<?php include_once \FilterPlus::core_dir() . "admin/views/shortcodes.php"; ?>
		</div>
	<?php
    }

	/**
     * Admin sub menu view
     *
     * @return void
     */
    public function filter_plus_settings_view()
    {
	?>
        <div class="wrap" id="">over view test</div>
	<?php
    }
}
