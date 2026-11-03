<?php

namespace FilterPlus\Core\Admin\FilterSets;

use FilterPlus\Utils\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Live preview of a Filter Set's sidebar.
 *
 * Renders the real shortcode output on a bare front-end page (theme +
 * plugin public assets via wp_head/wp_footer) so the admin preview iframe
 * always shows the actual filter templates. Any future template/UX change
 * shows up here automatically - nothing preview-specific to keep in sync.
 *
 * @since 1.1.39
 */
class Preview {

	use Singleton;

	const QUERY_VAR = 'filterplus_preview';
	const NONCE     = 'filterplus_filter_set_preview';

	/**
	 * Shortcodes the preview is allowed to render.
	 *
	 * @var array
	 */
	private $allowed_tags = array( 'filter_products', 'wp_filter_plus' );

	/**
	 * Initialize
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'template_redirect', array( $this, 'render' ), 0 );
	}

	/**
	 * Preview endpoint URL (front end, so theme + public assets load).
	 *
	 * @return string
	 */
	public static function url() {
		return add_query_arg( self::QUERY_VAR, '1', home_url( '/' ) );
	}

	/**
	 * Output the preview page and stop.
	 *
	 * @return void
	 */
	public function render() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- flag only, nonce verified below.
		if ( empty( $_GET[ self::QUERY_VAR ] ) ) {
			return;
		}

		if ( ! current_user_can( 'manage_options' )
			|| empty( $_POST['_wpnonce'] )
			|| ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ), self::NONCE ) ) {
			status_header( 403 );
			wp_die( esc_html__( 'Preview not allowed.', 'filter-plus' ), '', array( 'response' => 403 ) );
		}

		$shortcode = isset( $_POST['shortcode'] ) ? wp_unslash( $_POST['shortcode'] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- parsed and sanitized per attribute below.
		$html      = $this->render_shortcode( $shortcode );

		show_admin_bar( false );
		nocache_headers();
		header( 'X-Robots-Tag: noindex, nofollow' );
		header( 'X-Frame-Options: SAMEORIGIN' );

		?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, nofollow">
	<script>
		// Front-end scripts scroll to the results on load; inside the admin iframe
		// that would scroll the preview panel itself, so make scrolling a no-op.
		( function () {
			var noop = function () {};
			window.scrollTo = window.scroll = window.scrollBy = noop;
			Element.prototype.scrollIntoView = noop;
			var focus = HTMLElement.prototype.focus;
			HTMLElement.prototype.focus = function () {
				return focus.call( this, { preventScroll: true } );
			};
		} )();
	</script>
	<?php wp_head(); ?>
	<style id="filterplus-preview-css">
		html, body { margin: 0 !important; padding: 0 !important; background: #fff !important; min-height: 0 !important; height: auto !important; }
		body.filterplus-preview { padding: 12px !important; overflow: hidden; }
		/* only the filter: drop footer widgets other plugins inject (floating side-cart bubble, chat, cookie bars...) */
		body.filterplus-preview > :not(.shopContainer):not(script):not(style):not(link) { display: none !important; }
		.filterplus-preview .shopContainer { display: block !important; width: 100% !important; max-width: none !important; margin: 0 !important; padding: 0 !important; }
		.filterplus-preview .shopContainer > :not(.shop-sidebar) { display: none !important; }
		/* the preview frame is phone-width, where the sidebar turns into a hidden off-canvas drawer - undo that */
		.filterplus-preview .shop-sidebar { display: block !important; position: static !important; inset: auto !important; left: auto !important; width: 100% !important; max-width: none !important; height: auto !important; max-height: none !important; overflow: visible !important; flex: none !important; transform: none !important; opacity: 1 !important; visibility: visible !important; box-shadow: none !important; margin: 0 !important; z-index: auto !important; }
		.filterplus-preview a { pointer-events: none; }
	</style>
</head>
<body class="filterplus-preview">
	<?php echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- shortcode output, escaped by its templates. ?>
	<?php wp_footer(); ?>
</body>
</html>
		<?php
		exit;
	}

	/**
	 * Parse "[tag attr="value" ...]" and render it through the plugin's own
	 * shortcode callbacks. Only our two tags are accepted - never arbitrary
	 * do_shortcode() input.
	 *
	 * @param string $shortcode Raw shortcode string from the settings form.
	 *
	 * @return string
	 */
	private function render_shortcode( $shortcode ) {
		$shortcode = trim( (string) $shortcode );

		if ( ! preg_match( '/^\[([a-z_]+)\s*(.*?)\]$/s', $shortcode, $match ) || ! in_array( $match[1], $this->allowed_tags, true ) ) {
			return '<p>' . esc_html__( 'Nothing to preview.', 'filter-plus' ) . '</p>';
		}

		$atts = shortcode_parse_atts( $match[2] );
		$atts = is_array( $atts ) ? $atts : array();

		$clean = array();
		foreach ( $atts as $key => $value ) {
			if ( ! is_string( $key ) ) {
				continue;
			}
			$clean[ sanitize_key( $key ) ] = sanitize_text_field( $value );
		}

		$shortcodes = \FilterPlus\Core\Frontend\Shortcodes::instance();

		return 'wp_filter_plus' === $match[1]
			? (string) $shortcodes->wp_filter_plus( $clean )
			: (string) $shortcodes->filter_plus( $clean );
	}
}
