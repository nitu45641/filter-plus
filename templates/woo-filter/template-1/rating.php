<!-- rating -->
<?php

use FilterPlus\Utils\Helper;
?>
<div class="sidebar-row">
	<h4 class="sidebar-label"><?php echo !empty( $review_label ) ?  $review_label : esc_html__('Rating','filter-plus');?></h4>
	<ul class="ratings" id="">
		<?php  
			for ( $i = 5 ; $i >= 1 ; $i--  ) { 
				Helper::rating_html($i,$template);
			} 
		?>
		<span class="reset d-none reset-<?php esc_attr_e($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>
	</ul>
</div>