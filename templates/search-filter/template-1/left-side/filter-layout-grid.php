
<div class="sidebar-row radio-wrap">
	<h4 class="sidebar-label"><?php echo ($title); ?></h4>
	<div class="param-box">
		<?php
			foreach ($get_attr as $key => $term_id) {
				if (!empty( get_term( $term_id ) ) ) {
					?>
						<div class="radio-item" 
						data-term_id="<?php esc_attr_e($term_id); ?>"
						data-taxonomy="<?php esc_attr_e(get_term( $term_id )->taxonomy ); ?>"
						><?php echo esc_html( get_term( $term_id )->name ); ?></div>
					<?php
				}
			}
		?>
	</div>
	<span class="reset d-none"><?php esc_html_e('Reset','filter-plus');?></span>	
</div>
