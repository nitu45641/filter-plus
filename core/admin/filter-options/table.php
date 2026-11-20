<?php

namespace FilterPlus\Core\Admin\FilterOptions;

defined('ABSPATH') || exit;

use \FilterPlus\Core\Admin\FilterOptions\Helper as Helper;

if ( ! class_exists( 'WP_List_Table' )){
    require_once ABSPATH . 'wp-admin/inclueds/class-wp-list-table.php';
}

class Table extends \WP_List_Table{

    public $singular_name;
    public $plural_name;
    public $id = '';
    public $columns = [];
    
    /**
     * Show list
     */
    function __construct($all_data_of_table){

        $this->singular_name = $all_data_of_table['singular_name'];
        $this->plural_name   = $all_data_of_table['plural_name'];
        $this->columns       = $all_data_of_table['columns'];

        parent::__construct( [
            'singular' => $this->singular_name ,
            'plural'   => $this->plural_name ,
            'ajax'     => true
        ]);
    }
    
    /**
     * Get column header function
     */
    public function get_columns(){
        return $this->columns;
    }
    

    /**
     * Sortable column function
     */
    public function get_sortable_columns() {
		unset($this->columns['actions'],$this->columns['cb']);

        return $this->columns;
    }

    /**
     * Display all row function
     */
    protected function column_default( $item , $column_name ){
        $labels = array(
            'type'  => array(
                'custom_field' => esc_html__( 'Custom Field', 'filter-plus' ),
                'date_range'   => esc_html__( 'Date Range', 'filter-plus' ),
            ),
            'style' => array(
                'select'     => esc_html__( 'Select', 'filter-plus' ),
                'checkbox'   => esc_html__( 'Checkbox', 'filter-plus' ),
                'radio'      => esc_html__( 'Radio', 'filter-plus' ),
                'date_range' => esc_html__( 'Date Range', 'filter-plus' ),
            ),
        );
        $value = isset( $item[ $column_name ] ) ? $item[ $column_name ] : '';

        if ( 'actions' === $column_name ) {
            return $value; // pre-built, escaped button markup
        }
        if ( isset( $labels[ $column_name ][ $value ] ) ) {
            return '<span class="filter-option-badge">' . $labels[ $column_name ][ $value ] . '</span>';
        }
        if ( 'label' === $column_name ) {
            return '<strong>' . esc_html( $value ) . '</strong>';
        }

        return esc_html( $value );
    }

    /**
     * Hide the bulk-action bar while the list is empty (it only adds blank space).
     */
    protected function display_tablenav( $which ) {
        if ( ! $this->has_items() ) {
            return;
        }
        parent::display_tablenav( $which );
    }

    /**
     * Empty state with a direct way to create the first option.
     */
    public function no_items() {
        ?>
        <div class="filter-options-empty">
            <p class="filter-options-empty__title"><?php esc_html_e( 'No filter options yet', 'filter-plus' ); ?></p>
            <p class="filter-options-empty__text"><?php esc_html_e( 'Add a custom field filter, then pick it in the Custom Field Filter section of your filter set.', 'filter-plus' ); ?></p>
            <button type="button" class="button button-primary add-filter-opt"><?php esc_html_e( 'Add Filter Option', 'filter-plus' ); ?></button>
        </div>
        <?php
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
            '<input type="checkbox" name="bulk-delete[]" id="filter-options-delete" value="%1$s" />',
            $item['ID']
        );
    }

    /**
     * Get Bulk options
     */
    public function get_bulk_actions() {
        $actions = array();
        $actions['trash'] = esc_html__( 'Move to Trash','filter-plus' );

        return $actions;
    }

    /**
     * Delete data
    */
    public function process_bulk_action() {
        $action = $this->current_action();
        if( 'trash'===$action ) {
            if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ), 'bulk-' . $this->_args['plural'] ) ) {
                return;
            }
            if ( ! isset( $_POST['bulk-delete'] ) ) {
                return;
            }
            $delete_ids = array_map( 'absint', (array) wp_unslash( $_POST['bulk-delete'] ) );
            foreach ( $delete_ids as $did ) {
                wp_delete_post( $did, true );
            }
            wp_safe_redirect( esc_url( add_query_arg() ) );
            exit;
        }
    }

    /**
     * Main query and show function
     */
    public function preparing_items(){
        $per_page = 20;
        $column   = $this->get_columns();
        $hidden   = [];
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = [ $column , $hidden , $sortable ];
        $current_page = $this->get_pagenum();
        $offset       = ( $current_page - 1) * $per_page;
        $this->process_bulk_action();

        // phpcs:disable WordPress.Security.NonceVerification.Recommended -- Sorting parameters don't require nonce verification
        if ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
            $args['orderby'] = sanitize_key( wp_unslash( $_REQUEST['orderby'] ) );
            $args['order']   = sanitize_key( wp_unslash( $_REQUEST['order'] ) );
        }
        // phpcs:enable WordPress.Security.NonceVerification.Recommended

        $args['limit']  = $per_page;
        $args['offset'] = $offset;

        $get_data = Helper::instance()->get_filter_options();
        $this->set_pagination_args( [
            'total_items'   => count( Helper::instance()->get_filter_options() ),
            'per_page'      => $per_page,
        ] );

        
        $this->items =  $get_data;
    }

}
