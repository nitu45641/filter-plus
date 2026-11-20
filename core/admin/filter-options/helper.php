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
                    $single_options['actions'] = sprintf(
                        '<button type="button" class="button button-small filter-action update-filter-option" data-id="%1$s" data-label="%2$s" data-type="%3$s" data-style="%4$s" data-custom_field_list="%5$s" aria-label="%6$s"><span class="union-edit" aria-hidden="true"></span>%7$s</button>',
                        esc_attr( $value->ID ),
                        esc_attr( $single_options['label'] ),
                        esc_attr( $single_options['type'] ),
                        esc_attr( $single_options['style'] ),
                        esc_attr( $single_options['custom_field_list'] ),
                        /* translators: %s: filter option label */
                        esc_attr( sprintf( __( 'Edit %s', 'filter-plus' ), $single_options['label'] ) ),
                        esc_html__( 'Edit', 'filter-plus' )
                    );
                    
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

	/**
	 * Convert a stored date meta value to Y-m-d. Handles the formats ACF and
	 * most plugins save: Ymd (ACF date picker), Y-m-d[ H:i:s] and Unix timestamps.
	 *
	 * @param string $value Raw meta value.
	 * @return string Y-m-d, or '' when it isn't a date.
	 */
	public static function normalize_date( $value ) {
		$value = trim( (string) $value );
		if ( preg_match( '/^(\d{4})(\d{2})(\d{2})$/', $value, $m ) && checkdate( (int) $m[2], (int) $m[3], (int) $m[1] ) ) {
			return $m[1] . '-' . $m[2] . '-' . $m[3];
		}
		if ( preg_match( '/^(\d{4})-(\d{2})-(\d{2})/', $value, $m ) && checkdate( (int) $m[2], (int) $m[3], (int) $m[1] ) ) {
			return $m[1] . '-' . $m[2] . '-' . $m[3];
		}
		if ( preg_match( '/^\d{9,11}$/', $value ) ) {
			return gmdate( 'Y-m-d', (int) $value );
		}
		return '';
	}

	/**
	 * How a date custom field is stored: 'ymd' (20261120), 'date' (2026-11-20…)
	 * or 'timestamp'. Detected from the stored values.
	 *
	 * @param string $key Meta key.
	 * @return string
	 */
	public static function date_storage_format( $key ) {
		foreach ( (array) self::get_custom_fields_values( $key ) as $row ) {
			$value = trim( (string) $row->meta_value );
			if ( preg_match( '/^\d{8}$/', $value ) ) {
				return 'ymd';
			}
			if ( preg_match( '/^\d{4}-\d{2}-\d{2}/', $value ) ) {
				return 'date';
			}
			if ( preg_match( '/^\d{9,11}$/', $value ) ) {
				return 'timestamp';
			}
		}
		return 'date';
	}

	/**
	 * Earliest and latest date stored in a custom field (Y-m-d), for the
	 * date pickers' min/max.
	 *
	 * @param string $key Meta key.
	 * @return array{min:string,max:string}
	 */
	public static function get_date_bounds( $key ) {
		$dates = array();
		foreach ( (array) self::get_custom_fields_values( $key ) as $row ) {
			$date = self::normalize_date( $row->meta_value );
			if ( '' !== $date ) {
				$dates[] = $date;
			}
		}
		sort( $dates );

		return array(
			'min' => $dates ? reset( $dates ) : '',
			'max' => $dates ? end( $dates ) : '',
		);
	}

	/**
	 * Numeric spread of a custom field across published content: rounded
	 * min / max and a 20-bar histogram, for the Price Range filter.
	 *
	 * @param string $key Meta key.
	 * @return array{min:float,max:float,step:float,bars:int[]}
	 */
	public static function get_number_stats( $key ) {
		$cache_key = 'filterplus_num_' . md5( $key );
		$stats     = wp_cache_get( $cache_key, 'filterplus' );
		if ( false !== $stats ) {
			return $stats;
		}

		global $wpdb;
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery -- aggregate over one meta key, cached above
		$rows = $wpdb->get_col( $wpdb->prepare(
			"SELECT pm.meta_value FROM {$wpdb->postmeta} pm INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
			 WHERE pm.meta_key = %s AND p.post_status = 'publish' AND pm.meta_value <> ''",
			$key
		) );

		$values = array();
		foreach ( (array) $rows as $raw ) {
			$num = str_replace( array( ',', ' ' ), '', (string) $raw );
			if ( is_numeric( $num ) ) {
				$values[] = (float) $num;
			}
		}

		$stats = array( 'min' => 0, 'max' => 0, 'step' => 1, 'bars' => array() );
		if ( $values ) {
			$min  = floor( min( $values ) );
			$max  = ceil( max( $values ) );
			$max  = $max > $min ? $max : $min + 1;
			$bars = array_fill( 0, 20, 0 );
			foreach ( $values as $v ) {
				$i = (int) floor( ( $v - $min ) / ( $max - $min ) * 20 );
				++$bars[ min( 19, max( 0, $i ) ) ];
			}
			$stats = array(
				'min'  => $min,
				'max'  => $max,
				'step' => ( $max - $min ) > 200 ? 5 : 1,
				'bars' => $bars,
			);
		}

		wp_cache_set( $cache_key, $stats, 'filterplus', HOUR_IN_SECONDS );
		return $stats;
	}

	/**
	 * Meta keys of filter options that use a given style.
	 *
	 * @param string $style e.g. 'date_range', 'price_range', 'rating'.
	 * @return string[]
	 */
	public static function keys_with_style( $style ) {
		$keys = array();
		foreach ( self::get_filter_options( -1 ) as $option ) {
			if ( isset( $option['style'] ) && $style === $option['style'] && ! empty( $option['custom_field_list'] ) ) {
				$keys[] = $option['custom_field_list'];
			}
		}
		return $keys;
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
