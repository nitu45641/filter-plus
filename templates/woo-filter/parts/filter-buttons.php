<?php
/**
 * Filter Apply/Reset Buttons Template
 *
 * @package Filter_Plus
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( 'yes' != $apply_button_mode ) {
	return;
}

$filterplus_apply_label = ! empty( $apply_button_label ) ? $apply_button_label : esc_html__( 'Apply', 'filter-plus' );
$filterplus_reset_label = ! empty( $reset_button_label ) ? $reset_button_label : esc_html__( 'Reset', 'filter-plus' );
?>

<div class="filter-buttons-wrap">
	<button type="button" class="filter-reset-btn">
		<?php echo esc_html( $filterplus_reset_label ); ?>
	</button>
	<button type="button" class="filter-apply-btn">
		<?php echo esc_html( $filterplus_apply_label ); ?>
	</button>
</div>
