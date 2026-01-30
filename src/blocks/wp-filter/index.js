import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, SelectControl, TextControl, ToggleControl, CheckboxControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType('filter-plus/wp-filter', {
    title: __('WP Content Filter', 'filter-plus'),
    icon: 'filter',
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
        },
        filter_position: {
            type: 'string',
            default: 'left'
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
            let options = [
                { value: '1', label: __('Template-1', 'filter-plus') }
            ];
            for (let i = 2; i <= 3; i++) {
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

                        <SelectControl
                            label={__('Filter Position', 'filter-plus')}
                            value={attributes.filter_position}
                            options={[
                                { value: 'left', label: __('Left', 'filter-plus') },
                                { value: 'right', label: __('Right', 'filter-plus') },
                                { value: 'top', label: __('Top', 'filter-plus') }
                            ]}
                            onChange={(value) => setAttributes({ filter_position: value })}
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
                    <div style={{
                        border: '1px solid #e0e0e0',
                        borderRadius: '4px',
                        padding: '20px',
                        backgroundColor: '#fff',
                        minHeight: '400px'
                    }}>
                        <div style={{
                            display: 'flex',
                            gap: '20px',
                            flexDirection: attributes.filter_position === 'top' ? 'column' : 'row'
                        }}>
                            {/* Left Sidebar - Filters */}
                            <div style={{
                                width: attributes.filter_position === 'top' ? '100%' : '250px',
                                backgroundColor: '#f9f9f9',
                                padding: '15px',
                                borderRadius: '4px',
                                border: '1px solid #e0e0e0'
                            }}>
                                <div style={{ marginBottom: '20px', textAlign: 'center', color: '#666', fontSize: '12px' }}>
                                    {__('Filter Section', 'filter-plus')}
                                </div>

                                {attributes.show_categories && (
                                    <div style={{ marginBottom: '15px' }}>
                                        <div style={{ fontWeight: '600', fontSize: '14px', marginBottom: '8px', color: '#333' }}>
                                            {attributes.category_label || __('Categories', 'filter-plus')}
                                        </div>
                                        <div style={{ fontSize: '12px', color: '#666', paddingLeft: '10px' }}>
                                            {['□ Category 1', '□ Category 2', '□ Category 3'].map((item, i) => (
                                                <div key={i} style={{ padding: '4px 0' }}>{item}</div>
                                            ))}
                                        </div>
                                    </div>
                                )}

                                {attributes.show_tags && (
                                    <div style={{ marginBottom: '15px' }}>
                                        <div style={{ fontWeight: '600', fontSize: '14px', marginBottom: '8px', color: '#333' }}>
                                            {attributes.tag_label || __('Tags', 'filter-plus')}
                                        </div>
                                        <div style={{ fontSize: '12px', color: '#666', paddingLeft: '10px' }}>
                                            {['□ Tag 1', '□ Tag 2', '□ Tag 3'].map((item, i) => (
                                                <div key={i} style={{ padding: '4px 0' }}>{item}</div>
                                            ))}
                                        </div>
                                    </div>
                                )}

                                {attributes.author && (
                                    <div style={{ marginBottom: '15px' }}>
                                        <div style={{ fontWeight: '600', fontSize: '14px', marginBottom: '8px', color: '#333' }}>
                                            {attributes.author_label || __('Authors', 'filter-plus')}
                                        </div>
                                        <div style={{ fontSize: '12px', color: '#666', paddingLeft: '10px' }}>
                                            {['□ Author 1', '□ Author 2'].map((item, i) => (
                                                <div key={i} style={{ padding: '4px 0' }}>{item}</div>
                                            ))}
                                        </div>
                                    </div>
                                )}

                                {attributes.custom_field && (
                                    <div style={{ marginBottom: '15px' }}>
                                        <div style={{ fontWeight: '600', fontSize: '14px', marginBottom: '8px', color: '#333' }}>
                                            {attributes.custom_field_label || __('Custom Field', 'filter-plus')}
                                        </div>
                                        <div style={{ fontSize: '12px', color: '#666', paddingLeft: '10px' }}>
                                            {['□ Option 1', '□ Option 2'].map((item, i) => (
                                                <div key={i} style={{ padding: '4px 0' }}>{item}</div>
                                            ))}
                                        </div>
                                    </div>
                                )}
                            </div>

                            {/* Right Content - Grid */}
                            <div style={{ flex: 1 }}>
                                {attributes.title && (
                                    <h2 style={{
                                        fontSize: '24px',
                                        fontWeight: '600',
                                        marginBottom: '20px',
                                        color: '#1e1e1e'
                                    }}>
                                        {attributes.title}
                                    </h2>
                                )}

                                <div style={{
                                    display: 'grid',
                                    gridTemplateColumns: attributes.template === '1' ? 'repeat(auto-fill, minmax(280px, 1fr))' :
                                                         attributes.template === '2' ? 'repeat(auto-fill, minmax(250px, 1fr))' :
                                                         'repeat(auto-fill, minmax(300px, 1fr))',
                                    gap: attributes.template === '1' ? '20px' : attributes.template === '2' ? '15px' : '25px'
                                }}>
                                    {[
                                        { title: 'Getting Started with WordPress', cat: 'Tutorial', tag: 'Beginner', author: 'John Doe', date: 'March 15, 2024' },
                                        { title: 'Advanced Filter Techniques', cat: 'Guide', tag: 'Advanced', author: 'Jane Smith', date: 'March 14, 2024' },
                                        { title: 'Building Custom Post Types', cat: 'Development', tag: 'Developer', author: 'Mike Johnson', date: 'March 13, 2024' },
                                        { title: 'Content Strategy Tips', cat: 'Marketing', tag: 'Content', author: 'Sarah Lee', date: 'March 12, 2024' },
                                        { title: 'SEO Best Practices', cat: 'SEO', tag: 'Optimization', author: 'Tom Wilson', date: 'March 11, 2024' },
                                        { title: 'Plugin Development Guide', cat: 'Development', tag: 'Plugin', author: 'John Doe', date: 'March 10, 2024' }
                                    ].slice(0, parseInt(attributes.no_of_items) || 6).map((item, index) => {
                                        // Template 1 - Card Style
                                        if (attributes.template === '1') {
                                            return (
                                                <div key={index} style={{
                                                    border: '1px solid #e5e7eb',
                                                    borderRadius: '8px',
                                                    overflow: 'hidden',
                                                    backgroundColor: '#fff',
                                                    boxShadow: '0 1px 3px rgba(0,0,0,0.1)',
                                                    transition: 'transform 0.2s'
                                                }}>
                                                    <div style={{
                                                        height: '160px',
                                                        backgroundColor: '#f0f0f1',
                                                        display: 'flex',
                                                        alignItems: 'center',
                                                        justifyContent: 'center',
                                                        position: 'relative'
                                                    }}>
                                                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="60" height="60" fill="#a7aaad"/>
                                                            <path d="M36.5 32.5L30 25L20 37.5H40L36.5 32.5Z" fill="#f0f0f1"/>
                                                            <circle cx="25" cy="22.5" r="3.5" fill="#f0f0f1"/>
                                                        </svg>
                                                    </div>
                                                    <div style={{ padding: '16px' }}>
                                                        {attributes.post_categories && (
                                                            <span style={{
                                                                display: 'inline-block',
                                                                padding: '4px 10px',
                                                                backgroundColor: '#e0e7ff',
                                                                color: '#4338ca',
                                                                borderRadius: '12px',
                                                                fontSize: '11px',
                                                                fontWeight: '600',
                                                                marginBottom: '8px'
                                                            }}>
                                                                {item.cat}
                                                            </span>
                                                        )}
                                                        {attributes.hide_wp_title && (
                                                            <h3 style={{
                                                                fontSize: '18px',
                                                                fontWeight: '700',
                                                                color: '#111827',
                                                                marginBottom: '10px',
                                                                lineHeight: '1.3'
                                                            }}>
                                                                {item.title}
                                                            </h3>
                                                        )}
                                                        {attributes.hide_wp_desc && (
                                                            <p style={{
                                                                fontSize: '14px',
                                                                color: '#4b5563',
                                                                lineHeight: '1.6',
                                                                marginBottom: '12px'
                                                            }}>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt.
                                                            </p>
                                                        )}
                                                        <div style={{
                                                            display: 'flex',
                                                            justifyContent: 'space-between',
                                                            alignItems: 'center',
                                                            fontSize: '12px',
                                                            color: '#9ca3af',
                                                            borderTop: '1px solid #f3f4f6',
                                                            paddingTop: '12px'
                                                        }}>
                                                            {attributes.post_author && <span>👤 {item.author}</span>}
                                                            <span>📅 {item.date}</span>
                                                        </div>
                                                        {attributes.post_tags && (
                                                            <div style={{ marginTop: '8px' }}>
                                                                <span style={{
                                                                    display: 'inline-block',
                                                                    padding: '2px 8px',
                                                                    backgroundColor: '#f3f4f6',
                                                                    color: '#6b7280',
                                                                    borderRadius: '4px',
                                                                    fontSize: '10px'
                                                                }}>
                                                                    {item.tag}
                                                                </span>
                                                            </div>
                                                        )}
                                                    </div>
                                                </div>
                                            );
                                        }

                                        // Template 2 - Minimal Style
                                        if (attributes.template === '2') {
                                            return (
                                                <div key={index} style={{
                                                    border: '1px solid #e5e7eb',
                                                    borderRadius: '4px',
                                                    overflow: 'hidden',
                                                    backgroundColor: '#fff',
                                                    padding: '16px'
                                                }}>
                                                    <div style={{
                                                        width: '100%',
                                                        height: '140px',
                                                        backgroundColor: '#f0f0f1',
                                                        borderRadius: '4px',
                                                        marginBottom: '12px',
                                                        display: 'flex',
                                                        alignItems: 'center',
                                                        justifyContent: 'center'
                                                    }}>
                                                        <svg width="50" height="50" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="60" height="60" fill="#a7aaad"/>
                                                            <path d="M36.5 32.5L30 25L20 37.5H40L36.5 32.5Z" fill="#f0f0f1"/>
                                                            <circle cx="25" cy="22.5" r="3.5" fill="#f0f0f1"/>
                                                        </svg>
                                                    </div>
                                                    {attributes.hide_wp_title && (
                                                        <h3 style={{
                                                            fontSize: '17px',
                                                            fontWeight: '700',
                                                            color: '#111827',
                                                            marginBottom: '8px',
                                                            lineHeight: '1.3'
                                                        }}>
                                                            {item.title}
                                                        </h3>
                                                    )}
                                                    {attributes.hide_wp_desc && (
                                                        <p style={{
                                                            fontSize: '14px',
                                                            color: '#4b5563',
                                                            lineHeight: '1.6',
                                                            marginBottom: '10px'
                                                        }}>
                                                            Brief description of the content goes here for this post.
                                                        </p>
                                                    )}
                                                    {attributes.post_categories && (
                                                        <div style={{
                                                            fontSize: '11px',
                                                            color: '#3b82f6',
                                                            fontWeight: '500',
                                                            marginBottom: '6px'
                                                        }}>
                                                            📁 {item.cat}
                                                        </div>
                                                    )}
                                                    {attributes.post_author && (
                                                        <div style={{
                                                            fontSize: '11px',
                                                            color: '#9ca3af'
                                                        }}>
                                                            By {item.author}
                                                        </div>
                                                    )}
                                                </div>
                                            );
                                        }

                                        // Template 3 - Modern Style
                                        return (
                                            <div key={index} style={{
                                                borderRadius: '12px',
                                                overflow: 'hidden',
                                                backgroundColor: '#fff',
                                                boxShadow: '0 4px 6px rgba(0,0,0,0.07)',
                                                transition: 'all 0.3s'
                                            }}>
                                                <div style={{
                                                    height: '180px',
                                                    backgroundColor: '#f0f0f1',
                                                    display: 'flex',
                                                    alignItems: 'center',
                                                    justifyContent: 'center',
                                                    position: 'relative'
                                                }}>
                                                    <svg width="70" height="70" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="60" height="60" fill="#a7aaad"/>
                                                        <path d="M36.5 32.5L30 25L20 37.5H40L36.5 32.5Z" fill="#f0f0f1"/>
                                                        <circle cx="25" cy="22.5" r="3.5" fill="#f0f0f1"/>
                                                    </svg>
                                                    {attributes.post_categories && (
                                                        <div style={{
                                                            position: 'absolute',
                                                            top: '12px',
                                                            right: '12px',
                                                            backgroundColor: 'rgba(255,255,255,0.9)',
                                                            color: '#1e1e1e',
                                                            padding: '6px 12px',
                                                            borderRadius: '20px',
                                                            fontSize: '11px',
                                                            fontWeight: '600'
                                                        }}>
                                                            {item.cat}
                                                        </div>
                                                    )}
                                                </div>
                                                <div style={{ padding: '20px' }}>
                                                    {attributes.hide_wp_title && (
                                                        <h3 style={{
                                                            fontSize: '19px',
                                                            fontWeight: '700',
                                                            color: '#111827',
                                                            marginBottom: '10px',
                                                            lineHeight: '1.3'
                                                        }}>
                                                            {item.title}
                                                        </h3>
                                                    )}
                                                    {attributes.hide_wp_desc && (
                                                        <p style={{
                                                            fontSize: '14px',
                                                            color: '#4b5563',
                                                            lineHeight: '1.6',
                                                            marginBottom: '14px'
                                                        }}>
                                                            Discover amazing content and learn new techniques with this comprehensive guide.
                                                        </p>
                                                    )}
                                                    <div style={{
                                                        display: 'flex',
                                                        justifyContent: 'space-between',
                                                        alignItems: 'center',
                                                        paddingTop: '12px',
                                                        borderTop: '1px solid #f3f4f6'
                                                    }}>
                                                        {attributes.post_author && (
                                                            <div style={{ fontSize: '12px', color: '#6b7280', fontWeight: '500' }}>
                                                                {item.author}
                                                            </div>
                                                        )}
                                                        {attributes.post_tags && (
                                                            <div style={{
                                                                fontSize: '10px',
                                                                backgroundColor: '#f3f4f6',
                                                                color: '#4b5563',
                                                                padding: '4px 10px',
                                                                borderRadius: '12px',
                                                                fontWeight: '600'
                                                            }}>
                                                                {item.tag}
                                                            </div>
                                                        )}
                                                    </div>
                                                </div>
                                            </div>
                                        );
                                    })}
                                </div>
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
