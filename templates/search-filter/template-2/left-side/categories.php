
<div class="sidebar-row categories-wrap">
	<h4 class="sidebar-label"><?php esc_html_e('Categories','filter-plus');?></h4>
	<div class="down-arrow">
		<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"/></svg>
	</div>
	<div class="up-arrow">
		<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M201.4 137.4c12.5-12.5 32.8-12.5 45.3 0l160 160c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L224 205.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160z"/></svg>
	</div>
	<!-- <ul class="category-list panel"> -->
		<?php 
			// $get_categories = \FilterPlus\Utils\Helper::get_categories($categories);
			// if ( !empty( $get_categories ) ) :
			// 	foreach($get_categories as $item): ?>
					<!-- <li data-cat_id="<?php // echo esc_attr($item->term_id)?>"><?php // echo esc_html($item->name)  ;?></li> -->
				<?php 
			// 	endforeach; 
			// endif;
		?>
	<!-- </ul> -->
	<div class="categories-wrapper">
		<div class="cat-group">
			<input type="checkbox" id="html">
			<label for="html">Baby Item</label>
		</div>
		<div class="cat-group">
			<input type="checkbox" id="grocery">
			<label for="grocery">Gricery</label>
		</div>
		<div class="cat-group">
			<input type="checkbox" id="pharmacy">
			<label for="pharmacy">Pharmacy</label>
		</div>
	</div>

	<span class="reset d-none"><?php esc_html_e('Reset','filter-plus');?></span>
</div>