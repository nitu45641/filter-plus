<?php
/**
 * Brand filter - radio (single select).
 *
 * Available: $filterplus_brands, $brand_label, $brand_count, $template.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="sidebar-row fp-brands-wrap fp-brands-radio">
	<?php
		$_fp_tpl = \FilterPlus::locate_template( 'parts/filter-param-header.php' );
		if ( file_exists( $_fp_tpl ) ) {
			$filterplus_label = $brand_label;
			include $_fp_tpl;
		}
	?>
	<ul class="fp-brand-list fp-brand-list-radio panel" data-input="radio">
		<?php foreach ( $filterplus_brands as $filterplus_brand ) : ?>
			<li class="fp-brand-item"
				data-brand_id="<?php echo esc_attr( $filterplus_brand['term_id'] ); ?>"
				data-name="<?php echo esc_attr( $filterplus_brand['name'] ); ?>"
				data-slug="<?php echo esc_attr( $filterplus_brand['slug'] ); ?>"
			>
				<label for="<?php echo esc_attr( 'fp_brand_' . $filterplus_brand['term_id'] ); ?>">
					<input type="radio"
						class="regular-radio fp-brand-input"
						name="fp_brand_radio"
						value="<?php echo esc_attr( $filterplus_brand['term_id'] ); ?>"
						id="<?php echo esc_attr( 'fp_brand_' . $filterplus_brand['term_id'] ); ?>"
					/>
					<span class="fp-brand-name"><?php echo esc_html( $filterplus_brand['name'] ); ?></span>
					<?php if ( 'yes' === $brand_count ) : ?>
						<span class="fp-brand-count">(<?php echo esc_html( $filterplus_brand['count'] ); ?>)</span>
					<?php endif; ?>
				</label>
			</li>
		<?php endforeach; ?>
	</ul>
	<span class="fp-brand-reset reset d-none reset-<?php echo esc_attr( $template ); ?>"><?php esc_html_e( 'Reset', 'filter-plus' ); ?></span>
</div>
