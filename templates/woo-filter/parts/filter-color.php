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
			<div class="param-box color-meta">
			<?php
			if ( ! empty( $get_attr['terms'] ) ) {
				foreach ( $get_attr['terms'] as $key => $value ) {
					if ( ! empty( $value->name ) ) {
						?>
								<div class="radio-item color-item tooltips" title="<?php echo esc_attr( $value->name ); ?>"
								data-term_id="<?php echo esc_attr( $value->term_id ); ?>"
								data-taxonomy="<?php echo esc_attr( $value->taxonomy ); ?>"
								data-name="<?php echo esc_attr( $value->name ); ?>"
								data-slug="<?php echo esc_attr( $value->slug ); ?>"
								style="background-color: <?php echo esc_attr( strtolower( $value->name ) ); ?>">
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