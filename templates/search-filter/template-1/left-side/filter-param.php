<!-- Filter By Size -->
<?php
	if ( "yes" == $size ) {
		$attrs      = \FilterPlus\Utils\Helper::get_attributes("pa_size");
		$title      = esc_html__("Filter By Size","filter-plus");
		$get_attr   = array();
		foreach ($attrs['terms'] as $key => $value) {
			$get_attr[$key]  = $value->term_id;
		}
		
		include \FilterPlus::plugin_dir() . "templates/search-filter/template-".$template."/left-side/filter-layout-grid.php";
	}
?>

<!-- Filter By Color -->
<?php
	if ( "yes" == $colors ) {
	$get_attr = \FilterPlus\Utils\Helper::get_attributes("pa_color");
?>
	<div class="sidebar-row radio-wrap">
		<h4 class="sidebar-label"><?php echo esc_html__("Filter By") ." ".$get_attr['label'] ;?></h4>
		<div class="param-box">
			<?php
				if (!empty( $get_attr['terms'] ) ) {
					foreach ( $get_attr['terms'] as $key => $value) { ?>
						<div class="radio-item color-item" 
						data-term_id="<?php esc_attr_e($value->term_id); ?>"
						data-taxonomy="<?php esc_attr_e($value->taxonomy); ?>"
						style="background-color: <?php esc_attr_e(strtolower($value->name))?>"></div>
					<?php }
				}
			?>
		</div>
		<span class="reset d-none"><?php esc_html_e('Reset','filter-plus');?></span>		
	</div>
<?php
}
?>

