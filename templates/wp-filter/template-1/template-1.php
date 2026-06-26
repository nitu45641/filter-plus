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
		if ( 'yes'== $author ) {
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
	<?php
		$_fp_editor_grid = '';
		$_fp_is_rest = defined( 'REST_REQUEST' ) && REST_REQUEST;
		if ( $_fp_is_rest ) {
			$_fp_actual_type = ( isset( $filter_type ) && $filter_type !== 'post' && ! empty( $custom_post ) ) ? $custom_post : 'post';
			$_fp_actions = \FilterPlus\Core\Frontend\SearchFilter\Actions::instance();
			$_fp_result  = $_fp_actions->get_products( array(
				'filter_type'        => $_fp_actual_type,
				'offset'             => 1,
				'limit'              => isset( $no_of_items ) ? intval( $no_of_items ) : 9,
				'author'             => '',
				'filter_param'       => array(),
				'cat_id'             => '',
				'taxonomies'         => array(),
				'search_value'       => '',
				'min'                => '',
				'max'                => '',
				'rating'             => '',
				'product_tags'       => 'yes',
				'show_sale_badge'    => 'yes',
				'post_author'        => isset( $post_author ) ? $post_author : 'yes',
				'order_by'           => '',
				'product_categories' => isset( $post_categories ) ? $post_categories : 'yes',
				'stock'              => '',
				'on_sale'            => '',
				'cf_list'            => array(),
				'masonry_style'      => isset( $masonry_style ) ? $masonry_style : 'no',
				'exclude_cat_id'     => '',
				'taxonomy'           => 'category',
				'pagination_style'   => 'numbers',
				'template'           => isset( $template ) ? $template : '1',
				'hide_wp_title'      => isset( $hide_wp_title ) ? $hide_wp_title : 'yes',
				'hide_wp_desc'       => isset( $hide_wp_desc ) ? $hide_wp_desc : 'yes',
			) );
			$_fp_rendered    = $_fp_actions->render_products_html( $_fp_result['products'], $_fp_actual_type, isset( $template ) ? $template : '1' );
			$_fp_editor_grid = $_fp_rendered['grid'];
		}
	?>
	<div class="post-grid-view-<?php echo esc_attr($template)?> prods-grid-view"<?php echo ! empty( $_fp_editor_grid ) ? ' data-editor-products="1"' : ''; ?>>
		<?php echo $_fp_editor_grid; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- pre-rendered trusted HTML ?>
	</div>
	<div class="message"></div>
	<?php include_once \FilterPlus::locate_template( "wp-filter/template-".$template."/right-side/product-template.php" ); ?>
	<!-- pagination -->
	<ul class="pagination pagination-1"></ul>
</div>


