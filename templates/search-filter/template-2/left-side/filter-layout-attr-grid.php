<?php 

if ( ! defined( 'ABSPATH' ) ) exit;

foreach ($attributes as $key => $item ) { 
	$get_attr = \FilterPlus\Utils\Helper::get_attributes( wc_get_attribute( $item )->slug );
?>
<div class="sidebar-row radio-wrap">
	<h4 class="sidebar-label"><?php echo esc_html__('Filter By ') .esc_html($get_attr['label']); ?></h4>
	<div class="down-arrow">
		<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"/></svg>
	</div>
	<div class="up-arrow">
		<svg width="14" height="8" viewBox="0 0 14 8" fill="#B3B3B3" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" stroke="#B3B3B3" d="M6.29289 0.292893C6.68342 -0.0976311 7.31658 -0.0976311 7.70711 0.292893L13.7071 6.29289C14.0976 6.68342 14.0976 7.31658 13.7071 7.70711C13.3166 8.09763 12.6834 8.09763 12.2929 7.70711L7 2.41421L1.70711 7.70711C1.31658 8.09763 0.683417 8.09763 0.292893 7.70711C-0.0976311 7.31658 -0.0976311 6.68342 0.292893 6.29289L6.29289 0.292893Z" fill="#B3B3B3"/></svg>	
	</div>
	<div class="panel">
		<div class="param-box">
			<?php
				foreach ($get_attr['terms'] as $key => $term) {
					if (!empty( $term ) ) {
						?>
							<div class="radio-item" 
							data-taxonomy="<?php echo esc_attr($term->taxonomy); ?>"
							data-term_id="<?php echo esc_attr($term->term_id); ?>"
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

