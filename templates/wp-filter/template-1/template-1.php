<?php
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals -- template file included in function scope
if ( ! defined( 'ABSPATH' ) ) exit;
use FilterPlus\Base\DataFactory;

?>
<div class="shop-sidebar sidebar-style-<?php echo esc_attr($template);?>">
	<?php
		// Add apply and reset buttons if apply button mode is enabled
		if ($apply_button_mode == 'yes') {
			$_fp_tpl = \FilterPlus::locate_template( 'woo-filter/parts/filter-buttons.php' );
			if ( file_exists( $_fp_tpl ) ) {
				include_once $_fp_tpl;
			}
		}
		include_once \FilterPlus::locate_template( "wp-filter/template-".$template."/left-side/product-search.php" );

		// category template
		if ( 'yes'== $show_categories ) {
			DataFactory::category_template_url(array(
				'taxonomy' => 'category',
				'template' => $template,
				'category_template' => $category_template,
				'categories' => $categories,
				'hide_empty_cat' => $hide_empty_cat,
				'sub_categories' => $sub_categories,
				'category_label' => $category_label,
			));
		}

		// custom tags
		if ( 'yes'== $show_tags ) {
			$filterplus_get_attr = \FilterPlus\Utils\Helper::array_data($tags);
			// If no specific tags provided, get all post tags
			if (count($filterplus_get_attr) === 0) {
				$all_tags = get_terms(array(
					'taxonomy' => 'post_tag',
					'hide_empty' => true,
				));
				if (!is_wp_error($all_tags) && !empty($all_tags)) {
					$filterplus_get_attr = wp_list_pluck($all_tags, 'term_id');
				}
			}
			if (count($filterplus_get_attr)>0) {
				$title = !empty($tag_label) ? $tag_label : esc_html__("Filter By Tag","filter-plus");
				include \FilterPlus::locate_template( "wp-filter/template-".$template."/left-side/filter-layout-grid.php" );
			}
		}
		// custom fields
		if ( 'yes'== $custom_field ) {
			include \FilterPlus::locate_template( "wp-filter/parts/custom-fields.php" );
		}
		// author
		if ( 'yes'== $post_author ) {
			$filterplus_authors = \FilterPlus\Utils\Helper::instance()->author_list($author_list);
			if (count($filterplus_authors)>0) {
				$title =   !empty($author_label) ? $author_label : esc_html__("Authors","filter-plus");
				include \FilterPlus::locate_template( "wp-filter/template-".$template."/left-side/authors.php" );
			}
		}
	?>
</div>
<div class="row products-wrap">
	<div class="filter-mb-search"></div>
	<?php
		$_fp_tpl = \FilterPlus::locate_template( 'parts/filter-top.php' );
		if ( file_exists( $_fp_tpl ) ) {
			include_once $_fp_tpl;
		}
	?>
	<div class="post-grid-view-<?php echo esc_attr($template)?> prods-grid-view"></div>
	<div class="message"></div>
	<?php include_once \FilterPlus::locate_template( "wp-filter/template-".$template."/right-side/product-template.php" ); ?>
	<!-- pagination -->
	<ul class="pagination pagination-1"></ul>
</div>


