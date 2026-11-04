<?php
/**
 * Brand filter - logo / image grid (multi select).
 *
 * Available: $filterplus_brands, $brand_label, $brand_count, $template.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="sidebar-row fp-brands-wrap fp-brands-image">
	<?php
		$_fp_tpl = \FilterPlus::locate_template( 'parts/filter-param-header.php' );
		if ( file_exists( $_fp_tpl ) ) {
			$filterplus_label = $brand_label;
			include $_fp_tpl;
		}
	?>
	<ul class="fp-brand-list fp-brand-list-image panel" data-input="checkbox">
		<?php foreach ( $filterplus_brands as $filterplus_brand ) :
			$filterplus_brand_img = \FilterPlus\Utils\Helper::brand_image_url( $filterplus_brand['term_id'], 'thumbnail' );
			?>
			<li class="fp-brand-item fp-brand-card"
				data-brand_id="<?php echo esc_attr( $filterplus_brand['term_id'] ); ?>"
				data-name="<?php echo esc_attr( $filterplus_brand['name'] ); ?>"
				data-slug="<?php echo esc_attr( $filterplus_brand['slug'] ); ?>"
				title="<?php echo esc_attr( $filterplus_brand['name'] ); ?>"
			>
				<input type="checkbox"
					class="fp-brand-input fp-brand-card-check"
					value="<?php echo esc_attr( $filterplus_brand['term_id'] ); ?>"
					id="<?php echo esc_attr( 'fp_brand_' . $filterplus_brand['term_id'] ); ?>"
				/>
				<label for="<?php echo esc_attr( 'fp_brand_' . $filterplus_brand['term_id'] ); ?>" class="fp-brand-card-label">
					<span class="fp-brand-card-thumb">
						<?php if ( ! empty( $filterplus_brand_img ) ) : ?>
							<img src="<?php echo esc_url( $filterplus_brand_img ); ?>" alt="<?php echo esc_attr( $filterplus_brand['name'] ); ?>" loading="lazy" />
						<?php endif; ?>
					</span>
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
