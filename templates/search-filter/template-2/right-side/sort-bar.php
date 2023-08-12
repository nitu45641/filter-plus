<div class="sorting">
	<div class="showing">
		<p><?php esc_html_e('Showing','filter-plus')?> <span class="pages">1</span><span><?php esc_html_e(' of','filter-plus')?> </span><span class="total"></span> <?php esc_html_e('Products','filter-plus')?></p>
	</div>
	<?php if( 'yes' == $sorting ): ?>
	<div class="sort-by">
		<select name="sort-by" id="sort-by">
			<option value="most-popular"><?php esc_html_e('Sort By Most Popular','filter-plus')?></option>
			<option value="default"><?php esc_html_e('Default Sorting','filter-plus')?></option>
			<option value="popularity"><?php esc_html_e('Sort by Popularity','filter-plus')?></option>
			<option value="average-rating"><?php esc_html_e('Sort by average rating','filter-plus')?></option>
			<option value="latest"><?php esc_html_e('Sort by latest','filter-plus')?></option>
			<option value="price-low-to-high"><?php esc_html_e('Sort by price: low to high','filter-plus')?></option>
		</select>
	</div>
	<?php endif; ?>
</div>
