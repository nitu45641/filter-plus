<?php

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div class="sidebar-row categories-wrap">
	<ul class="category-list filter-tab-pane">
		<?php 
			$get_categories = \FilterPlus\Utils\Helper::get_categories($categories, '' , 
			array('taxonomy'=> $taxonomy ) );

			if ( !empty( $get_categories ) ) :
				foreach($get_categories as $item): ?>
					<li 
					data-cat_id="<?php echo esc_attr($item['term_id'])?>"
					data-slug="<?php echo esc_attr($item['slug'])?>">
					<?php echo esc_html($item['name'])  ;?></li>
				<?php 
				endforeach; 
			endif;
		?>
	</ul>
	<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus-pro');?></span>
</div>