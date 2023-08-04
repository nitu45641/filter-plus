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
		<div class="down-arrow">
			<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"/></svg>
		</div>
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
	</div>
<?php
}
?>

