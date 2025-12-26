
<?php

if ( ! defined( 'ABSPATH' ) ) exit;

?>

<div class="sidebar-row categories-wrap">
<h4 class="sidebar-label"><?php echo !empty( $category_label ) ? esc_html( $category_label ) : esc_html__('Categories','filter-plus');?></h4>
	<ul class="category-list panel categories-wrapper">
		<?php
			$filterplus_get_categories = \FilterPlus\Utils\Helper::get_categories($categories);
			if ( !empty( $filterplus_get_categories ) ) :
				foreach($filterplus_get_categories as $filterplus_item): ?>
						<li class="cat-group" data-cat_id="<?php  echo esc_attr($filterplus_item->term_id)?>"
						data-slug="<?php echo esc_attr($filterplus_item->slug)?>">
							<input type="checkbox" class="regular-checkbox" value="<?php  echo esc_attr($filterplus_item->term_id)?>" id="<?php  echo esc_attr("cat_li_".$filterplus_item->term_id)?>">
							<label for="<?php  echo esc_attr("cat_li_".$filterplus_item->term_id)?>"><?php  echo esc_html($filterplus_item->name)  ;?></label>
						</li>
				<?php
				endforeach;
			endif;
		?>
	</ul>
	<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>
</div>