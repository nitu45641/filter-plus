<?php

namespace FilterPlus\Core\Admin\FilterSets;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * Saved Filter Sets list table.
 */
class Table extends \WP_List_Table {

	public $singular_name;
	public $plural_name;
	public $columns = array();

	/**
	 * Show list
	 */
	function __construct( $all_data_of_table ) {

		$this->singular_name = $all_data_of_table['singular_name'];
		$this->plural_name   = $all_data_of_table['plural_name'];
		$this->columns       = $all_data_of_table['columns'];

		parent::__construct(
			array(
				'singular' => $this->singular_name,
				'plural'   => $this->plural_name,
				'ajax'     => true,
			)
		);
	}

	/**
	 * Get column header function
	 */
	public function get_columns() {
		return $this->columns;
	}

	/**
	 * Sortable column function
	 */
	public function get_sortable_columns() {
		unset( $this->columns['cb'] );

		return $this->columns;
	}

	/**
	 * Display default column values
	 */
	protected function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'name':
				return esc_html( $item['name'] );
			default:
				return '';
		}
	}

	/**
	 * Shortcode column - a read-only, click-to-copy field.
	 */
	protected function column_shortcode( $item ) {
		return '<div class="shortcode-cell">'
			. '<input type="text" readonly class="full_input saved-shortcode" value="' . esc_attr( $item['shortcode'] ) . '" />'
			. '<button type="button" class="button copy-filter-set">' . esc_html__( 'Copy', 'filter-plus' ) . '</button>'
			. '</div>';
	}

	/**
	 * Render the bulk edit checkbox
	 *
	 * @param array $item
	 *
	 * @return string
	 */
	function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="bulk-delete[]" id="filter-set-delete" value="%1$s" />',
			$item['ID']
		);
	}

	/**
	 * Get Bulk options
	 */
	public function get_bulk_actions() {
		$actions           = array();
		$actions['trash']  = esc_html__( 'Move to Trash', 'filter-plus' );

		return $actions;
	}

	/**
	 * Delete data
	 */
	public function process_bulk_action() {
		$action = $this->current_action();
		if ( 'trash' === $action ) {
			if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ), 'bulk-' . $this->_args['plural'] ) ) {
				return;
			}
			if ( ! isset( $_POST['bulk-delete'] ) ) {
				return;
			}
			$delete_ids = array_map( 'absint', (array) wp_unslash( $_POST['bulk-delete'] ) );
			foreach ( $delete_ids as $did ) {
				Helper::delete_filter_set( $did );
			}
			wp_safe_redirect( esc_url( add_query_arg() ) );
			exit;
		}
	}

	/**
	 * Main query and show function
	 */
	public function preparing_items() {
		$per_page = 20;
		$column   = $this->get_columns();
		$hidden   = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array( $column, $hidden, $sortable );
		$this->process_bulk_action();

		$get_data = Helper::get_filter_sets();

		$this->set_pagination_args(
			array(
				'total_items' => count( $get_data ),
				'per_page'    => $per_page,
			)
		);

		$this->items = $get_data;
	}
}
