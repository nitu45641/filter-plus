
<div class="sidebar-row categories-wrap">
	<h4 class="sidebar-label"><?php esc_html_e('Categories','filter-plus');?></h4>
	<div class="down-arrow">
		<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"/></svg>
	</div>
	<ul class="category-list panel">
		<?php 
			$get_categories = \FilterPlus\Utils\Helper::get_categories($categories);
			if ( !empty( $get_categories ) ) :
				foreach($get_categories as $item): ?>
					<li data-cat_id="<?php echo esc_attr($item->term_id)?>"><?php echo esc_html($item->name)  ;?></li>
				<?php 
				endforeach; 
			endif;
		?>
	</ul>
	<span class="reset d-none"><?php esc_html_e('Reset','filter-plus');?></span>
</div>