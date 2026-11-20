<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div id="filter-options-form-wrap" class="d-none mt-2">
    <div class="content-header flp-form-header mb-2">
        <button type="button" class="close-filter-option-form flp-back-btn" aria-label="<?php esc_attr_e( 'Back to Filter Options', 'filter-plus' ); ?>">
            <span aria-hidden="true">&larr;</span> <?php esc_html_e( 'Back', 'filter-plus' ); ?>
        </button>
        <div class="title filter-option-form-title"><?php esc_html_e( 'Add New Filter Option', 'filter-plus' ); ?></div>
    </div>
    <section class="filter-option-form-card">
        <form method="POST" id="add-filter-option" class="fields">
            <?php
			    $filterplus_meta_keys = \FilterPlus\Utils\Helper::instance()->get_custom_fields_keys();
                $filterplus_args = array(
                    'label'=>'',
                    'placeholder'=>'',
                    'field_type' => 'hidden',
                    'id' => 'id',
                    'value' => '' ,
                );
                filterplus_number_input_field($filterplus_args);

                $filterplus_args = array(
                'label'         => esc_html__("Field Type:","filter-plus"),
                'id'            => 'type',
                'type'          => 'random',
                'data_label'    => 'field_type',
                'options'       => array(
                    'custom_field'=>__('Custom Field','filter-plus'),
                ),
                'selected'      =>'custom_field'
                );

                filterplus_select_field($filterplus_args);

                $filterplus_args = array(
                    'label'=>esc_html__('Label','filter-plus'),
                    'placeholder'=>esc_html__('Enter Label','filter-plus'),
                    'field_type' => 'text',
                    'id' => 'label',
                    'value' => '' ,
                );
                filterplus_number_input_field($filterplus_args);

                $filterplus_args = array(
                    'label'         => esc_html__("Style:","filter-plus"),
                    'id'            => 'style',
                    'type'          => 'random',
                    'data_label'    => 'style',
                    'options'       => array(
                        'select'    =>__('Select','filter-plus'),
                        'checkbox'  =>__('Checkbox','filter-plus'),
                        'radio'     =>__('Radio','filter-plus'),
                        'date_range'=>__('Date Range','filter-plus'),
                    ),
                    'selected'      =>'Select'
                );

                filterplus_select_field($filterplus_args);

                $filterplus_args        = array(
                    'label'=>esc_html__("Custom Field List:","filter-plus"),
                    'id' => 'custom_field_list',
                    'data_label' => 'custom_field_list',
                    'options'=>$filterplus_meta_keys ,
                    'type' => 'random',
                    'select_type' => 'single',
                );
                filterplus_select_field($filterplus_args);

            ?>
            <div class="filter-option-form-actions">
                <button type="button" class="button close-filter-option-form"><?php esc_html_e( 'Cancel', 'filter-plus' ); ?></button>
                <button type="submit" class="button button-primary add-filter-option <?php echo class_exists('FilterPlusPro') ? '': 'disable'?>"><?php esc_html_e( 'Save Filter Option', 'filter-plus' ); ?></button>
            </div>
        </form>
    </section>
</div>
