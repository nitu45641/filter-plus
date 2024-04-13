<?php

if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="sidebar-row categories-wrap">
	<h4 class="sidebar-label"><?php echo !empty( $category_label ) ?  $category_label : esc_html__('Categories','filter-plus');?></h4>
	<ul class="category-list">
		<?php 
			$get_categories = \FilterPlus\Utils\Helper::get_categories($categories);
			if ( !empty( $get_categories ) ) :
				foreach($get_categories as $item): 
				?>
				<li 
					data-name="<?php echo esc_attr($item['name'])?>"
					data-cat_id="<?php echo esc_attr($item['term_id'])?>"
					data-slug="<?php echo esc_attr($item['slug'])?>"
				>
					<?php echo esc_html($item['name']);?>
					<?php if( !empty($item['sub_categories'])): ?>
					<ul class="sub_categories">
					<?php foreach($item['sub_categories'] as $sub): ?>
						<li 
							data-name="<?php echo esc_attr($sub['name'])?>"
							data-cat_id="<?php echo esc_attr($sub['term_id'])?>"
							data-slug="<?php echo esc_attr($sub['slug'])?>">
							<?php echo esc_html($sub['name']);?>
						</li>
					<?php endforeach; ?>
					</ul>
					<?php endif; ?>
				</li>
				<?php 
				endforeach; 
			endif;
		?>
	</ul>
	<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>
</div>