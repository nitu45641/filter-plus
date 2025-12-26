<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="sidebar-row categories-wrap">
<h4 class="sidebar-label"><?php echo !empty( $category_label ) ? esc_html( $category_label ) : esc_html__('Categories','filter-plus');?></h4>
	<ul class="category-list categories-wrapper">
		<?php
			$filterplus_get_categories = \FilterPlus\Utils\Helper::get_categories($categories,false,
			array( 'hide_empty' => $hide_empty_cat , 'taxonomy' => $taxonomy  ) );

			if ( !empty( $filterplus_get_categories ) ) :
				foreach($filterplus_get_categories as $filterplus_item): ?>
					<li class="cat-group parent"
						data-name="<?php echo esc_attr($filterplus_item['name'])?>"
						data-cat_id="<?php echo esc_attr($filterplus_item['term_id'])?>"
						data-slug="<?php echo esc_attr($filterplus_item['slug'])?>"
						data-parent="<?php  echo esc_attr($filterplus_item['term_id'])?>"
					>
						<label for="<?php  echo esc_attr("cat_li_parent_".$filterplus_item['term_id'])?>">
							<input type="checkbox"
								class="regular-checkbox"
								value="<?php  echo esc_attr($filterplus_item['term_id'])?>"
								id="<?php  echo esc_attr("cat_li_parent_".$filterplus_item['term_id'])?>"
							/>
							<?php echo esc_html($filterplus_item['name']);?>
							<?php if ($product_count == 'yes') { echo ' (' . esc_html($filterplus_item['count']) . ')'; } ?>
						</label>
					</li>
					<?php if( $sub_categories == 'yes' && !empty($filterplus_item['sub_categories'])): ?>
						<ul class="sub_categories">
							<?php foreach($filterplus_item['sub_categories'] as $filterplus_sub): ?>
								<li
									class="cat-group"
									data-parent="<?php  echo esc_attr($filterplus_item['term_id'])?>"
									data-name="<?php echo esc_attr($filterplus_sub['name'])?>"
									data-cat_id="<?php echo esc_attr($filterplus_sub['term_id'])?>"
									data-slug="<?php echo esc_attr($filterplus_sub['slug'])?>">
									<input type="checkbox" class="regular-checkbox" value="<?php  echo esc_attr($filterplus_sub['term_id'])?>" id="<?php  echo esc_attr("cat_li_child_".$filterplus_sub['term_id'])?>">
									<label for="<?php  echo esc_attr("cat_li_child_".$filterplus_sub['term_id'])?>">
										<?php echo esc_html($filterplus_sub['name']); ?>
										<?php if ($product_count == 'yes') { echo ' (' . esc_html($filterplus_sub['count']) . ')'; } ?>
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