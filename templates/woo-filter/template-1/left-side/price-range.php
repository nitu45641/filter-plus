<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<!-- Price range -->
<?php

$filter_plus_price = \FilterPlus\Utils\Helper::instance()->get_price_range();
extract( $filter_plus_price );
?>
<div class="sidebar-row price-range-area">
	<h4 class="sidebar-label"><?php echo !empty( $price_range_label ) ?  $price_range_label : esc_html__('Price Range','filter-plus');?></h4>
	<div class="slide-container">
		<input type="hidden" data-min="<?php echo absint($min)?>" data-max="<?php echo absint($max)?>" value="" class="slider range-slider">
		<div class="custom-range-slider">
			<div class="range-track">
				<div class="range-fill"></div>
			</div>
			<div class="range-thumb range-thumb-min" data-thumb="min"></div>
			<div class="range-thumb range-thumb-max" data-thumb="max"></div>
		</div>
		<div class="range-labels">
			<span class="range-label-min"><?php echo (\FilterPlus\Utils\Helper::instance()->currency_position( $min )); ?></span>
			<span class="range-separator">-</span>
			<span class="range-label-max"><?php echo (\FilterPlus\Utils\Helper::instance()->currency_position( $max )); ?></span>
		</div>
		<div class="default-range" style="display: none;">
			<span class="min"><?php echo (\FilterPlus\Utils\Helper::instance()->currency_position( $min )); ?></span>
			<span>-</span>
			<span class="max"><?php echo (\FilterPlus\Utils\Helper::instance()->currency_position( $max )); ?></span>
		</div>
	</div>
	<span class="reset d-none reset-<?php echo esc_html($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>
</div>