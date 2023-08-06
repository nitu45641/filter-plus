
<?php 
foreach ($attributes as $key => $item ) { 
	$get_attr = \FilterPlus\Utils\Helper::get_attributes( wc_get_attribute( $item )->slug );
?>
<div class="sidebar-row radio-wrap">
	<h4 class="sidebar-label"><?php echo esc_html__('Filter By ') .$get_attr['label']; ?></h4>
	<div class="down-arrow">
		<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"/></svg>
	</div>
	<div class="param-box">
		<?php
			foreach ($get_attr['terms'] as $key => $term) {
				if (!empty( $term ) ) {
					?>
						<div class="radio-item" 
						data-taxonomy="<?php esc_attr_e($term->taxonomy); ?>"
						data-term_id="<?php esc_attr_e($term->term_id); ?>"
						>
							<?php echo esc_html($term->name); ?>
						</div>
					<?php
				}
			}
		?>
	</div>
	<span class="reset d-none"><?php esc_html_e('Reset','filter-plus');?></span>	
</div>
<?php } ?>

