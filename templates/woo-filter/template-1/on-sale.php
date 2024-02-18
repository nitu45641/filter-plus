<!-- on sale -->
<div class="sidebar-row">
	<h4 class="sidebar-label"><?php esc_html_e('Sales:','filter-plus-pro');?></h4>
	<div class="param-box">
        <label class="checkbox-item on_sale">
            <input type="checkbox"  data-on_sale_text="<?php esc_html_e('On Sale','filter-plus-pro');?>"
            value="<?php echo esc_attr('true');?>"/>
            <?php esc_html_e('On Sale','filter-plus-pro');?>
        </label>
        <label class="checkbox-item on_sale">
            <input type="checkbox" 
            data-on_sale_text="<?php esc_html_e('Regular Sale','filter-plus-pro');?>"
            value="<?php echo esc_attr('false');?>"/>
            <?php esc_html_e('Regular Sale','filter-plus-pro');?>
        </label>
		<span class="reset d-none reset-<?php esc_attr_e($template);?>"><?php esc_html_e('Reset','filter-plus-pro');?></span>
	</div>
</div>