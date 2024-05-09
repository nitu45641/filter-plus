<?php

if ($custom_field_list == '') {
    return;
}
?>
<div class="sidebar-row radio-wrap">
    <h4 class="sidebar-label"><?php echo $custom_field_label == '' ? esc_html__('Custom Field','filter-plus-pro'): esc_html($custom_field_label);?></h4>
	<div class="param-box custom-field-<?php echo esc_attr($template);?>">
		<?php
            $field_list = \FilterPlusPro\Utils\Helper::instance()->get_custom_fields_values($custom_field_list);

			foreach ($field_list as $key => $field) {
                ?>
                    <label class="checkbox-item custom-field">
                        <input type="checkbox" 
                        data-meta_condition="<?php echo esc_attr($meta_condition);?>"
                        data-meta_value="<?php echo esc_attr($field->meta_value);?>"
                        value="<?php echo esc_attr($custom_field_list);?>"/>
                        <?php echo esc_html($field->meta_value);?>
                    </label>
                <?php
			}
		?>
	</div>
	<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus-pro');?></span>	
</div>
