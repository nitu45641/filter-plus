<?php

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div class="sidebar-row radio-wrap">
	<h4 class="sidebar-label"><?php echo esc_html($title); ?></h4>
	<div class="param-box">
		<?php
			foreach ($get_attr as $key => $term_id) {
				if (!empty( get_term( $term_id ) ) ) {
					?>
						<div class="radio-item taxonomy-item-<?php echo esc_attr($template);?>" 
						data-term_id="<?php echo esc_attr($term_id); ?>"
						data-taxonomy="<?php echo esc_attr(get_term( $term_id )->taxonomy ); ?>"
						><?php echo esc_html( get_term( $term_id )->name ); ?></div>
					<?php
				}
			}
		?>
	</div>
	<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>	
</div>
