<?php

if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="sidebar-row categories-wrap">
	<h4 class="sidebar-label"><?php echo !empty( $category_label ) ? esc_html( $category_label ) : esc_html__('Categories','filter-plus');?></h4>
	<div class="dropdown-label closed" data-category_label="Select..."><?php esc_html_e('Select...','filter-plus')?></div>
	<ul class="category-list panel dropdown-box d-none">
		<?php
			$filterplus_get_categories = \FilterPlus\Utils\Helper::get_categories($categories,false,array( 'hide_empty' => $hide_empty_cat , 'taxonomy' => $taxonomy, 'exclude_categories' => isset($exclude_categories) ? $exclude_categories : '', 'category_orderby' => isset($category_orderby) ? $category_orderby : '' ));
			if ( !empty( $filterplus_get_categories ) ) :
				foreach($filterplus_get_categories as $filterplus_item):
					$filterplus_has_sub = $sub_categories == 'yes' && !empty($filterplus_item['sub_categories']);
					$filterplus_is_wrap = isset( $wrap_sub_categories ) && $wrap_sub_categories == 'yes';
				?>
				<li
					id="<?php echo 'cat_li_parent_' . esc_attr($filterplus_item['term_id'])?>"
					class="<?php echo ( $filterplus_has_sub && $filterplus_is_wrap ) ? 'has-sub-categories' : ''; ?>"
					data-name="<?php echo esc_attr($filterplus_item['name'])?>"
					data-cat_id="<?php echo esc_attr($filterplus_item['term_id'])?>"
					data-slug="<?php echo esc_attr($filterplus_item['slug'])?>"
				>
					<?php echo esc_html($filterplus_item['name']);?>
					<?php if ($product_count == 'yes') { echo ' (' . esc_html($filterplus_item['count']) . ')'; } ?>
					<?php if ( $filterplus_has_sub && $filterplus_is_wrap ) : ?>
						<span class="fp-cat-caret" aria-label="<?php esc_attr_e('Toggle sub categories','filter-plus');?>">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"/></svg>
						</span>
					<?php endif; ?>
				</li>
					<?php if( $filterplus_has_sub ): ?>
						<ul class="sub_categories<?php echo $filterplus_is_wrap ? ' wrap-sub-cats' : ''; ?>">
							<?php foreach($filterplus_item['sub_categories'] as $filterplus_sub): ?>
								<li
									id="<?php  echo esc_attr("cat_li_child_".$filterplus_sub['term_id'])?>"
									data-name="<?php echo esc_attr($filterplus_sub['name'])?>"
									data-cat_id="<?php echo esc_attr($filterplus_sub['term_id'])?>"
									data-slug="<?php echo esc_attr($filterplus_sub['slug'])?>">
									<?php echo esc_html($filterplus_sub['name']);?>
									<?php if ($product_count == 'yes') { echo ' (' . esc_html($filterplus_sub['count']) . ')'; } ?>
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