<!-- rating -->
<?php

use FilterPlus\Utils\Helper;
?>
<div class="sidebar-row">
	<h4 class="sidebar-label"><?php esc_html_e('Rating:','filter-plus-pro');?></h4>
	<ul class="ratings" id="">
		<?php  
			for ( $i = 5 ; $i >= 1 ; $i--  ) { 
				Helper::rating_html($i,$template);
			} 
		?>
		<span class="reset d-none reset-<?php esc_attr_e($template);?>"><?php esc_html_e('Reset','filter-plus-pro');?></span>
	</ul>
</div>