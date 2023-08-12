
<div class="sidebar-row categories-wrap">
	<h4 class="sidebar-label"><?php esc_html_e('Categories','filter-plus');?></h4>
	<ul class="category-list panel categories-wrapper">
		<?php 
			$get_categories = \FilterPlus\Utils\Helper::get_categories($categories);
			if ( !empty( $get_categories ) ) :
				foreach($get_categories as $item): ?>
						<li class="cat-group" data-cat_id="<?php  echo esc_attr($item->term_id)?>">
							<input type="checkbox" value="<?php  echo esc_attr($item->term_id)?>" id="<?php  echo esc_attr($item->term_id)?>">
							<label for="<?php  echo esc_attr($item->term_id)?>"><?php  echo esc_html($item->name)  ;?></label>
						</li>
				<?php 
				endforeach; 
			endif;
		?>
	</ul>
	<span class="reset d-none"><?php esc_html_e('Reset','filter-plus');?></span>
</div>