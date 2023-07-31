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
        global $submenu;
        $capability = 'read';
        $slug       = 'filter_plus';

		// Add main page
        add_menu_page(
            esc_html__('Shortcodes', 'filter-plus'),
            esc_html__('Filter Plus', 'filter-plus'),
            $capability,
            $slug,
            array($this, 'filter_plus_view'),
            "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBzdGFuZGFsb25lPSJubyI/PgogICAgICAgIDwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgCiAgICAgICAgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+IDxzdmcgc3R5bGU9ImNvbG9yOiBibHVlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCI+PHBhdGggZD0iTTE1LDEwSDEyVjdhMSwxLDAsMCwwLTIsMHYzSDdhMSwxLDAsMCwwLDAsMmgzdjNhMSwxLDAsMCwwLDIsMFYxMmgzYTEsMSwwLDAsMCwwLTJabTYuNzEsMTAuMjlMMTgsMTYuNjFBOSw5LDAsMSwwLDE2LjYxLDE4bDMuNjgsMy42OGExLDEsMCwwLDAsMS40MiwwQTEsMSwwLDAsMCwyMS43MSwyMC4yOVpNMTEsMThhNyw3LDAsMSwxLDctN0E3LDcsMCwwLDEsMTEsMThaIiBmaWxsPSJibHVlIj48L3BhdGg+PC9zdmc+IA==",
            10
        );

		// Add submenu pages
		if (count( $this->sub_menu_pages() ) > 0 ) {
			foreach ( $this->sub_menu_pages() as $key => $value ) {
				add_submenu_page( $value['parent_slug'], $value['page_title'], __( $value['menu_title'], 'filter-plus' ),
				$value['capability'], $value['menu_slug'], $value['cb_function'] , $value['position'] );
			}

			global $submenu;
			$submenu['filter_plus'][0][0] = esc_html__('Over View','filter-plus');
		}

    }

	/**
	 * Create menu page
	 * @param [type] $cb_function
	 */
	public function sub_menu_pages() {
		$sub_pages  = array();

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
