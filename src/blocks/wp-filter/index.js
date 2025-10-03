import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, SelectControl, TextControl, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType('filter-plus/wp-filter', {
    title: __('WordPress Content Filter', 'filter-plus'),
    icon: 'image-filter',
    category: 'filter-plus-blocks',
    attributes: {
        filter_type: {
            type: 'string',
            default: 'post'
        },
        custom_post: {
            type: 'string',
            default: ''
        },
        template: {
            type: 'string',
            default: '1'
        },
        title: {
            type: 'string',
            default: ''
        },
        no_of_items: {
            type: 'number',
            default: 9
        },
        show_categories: {
            type: 'boolean',
            default: true
        },
        category_label: {
            type: 'string',
            default: ''
        },
        categories: {
            type: 'array',
            default: []
        },
        sub_categories: {
            type: 'boolean',
            default: true
        },
        show_tags: {
            type: 'boolean',
            default: true
        },
        tag_label: {
            type: 'string',
            default: ''
        },
        tags: {
            type: 'array',
            default: []
        },
        author: {
            type: 'boolean',
            default: false
        },
        author_label: {
            type: 'string',
            default: ''
        },
        author_list: {
            type: 'array',
            default: []
        },
        custom_field: {
            type: 'boolean',
            default: false
        },
        custom_field_label: {
            type: 'string',
            default: ''
        },
        meta_condition: {
            type: 'string',
            default: 'OR'
        },
        custom_field_list: {
            type: 'string',
            default: ''
        },
        post_categories: {
            type: 'boolean',
            default: true
        },
        post_tags: {
            type: 'boolean',
            default: true
        },
        post_author: {
            type: 'boolean',
            default: true
        }
    },

    edit({ attributes, setAttributes }) {
        const blockProps = useBlockProps();

        const isPro = () => {
            return window.filterPlus?.is_pro_active == 1 ? __('(Pro)', 'filter-plus') : '';
        };

        const isDisabled = () => {
            return window.filterPlus?.is_pro_active == 0 ? false : true;
        };

        const getTemplateOptions = () => {
            const disabled = isDisabled();
            let options = [];
            for (let i = 1; i <= 3; i++) {
                options.push({
                    value: i.toString(),
                    label: __('Template-' + i, 'filter-plus') + ' ' + isPro(),
                    disabled
                });
            }
            return options;
        };

        return (
            <>
                <InspectorControls>
                    <PanelBody title={__('Filter Options', 'filter-plus')}>
                        <SelectControl
                            label={__('Select Template', 'filter-plus')}
                            value={attributes.template}
                            options={getTemplateOptions()}
                            onChange={(value) => setAttributes({ template: value })}
                        />

                        <SelectControl
                            label={__('Select Filter Type', 'filter-plus')}
                            value={attributes.filter_type}
                            options={[
                                { value: 'post', label: __('Post', 'filter-plus'), disabled: isDisabled() },
                                { value: 'custom_post', label: __('Custom Post', 'filter-plus'), disabled: isDisabled() }
                            ]}
                            onChange={(value) => setAttributes({ filter_type: value })}
                        />

                        {attributes.filter_type === 'custom_post' && (
                            <SelectControl
                                label={__('Select Custom Post Type', 'filter-plus')}
                                value={attributes.custom_post}
                                options={window.filterPlus?.custom_post_type || []}
                                onChange={(value) => setAttributes({ custom_post: value })}
                            />
                        )}

                        <TextControl
                            label={__('Title', 'filter-plus')}
                            value={attributes.title}
                            onChange={(value) => setAttributes({ title: value })}
                            placeholder={__('Place Title', 'filter-plus')}
                        />

                        <TextControl
                            label={__('No of Items Per Page', 'filter-plus')}
                            type="number"
                            value={attributes.no_of_items}
                            onChange={(value) => setAttributes({ no_of_items: parseInt(value) })}
                            placeholder={__('Place No of Items Per Page', 'filter-plus')}
                        />

                        <ToggleControl
                            label={__('Display Categories', 'filter-plus')}
                            checked={attributes.show_categories}
                            onChange={(value) => setAttributes({ show_categories: value })}
                        />

                        {attributes.show_categories && (
                            <>
                                <TextControl
                                    label={__('Category Label', 'filter-plus')}
                                    value={attributes.category_label}
                                    onChange={(value) => setAttributes({ category_label: value })}
                                    placeholder={__('Place Category Label', 'filter-plus')}
                                />

                                <SelectControl
                                    multiple
                                    label={__('Category List', 'filter-plus')}
                                    value={attributes.categories}
                                    options={window.filterPlus?.wp_cats || []}
                                    onChange={(value) => setAttributes({ categories: value })}
                                />

                                <ToggleControl
                                    label={__('Display Sub Categories', 'filter-plus')}
                                    checked={attributes.sub_categories}
                                    onChange={(value) => setAttributes({ sub_categories: value })}
                                />
                            </>
                        )}

                        <ToggleControl
                            label={__('Display Tags', 'filter-plus')}
                            checked={attributes.show_tags}
                            onChange={(value) => setAttributes({ show_tags: value })}
                        />

                        {attributes.show_tags && (
                            <>
                                <TextControl
                                    label={__('Tag Label', 'filter-plus')}
                                    value={attributes.tag_label}
                                    onChange={(value) => setAttributes({ tag_label: value })}
                                />

                                <SelectControl
                                    multiple
                                    label={__('Tags', 'filter-plus')}
                                    value={attributes.tags}
                                    options={window.filterPlus?.post_tag || []}
                                    onChange={(value) => setAttributes({ tags: value })}
                                />
                            </>
                        )}

                        <ToggleControl
                            label={__('Display Authors', 'filter-plus')}
                            checked={attributes.author}
                            onChange={(value) => setAttributes({ author: value })}
                        />

                        {attributes.author && (
                            <>
                                <TextControl
                                    label={__('Author Label', 'filter-plus')}
                                    value={attributes.author_label}
                                    onChange={(value) => setAttributes({ author_label: value })}
                                    placeholder={__('Place Author Label', 'filter-plus')}
                                />

                                <SelectControl
                                    multiple
                                    label={__('Author List', 'filter-plus')}
                                    value={attributes.author_list}
                                    options={window.filterPlus?.author_list || []}
                                    onChange={(value) => setAttributes({ author_list: value })}
                                />
                            </>
                        )}

                        <ToggleControl
                            label={__('Display Custom Field', 'filter-plus')}
                            checked={attributes.custom_field}
                            onChange={(value) => setAttributes({ custom_field: value })}
                        />

                        {attributes.custom_field && (
                            <>
                                <TextControl
                                    label={__('Custom Field Label', 'filter-plus')}
                                    value={attributes.custom_field_label}
                                    onChange={(value) => setAttributes({ custom_field_label: value })}
                                    placeholder={__('Custom Field Label', 'filter-plus')}
                                />

                                <TextControl
                                    label={__('Custom Field Name', 'filter-plus')}
                                    value={attributes.custom_field_list}
                                    onChange={(value) => setAttributes({ custom_field_list: value })}
                                    help={__('Enter Exact Custom Field Name', 'filter-plus')}
                                />

                                <SelectControl
                                    label={__('Meta Condition', 'filter-plus')}
                                    value={attributes.meta_condition}
                                    options={[
                                        { value: 'OR', label: __('OR', 'filter-plus') },
                                        { value: 'AND', label: __('AND', 'filter-plus') }
                                    ]}
                                    onChange={(value) => setAttributes({ meta_condition: value })}
                                />
                            </>
                        )}
                    </PanelBody>

                    <PanelBody title={__('Filter Result Options', 'filter-plus')}>
                        <ToggleControl
                            label={__('Display Categories in Filter Result', 'filter-plus')}
                            checked={attributes.post_categories}
                            onChange={(value) => setAttributes({ post_categories: value })}
                        />

                        <ToggleControl
                            label={__('Display Tags in Filter Result', 'filter-plus')}
                            checked={attributes.post_tags}
                            onChange={(value) => setAttributes({ post_tags: value })}
                        />

                        <ToggleControl
                            label={__('Display Author in Filter Result', 'filter-plus')}
                            checked={attributes.post_author}
                            onChange={(value) => setAttributes({ post_author: value })}
                        />
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps}>
                    <div className="filter-plus-block-placeholder">
                        <p>{__('WordPress Content Filter', 'filter-plus')}</p>
                        <p className="description">
                            {__('Customize the filtering options from the block settings', 'filter-plus')}
                        </p>
                    </div>
                </div>
            </>
        );
    },

    save() {
        return null; // Server-side rendering
    }
});
