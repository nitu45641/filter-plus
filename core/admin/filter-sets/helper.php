<?php

namespace FilterPlus\Core\Admin\FilterSets;

use FilterPlus\Utils\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Filter Sets Helper
 *
 * Saved filter shortcodes are stored as a custom post type so a user can
 * name a configured shortcode, reuse it, or edit it later without
 * rebuilding it field by field.
 *
 * @since 1.0.0
 */
class Helper {

	use Singleton;

	const POST_TYPE = 'filterplus_set';

	/**
	 * Register the "Filter Set" custom post type.
	 *
	 * Internal storage only — no public/admin UI is generated for it,
	 * the Filter Sets admin page renders its own list and form.
	 *
	 * @return void
	 */
	public static function register_post_type() {
		register_post_type(
			self::POST_TYPE,
			array(
				'label'           => esc_html__( 'Filter Sets', 'filter-plus' ),
				'public'          => false,
				'show_ui'         => false,
				'show_in_menu'    => false,
				'show_in_rest'    => false,
				'capability_type' => 'post',
				'map_meta_cap'    => true,
				'supports'        => array( 'title' ),
			)
		);
	}

	/**
	 * Save (insert or update) a filter set.
	 *
	 * @param int    $id        Existing post ID, or 0 to create a new set.
	 * @param string $name      Set name (post title).
	 * @param string $type      Shortcode name (filter_products|wp_filter_plus).
	 * @param string $shortcode Full generated shortcode text.
	 * @param array  $params    Raw field values, kept so the set can repopulate the form on edit.
	 *
	 * @return int Post ID, or 0 on failure.
	 */
	public static function save_filter_set( $id, $name, $type, $shortcode, $params ) {
		$post_args = array(
			'post_title'  => $name,
			'post_type'   => self::POST_TYPE,
			'post_status' => 'publish',
		);

		if ( ! empty( $id ) && self::POST_TYPE === get_post_type( $id ) ) {
			$post_args['ID'] = $id;
			$post_id         = wp_update_post( $post_args, true );
		} else {
			$post_id = wp_insert_post( $post_args, true );
		}

		if ( is_wp_error( $post_id ) || empty( $post_id ) ) {
			return 0;
		}

		update_post_meta( $post_id, 'filter_type', $type );
		update_post_meta( $post_id, 'shortcode', $shortcode );
		update_post_meta( $post_id, 'params', $params );

		return $post_id;
	}

	/**
	 * Get all saved filter sets.
	 *
	 * @param int    $limit
	 * @param string $type Optional shortcode name to filter by.
	 *
	 * @return array
	 */
	public static function get_filter_sets( $limit = -1, $type = '' ) {
		$posts = get_posts(
			array(
				'post_type'      => self::POST_TYPE,
				'posts_per_page' => $limit,
				'orderby'        => 'date',
				'order'          => 'DESC',
			)
		);

		$sets = array();

		foreach ( $posts as $post ) {
			$set = self::get_filter_set( $post->ID, $post );

			if ( ! empty( $type ) && $set['type'] !== $type ) {
				continue;
			}

			$sets[] = $set;
		}

		return $sets;
	}

	/**
	 * Get a single filter set as an array.
	 *
	 * @param int          $id
	 * @param \WP_Post|null $post Optional post object, to avoid a redundant lookup.
	 *
	 * @return array
	 */
	public static function get_filter_set( $id, $post = null ) {
		if ( empty( $post ) ) {
			$post = get_post( $id );
		}

		if ( empty( $post ) ) {
			return array();
		}

		$params = get_post_meta( $post->ID, 'params', true );

		return array(
			'ID'        => $post->ID,
			'name'      => $post->post_title,
			'type'      => get_post_meta( $post->ID, 'filter_type', true ),
			'shortcode' => get_post_meta( $post->ID, 'shortcode', true ),
			'params'    => is_array( $params ) ? $params : array(),
		);
	}

	/**
	 * Permanently delete a filter set.
	 *
	 * @param int $id
	 *
	 * @return bool
	 */
	public static function delete_filter_set( $id ) {
		$post = get_post( $id );

		if ( empty( $post ) || self::POST_TYPE !== $post->post_type ) {
			return false;
		}

		return (bool) wp_delete_post( $id, true );
	}
}
