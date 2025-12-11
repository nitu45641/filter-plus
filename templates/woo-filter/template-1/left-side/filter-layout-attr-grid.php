
<?php

if ( ! defined( 'ABSPATH' ) ) exit;

foreach ( $filter_plus_attributes as $filter_plus_key => $filter_plus_item ) {
	$filter_plus_attr = \FilterPlus\Utils\Helper::get_attributes( ! empty( wc_get_attribute( $filter_plus_item ) ) ? wc_get_attribute( $filter_plus_item )->slug : '' );
?>
<div class="sidebar-row radio-wrap">
	<h4 class="sidebar-label"><?php echo ! empty( $attribute_label ) ? esc_html( $attribute_label ) : esc_html__( 'Filter By ', 'filter-plus' ) . esc_html( $filter_plus_attr['label'] ); ?></h4>
	<div class="param-box param-box-<?php echo esc_attr( $template ); ?>">
		<?php
			foreach ( $filter_plus_attr['terms'] as $filter_plus_term_key => $filter_plus_term ) {
				if ( ! empty( $filter_plus_term ) ) {
					?>
						<div class="radio-item taxonomy-item-<?php echo esc_attr( $template ); ?>"
						data-taxonomy="<?php echo esc_attr( $filter_plus_term->taxonomy ); ?>"
						data-term_id="<?php echo esc_attr( $filter_plus_term->term_id ); ?>"
						data-slug="<?php echo esc_attr( $filter_plus_term->slug ); ?>"
						data-name="<?php echo esc_attr( $filter_plus_term->name ); ?>"
						>
							<?php echo esc_html( $filter_plus_term->name ); ?>
						</div>
					<?php
				}
			}
		?>
	</div>
	<span class="reset d-none reset-<?php echo esc_attr( $template ); ?>"><?php esc_html_e( 'Reset', 'filter-plus' ); ?></span>
</div>
<?php } ?>

