
<?php 

if ( ! defined( 'ABSPATH' ) ) exit;

foreach ($filterplus_attributes as $filterplus_key => $filterplus_item ) {
	$filterplus_get_attr = \FilterPlus\Utils\Helper::get_attributes( !empty( wc_get_attribute( $filterplus_item ) ) ? wc_get_attribute( $filterplus_item )->slug : '' );
?>
<div class="sidebar-row radio-wrap">
	<h4 class="sidebar-label"><?php echo esc_html__('Filter By ','filter-plus') .esc_html($filterplus_get_attr['label']); ?></h4>
	<div class="param-box param-box-<?php echo esc_attr($template);?>">
		<?php
			foreach ($filterplus_get_attr['terms'] as $filterplus_term_key => $filterplus_term) {
				if (!empty( $filterplus_term ) ) {
					?>
						<div class="radio-item taxonomy-item-<?php echo esc_attr($template);?>"
						data-taxonomy="<?php echo esc_attr($filterplus_term->taxonomy); ?>"
						data-term_id="<?php echo esc_attr($filterplus_term->term_id); ?>"
						data-slug="<?php echo esc_attr($filterplus_term->slug); ?>"
						data-name="<?php echo esc_attr($filterplus_term->name); ?>"
						>
							<?php echo esc_html($filterplus_term->name); ?>
						</div>
					<?php
				}
			}
		?>
	</div>
	<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>
</div>
<?php } ?>

