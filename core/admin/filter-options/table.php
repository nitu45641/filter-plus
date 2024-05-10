<?php

namespace FilterPlus\Core\Admin\FilterOptions;

defined('ABSPATH') || exit;

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
		unset($this->columns['enable_rules']);
		unset($this->columns['action']);

        return $this->columns;
    }

    /**
     * Display all row function
     */
    protected function column_default( $item , $column_name ){
        switch( $column_name ) { 
			case "enable_rules":
				return  '<span>'.$item[$column_name].'</span>';
			case $column_name:
				return  $item[$column_name];
            default:
                isset( $item[$column_name] ) ? $item[$column_name] : '';
            break;
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

        if ( isset( $_REQUEST['orderby']) && isset( $_REQUEST['order']) ) 
        {
            $args['orderby']    = sanitize_key($_REQUEST['orderby']);
            $args['order']      = sanitize_key($_REQUEST['order']);
        }

        $args['limit']  = $per_page;
        $args['offset'] = $offset;

        $get_data = array();
        $this->set_pagination_args( [
            'total_items'   => count( array() ),
            'per_page'      => $per_page,
        ] );

        
        $this->items =  $get_data;
    }

}
