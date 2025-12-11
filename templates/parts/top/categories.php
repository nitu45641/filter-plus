<?php

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div class="sidebar-row categories-wrap">
	<ul class="category-list filter-tab-pane">
		<?php
			$filterplus_categories = \FilterPlus\Utils\Helper::get_categories( $categories, '', array( 'taxonomy' => $taxonomy ) );

			if ( ! empty( $filterplus_categories ) ) :
				foreach ( $filterplus_categories as $filterplus_item ) : ?>
					<li
					data-cat_id="<?php echo esc_attr( $filterplus_item['term_id'] ); ?>"
					data-slug="<?php echo esc_attr( $filterplus_item['slug'] ); ?>">
					<?php echo esc_html( $filterplus_item['name'] ); ?></li>
				<?php
				endforeach;
			endif;
		?>
	</ul>
	<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>
</div>