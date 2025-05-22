<?php

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div class="sidebar-row categories-wrap">
	<?php
		$title = !empty($category_label) ? $category_label : esc_html__("Categories","filter-plus-pro");
	?>
	<h4 class="sidebar-label"><?php echo esc_html($title);?></h4>
	
	<ul class="category-list">
		<?php 
			$get_categories = \FilterPlus\Utils\Helper::get_categories($categories, '' , 
			array('taxonomy'=> 'category') );

			if ( !empty( $get_categories ) ) :
				foreach($get_categories as $item): 
				?>
				<li 
					data-name="<?php echo esc_attr($item['name'])?>"
					data-cat_id="<?php echo esc_attr($item['term_id'])?>"
					data-slug="<?php echo esc_attr($item['slug'])?>"
				>
					<input type="checkbox" class="regular-checkbox" value="<?php  echo esc_attr($item['term_id'])?>" id="<?php  echo esc_attr("cat_li_".$item['term_id'])?>">
					<label for="<?php  echo esc_attr("cat_li_".$item['term_id'])?>"><?php  echo esc_html($item['name'])  ;?></label>
					<?php if( $sub_categories == 'yes' && !empty($item['sub_categories'])): ?>
					<ul class="sub_categories"
					class="cat-group"
					>
					<?php foreach($item['sub_categories'] as $sub): ?>
						<li 
							data-name="<?php echo esc_attr($sub['name'])?>"
							data-cat_id="<?php echo esc_attr($sub['term_id'])?>"
							data-slug="<?php echo esc_attr($sub['slug'])?>">
							<input type="checkbox" class="regular-checkbox" value="<?php  echo esc_attr($sub['term_id'])?>" id="<?php  echo esc_attr("cat_li_".$sub['term_id'])?>">
							<label for="<?php  echo esc_attr("cat_li_".$sub['term_id'])?>"><?php  echo esc_html($sub['name'])  ;?></label>
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
	<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus-pro');?></span>
</div>