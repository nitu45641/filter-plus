<?php

    if ( ! defined( 'ABSPATH' ) ) exit; 

    use FilterPlus\Core\Admin\FilterOptions\Helper as OptionHelper;
    if ($custom_field_list == '') {
        return;
    }
    $filterplus_lists = array();
    if ( !class_exists('FilterPlusPro') ) {
        $custom_field_label == '' ? esc_html__('Custom Field','filter-plus'): esc_html($custom_field_label);

        $filterplus_lists[] = array( 'label' => $custom_field_label , 'style'=> 'checkbox' , 'custom_field_list' => $custom_field_list );
    }
    else{
        $filterplus_lists	= OptionHelper::instance()->get_filter_option_list($custom_field_list);
    }
    if (empty($filterplus_lists)) {
        return;
    }

    foreach( $filterplus_lists as $filterplus_item ):

        // Date Range style: From / To date pickers instead of one input per stored value.
        if ( isset( $filterplus_item['style'] ) && 'date_range' === $filterplus_item['style'] ) {
            $filterplus_bounds = OptionHelper::instance()->get_date_bounds( $filterplus_item['custom_field_list'] );
            $filterplus_dr_id  = wp_unique_id( 'fp-date-range-' );
            ?>
            <div class="sidebar-row fp-date-range-row">
                <h4 class="sidebar-label" id="<?php echo esc_attr( $filterplus_dr_id ); ?>-label"><?php echo esc_html( $filterplus_item['label'] ); ?></h4>
                <div class="fp-date-range" role="group" aria-labelledby="<?php echo esc_attr( $filterplus_dr_id ); ?>-label"
                    data-meta_key="<?php echo esc_attr( $filterplus_item['custom_field_list'] ); ?>"
                    data-label="<?php echo esc_attr( $filterplus_item['label'] ); ?>">
                    <label class="fp-date-range__field">
                        <span><?php esc_html_e( 'From', 'filter-plus' ); ?></span>
                        <input type="date" class="fp-date-from" min="<?php echo esc_attr( $filterplus_bounds['min'] ); ?>" max="<?php echo esc_attr( $filterplus_bounds['max'] ); ?>" />
                    </label>
                    <label class="fp-date-range__field">
                        <span><?php esc_html_e( 'To', 'filter-plus' ); ?></span>
                        <input type="date" class="fp-date-to" min="<?php echo esc_attr( $filterplus_bounds['min'] ); ?>" max="<?php echo esc_attr( $filterplus_bounds['max'] ); ?>" />
                    </label>
                </div>
                <button type="button" class="fp-date-clear" hidden><?php esc_html_e( 'Clear dates', 'filter-plus' ); ?></button>
            </div>
            <?php
            continue;
        }

    ?>
    <div class="sidebar-row radio-wrap">
        <h4 class="sidebar-label"><?php echo esc_html($filterplus_item['label']) ?></h4>
        <div class="param-box custom-field-<?php echo esc_attr($template);?>">
            <?php
                $filterplus_field_list = OptionHelper::instance()->get_custom_fields_values($filterplus_item['custom_field_list']);

                if ( $filterplus_item['style'] !== 'select') {
                    foreach ($filterplus_field_list as $filterplus_key => $filterplus_field) {
                        ?>
                            <label class="checkbox-item checkbox-item-<?php echo esc_html($template);?> custom-field">
                                <input
                                name="custom-field"
                                type="<?php echo esc_attr($filterplus_item['style'])?>"
                                data-meta_condition="<?php echo esc_attr($meta_condition);?>"
                                data-meta_key="<?php echo esc_attr($filterplus_item['custom_field_list']);?>"
                                value="<?php echo esc_attr($filterplus_field->meta_value);?>"/>
                                <?php echo esc_html($filterplus_field->meta_value);?>
                            </label>
                        <?php
                    }
                }else{
                    ?>
                    <select name="custom-field"
                    class="custom-field"
                    data-meta_condition="<?php echo esc_attr($meta_condition);?>"
                    data-meta_key="<?php echo esc_attr($filterplus_item['custom_field_list']);?>"
                    >
                        <option value=""><?php echo esc_html__('Select','filter-plus').' '.esc_html($filterplus_item['label']) ?></option>
                        <?php foreach ($filterplus_field_list as $filterplus_key => $filterplus_field) {  ?>
                            <option value="<?php echo esc_attr($filterplus_field->meta_value);?>">
                                <?php echo esc_html($filterplus_field->meta_value);?>
                            </option>
                        <?php } ?>
                    </select>
                    <?php
                }
            ?>
        </div>
        <span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>
    </div>

    <?php endforeach; ?>
