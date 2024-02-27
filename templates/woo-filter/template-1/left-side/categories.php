<?php

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div class="sidebar-row categories-wrap">
	<h4 class="sidebar-label"><?php echo !empty( $category_label ) ?  $category_label : esc_html__('Categories','filter-plus');?></h4>
	<ul class="category-list">
		<?php 
			$get_categories = \FilterPlus\Utils\Helper::get_categories($categories);
			if ( !empty( $get_categories ) ) :
				foreach($get_categories as $item): ?>
					<li 
					data-cat_id="<?php echo esc_attr($item->term_id)?>"
					data-slug="<?php echo esc_attr($item->slug)?>">
					<?php echo esc_html($item->name)  ;?></li>
				<?php 
				endforeach; 
			endif;
		?>
	</ul>
	<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>
</div>