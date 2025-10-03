import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, SelectControl, TextControl, ToggleControl, CheckboxControl } from '@wordpress/components';
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
        },
        hide_wp_title: {
            type: 'boolean',
            default: true
        },
        hide_wp_desc: {
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

                                <div style={{ marginBottom: '12px' }}>
                                    <label style={{ display: 'block', marginBottom: '8px', fontWeight: '500' }}>
                                        {__('Category List', 'filter-plus')}
                                    </label>
                                    {(window.filterPlus?.wp_cats || []).map((option) => (
                                        <CheckboxControl
                                            key={option.value}
                                            label={option.label}
                                            checked={attributes.categories.includes(option.value)}
                                            onChange={(checked) => {
                                                const newCategories = checked
                                                    ? [...attributes.categories, option.value]
                                                    : attributes.categories.filter(v => v !== option.value);
                                                setAttributes({ categories: newCategories });
                                            }}
                                        />
                                    ))}
                                </div>

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

                                <div style={{ marginBottom: '12px' }}>
                                    <label style={{ display: 'block', marginBottom: '8px', fontWeight: '500' }}>
                                        {__('Tags', 'filter-plus')}
                                    </label>
                                    {(window.filterPlus?.post_tag || []).map((option) => (
                                        <CheckboxControl
                                            key={option.value}
                                            label={option.label}
                                            checked={attributes.tags.includes(option.value)}
                                            onChange={(checked) => {
                                                const newTags = checked
                                                    ? [...attributes.tags, option.value]
                                                    : attributes.tags.filter(v => v !== option.value);
                                                setAttributes({ tags: newTags });
                                            }}
                                        />
                                    ))}
                                </div>
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

                                <div style={{ marginBottom: '12px' }}>
                                    <label style={{ display: 'block', marginBottom: '8px', fontWeight: '500' }}>
                                        {__('Author List', 'filter-plus')}
                                    </label>
                                    {(window.filterPlus?.author_list || []).map((option) => (
                                        <CheckboxControl
                                            key={option.value}
                                            label={option.label}
                                            checked={attributes.author_list.includes(option.value)}
                                            onChange={(checked) => {
                                                const newAuthors = checked
                                                    ? [...attributes.author_list, option.value]
                                                    : attributes.author_list.filter(v => v !== option.value);
                                                setAttributes({ author_list: newAuthors });
                                            }}
                                        />
                                    ))}
                                </div>
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
                            label={__('Hide Title', 'filter-plus')}
                            checked={attributes.hide_wp_title}
                            onChange={(value) => setAttributes({ hide_wp_title: value })}
                        />

                        <ToggleControl
                            label={__('Hide Description', 'filter-plus')}
                            checked={attributes.hide_wp_desc}
                            onChange={(value) => setAttributes({ hide_wp_desc: value })}
                        />

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
                    <div className="filter-plus-block-placeholder" style={{
                        border: '2px dashed #ccc',
                        borderRadius: '8px',
                        padding: '40px 20px',
                        textAlign: 'center',
                        backgroundColor: '#f9f9f9',
                        minHeight: '300px',
                        display: 'flex',
                        flexDirection: 'column',
                        alignItems: 'center',
                        justifyContent: 'center'
                    }}>
                        <div style={{
                            fontSize: '48px',
                            marginBottom: '16px',
                            opacity: '0.5'
                        }}>🔍</div>
                        <h3 style={{
                            margin: '0 0 8px 0',
                            fontSize: '18px',
                            fontWeight: '600',
                            color: '#1e1e1e'
                        }}>{__('WordPress Content Filter', 'filter-plus')}</h3>
                        <p style={{
                            margin: '0 0 20px 0',
                            color: '#757575',
                            fontSize: '14px'
                        }}>
                            {__('Customize the filtering options from the block settings', 'filter-plus')}
                        </p>
                        <div style={{
                            display: 'grid',
                            gridTemplateColumns: '1fr 1fr',
                            gap: '10px',
                            width: '100%',
                            maxWidth: '400px',
                            marginTop: '10px',
                            fontSize: '12px',
                            color: '#666'
                        }}>
                            <div style={{ padding: '8px', backgroundColor: '#fff', borderRadius: '4px', border: '1px solid #e0e0e0' }}>
                                📁 {attributes.show_categories ? __('Categories', 'filter-plus') : ''}
                            </div>
                            <div style={{ padding: '8px', backgroundColor: '#fff', borderRadius: '4px', border: '1px solid #e0e0e0' }}>
                                🏷️ {attributes.show_tags ? __('Tags', 'filter-plus') : ''}
                            </div>
                            <div style={{ padding: '8px', backgroundColor: '#fff', borderRadius: '4px', border: '1px solid #e0e0e0' }}>
                                👤 {attributes.author ? __('Authors', 'filter-plus') : ''}
                            </div>
                            <div style={{ padding: '8px', backgroundColor: '#fff', borderRadius: '4px', border: '1px solid #e0e0e0' }}>
                                ⚙️ {attributes.custom_field ? __('Custom Fields', 'filter-plus') : ''}
                            </div>
                        </div>
                    </div>
                </div>
            </>
        );
    },

    save() {
        return null; // Server-side rendering
    }
});
