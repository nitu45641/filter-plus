<!-- Filter By Size -->
<?php

	if ( ! defined( 'ABSPATH' ) ) exit;

	if ( "yes" == $size ) {
		$attrs      = \FilterPlus\Utils\Helper::get_attributes("pa_size");
		$title      = !empty($size_label) ? $size_label : esc_html__("Filter By Size","filter-plus");
		$get_attr   = array();
		foreach ($attrs['terms'] as $key => $value) {
			$get_attr[$key]  = $value->term_id;
		}
		
		include \FilterPlus::plugin_dir() . "templates/woo-filter/template-".$template."/left-side/filter-layout-grid.php";
	}
?>

<!-- Filter By Color -->
<?php
	if ( "yes" == $colors ) {
	$get_attr = \FilterPlus\Utils\Helper::get_attributes("pa_color");
?>
	<div class="sidebar-row radio-wrap">
		<h4 class="sidebar-label"><?php echo 
		!empty($color_label) ? $color_label : esc_html__("Filter By") ." ".esc_html($get_attr['label']) ;?></h4>
		<div class="panel">
			<div class="param-box">
				<?php
					if (!empty( $get_attr['terms'] ) ) {
						foreach ( $get_attr['terms'] as $key => $value) { ?>
							<div class="radio-item color-item" 
							data-term_id="<?php echo esc_attr($value->term_id); ?>"
							data-taxonomy="<?php echo esc_attr($value->taxonomy); ?>"
							data-name="<?php echo esc_attr($value->name); ?>"
							data-slug="<?php echo esc_attr($value->slug); ?>"
							style="background-color: <?php echo esc_attr(strtolower($value->name))?>"></div>
						<?php }
					}
				?>
			</div>
			<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>
		</div>		
	</div>
<?php
}
?>

