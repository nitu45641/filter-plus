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
			add_menu_page(
				esc_html__( 'Shortcodes', 'filter-plus' ),
				esc_html__( 'Filter Plus', 'filter-plus' ),
				$capability,
				$slug,
				array( $this, 'filter_plus_view' ),
				'data:image/svg+xml;base64,' . base64_encode(
					'<svg width="89" height="80" viewBox="0 0 75 80" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M49.3946 79.1002L34.6998 39.461C34.4022 38.6632 35.447 38.4637 35.447 38.4637L74.3009 52.6741C75.0481 54.6685 76.0444 67.1336 69.5687 73.6155C64.3882 78.801 53.9607 79.4326 49.3946 79.1002ZM51.3871 68.879C51.3871 68.1905 51.9452 67.6324 52.6336 67.6324H55.8702V64.3901C55.8702 63.7023 56.4278 63.1448 57.1155 63.1448C57.8033 63.1448 58.3608 63.7023 58.3608 64.3901V67.6324H61.5975C62.2859 67.6324 62.844 68.1905 62.844 68.879C62.844 69.5674 62.2859 70.1255 61.5975 70.1255H58.3608V73.3674C58.3608 74.0551 57.8033 74.6127 57.1155 74.6127C56.4278 74.6127 55.8702 74.0551 55.8702 73.3674V70.1255H52.6336C51.9452 70.1255 51.3871 69.5674 51.3871 68.879Z" fill="white"/>
					<path d="M38.8426 0.173097C32.0319 0.176392 26.46 5.86365 26.46 12.6809V20.7914C26.46 21.2016 26.7921 21.534 27.2018 21.534H29.8937C30.3033 21.534 30.6355 21.2015 30.6355 20.7914V12.5737C30.6355 8.02453 34.346 4.32652 38.8968 4.35276C43.4289 4.37888 47.062 8.12778 47.062 12.6643V20.7914C47.062 21.2016 47.3942 21.534 47.8039 21.534H50.4957C50.9055 21.534 51.2376 21.2015 51.2376 20.7914V12.5737C51.2376 5.73398 45.6767 0.169802 38.8426 0.173097Z" fill="white"/>
					<path d="M33.4153 35.8682L49.2891 41.665L74.4199 50.8416L71.6422 36.3811L69.5671 25.58C69.2674 24.0198 67.9034 22.8923 66.3165 22.8923H12.7181C11.2954 22.8923 10.0521 23.7983 9.59389 25.1106C9.54028 25.2631 9.49796 25.4207 9.46692 25.5834L7.50582 35.8451C7.50582 35.8445 7.50582 35.8456 7.50582 35.8451L0.0598944 74.8124C-0.330075 76.855 1.23374 78.7485 3.31108 78.7485H47.2276L46.4872 76.7172L39.6434 57.9388L32.0846 37.2002C32.0372 37.0709 32.0169 36.9421 32.0203 36.8178C32.0338 36.1461 32.7155 35.6129 33.4153 35.8682ZM49.1498 26.3206C49.9557 26.3206 50.6092 26.9742 50.6092 27.7813C50.6092 28.588 49.9557 29.2421 49.1498 29.2421C48.3439 29.2421 47.6904 28.588 47.6904 27.7813C47.6904 26.9741 48.3439 26.3206 49.1498 26.3206ZM28.5479 26.3206C29.3538 26.3206 30.0073 26.9742 30.0073 27.7813C30.0073 28.588 29.3538 29.2421 28.5479 29.2421C27.7414 29.2421 27.0879 28.588 27.0879 27.7813C27.0879 26.9741 27.7414 26.3206 28.5479 26.3206Z" fill="white"/>
					<path d="M56.9995 59.8568C60.1475 59.8568 63.1743 59.3363 65.9982 58.3748C68.5727 57.4983 72.1974 55.2785 73.7966 53.9969C74.5502 53.4217 74.4077 52.6558 73.6917 52.395L71.1076 51.4509L70.2013 51.1196L67.8697 50.269L67.8282 50.254L67.6702 50.1962L66.4053 49.7334L63.8743 48.8089L62.9356 48.4672L62.607 48.3472L60.1579 47.4527L60.0564 47.4157L59.2515 47.1214L36.6417 38.8655L35.9395 38.6092C35.2396 38.3542 34.5604 39.034 34.8152 39.7346L36.9854 45.689L37.9182 48.2468L38.587 50.0808L40.0664 54.1389C44.7652 57.7273 50.6344 59.8568 56.9995 59.8568Z" fill="#FAFAFA"/>
					<path d="M67.8282 50.2539L67.8697 50.2689C63.6448 52.8382 58.6853 54.3166 53.3811 54.3166C47.9489 54.3166 42.8777 52.7654 38.587 50.0808L37.9182 48.2468L36.9854 45.689L34.8152 39.7346C34.5604 39.034 35.2396 38.3542 35.9395 38.6092L36.6417 38.8655L59.2515 47.1214L60.0564 47.4157L60.1578 47.4527L62.607 48.3472L62.9356 48.4672L63.8742 48.8089L66.4053 49.7334L67.6702 50.1962L67.8282 50.2539Z" fill="#F0F0F0"/>
					<path d="M36.6417 38.8655L59.2515 47.1214C56.2892 48.1937 53.0929 48.7765 49.7616 48.7765C45.1573 48.7765 40.8136 47.6627 36.9854 45.689L34.8152 39.7346C34.5604 39.034 35.2396 38.3542 35.9395 38.6092L36.6417 38.8655Z" fill="white"/>
					<path d="M33.4154 35.8682L49.2892 41.665L74.4199 50.8416L71.6422 36.3811L69.5671 25.58C69.2675 24.0198 67.9034 22.8923 66.3165 22.8923H12.7181C11.2954 22.8923 10.0522 23.7983 9.59393 25.1106C9.54032 25.2631 9.498 25.4207 9.46696 25.5834L7.50586 35.8451C7.50586 35.8456 7.50586 35.8456 7.50586 35.8462C7.50642 57.8071 24.7917 75.7258 46.4872 76.7172L39.6435 57.9388L32.0847 37.2002C32.0373 37.0709 32.017 36.9421 32.0203 36.8178C32.0339 36.1461 32.7156 35.6129 33.4154 35.8682ZM49.1498 26.3206C49.9557 26.3206 50.6092 26.9742 50.6092 27.7813C50.6092 28.588 49.9557 29.2421 49.1498 29.2421C48.3439 29.2421 47.6904 28.588 47.6904 27.7813C47.6904 26.9741 48.3439 26.3206 49.1498 26.3206ZM28.5479 26.3206C29.3538 26.3206 30.0073 26.9742 30.0073 27.7813C30.0073 28.588 29.3538 29.2421 28.5479 29.2421C27.7415 29.2421 27.088 28.588 27.088 27.7813C27.088 26.9741 27.7415 26.3206 28.5479 26.3206Z" fill="#FDFDFD"/>
					<path d="M33.4154 35.8682L49.2892 41.665L74.42 50.8416L71.6423 36.3811L69.5672 25.58C69.2675 24.0198 67.9035 22.8923 66.3166 22.8923H12.7182C11.2955 22.8923 10.0522 23.7983 9.59399 25.1106C12.2583 41.0889 24.1743 53.9332 39.6435 57.9388L32.0847 37.2002C32.0373 37.0709 32.017 36.9421 32.0204 36.8178C32.0339 36.1461 32.7156 35.6129 33.4154 35.8682ZM49.1499 26.3206C49.9558 26.3206 50.6093 26.9742 50.6093 27.7813C50.6093 28.588 49.9558 29.2421 49.1499 29.2421C48.344 29.2421 47.6905 28.588 47.6905 27.7813C47.6905 26.9741 48.344 26.3206 49.1499 26.3206ZM28.548 26.3206C29.3539 26.3206 30.0074 26.9742 30.0074 27.7813C30.0074 28.588 29.3539 29.2421 28.548 29.2421C27.7415 29.2421 27.088 28.588 27.088 27.7813C27.088 26.9741 27.7416 26.3206 28.548 26.3206Z" fill="#FBFBFB"/>
					<path d="M69.5673 25.58C69.2676 24.0198 67.9036 22.8923 66.3167 22.8923H17.0242C20.7578 28.7083 25.9221 33.5166 32.0204 36.8178C32.034 36.1461 32.7157 35.6129 33.4155 35.8682L49.2893 41.665C50.0009 41.7018 50.7177 41.7204 51.4383 41.7204C58.7872 41.7204 65.6835 39.7795 71.6423 36.3811L69.5673 25.58ZM28.548 29.2421C27.7416 29.2421 27.0881 28.588 27.0881 27.7814C27.0881 26.9742 27.7416 26.3206 28.548 26.3206C29.3539 26.3206 30.0074 26.9742 30.0074 27.7814C30.0075 28.588 29.3539 29.2421 28.548 29.2421ZM49.1499 29.2421C48.3441 29.2421 47.6905 28.588 47.6905 27.7814C47.6905 26.9742 48.3441 26.3206 49.1499 26.3206C49.9558 26.3206 50.6093 26.9742 50.6093 27.7814C50.6093 28.588 49.9558 29.2421 49.1499 29.2421Z" fill="white"/>
					</svg>
					'
				),
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
