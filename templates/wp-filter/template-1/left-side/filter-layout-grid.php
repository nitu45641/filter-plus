<?php

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div class="sidebar-row radio-wrap">
	<h4 class="sidebar-label"><?php echo esc_html($title); ?></h4>
	<div class="param-box param-box-<?php echo esc_attr($template);?>">
		<?php
			foreach ($filterplus_get_attr as $filterplus_key => $filterplus_term_id) {
				if (!empty( get_term( $filterplus_term_id ) ) ) {
					?>
						<div class="radio-item taxonomy-item-<?php echo esc_attr($template);?>"
						data-term_id="<?php echo esc_attr($filterplus_term_id); ?>"
						data-taxonomy="<?php echo esc_attr(get_term( $filterplus_term_id )->taxonomy ); ?>"
						data-slug="<?php echo esc_attr(get_term( $filterplus_term_id )->slug ); ?>"
						><?php echo esc_html( get_term( $filterplus_term_id )->name ); ?></div>
					<?php
				}
			}
		?>
	</div>
	<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>	
</div>
