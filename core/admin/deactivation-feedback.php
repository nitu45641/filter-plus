<?php
/**
 * Deactivation Feedback
 *
 * Shows a feedback modal when the user deactivates the plugin.
 *
 * @package FilterPlus
 */

namespace FilterPlus\Core\Admin;

defined( 'ABSPATH' ) || exit;

use FilterPlus\Utils\Singleton;

class DeactivationFeedback {

	use Singleton;

	/**
	 * Plugin basename.
	 *
	 * @var string
	 */
	private $plugin_basename;

	/**
	 * API endpoint to receive feedback.
	 *
	 * @var string
	 */
	private $api_url = 'https://wpbens.com/wp-json/filter-plus/v1/deactivation-feedback';

	/**
	 * Initialize hooks.
	 *
	 * @return void
	 */
	public function init() {
		$this->plugin_basename = \FilterPlus::plugins_basename();

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		add_action( 'admin_footer', array( $this, 'render_modal' ) );
		add_action( 'wp_ajax_filter_plus_deactivation_feedback', array( $this, 'handle_feedback' ) );
	}

	/**
	 * Only load on the plugins page.
	 *
	 * @return bool
	 */
	private function is_plugins_page() {
		$screen = get_current_screen();
		return $screen && 'plugins' === $screen->id;
	}

	/**
	 * Enqueue modal assets on plugins page only.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		if ( ! $this->is_plugins_page() ) {
			return;
		}

		wp_enqueue_style(
			'filter-plus-deactivation-feedback',
			\FilterPlus::assets_url() . 'css/deactivation-feedback.css',
			array(),
			\FilterPlus::get_version()
		);

		wp_enqueue_script(
			'filter-plus-deactivation-feedback',
			\FilterPlus::assets_url() . 'js/deactivation-feedback.js',
			array( 'jquery' ),
			\FilterPlus::get_version(),
			true
		);

		wp_localize_script(
			'filter-plus-deactivation-feedback',
			'filter_plus_deactivation',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'filter_plus_deactivation_feedback' ),
				'slug'     => dirname( $this->plugin_basename ),
			)
		);
	}

	/**
	 * Get feedback reasons.
	 *
	 * @return array
	 */
	private function get_reasons() {
		return array(
			'no_longer_needed'        => esc_html__( 'I no longer need the plugin', 'filter-plus' ),
			'found_better_plugin'     => esc_html__( 'I found a better plugin', 'filter-plus' ),
			'could_not_get_to_work'   => esc_html__( 'I couldn\'t get the plugin to work', 'filter-plus' ),
			'temporary_deactivation'  => esc_html__( 'It\'s a temporary deactivation', 'filter-plus' ),
			'plugin_broke_site'       => esc_html__( 'The plugin broke my site', 'filter-plus' ),
			'plugin_suddenly_stopped' => esc_html__( 'The plugin suddenly stopped working', 'filter-plus' ),
			'missing_feature'         => esc_html__( 'I need a specific feature that is missing', 'filter-plus' ),
			'other'                   => esc_html__( 'Other', 'filter-plus' ),
		);
	}

	/**
	 * Render the feedback modal HTML in the admin footer.
	 *
	 * @return void
	 */
	public function render_modal() {
		if ( ! $this->is_plugins_page() ) {
			return;
		}

		$reasons = $this->get_reasons();
		?>
		<div id="filter-plus-deactivation-modal" class="filter-plus-deactivation-modal" style="display:none;">
			<div class="filter-plus-deactivation-modal-overlay"></div>
			<div class="filter-plus-deactivation-modal-content">
				<div class="filter-plus-deactivation-modal-header">
					<h3><?php esc_html_e( 'Quick Feedback', 'filter-plus' ); ?></h3>
					<p><?php esc_html_e( 'If you have a moment, please let us know why you are deactivating Filter Plus:', 'filter-plus' ); ?></p>
				</div>
				<div class="filter-plus-deactivation-modal-body">
					<ul class="filter-plus-deactivation-reasons">
						<?php foreach ( $reasons as $key => $label ) : ?>
							<li>
								<label>
									<input type="radio" name="filter_plus_deactivation_reason" value="<?php echo esc_attr( $key ); ?>" />
									<span><?php echo esc_html( $label ); ?></span>
								</label>
								<?php if ( in_array( $key, array( 'found_better_plugin', 'missing_feature', 'other' ), true ) ) : ?>
									<input type="text"
										class="filter-plus-deactivation-detail"
										style="display:none;"
										placeholder="<?php
										if ( 'found_better_plugin' === $key ) {
											esc_attr_e( 'Please share the plugin name', 'filter-plus' );
										} elseif ( 'missing_feature' === $key ) {
											esc_attr_e( 'Please describe the feature', 'filter-plus' );
										} else {
											esc_attr_e( 'Please share your reason', 'filter-plus' );
										}
										?>"
									/>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="filter-plus-deactivation-modal-footer">
					<button class="button button-secondary filter-plus-deactivation-skip">
						<?php esc_html_e( 'Skip & Deactivate', 'filter-plus' ); ?>
					</button>
					<button class="button button-primary filter-plus-deactivation-submit" disabled>
						<?php esc_html_e( 'Submit & Deactivate', 'filter-plus' ); ?>
					</button>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Handle the AJAX feedback submission.
	 *
	 * @return void
	 */
	public function handle_feedback() {
		check_ajax_referer( 'filter_plus_deactivation_feedback', 'nonce' );

		$reason = isset( $_POST['reason'] ) ? sanitize_text_field( wp_unslash( $_POST['reason'] ) ) : '';
		$detail = isset( $_POST['detail'] ) ? sanitize_textarea_field( wp_unslash( $_POST['detail'] ) ) : '';

		if ( empty( $reason ) ) {
			wp_send_json_error( array( 'message' => 'No reason provided.' ) );
		}

		$body = array(
			'reason'         => $reason,
			'detail'         => $detail,
			'plugin'         => 'filter-plus',
			'plugin_version' => \FilterPlus::get_version(),
			'wp_version'     => get_bloginfo( 'version' ),
			'php_version'    => phpversion(),
			'site_url'       => home_url(),
			'site_lang'      => get_bloginfo( 'language' ),
		);

		wp_remote_post(
			$this->api_url,
			array(
				'timeout'   => 15,
				'blocking'  => false,
				'sslverify' => false,
				'body'      => $body,
			)
		);

		wp_send_json_success();
	}
}
