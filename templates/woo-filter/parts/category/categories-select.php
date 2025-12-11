<?php

if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="sidebar-row categories-wrap">
	<h4 class="sidebar-label"><?php echo !empty( $category_label ) ?  $category_label : esc_html__('Categories','filter-plus');?></h4>
	<div class="dropdown-label closed" data-category_label="Select..."><?php esc_html_e('Select...','filter-plus')?></div>
	<ul class="category-list panel dropdown-box d-none">
		<?php 
			$get_categories = \FilterPlus\Utils\Helper::get_categories($categories,false,array( 'hide_empty' => $hide_empty_cat , 'taxonomy' => $taxonomy));
			if ( !empty( $get_categories ) ) :
				foreach($get_categories as $item): 
				?>
				<li 
					id="<?php echo 'cat_li_parent_' . esc_attr($item['term_id'])?>"
					data-name="<?php echo esc_attr($item['name'])?>"
					data-cat_id="<?php echo esc_attr($item['term_id'])?>"
					data-slug="<?php echo esc_attr($item['slug'])?>"
				>
					<?php echo esc_html($item['name']);?>
					<?php if ($product_count == 'yes') { echo ' (' . esc_html($item['count']) . ')'; } ?>
				</li>
					<?php if( $sub_categories == 'yes' && !empty($item['sub_categories'])): ?>
						<ul class="sub_categories">
							<?php foreach($item['sub_categories'] as $sub): ?>
								<li 
									id="<?php  echo esc_attr("cat_li_child_".$sub['term_id'])?>"
									data-name="<?php echo esc_attr($sub['name'])?>"
									data-cat_id="<?php echo esc_attr($sub['term_id'])?>"
									data-slug="<?php echo esc_attr($sub['slug'])?>">
									<?php echo esc_html($sub['name']);?>
									<?php if ($product_count == 'yes') { echo ' (' . esc_html($sub['count']) . ')'; } ?>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				<?php 
				endforeach; 
			endif;
		?>
	</ul>
	<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>
</div>