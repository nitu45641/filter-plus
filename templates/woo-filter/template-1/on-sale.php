<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<!-- on sale -->
<div class="sidebar-row">
    <h4 class="sidebar-label"><?php echo !empty( $on_sale_label ) ?  $on_sale_label : esc_html__('Sales','filter-plus');?></h4>
	<div class="param-box">
        <label class="checkbox-item on_sale checkbox-item-<?php echo esc_html($template);?>">
            <input type="checkbox"  data-on_sale_text="<?php esc_html_e('On Sale','filter-plus');?>"
            value="<?php echo esc_attr('true');?>"/>
            <?php esc_html_e('On Sale','filter-plus');?>
        </label>
        <label class="checkbox-item on_sale checkbox-item-<?php echo esc_html($template);?>">
            <input type="checkbox" 
            data-on_sale_text="<?php esc_html_e('Regular Sale','filter-plus');?>"
            value="<?php echo esc_attr('false');?>"/>
            <?php esc_html_e('Regular Sale','filter-plus');?>
        </label>
		<span class="reset d-none reset-<?php echo esc_html($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>
	</div>
</div>