<?php

if ( ! defined( 'ABSPATH' ) ) exit; 

/* Filter By Color */

if ( 'yes' == $colors ) {
	$filterplus_get_attr = \FilterPlus\Utils\Helper::get_attributes( 'pa_color' );
	?>
	<div class="sidebar-row radio-wrap">
		<?php
			if (file_exists(\FilterPlus::template_dir() . "parts/filter-param-header.php")) {
				$filterplus_label =  ! empty( $color_label ) ? $color_label : esc_html__( 'Filter By', 'filter-plus' ) . ' ' . esc_html( $filterplus_get_attr['label'] );
				include \FilterPlus::template_dir() . "parts/filter-param-header.php";
			}
		?>
		<div class="panel">
			<div class="param-box color-meta color-style-<?php echo esc_attr( $color_template ); ?>">
			<?php
			if ( ! empty( $filterplus_get_attr['terms'] ) ) {
				$filterplus_tooltip = ( '1' == $color_template ) ? 'tooltips' : '';
				foreach ( $filterplus_get_attr['terms'] as $filterplus_key => $filterplus_value ) {
					if ( ! empty( $filterplus_value->name ) ) {
						$filterplus_style = ( $color_template !== '3' ) ? 'style="background-color: ' . esc_attr( $filterplus_value->name ) . ';"' : '';
						?>
							<div class="checkbox-item color-item <?php echo esc_attr( $filterplus_tooltip ); ?>" title="<?php echo esc_attr( $filterplus_value->name ); ?>"
								data-term_id="<?php echo esc_attr( $filterplus_value->term_id ); ?>"
								data-taxonomy="<?php echo esc_attr( $filterplus_value->taxonomy ); ?>"
								data-name="<?php echo esc_attr( $filterplus_value->name ); ?>"
								data-slug="<?php echo esc_attr( $filterplus_value->slug ); ?>"
								<?php
									// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- $filterplus_style is built with esc_attr() above
									echo $filterplus_style;
								?>
								>
								<?php if (  $color_template == "3" ) { ?>
									<label>
										<input type="checkbox"
											data-taxonomy="<?php echo esc_attr($filterplus_value->taxonomy); ?>"
											data-term_id="<?php echo esc_attr($filterplus_value->term_id); ?>"
											data-slug="<?php echo esc_attr($filterplus_value->slug); ?>"
										/>
										<span><?php echo esc_attr( $filterplus_value->name ); ?></span>
									</label>
								<?php } ?>
							</div>
							<?php if (  $color_template == "2" ) { ?>
								<div class="meta-count"><?php echo '(' . intval( $filterplus_value->count ) . ')'; ?></div>
							<?php } ?>
						<?php
					}
				}
			}
			?>
			</div>
			<span class="reset d-none reset-<?php echo esc_attr( $template ); ?>"><?php esc_html_e( 'Reset', 'filter-plus' ); ?></span>
		</div>
	</div>
	<?php
}