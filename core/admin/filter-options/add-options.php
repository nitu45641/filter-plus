<div class="popup-modal" id="filter-options-modal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="content-header">
                <div class="title"><?php esc_html_e('Add Filter Options','filter-plus'); ?></div>
            </div>
            <span class="modal-close">&times;</span>
        </div>
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
            <button type="submit" class="button button-primary add-filter-option mt-3 <?php echo class_exists('FilterPlusPro') ? '': 'disable'?>"><?php esc_html_e('Save Changes','filter-plus'); ?></button>
        </form>
    </div>
</div>