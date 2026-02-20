<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="sidebar-row categories-wrap">
<h4 class="sidebar-label"><?php echo !empty( $category_label ) ? esc_html( $category_label ) : esc_html__('Categories','filter-plus');?></h4>
	<ul class="category-list categories-text-list">
		<?php
			$filterplus_get_categories = \FilterPlus\Utils\Helper::get_categories($categories,false,
			array( 'hide_empty' => $hide_empty_cat , 'taxonomy' => $taxonomy  ) );

			if ( !empty( $filterplus_get_categories ) ) :
				foreach($filterplus_get_categories as $filterplus_item): ?>
					<li class="cat-group parent"
						data-name="<?php echo esc_attr($filterplus_item['name'])?>"
						data-cat_id="<?php echo esc_attr($filterplus_item['term_id'])?>"
						data-slug="<?php echo esc_attr($filterplus_item['slug'])?>"
						data-parent="<?php echo esc_attr($filterplus_item['term_id'])?>"
					>
						<span class="fp-text-label">
							<?php echo esc_html($filterplus_item['name']);?>
							<?php if ($product_count == 'yes') { echo ' (' . esc_html($filterplus_item['count']) . ')'; } ?>
						</span>
					</li>
					<?php if( $sub_categories == 'yes' && !empty($filterplus_item['sub_categories'])): ?>
						<?php foreach($filterplus_item['sub_categories'] as $filterplus_sub): ?>
							<li
								class="cat-group"
								data-parent="<?php echo esc_attr($filterplus_item['term_id'])?>"
								data-name="<?php echo esc_attr($filterplus_sub['name'])?>"
								data-cat_id="<?php echo esc_attr($filterplus_sub['term_id'])?>"
								data-slug="<?php echo esc_attr($filterplus_sub['slug'])?>">
								<span class="fp-text-label">
									<?php echo esc_html($filterplus_sub['name']); ?>
									<?php if ($product_count == 'yes') { echo ' (' . esc_html($filterplus_sub['count']) . ')'; } ?>
								</span>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
				<?php
				endforeach;
			endif;
		?>
	</ul>
	<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>
</div>
