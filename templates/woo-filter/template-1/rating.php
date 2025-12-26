<!-- rating -->
<?php if ( ! defined( 'ABSPATH' ) ) exit;

use FilterPlus\Utils\Helper;

if ( $review_template !== '1' ) {
	if ( class_exists('FilterPlusPro') && file_exists(\FilterPlusPro::plugin_dir() . "templates/woo-filter/parts/rating.php")) {
		include_once \FilterPlusPro::plugin_dir() . "templates/woo-filter/parts/rating.php";
	}
	return;
}
?>
<div class="panel sidebar-row">
	<h4 class="sidebar-label"><?php echo !empty( $review_label ) ? esc_html( $review_label ) : esc_html__('Rating','filter-plus');?></h4>
	<ul class=" ratings rating-wrap" id="">
		<?php
			for ( $filterplus_i = 5; $filterplus_i >= 1; $filterplus_i-- ) {
				Helper::rating_html( $filterplus_i, $template );
			}
		?>
	</ul>
	<span class="reset d-none reset-<?php echo esc_html($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>
</div>