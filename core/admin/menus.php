<?php

/**
 * Menu class
 */

namespace FilterPlus\Core\Admin;

use FilterPlus\Utils\Singleton;

/**
 * Class Menu
 */
class Menus {

	use Singleton;

	public $capability = 'read';

	/**
	 * Initialize
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
	}


	/**
	 * Register admin menu
	 *
	 * @return void
	 */
	public function register_admin_menu() {
		$capability = $this->capability;
		$slug       = 'filter_plus';

		// Add main page
		if ( empty( $GLOBALS['admin_page_hooks'][ $slug ] ) ) {
			$logo = \FilterPlus::assets_url() . 'images/logo.png' ;
			add_menu_page(
				esc_html__( 'Shortcodes', 'filter-plus' ),
				esc_html__( 'Filter Plus', 'filter-plus' ),
				$capability,
				$slug,
				array( $this, 'filter_plus_view' ),
				$logo,
				10
			);
		}

		// Add submenu pages
		if ( count( $this->sub_menu_pages() ) > 0 ) {
			foreach ( $this->sub_menu_pages() as $key => $value ) {
				add_submenu_page(
					$value['parent_slug'],
					$value['page_title'],
					$value['menu_title'],
					$value['capability'],
					$value['menu_slug'],
					$value['cb_function'],
					$value['position']
				);
			}
		}

		if ( ! empty( $GLOBALS['admin_page_hooks'][ $slug ] ) ) {
			unset( $GLOBALS['submenu']['filter_plus'][0] );
		}
	}

	/**
	 * Create menu page
	 *
	 * @param [type] $cb_function
	 */
	public function sub_menu_pages() {
		$sub_pages = array(
			array(
				'parent_slug' => 'filter_plus',
				'page_title'  => esc_html__( 'Overview', 'filter-plus' ),
				'menu_title'  => esc_html__( 'Overview', 'filter-plus' ),
				'capability'  => $this->capability,
				'menu_slug'   => 'filter-plus-overview',
				'cb_function' => array( $this, 'over_view' ),
				'position'    => 11,
			),
			array(
				'parent_slug' => 'filter_plus',
				'page_title'  => esc_html__( 'Filter Options', 'filter-plus' ),
				'menu_title'  => esc_html__( 'Filter Options', 'filter-plus' ),
				'capability'  => $this->capability,
				'menu_slug'   => 'filter-options',
				'cb_function' => array( $this, 'filter_options' ),
				'position'    => 11,
			),
			array(
				'parent_slug' => 'filter_plus',
				'page_title'  => esc_html__( 'Filter Sets', 'filter-plus' ),
				'menu_title'  => esc_html__( 'Filter Sets', 'filter-plus' ),
				'capability'  => $this->capability,
				'menu_slug'   => 'filter-sets',
				'cb_function' => array( $this, 'filter_sets' ),
				'position'    => 11,
			),
			array(
				'parent_slug' => 'filter_plus',
				'page_title'  => esc_html__( 'Settings', 'filter-plus' ),
				'menu_title'  => esc_html__( 'Settings', 'filter-plus' ),
				'capability'  => $this->capability,
				'menu_slug'   => 'filter-plus-settings',
				'cb_function' => array( $this, 'filter_plus_view' ),
				'position'    => 11,
			),
		);

		if ( ! class_exists( 'FilterPlusPro' ) ) {
			$premium_link = array(
				'parent_slug' => 'filter_plus',
				'page_title'  => '',
				'menu_title'  => esc_html__( 'Upgrade To Premium', 'filter-plus' ),
				'capability'  => $this->capability,
				'menu_slug'   => 'https://woooplugin.com/filter-plus/',
				'cb_function' => null,
				'position'    => 11,
			);

			array_push( $sub_pages, $premium_link );
		}

		return $sub_pages;
	}
	
	/**
	 * Filter Options
	 *
	 */
	function filter_options() {
		if (file_exists(\FilterPlus::core_dir() . 'admin/header.php')) {
			require_once \FilterPlus::core_dir() . 'admin/header.php';
		}
		?>
		<div class="wrap">
		<?php
			if (file_exists(\FilterPlus::core_dir() . 'admin/filter-options/filter-options.php')) {
				include_once \FilterPlus::core_dir() . 'admin/filter-options/filter-options.php';
			}
		?>
		</div>
		<?php
	}

	/**
	 * OverView
	 *
	 * @return void
	 */
	public function over_view() {
		if (file_exists(\FilterPlus::core_dir() . 'admin/header.php')) {
			require_once \FilterPlus::core_dir() . 'admin/header.php';
		}
		if (file_exists(\FilterPlus::core_dir() . 'admin/overview.php')) {
			include_once \FilterPlus::core_dir() . 'admin/overview.php';
		}
	}

	/**
	 * OverView
	 *
	 * @return void
	 */
	public function filter_sets() {
		if (file_exists(\FilterPlus::core_dir() . 'admin/header.php')) {
			require_once \FilterPlus::core_dir() . 'admin/header.php';
		}
		?>
			<div class="wrap"><?php include_once \FilterPlus::core_dir() . 'admin/filter-set.php'; ?></div>
		<?php
	}

	/**
	 * Admin view
	 *
	 * @return void
	 */
	public function filter_plus_view() {
		require_once \FilterPlus::core_dir() . 'admin/header.php';
		?>
		<div class="wrap">
			<?php include_once \FilterPlus::core_dir() . 'admin/settings/settings.php'; ?>
		</div>
		<?php
	}
}
