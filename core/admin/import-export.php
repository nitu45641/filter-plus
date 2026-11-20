<?php

namespace FilterPlus\Core\Admin;

use FilterPlus\Utils\Singleton;
use FilterPlus\Core\Admin\FilterSets\Helper as SetHelper;
use FilterPlus\Core\Admin\FilterOptions\Helper as OptionHelper;

defined( 'ABSPATH' ) || exit;

/**
 * Import / export Filter Options and Filter Sets as a JSON file.
 *
 * Export: admin-post.php?action=filterplus_export&what=options|sets (nonce)
 * Import: POST admin-post.php action=filterplus_import with a .json file.
 * Records that already exist (same label + field / same name + shortcode) are skipped.
 */
class ImportExport {

	use Singleton;

	const NONCE      = 'filterplus_import_export';
	const OPTION_CPT = 'filter_plus_option';
	const MAX_BYTES  = 1048576; // 1 MB is far more than any real export.

	public function init() {
		add_action( 'admin_post_filterplus_export', array( $this, 'export' ) );
		add_action( 'admin_post_filterplus_import', array( $this, 'import' ) );
		add_action( 'admin_notices', array( $this, 'notice' ) );
	}

	/**
	 * Hidden import form. Printed outside the list table's own <form>
	 * (forms can't nest); the Import button in the bulk bar points at its file input.
	 *
	 * @param string $what 'options' or 'sets'.
	 * @return void
	 */
	public static function import_form( $what ) {
		$what = 'sets' === $what ? 'sets' : 'options';
		?>
		<form class="fp-import-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" enctype="multipart/form-data" hidden>
			<input type="hidden" name="action" value="filterplus_import" />
			<input type="hidden" name="what" value="<?php echo esc_attr( $what ); ?>" />
			<?php wp_nonce_field( self::NONCE ); ?>
			<input type="file" id="filterplus-import-<?php echo esc_attr( $what ); ?>" name="filterplus_import_file" accept=".json,application/json" class="fp-import-file" />
		</form>
		<?php
	}

	/**
	 * Export / Import buttons (shown in the list table's bulk-actions bar).
	 *
	 * @param string $what 'options' or 'sets'.
	 * @return void
	 */
	public static function buttons( $what ) {
		$what       = 'sets' === $what ? 'sets' : 'options';
		$export_url = wp_nonce_url( admin_url( 'admin-post.php?action=filterplus_export&what=' . $what ), self::NONCE );
		?>
		<div class="alignleft actions fp-import-export">
			<a class="button fp-ie-btn" href="<?php echo esc_url( $export_url ); ?>">
				<span class="dashicons dashicons-download" aria-hidden="true"></span><?php esc_html_e( 'Export', 'filter-plus' ); ?>
			</a>
			<button type="button" class="button fp-ie-btn fp-import-trigger" data-input="filterplus-import-<?php echo esc_attr( $what ); ?>">
				<span class="dashicons dashicons-upload" aria-hidden="true"></span><?php esc_html_e( 'Import', 'filter-plus' ); ?>
			</button>
		</div>
		<?php
	}

	/**
	 * Download the records as JSON.
	 */
	public function export() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have permission to export.', 'filter-plus' ), 403 );
		}
		check_admin_referer( self::NONCE );

		$what = isset( $_GET['what'] ) && 'sets' === $_GET['what'] ? 'sets' : 'options';
		$data = array(
			'plugin'      => 'filter-plus',
			'version'     => \FilterPlus::get_version(),
			'exported_at' => gmdate( 'c' ),
		);

		if ( 'options' === $what ) {
			$data['filter_options'] = array();
			foreach ( OptionHelper::get_filter_options( -1 ) as $option ) {
				$data['filter_options'][] = array(
					'label'             => (string) $option['label'],
					'type'              => (string) $option['type'],
					'style'             => (string) $option['style'],
					'custom_field_list' => (string) $option['custom_field_list'],
					'style_template'    => isset( $option['style_template'] ) ? (string) $option['style_template'] : '1',
				);
			}
		} else {
			$data['filter_sets'] = array();
			foreach ( SetHelper::get_filter_sets( -1 ) as $set ) {
				$data['filter_sets'][] = array(
					'name'      => (string) $set['name'],
					'type'      => (string) $set['type'],
					'shortcode' => (string) $set['shortcode'],
					'params'    => (array) $set['params'],
				);
			}
		}

		$filename = sprintf( 'filter-plus-%s-%s.json', 'sets' === $what ? 'filter-sets' : 'filter-options', gmdate( 'Y-m-d' ) );
		nocache_headers();
		header( 'Content-Type: application/json; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
		echo wp_json_encode( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
		exit;
	}

	/**
	 * Read an uploaded JSON file and create the records.
	 */
	public function import() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have permission to import.', 'filter-plus' ), 403 );
		}
		check_admin_referer( self::NONCE );

		$what = isset( $_POST['what'] ) && 'sets' === $_POST['what'] ? 'sets' : 'options';
		$page = 'sets' === $what ? 'filter-sets' : 'filter-options';
		$back = admin_url( 'admin.php?page=' . $page );

		// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated,WordPress.Security.ValidatedSanitizedInput.MissingUnslash,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- file array checked below
		$file = isset( $_FILES['filterplus_import_file'] ) ? $_FILES['filterplus_import_file'] : null;
		if ( empty( $file['tmp_name'] ) || ! empty( $file['error'] ) || ! is_uploaded_file( $file['tmp_name'] ) ) {
			$this->back( $back, array( 'fp_ie' => 'nofile' ) );
		}
		if ( (int) $file['size'] > self::MAX_BYTES ) {
			$this->back( $back, array( 'fp_ie' => 'toobig' ) );
		}

		$data = json_decode( (string) file_get_contents( $file['tmp_name'] ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- local uploaded tmp file
		if ( ! is_array( $data ) || ( isset( $data['plugin'] ) && 'filter-plus' !== $data['plugin'] ) ) {
			$this->back( $back, array( 'fp_ie' => 'invalid' ) );
		}

		$key = 'sets' === $what ? 'filter_sets' : 'filter_options';
		if ( empty( $data[ $key ] ) || ! is_array( $data[ $key ] ) ) {
			$this->back( $back, array( 'fp_ie' => 'empty' ) );
		}

		$result = 'sets' === $what ? $this->import_sets( $data[ $key ] ) : $this->import_options( $data[ $key ] );
		$this->back( $back, array( 'fp_ie' => 'done', 'added' => $result['added'], 'skipped' => $result['skipped'] ) );
	}

	/**
	 * @param array $rows Exported filter options.
	 * @return array{added:int,skipped:int}
	 */
	private function import_options( $rows ) {
		$added    = 0;
		$skipped  = 0;
		$styles   = array( 'select', 'checkbox', 'radio', 'date_range', 'price_range', 'rating' );
		$existing = array();
		foreach ( OptionHelper::get_filter_options( -1 ) as $option ) {
			$existing[] = strtolower( $option['label'] ) . '|' . $option['custom_field_list'];
		}

		foreach ( $rows as $row ) {
			$label = isset( $row['label'] ) ? sanitize_text_field( $row['label'] ) : '';
			$field = isset( $row['custom_field_list'] ) ? sanitize_text_field( $row['custom_field_list'] ) : '';
			$style = isset( $row['style'] ) && in_array( $row['style'], $styles, true ) ? $row['style'] : 'select';
			$sig   = strtolower( $label ) . '|' . $field;

			if ( '' === $label || '' === $field || in_array( $sig, $existing, true ) ) {
				++$skipped;
				continue;
			}

			$id = wp_insert_post( array( 'post_title' => $label, 'post_type' => self::OPTION_CPT, 'post_status' => 'publish' ), true );
			if ( is_wp_error( $id ) || ! $id ) {
				++$skipped;
				continue;
			}
			update_post_meta( $id, 'label', $label );
			update_post_meta( $id, 'type', 'custom_field' );
			update_post_meta( $id, 'style', $style );
			update_post_meta( $id, 'custom_field_list', $field );
			update_post_meta( $id, 'style_template', isset( $row['style_template'] ) && '2' === (string) $row['style_template'] ? '2' : '1' );
			$existing[] = $sig;
			++$added;
		}

		return array( 'added' => $added, 'skipped' => $skipped );
	}

	/**
	 * @param array $rows Exported filter sets.
	 * @return array{added:int,skipped:int}
	 */
	private function import_sets( $rows ) {
		$added    = 0;
		$skipped  = 0;
		$existing = array();
		foreach ( SetHelper::get_filter_sets( -1 ) as $set ) {
			$existing[] = strtolower( $set['name'] ) . '|' . $set['shortcode'];
		}

		foreach ( $rows as $row ) {
			$name      = isset( $row['name'] ) ? sanitize_text_field( $row['name'] ) : '';
			$type      = isset( $row['type'] ) ? sanitize_key( $row['type'] ) : '';
			$shortcode = isset( $row['shortcode'] ) ? sanitize_text_field( $row['shortcode'] ) : '';
			$params    = isset( $row['params'] ) && is_array( $row['params'] ) ? $this->clean_params( $row['params'] ) : array();
			$sig       = strtolower( $name ) . '|' . $shortcode;

			// Shortcode must be one of ours, matching its type.
			$valid = in_array( $type, array( 'filter_products', 'wp_filter_plus' ), true ) && 0 === strpos( $shortcode, '[' . $type );
			if ( '' === $name || ! $valid || in_array( $sig, $existing, true ) ) {
				++$skipped;
				continue;
			}

			if ( SetHelper::save_filter_set( 0, $name, $type, $shortcode, $params ) ) {
				$existing[] = $sig;
				++$added;
			} else {
				++$skipped;
			}
		}

		return array( 'added' => $added, 'skipped' => $skipped );
	}

	/**
	 * Same cleaning the Filter Set save uses: keys → sanitize_key, values → text.
	 */
	private function clean_params( $params ) {
		$clean = array();
		foreach ( $params as $key => $value ) {
			$key = sanitize_key( $key );
			$clean[ $key ] = is_array( $value ) ? array_map( 'sanitize_text_field', array_filter( $value, 'is_scalar' ) ) : sanitize_text_field( (string) $value );
		}
		return $clean;
	}

	private function back( $url, $args ) {
		wp_safe_redirect( add_query_arg( $args, $url ) );
		exit;
	}

	/**
	 * Result message after an import.
	 */
	public function notice() {
		// phpcs:disable WordPress.Security.NonceVerification.Recommended -- display only
		if ( empty( $_GET['fp_ie'] ) || empty( $_GET['page'] ) || ! in_array( $_GET['page'], array( 'filter-options', 'filter-sets' ), true ) ) {
			return;
		}
		$code    = sanitize_key( $_GET['fp_ie'] );
		$added   = isset( $_GET['added'] ) ? absint( $_GET['added'] ) : 0;
		$skipped = isset( $_GET['skipped'] ) ? absint( $_GET['skipped'] ) : 0;
		// phpcs:enable

		$errors = array(
			'nofile'  => __( 'Choose a .json file to import.', 'filter-plus' ),
			'toobig'  => __( 'That file is too large to be a Filter Plus export.', 'filter-plus' ),
			'invalid' => __( 'That file is not a Filter Plus export.', 'filter-plus' ),
			'empty'   => __( 'That file has nothing to import for this page.', 'filter-plus' ),
		);
		if ( isset( $errors[ $code ] ) ) {
			printf( '<div class="notice notice-error is-dismissible"><p>%s</p></div>', esc_html( $errors[ $code ] ) );
			return;
		}
		if ( 'done' === $code ) {
			/* translators: 1: number imported, 2: number skipped */
			$msg = sprintf( __( 'Import finished: %1$d added, %2$d skipped (already exist or invalid).', 'filter-plus' ), $added, $skipped );
			printf( '<div class="notice notice-success is-dismissible"><p>%s</p></div>', esc_html( $msg ) );
		}
	}
}
