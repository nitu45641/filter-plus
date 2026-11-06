<?php

namespace FilterPlus\Base;

defined( 'ABSPATH' ) || exit;

use FilterPlus\Utils\Singleton;

/**
 * Filter Plus Pro 50% discount banner.
 * Shown only on Filter Plus admin pages while Filter Plus Pro is not active.
 */
class PromoBanner {

	use Singleton;

	const META_KEY     = 'filterplus_pro_discount_banner_dismissed';
	const DISMISS_DAYS = 7;
	const URL          = 'https://wpbens.com/deals/#filterplus';

	/**
	 * Initialize
	 */
	public function init() {
		add_action( 'admin_notices', array( $this, 'render' ) );
		add_action( 'wp_ajax_filterplus_dismiss_discount_banner', array( $this, 'dismiss' ) );
	}

	/**
	 * Is Pro active
	 */
	private function is_pro_active() {
		return class_exists( 'FilterPlusPro' );
	}

	/**
	 * Is current screen a Filter Plus admin page
	 */
	private function is_filterplus_page() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$page = isset( $_GET['page'] ) ? sanitize_key( wp_unslash( $_GET['page'] ) ) : '';

		return 0 === strpos( $page, 'filter_plus' )
			|| 0 === strpos( $page, 'filter-plus' )
			|| in_array( $page, array( 'filter-options', 'filter-sets' ), true );
	}

	/**
	 * Should banner be shown for current user
	 */
	private function should_show() {
		if ( $this->is_pro_active() || ! current_user_can( 'manage_options' ) || ! $this->is_filterplus_page() ) {
			return false;
		}

		$dismissed = (int) get_user_meta( get_current_user_id(), self::META_KEY, true );

		return ! $dismissed || ( time() - $dismissed ) > ( self::DISMISS_DAYS * DAY_IN_SECONDS );
	}

	/**
	 * Render banner
	 */
	public function render() {
		if ( ! $this->should_show() ) {
			return;
		}

		$nonce = wp_create_nonce( 'filterplus_dismiss_discount_banner' );
		?>
		<div class="notice inline filterplus-ltd-banner is-dismissible" data-nonce="<?php echo esc_attr( $nonce ); ?>">
			<div class="filterplus-ltd-banner__badge"><?php echo esc_html__( '50% OFF', 'filter-plus' ); ?></div>
			<div class="filterplus-ltd-banner__content">
				<strong><?php echo esc_html__( 'Filter Plus Pro — 50% Off!', 'filter-plus' ); ?></strong>
				<span><?php echo esc_html__( 'Unlock 7 extra shop templates, price, rating, stock & sale filters, quick view, drag & drop filter order and every Pro feature at half price.', 'filter-plus' ); ?></span>
			</div>
			<a class="filterplus-ltd-banner__btn" href="<?php echo esc_url( self::URL ); ?>" target="_blank" rel="noopener noreferrer">
				<?php echo esc_html__( 'Grab the Deal', 'filter-plus' ); ?>
			</a>
		</div>
		<style>
			.filterplus-ltd-banner{display:flex;align-items:center;gap:18px;padding:16px 44px 16px 20px!important;margin:0!important;border:0!important;border-radius:0;background:linear-gradient(120deg,#4f46e5 0%,#7c3aed 55%,#db2777 100%)!important;box-shadow:0 6px 20px rgba(79,70,229,.25);color:#fff}
			.filterplus-ltd-banner__badge{flex-shrink:0;background:#facc15;color:#1e1b4b;font-weight:800;font-size:15px;padding:10px 12px;border-radius:6px;line-height:1;transform:rotate(-3deg);box-shadow:0 3px 8px rgba(0,0,0,.2)}
			.filterplus-ltd-banner__content{flex:1;display:flex;flex-direction:column;gap:4px;font-size:13px;color:rgba(255,255,255,.88)}
			.filterplus-ltd-banner__content strong{font-size:16px;color:#fff}
			.filterplus-ltd-banner__btn{flex-shrink:0;background:#facc15;color:#1e1b4b!important;text-decoration:none;font-weight:700;padding:10px 20px;border-radius:6px;transition:transform .15s,background .15s}
			.filterplus-ltd-banner__btn:hover{background:#fde047;transform:translateY(-1px)}
			.filterplus-ltd-banner .notice-dismiss:before{color:rgba(255,255,255,.8)}
			.filterplus-ltd-banner .notice-dismiss:hover:before{color:#fff}
			@media (max-width:782px){.filterplus-ltd-banner{flex-wrap:wrap}}
		</style>
		<script>
			jQuery(function($){
				$(document).on('click', '.filterplus-ltd-banner .notice-dismiss', function(){
					var $b = $(this).closest('.filterplus-ltd-banner');
					$.post(ajaxurl, { action: 'filterplus_dismiss_discount_banner', nonce: $b.data('nonce') });
				});
			});
		</script>
		<?php
	}

	/**
	 * AJAX dismiss
	 */
	public function dismiss() {
		check_ajax_referer( 'filterplus_dismiss_discount_banner', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error();
		}

		update_user_meta( get_current_user_id(), self::META_KEY, time() );
		wp_send_json_success();
	}
}
