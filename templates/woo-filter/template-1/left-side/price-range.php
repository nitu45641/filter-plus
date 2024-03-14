<!-- Price range -->
<?php
$get_price = \FilterPlus\Utils\Helper::instance()->get_price_range();
extract($get_price);
?>
<div class="sidebar-row price-range-area">
	<h4 class="sidebar-label"><?php echo !empty( $price_range_label ) ?  $price_range_label : esc_html__('Price Range','filter-plus');?></h4>
	<div class="slide-container">
		<input type="hidden" data-min="<?php echo absint($min)?>" data-max="<?php echo absint($max)?>" value="" class="slider range-slider">
		<div class="default-range">
			<span class="min"><?php echo (\FilterPlus\Utils\Helper::instance()->currency_position( $min )); ?></span>
			<span>-</span>
			<span class="max"><?php echo (\FilterPlus\Utils\Helper::instance()->currency_position( $max )); ?></span>
		</div>
	</div>
	<span class="reset d-none reset-<?php esc_attr_e($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>
</div>