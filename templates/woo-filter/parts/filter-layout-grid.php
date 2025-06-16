<?php

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div class="sidebar-row radio-wrap">
	<?php 
		if (file_exists(\FilterPlus::template_dir() . "parts/filter-param-header.php")) {
			$label = esc_html($title);
			include \FilterPlus::template_dir() . "parts/filter-param-header.php";
		}
	?>
	<div class="panel">
		<div class="param-box">
			<?php
				foreach ($get_attr as $key => $term_id) {
					if (!empty( get_term( $term_id ) ) && empty(get_term( $term_id )->errors) ) {
						?>
							<div class="radio-item" 
							data-term_id="<?php echo esc_attr($term_id); ?>"
							data-taxonomy="<?php echo esc_attr(get_term( $term_id )->taxonomy ); ?>"
							data-slug="<?php echo esc_attr(get_term( $term_id )->slug ); ?>"
							><?php echo esc_html( get_term( $term_id )->name ); ?></div>
						<?php
					}
				}
			?>
		</div>	
		<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>
	</div>
</div>
