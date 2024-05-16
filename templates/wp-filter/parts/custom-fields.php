<?php
use FilterPlus\Core\Admin\FilterOptions\Helper as OptionHelper;
if ($custom_field_list == '') {
    return;
}
$lists = array();
if ( !class_exists('FilterPlusPro') ) {
    $custom_field_label == '' ? esc_html__('Custom Field','filter-plus-pro'): esc_html($custom_field_label);

    $lists[] = array( 'label' => $custom_field_label , 'style'=> 'checkbox' , 'custom_field_list' => $custom_field_list );
}
else{
    
}
if (empty($lists)) {
    return;
}
error_log(json_encode($lists));
foreach( $lists as $item ):

?>
<div class="sidebar-row radio-wrap">
    <h4 class="sidebar-label"><?php echo esc_html($item['label']) ?></h4>
	<div class="param-box custom-field-<?php echo esc_attr($template);?>">
		<?php
            $field_list = OptionHelper::instance()->get_custom_fields_values($custom_field_list);

			foreach ($field_list as $key => $field) {
                if ( $item['style'] !== 'select') {
                ?>
                    <label class="checkbox-item custom-field">
                        <input type="<?php echo esc_attr($item['style'])?>" 
                        data-meta_condition="<?php echo esc_attr($meta_condition);?>"
                        data-meta_value="<?php echo esc_attr($field->meta_value);?>"
                        value="<?php echo esc_attr($custom_field_list);?>"/>
                        <?php echo esc_html($field->meta_value);?>
                    </label>
                <?php
                }
			}
		?>
	</div>
	<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus-pro');?></span>	
</div>

<?php endforeach; ?>
