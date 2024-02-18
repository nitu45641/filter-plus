<!-- stock -->
<div class="sidebar-row">
	<h4 class="sidebar-label"><?php esc_html_e('Stock:','filter-plus-pro');?></h4>
	<div class="param-box">
        <label class="checkbox-item stock">
            <input type="checkbox" data-stock_text="<?php esc_html_e('In Stock','filter-plus-pro');?>"
            value="<?php echo esc_attr('instock');?>"/>
            <?php esc_html_e('In Stock','filter-plus-pro');?>
        </label>
        <label class="checkbox-item stock">
            <input type="checkbox" data-stock_text="<?php esc_html_e('Out Of Stock','filter-plus-pro');?>" value="<?php echo esc_attr('outofstock');?>"/>
            <?php esc_html_e('Out Of Stock','filter-plus-pro');?>
        </label>
		<span class="reset d-none reset-<?php esc_attr_e($template);?>"><?php esc_html_e('Reset','filter-plus-pro');?></span>
	</div>
</div>