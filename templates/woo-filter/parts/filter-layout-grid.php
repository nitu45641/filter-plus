<?php

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div class="sidebar-row radio-wrap">
	<?php
		if (file_exists(\FilterPlus::template_dir() . "parts/filter-param-header.php")) {
			$filterplus_label = esc_html($title);
			include \FilterPlus::template_dir() . "parts/filter-param-header.php";
		}
	?>
	<div class="panel">
		<div class="param-box param-box-<?php echo esc_attr($template);?>">
			<?php
				// ensure the variable is defined and is an array to avoid undefined variable notices
				$filterplus_get_attr = isset( $filterplus_get_attr ) && is_array( $filterplus_get_attr ) ? $filterplus_get_attr : array();
				if ( ! empty( $filterplus_get_attr ) ) {
					foreach ( $filterplus_get_attr as $filterplus_key => $filterplus_term_id ) {
						$term = get_term( $filterplus_term_id );
						if ( ! empty( $term ) && empty( $term->errors ) ) {
							?>
								<div class="radio-item"
								data-term_id="<?php echo esc_attr( $filterplus_term_id ); ?>"
								data-taxonomy="<?php echo esc_attr( $term->taxonomy ); ?>"
								data-slug="<?php echo esc_attr( $term->slug ); ?>"
								><?php echo esc_html( $term->name ); ?></div>
							<?php
						}
					}
				}
			?>
		</div>
		<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>
	</div>
</div>
