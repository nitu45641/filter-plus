<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<!-- stock -->
<div class="sidebar-row">
    <h4 class="sidebar-label"><?php echo !empty( $stock_label ) ?  $stock_label : esc_html__('Stock','filter-plus');?></h4>
	<div class="param-box">
        <label class="stock checkbox-item checkbox-item-<?php echo esc_html($template);?>">
            <input type="checkbox" data-stock_text="<?php esc_html_e('In Stock','filter-plus');?>"
            value="<?php echo esc_attr('instock');?>"/>
            <?php esc_html_e('In Stock','filter-plus');?>
        </label>
        <label class="checkbox-item stock checkbox-item-<?php echo esc_html($template);?>" >
            <input type="checkbox" data-stock_text="<?php esc_html_e('Out Of Stock','filter-plus');?>" value="<?php echo esc_attr('outofstock');?>"/>
            <?php esc_html_e('Out Of Stock','filter-plus');?>
        </label>
		<span class="reset d-none 
            reset-<?php echo esc_html($template);?>">
            <?php esc_html_e('Reset','filter-plus');?>
        </span>
	</div>
</div>