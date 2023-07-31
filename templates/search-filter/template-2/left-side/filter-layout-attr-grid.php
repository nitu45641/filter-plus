
<?php 
foreach ($attributes as $key => $item ) { 
	$get_attr = \FilterPlus\Utils\Helper::get_attributes( wc_get_attribute( $item )->slug );
?>
<div class="sidebar-row radio-wrap">
	<h4 class="sidebar-label"><?php echo esc_html__('Filter By ') .$get_attr['label']; ?></h4>
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
	<span class="reset d-none"><?php esc_html_e('Reset');?></span>	
</div>
<?php } ?>

