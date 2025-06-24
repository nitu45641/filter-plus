<?php

if ( ! defined( 'ABSPATH' ) ) exit; 

/* Filter By Color */

if ( 'yes' == $colors ) {
	$get_attr = \FilterPlus\Utils\Helper::get_attributes( 'pa_color' );
	?>
	<div class="sidebar-row radio-wrap">
		<?php 
			if (file_exists(\FilterPlus::template_dir() . "parts/filter-param-header.php")) {
				$label =  ! empty( $color_label ) ? $color_label : esc_html__( 'Filter By', 'filter-plus' ) . ' ' . esc_html( $get_attr['label'] );
				include \FilterPlus::template_dir() . "parts/filter-param-header.php";
			}
		?>
		<div class="panel">
			<div class="param-box checkbox-item color-meta color-style-<?php echo esc_attr( $color_template ); ?>">
			<?php
			if ( ! empty( $get_attr['terms'] ) ) {
				$tooltip = ( '1' == $color_template ) ? 'tooltips' : '';
				foreach ( $get_attr['terms'] as $key => $value ) {
					if ( ! empty( $value->name ) ) {
						$style = ( $color_template !== '3' ) ? 'style="background-color: ' . esc_attr( $value->name ) . ';"' : '';
						?>
						<div class="color-item-wrap">
							<div class="color-item <?php echo esc_attr( $tooltip ); ?>" title="<?php echo esc_attr( $value->name ); ?>"
								data-term_id="<?php echo esc_attr( $value->term_id ); ?>"
								data-taxonomy="<?php echo esc_attr( $value->taxonomy ); ?>"
								data-name="<?php echo esc_attr( $value->name ); ?>"
								data-slug="<?php echo esc_attr( $value->slug ); ?>"
								<?php echo \FilterPlus\Utils\Helper::kses( $style ); ?>
								>
								<?php if (  $color_template == "3" ) { ?>
									<label>
										<input type="checkbox" 
											data-taxonomy="<?php echo esc_attr($value->taxonomy); ?>"
											data-term_id="<?php echo esc_attr($value->term_id); ?>"
											data-slug="<?php echo esc_attr($value->slug); ?>"
										/>
										<span><?php echo esc_attr( $value->name ); ?></span>
									</label>
								<?php } ?>
							</div>
							<?php if (  $color_template == "2" ) { ?>
								<div class="meta-count"><?php echo '(' . intval( $value->count ) . ')'; ?></div>
							<?php } ?>
						</div>
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