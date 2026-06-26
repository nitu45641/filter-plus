<?php

if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="sidebar-row categories-wrap">
	<h4 class="sidebar-label"><?php echo !empty( $category_label ) ? esc_html( $category_label ) : esc_html__('Categories','filter-plus');?></h4>
	<ul class="category-list panel">
		<?php
			// Debug: Check what parameters are being passed
			$filterplus_hide_empty_value = isset($hide_empty_cat) && $hide_empty_cat == 'no' ? false : true;
			$filterplus_get_categories = \FilterPlus\Utils\Helper::get_categories(
				isset($categories) ? $categories : '',
				false,
				array(
					'hide_empty'          => isset($hide_empty_cat) ? $hide_empty_cat : 'yes',
					'taxonomy'            => isset($taxonomy) ? $taxonomy : 'category',
					'exclude_categories'  => isset($exclude_categories) ? $exclude_categories : '',
					'category_orderby'    => isset($category_orderby) ? $category_orderby : '',
				)
			);
			if ( !empty( $filterplus_get_categories ) ) :
				foreach($filterplus_get_categories as $filterplus_item):
				?>
				<li
					id="<?php echo 'cat_li_parent_' . esc_attr($filterplus_item['term_id'])?>"
					data-name="<?php echo esc_attr($filterplus_item['name'])?>"
					data-cat_id="<?php echo esc_attr($filterplus_item['term_id'])?>"
					data-slug="<?php echo esc_attr($filterplus_item['slug'])?>"
					data-url="<?php $filterplus_term_link = get_term_link( (int) $filterplus_item['term_id'], isset( $taxonomy ) ? $taxonomy : 'product_cat' ); echo is_wp_error( $filterplus_term_link ) ? '' : esc_url( $filterplus_term_link ); ?>"
				>
					<?php echo esc_html($filterplus_item['name']);?>
					<?php if ($product_count == 'yes') { echo ' (' . esc_html($filterplus_item['count']) . ')'; } ?>
				</li>
					<?php if( $sub_categories == 'yes' && !empty($filterplus_item['sub_categories'])): ?>
						<ul class="sub_categories">
							<?php foreach($filterplus_item['sub_categories'] as $filterplus_sub): ?>
								<li
									id="<?php  echo esc_attr("cat_li_child_".$filterplus_sub['term_id'])?>"
									data-name="<?php echo esc_attr($filterplus_sub['name'])?>"
									data-cat_id="<?php echo esc_attr($filterplus_sub['term_id'])?>"
									data-slug="<?php echo esc_attr($filterplus_sub['slug'])?>"
									data-url="<?php echo esc_url( get_term_link( (int) $filterplus_sub['term_id'], 'product_cat' ) ); ?>"
								>
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