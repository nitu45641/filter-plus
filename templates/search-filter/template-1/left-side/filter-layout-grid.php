
<div class="sidebar-row radio-wrap">
	<h4 class="sidebar-label"><?php echo ($title); ?></h4>
	<div class="down-arrow">
		<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"/></svg>
	</div>
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
