<?php 

if ( ! defined( 'ABSPATH' ) ) exit;

foreach ($attributes as $key => $item ) { 
	$get_attr = \FilterPlus\Utils\Helper::get_attributes( wc_get_attribute( $item )->slug );
?>
<div class="sidebar-row radio-wrap">
	<?php 
		if (file_exists(\FilterPlus::template_dir() . "parts/filter-param-header.php")) {
			$label =  !empty( $attribute_label ) ? $attribute_label :  esc_html__('Filter By ','filter-plus') .esc_html($get_attr['label']);
			include \FilterPlus::template_dir() . "parts/filter-param-header.php";
		}
	?>
	<div class="panel">
		<div class="param-box param-box-<?php echo esc_attr($template);?>">
			<?php
				foreach ($get_attr['terms'] as $key => $term) {
					if (!empty( $term ) ) {
						?>
							<div class="radio-item" 
							data-taxonomy="<?php echo esc_attr($term->taxonomy); ?>"
							data-term_id="<?php echo esc_attr($term->term_id); ?>"
							data-slug="<?php echo esc_attr($term->slug); ?>"
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
</div>
<?php } ?>

