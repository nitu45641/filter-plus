
<?php 

if ( ! defined( 'ABSPATH' ) ) exit;

foreach ($attributes as $key => $item ) { 
	$get_attr = \FilterPlus\Utils\Helper::get_attributes( !empty( wc_get_attribute( $item ) ) ? wc_get_attribute( $item )->slug : '' );
?>
<div class="sidebar-row radio-wrap">
	<h4 class="sidebar-label"><?php echo esc_html__('Filter By ') .esc_html($get_attr['label']); ?></h4>
	<div class="param-box">
		<?php
			foreach ($get_attr['terms'] as $key => $term) {
				if (!empty( $term ) ) {
					?>
						<div class="radio-item taxonomy-item-<?php echo esc_attr($template);?>" 
						data-taxonomy="<?php echo esc_attr($term->taxonomy); ?>"
						data-term_id="<?php echo esc_attr($term->term_id); ?>"
						data-name="<?php echo esc_attr($term->name); ?>"
						>
							<?php echo esc_html($term->name); ?>
						</div>
					<?php
				}
			}
		?>
	</div>
	<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>	
</div>
<?php } ?>

