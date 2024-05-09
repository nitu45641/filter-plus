<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="shop-sidebar sidebar-style-<?php echo esc_attr($template);?>">
	<?php include_once \FilterPlus::plugin_dir() . "templates/wp-filter/template-".$template."/left-side/product-search.php"; ?>
	<?php include_once \FilterPlus::plugin_dir() . "templates/wp-filter/parts/categories-list.php"; 
		// custom tags
		if ( 'yes'== $show_tags ) {
			$get_attr = \FilterPlus\Utils\Helper::array_data($tags);
			if (count($get_attr)>0) {
				$title = !empty($tag_label) ? $tag_label : esc_html__("Filter By Tag","filter-plus");
				include \FilterPlus::plugin_dir() . "templates/wp-filter/template-".$template."/left-side/filter-layout-grid.php";
			}
		}
		// custom fields
		if ( 'yes'== $custom_field ) {
			include \FilterPlus::plugin_dir() . "templates/wp-filter/parts/custom-fields.php";
		}
		// author
		if ( 'yes'== $author ) {
			$authors = \FilterPlus\Utils\Helper::instance()->author_list($author_list);
			
			if (count($authors)>0) {
				$title =   !empty($author_label) ? $author_label : esc_html__("Authors","filter-plus");
				include \FilterPlus::plugin_dir() . "templates/wp-filter/template-".$template."/left-side/authors.php";
			}
		}
	?>
</div>
<div class="row products-wrap">
	<?php 
		if (file_exists(\FilterPlus::plugin_dir() . 'templates/parts/filter-top.php')) {
			include_once \FilterPlus::plugin_dir() . 'templates/parts/filter-top.php'; 
		}
	?>
	<div class="prods-grid-view post-grid-view-<?php echo esc_attr($template)?>"></div>
	<div class="wp-list-view"></div>
	<div class="message"></div>
	<?php include_once \FilterPlus::plugin_dir() . "templates/wp-filter/template-".$template."/right-side/product-data.php"; ?>
	<!-- pagination -->
	<ul class="pagination pagination-1"></ul>
</div>


