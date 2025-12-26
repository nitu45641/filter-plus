<?php

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div class="sidebar-row categories-wrap">
	<?php
		$title = !empty($category_label) ? $category_label : esc_html__("Categories","filter-plus");
	?>
	<h4 class="sidebar-label"><?php echo esc_html($title);?></h4>
	
	<ul class="category-list panel">
		<?php
			$filterplus_get_categories = \FilterPlus\Utils\Helper::get_categories($categories, '' ,
			array('taxonomy'=> 'category') );

			if ( !empty( $filterplus_get_categories ) ) :
				foreach($filterplus_get_categories as $filterplus_item):
				?>
				<li
					data-name="<?php echo esc_attr($filterplus_item['name'])?>"
					data-cat_id="<?php echo esc_attr($filterplus_item['term_id'])?>"
					data-slug="<?php echo esc_attr($filterplus_item['slug'])?>"
				>
					<input type="checkbox" class="regular-checkbox" value="<?php  echo esc_attr($filterplus_item['term_id'])?>" id="<?php  echo esc_attr("cat_li_".$filterplus_item['term_id'])?>">
					<label for="<?php  echo esc_attr("cat_li_".$filterplus_item['term_id'])?>"><?php  echo esc_html($filterplus_item['name'])  ;?></label>
					<?php if( $sub_categories == 'yes' && !empty($filterplus_item['sub_categories'])): ?>
					<ul class="sub_categories"
					class="cat-group"
					>
					<?php foreach($filterplus_item['sub_categories'] as $filterplus_sub): ?>
						<li
							data-name="<?php echo esc_attr($filterplus_sub['name'])?>"
							data-cat_id="<?php echo esc_attr($filterplus_sub['term_id'])?>"
							data-slug="<?php echo esc_attr($filterplus_sub['slug'])?>">
							<input type="checkbox" class="regular-checkbox" value="<?php  echo esc_attr($filterplus_sub['term_id'])?>" id="<?php  echo esc_attr("cat_li_".$filterplus_sub['term_id'])?>">
							<label for="<?php  echo esc_attr("cat_li_".$filterplus_sub['term_id'])?>"><?php  echo esc_html($filterplus_sub['name'])  ;?></label>
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