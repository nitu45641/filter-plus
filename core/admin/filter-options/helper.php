<?php

namespace FilterPlus\Core\Admin\FilterOptions;

use FilterPlus\Utils\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Helper function
 */
class Helper {

	use Singleton;

	/**
	 * Get Filter Options
	 *
	 * @return array
	 */
	public static function get_filter_options( $limit=-1 , $type='' ) { 
		$all_opts = get_posts(array('post_type'=>'filter_plus_option','posts_per_page'=> $limit));

		return self::get_filters_arr( $all_opts , $type  );
	}

	/**
	 * Get filter options
	 *
	 * @param [type] $all_opts
	 * @return array
	 */
	public static function get_filters_arr( $all_opts , $type ) {
        $filter_opt = array();

		if (!empty($all_opts)) {
			foreach ( $all_opts as $key => $value ) {
				$single_options = self::get_filter_opt($value);

                if (empty($type)) {
                    $single_options['actions'] = '
                        <span class="filter-action update-filter-option"
                        data-id="'.$value->ID.'"
                        data-label="'.$value->label.'"
                        data-type="'.$value->type.'"
                        data-style="'.$value->style.'"
                        data-custom_field_list="'.$value->custom_field_list.'"
                        ><span class="union-edit"></span></span></span>
				    ';
                    
                    array_push($filter_opt,$single_options);
                }
                else if( $type == $value->type ){
                    $filter_opt[$key] = $value->label ;
                }
			}
		}

        return $filter_opt;

	}

	public static function get_filter_opt($value) {
		$arr = array();

		if ( !empty($value) ) {
			$arr['ID'] 	= $value->ID;
			$arr['label'] 	= get_post_meta(  $value->ID , 'label' , true );
			$arr['type'] 	= get_post_meta(  $value->ID , 'type' , true );
			$arr['style'] 	= get_post_meta(  $value->ID , 'style' , true );
			$arr['custom_field_list'] 	= get_post_meta(  $value->ID , 'custom_field_list' , true );
		}

		return $arr;
	}

	/**
	 * Get custom fields values
	 *
	 * @return object
	 */
	public static function get_custom_fields_values( $key ) {
		$cache_key = 'filterplus_custom_fields_' . md5( $key );
		$meta_values = wp_cache_get( $cache_key, 'filterplus' );

		if ( false === $meta_values ) {
			global $wpdb;
			// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery -- Custom query for distinct meta values not available via WP API
			$meta_values = $wpdb->get_results( $wpdb->prepare( 'SELECT DISTINCT meta_value FROM ' . $wpdb->postmeta . ' WHERE meta_value !="" AND meta_value IS NOT NULL AND meta_key=%s', $key ), OBJECT );
			wp_cache_set( $cache_key, $meta_values, 'filterplus', HOUR_IN_SECONDS );
		}

		return $meta_values;
	}

	public static function get_filter_option_list($keys,$filter_type='custom_field') {
		$result_arr = array();
		$fields	= self::get_filter_options(-1);
		$accepted_keys = explode(',',$keys);

		foreach ($fields as $index => $value ) {
			if ( in_array($index,$accepted_keys)) {
				$result_arr[]=$value;
			}
		}

		return $result_arr;
	}

}
