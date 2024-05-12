<?php

namespace FilterPlus\Core\Admin\FilterOptions;

defined('ABSPATH') || exit;

use \FilterPlus\Utils\Helper as Helper;

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
        switch( $column_name ) { 
			case $column_name:
				return  $item[$column_name];
            default:
                isset( $item[$column_name] ) ? $item[$column_name] : '';
            break;
        }
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
            '<input type="checkbox" name="%1$s" id="%2$s" value="checked" />',
            'ID',
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
        
        if ( isset( $_REQUEST['orderby']) && isset( $_REQUEST['order']) ) 
        {
            $args['orderby']    = sanitize_key($_REQUEST['orderby']);
            $args['order']      = sanitize_key($_REQUEST['order']);
        }

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
