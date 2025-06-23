<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="sidebar-row categories-wrap">
<h4 class="sidebar-label"><?php echo !empty( $category_label ) ?  $category_label : esc_html__('Categories','filter-plus');?></h4>
	<ul class="category-list categories-wrapper">
		<?php 
			$get_categories = \FilterPlus\Utils\Helper::get_categories($categories,false,
			array( 'hide_empty' => $hide_empty_cat , 'taxonomy' => 'product_cat'  ) );
			if ( !empty( $get_categories ) ) :
				foreach($get_categories as $item): ?>
					<li class="cat-group parent" 
						data-name="<?php echo esc_attr($item['name'])?>"
						data-cat_id="<?php echo esc_attr($item['term_id'])?>"
						data-slug="<?php echo esc_attr($item['slug'])?>"
						data-parent="<?php  echo esc_attr($item['term_id'])?>"
					>
						<input type="checkbox" class="regular-checkbox" 
						value="<?php  echo esc_attr($item['term_id'])?>"
						id="<?php  echo esc_attr("cat_li_parent_".$item['term_id'])?>"
						>
						<label for="<?php  echo esc_attr("cat_li_parent_".$item['term_id'])?>">
							<?php echo esc_html($item['name']);?>
							<?php if ($product_count == 'yes') { echo ' (' . esc_html($item['count']) . ')'; } ?>
						</label>
					</li>
					<?php if( $sub_categories == 'yes' && !empty($item['sub_categories'])): ?>
						<ul class="sub_categories">
							<?php foreach($item['sub_categories'] as $sub): ?>
								<li 
									class="cat-group"
									data-parent="<?php  echo esc_attr($item['term_id'])?>"
									data-name="<?php echo esc_attr($sub['name'])?>"
									data-cat_id="<?php echo esc_attr($sub['term_id'])?>"
									data-slug="<?php echo esc_attr($sub['slug'])?>">
									<input type="checkbox" class="regular-checkbox" value="<?php  echo esc_attr($sub['term_id'])?>" id="<?php  echo esc_attr("cat_li_child_".$sub['term_id'])?>">
									<label for="<?php  echo esc_attr("cat_li_child_".$sub['term_id'])?>">
										<?php echo esc_html($sub['name']); ?>
										<?php if ($product_count == 'yes') { echo ' (' . esc_html($sub['count']) . ')'; } ?>
									</label>
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