<?php

namespace FilterPlus\Base;

defined( 'ABSPATH' ) || exit;

/**
 * Sortable filter sidebar sections.
 *
 * One ordering source for every UI: the `filter_order` shortcode attribute
 * (comma separated section keys, e.g. "price,category,color"). The admin
 * drag & drop, a raw shortcode and the Elementor widget all just set that
 * attribute; templates never need to know where the order came from.
 *
 * Template usage:
 *
 *     SidebarSections::begin( $filter_order );       // right after the sidebar opens
 *         ...fixed markup (title, buttons, search)...
 *         SidebarSections::start( 'price' );
 *             ...price range markup / include...
 *         SidebarSections::end();
 *     SidebarSections::render();                      // right before the sidebar closes
 *
 * Fixed markup between begin() and render() stays exactly where it is. Each
 * start()/end() block is a slot; sections are re-dealt into those slots in
 * the requested order. Keys missing from the order keep their template
 * order after the listed ones. start()/end() outside begin()/render() are
 * pass-through, so shared parts can be wrapped safely.
 *
 * Ordering is a Pro feature - without Filter Plus Pro the template order is
 * always kept (filterable via `filterplus_sidebar_sections_sortable`).
 *
 * @since 1.1.39
 */
class SidebarSections {

	/**
	 * Open render frames (nesting-safe).
	 *
	 * @var array
	 */
	private static $frames = array();

	/**
	 * Section keys per filter type with admin labels. Single source for the
	 * admin accordion, Elementor controls and validation.
	 *
	 * @param string $type 'woo' or 'wp'.
	 *
	 * @return array key => label
	 */
	public static function keys( $type = 'woo' ) {
		$keys = 'wp' === $type
			? array(
				'search'       => esc_html__( 'Search Filter', 'filter-plus' ),
				'category'     => esc_html__( 'Category Filter', 'filter-plus' ),
				'tags'         => esc_html__( 'Tag Filter', 'filter-plus' ),
				'author'       => esc_html__( 'Author Filter', 'filter-plus' ),
				'custom_field' => esc_html__( 'Custom Field Filter', 'filter-plus' ),
			)
			: array(
				'search'     => esc_html__( 'Search Filter', 'filter-plus' ),
				'category'   => esc_html__( 'Category Filter', 'filter-plus' ),
				'brand'      => esc_html__( 'Brand Filter', 'filter-plus' ),
				'color'      => esc_html__( 'Color Filter', 'filter-plus' ),
				'size'       => esc_html__( 'Size Filter', 'filter-plus' ),
				'tags'       => esc_html__( 'Tag Filter', 'filter-plus' ),
				'attributes' => esc_html__( 'Attribute Filter', 'filter-plus' ),
				'price'      => esc_html__( 'Price Range Filter', 'filter-plus' ),
				'reviews'    => esc_html__( 'Review Filter', 'filter-plus' ),
				'stock'      => esc_html__( 'Stock Filter', 'filter-plus' ),
				'on_sale'    => esc_html__( 'On Sale Filter', 'filter-plus' ),
			);

		return apply_filters( 'filterplus_sidebar_section_keys', $keys, $type );
	}

	/**
	 * Register a "Filter Order" section on an Elementor widget.
	 *
	 * Uses a Repeater (drag & drop rows); saved value is a list of
	 * [ 'section' => key ] rows, which parse_order() already understands,
	 * so it flows through `filter_order` like the admin drag & drop.
	 *
	 * @param \Elementor\Widget_Base $widget Widget instance.
	 * @param string                 $type   'woo' or 'wp'.
	 *
	 * @return void
	 */
	public static function register_elementor_controls( $widget, $type = 'woo' ) {
		if ( ! class_exists( '\Elementor\Repeater' ) ) {
			return;
		}

		$keys = self::keys( $type );

		$widget->start_controls_section(
			'filter_order_section',
			array(
				'label' => esc_html__( 'Filter Order', 'filter-plus' ) . ( self::is_sortable() ? '' : ' (Pro)' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		if ( ! self::is_sortable() ) {
			$widget->add_control(
				'filter_order_pro_notice',
				array(
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'raw'  => sprintf(
						'<div class="elementor-control-field-description">%1$s <a href="%2$s" target="_blank">%3$s</a></div>',
						esc_html__( 'Drag & drop to reorder the sidebar filters is a Pro feature.', 'filter-plus' ),
						esc_url( 'https://wpbens.com/filter-plus/' ),
						esc_html__( 'Upgrade to Pro', 'filter-plus' )
					),
				)
			);
			$widget->end_controls_section();
			return;
		}

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'section',
			array(
				'label'   => esc_html__( 'Filter', 'filter-plus' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $keys,
				'default' => key( $keys ),
			)
		);

		$default = array();
		foreach ( array_keys( $keys ) as $key ) {
			$default[] = array( 'section' => $key );
		}

		$title_map = wp_json_encode( $keys );

		$widget->add_control(
			'filter_order',
			array(
				'label'         => esc_html__( 'Drag & drop to reorder sidebar filters', 'filter-plus' ),
				'type'          => \Elementor\Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'default'       => $default,
				// show the readable label, fall back to the key
				'title_field'   => '<# var fpMap = ' . $title_map . '; #>{{{ fpMap[ section ] || section }}}',
				'prevent_empty' => false,
				'description'   => esc_html__( 'Filters are shown only when enabled above. Sections missing from this list keep their default position.', 'filter-plus' ),
			)
		);

		$widget->end_controls_section();
	}

	/**
	 * Is reordering available?
	 *
	 * @return bool
	 */
	public static function is_sortable() {
		return (bool) apply_filters( 'filterplus_sidebar_sections_sortable', class_exists( 'FilterPlusPro' ) );
	}

	/**
	 * Normalize an order value (string "a,b" or array) to a clean key list.
	 *
	 * @param string|array $order Raw order.
	 *
	 * @return array
	 */
	public static function parse_order( $order ) {
		if ( is_string( $order ) ) {
			$order = explode( ',', $order );
		}
		if ( ! is_array( $order ) ) {
			return array();
		}

		$clean = array();
		foreach ( $order as $key ) {
			$key = sanitize_key( is_array( $key ) ? ( isset( $key['section'] ) ? $key['section'] : '' ) : $key );
			if ( '' !== $key && ! in_array( $key, $clean, true ) ) {
				$clean[] = $key;
			}
		}

		return $clean;
	}

	/**
	 * Start collecting a sidebar.
	 *
	 * @param string|array $order Section order (shortcode `filter_order`).
	 *
	 * @return void
	 */
	public static function begin( $order = '' ) {
		self::$frames[] = array(
			'order'   => self::is_sortable() ? self::parse_order( $order ) : array(),
			'chunks'  => array(),
			'current' => null,
		);
		ob_start();
	}

	/**
	 * Start a sortable section.
	 *
	 * @param string $key Section key.
	 *
	 * @return void
	 */
	public static function start( $key ) {
		$index = count( self::$frames ) - 1;
		if ( $index < 0 || null !== self::$frames[ $index ]['current'] ) {
			return; // no frame, or already inside a section: pass-through
		}

		self::$frames[ $index ]['chunks'][] = array( 'type' => 'static', 'html' => ob_get_clean() );
		self::$frames[ $index ]['current']  = sanitize_key( $key );
		ob_start();
	}

	/**
	 * End the current section.
	 *
	 * @return void
	 */
	public static function end() {
		$index = count( self::$frames ) - 1;
		if ( $index < 0 || null === self::$frames[ $index ]['current'] ) {
			return;
		}

		self::$frames[ $index ]['chunks'][] = array(
			'type' => 'section',
			'key'  => self::$frames[ $index ]['current'],
			'html' => ob_get_clean(),
		);
		self::$frames[ $index ]['current']  = null;
		ob_start();
	}

	/**
	 * Close the frame and print the sidebar with sections in order.
	 *
	 * @return void
	 */
	public static function render() {
		$frame = array_pop( self::$frames );
		if ( null === $frame ) {
			return;
		}

		if ( null !== $frame['current'] ) {
			// unbalanced start() - close it so nothing is lost
			$frame['chunks'][] = array( 'type' => 'section', 'key' => $frame['current'], 'html' => ob_get_clean() );
			ob_start();
		}
		$frame['chunks'][] = array( 'type' => 'static', 'html' => ob_get_clean() );

		// Listed sections are re-dealt, in the requested order, into the slots
		// the listed sections occupy; sections missing from the order (e.g. a
		// section added after the set was saved) keep their own slot.
		$listed = array();
		foreach ( $frame['chunks'] as $position => $chunk ) {
			if ( 'section' === $chunk['type'] && false !== array_search( $chunk['key'], $frame['order'], true ) ) {
				$listed[] = array(
					'rank'     => array_search( $chunk['key'], $frame['order'], true ),
					'position' => $position,
					'html'     => $chunk['html'],
				);
			}
		}

		usort(
			$listed,
			function ( $a, $b ) {
				return $a['rank'] === $b['rank'] ? $a['position'] - $b['position'] : ( $a['rank'] < $b['rank'] ? -1 : 1 );
			}
		);

		$html = '';
		foreach ( $frame['chunks'] as $chunk ) {
			if ( 'section' === $chunk['type'] && false !== array_search( $chunk['key'], $frame['order'], true ) ) {
				$next  = array_shift( $listed );
				$html .= $next ? $next['html'] : '';
			} else {
				$html .= $chunk['html'];
			}
		}

		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- already-escaped template output, only reordered.
	}
}
