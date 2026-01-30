import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, SelectControl, TextControl, ToggleControl, CheckboxControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType('filter-plus/woo-filter', {
    title: __('Woo Product Filter', 'filter-plus'),
    icon: 'filter',
    category: 'filter-plus-blocks',
    attributes: {
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
        filter_position: {
            type: 'string',
            default: 'left'
        },
        pagination_style: {
            type: 'string',
            default: 'numbers'
        },
        category_template: {
            type: 'string',
            default: '1'
        },
        category_label: {
            type: 'string',
            default: ''
        },
        categories: {
            type: 'array',
            default: []
        },
        hide_empty_cat: {
            type: 'boolean',
            default: true
        },
        sub_categories: {
            type: 'boolean',
            default: true
        },
        product_count: {
            type: 'boolean',
            default: true
        },
        colors: {
            type: 'boolean',
            default: true
        },
        color_template: {
            type: 'string',
            default: '1'
        },
        color_label: {
            type: 'string',
            default: ''
        },
        size: {
            type: 'boolean',
            default: true
        },
        size_label: {
            type: 'string',
            default: ''
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
        show_attributes: {
            type: 'boolean',
            default: true
        },
        attribute_label: {
            type: 'string',
            default: ''
        },
        attributes: {
            type: 'array',
            default: []
        },
        show_price_range: {
            type: 'boolean',
            default: true
        },
        price_range_label: {
            type: 'string',
            default: ''
        },
        show_reviews: {
            type: 'boolean',
            default: true
        },
        review_template: {
            type: 'string',
            default: '1'
        },
        review_label: {
            type: 'string',
            default: ''
        },
        stock: {
            type: 'boolean',
            default: true
        },
        stock_label: {
            type: 'string',
            default: ''
        },
        on_sale: {
            type: 'boolean',
            default: true
        },
        on_sale_label: {
            type: 'string',
            default: ''
        },
        hide_prod_title: {
            type: 'boolean',
            default: true
        },
        hide_prod_desc: {
            type: 'boolean',
            default: true
        },
        hide_prod_price: {
            type: 'boolean',
            default: true
        },
        hide_prod_add_cart: {
            type: 'boolean',
            default: true
        },
        hide_prod_rating: {
            type: 'boolean',
            default: true
        },
        sorting: {
            type: 'boolean',
            default: true
        },
        product_categories: {
            type: 'boolean',
            default: true
        },
        product_tags: {
            type: 'boolean',
            default: true
        },
        masonry_style: {
            type: 'boolean',
            default: true
        },
        apply_button_mode: {
            type: 'boolean',
            default: false
        },
        apply_button_label: {
            type: 'string',
            default: ''
        },
        reset_button_label: {
            type: 'string',
            default: ''
        }
    },

    edit({ attributes, setAttributes }) {
        const blockProps = useBlockProps();

        // Debug: Log attributes whenever they change
        console.log('WooCommerce Filter Block Attributes:', attributes);

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
            for (let i = 2; i <= 7; i++) {
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
                        <ToggleControl
                            label={__('Masonry Style', 'filter-plus')}
                            checked={attributes.masonry_style}
                            onChange={(value) => setAttributes({ masonry_style: value })}
                        />

                        <ToggleControl
                            label={__('Apply Button Mode', 'filter-plus')}
                            checked={attributes.apply_button_mode}
                            onChange={(value) => setAttributes({ apply_button_mode: value })}
                        />

                        {attributes.apply_button_mode && (
                            <>
                                <TextControl
                                    label={__('Apply Button Label', 'filter-plus')}
                                    value={attributes.apply_button_label}
                                    onChange={(value) => setAttributes({ apply_button_label: value })}
                                    placeholder={__('Apply', 'filter-plus')}
                                />

                                <TextControl
                                    label={__('Reset Button Label', 'filter-plus')}
                                    value={attributes.reset_button_label}
                                    onChange={(value) => setAttributes({ reset_button_label: value })}
                                    placeholder={__('Reset', 'filter-plus')}
                                />
                            </>
                        )}

                        <SelectControl
                            label={__('Select Template', 'filter-plus')}
                            value={attributes.template}
                            options={getTemplateOptions()}
                            onChange={(value) => setAttributes({ template: value })}
                        />

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

                        <SelectControl
                            label={__('Pagination Style', 'filter-plus')}
                            value={attributes.pagination_style}
                            options={[
                                { value: 'numbers', label: __('Numbers', 'filter-plus') },
                                { value: 'load_more', label: __('Load More', 'filter-plus') },
                                { value: 'infinite', label: __('Infinite Scroll', 'filter-plus') }
                            ]}
                            onChange={(value) => setAttributes({ pagination_style: value })}
                        />

                        <SelectControl
                            label={__('Select Category Filter Template', 'filter-plus')}
                            value={attributes.category_template}
                            options={[
                                { value: '1', label: __('Template 1', 'filter-plus') },
                                { value: '2', label: __('Template 2', 'filter-plus') },
                                { value: '3', label: __('Template 3', 'filter-plus') }
                            ]}
                            onChange={(value) => setAttributes({ category_template: value })}
                        />

                        <TextControl
                            label={__('Category Label', 'filter-plus')}
                            value={attributes.category_label}
                            onChange={(value) => setAttributes({ category_label: value })}
                            placeholder={__('Place Category Label Here', 'filter-plus')}
                        />

                        <div style={{ marginBottom: '16px' }}>
                            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '8px' }}>
                                <label style={{ fontWeight: '500', margin: 0 }}>
                                    {__('Categories', 'filter-plus')}
                                </label>
                                {attributes.categories.length > 0 && (
                                    <button
                                        type="button"
                                        className="button button-small"
                                        onClick={() => setAttributes({ categories: [] })}
                                        style={{ fontSize: '11px', padding: '2px 8px', height: 'auto' }}
                                    >
                                        {__('Clear All', 'filter-plus')}
                                    </button>
                                )}
                            </div>
                            <div style={{ maxHeight: '200px', overflowY: 'auto', border: '1px solid #ddd', padding: '8px', borderRadius: '4px', backgroundColor: '#fff' }}>
                                {(window.filterPlus?.woo_categories || []).map((cat) => {
                                    // Normalize: ensure we're always working with strings
                                    const catValue = String(cat.value);
                                    const normalizedCategories = attributes.categories.map(c => String(c));
                                    const isChecked = normalizedCategories.includes(catValue);

                                    return (
                                        <CheckboxControl
                                            key={cat.value}
                                            label={cat.label}
                                            checked={isChecked}
                                            onChange={(checked) => {
                                                // Normalize all existing categories to strings
                                                let normalizedCurrent = attributes.categories.map(c => String(c));
                                                let newCategories;

                                                if (checked) {
                                                    // Add category if not already present
                                                    if (!normalizedCurrent.includes(catValue)) {
                                                        newCategories = [...normalizedCurrent, catValue];
                                                    } else {
                                                        newCategories = normalizedCurrent;
                                                    }
                                                } else {
                                                    // Remove category
                                                    newCategories = normalizedCurrent.filter(c => c !== catValue);
                                                }

                                                console.log('Category toggled:', cat.label, 'Checked:', checked, 'New categories:', newCategories);
                                                setAttributes({ categories: newCategories });
                                            }}
                                        />
                                    );
                                })}
                            </div>
                            {attributes.categories.length > 0 && (
                                <div style={{ marginTop: '8px', fontSize: '12px', color: '#666' }}>
                                    Selected: {attributes.categories.length} categor{attributes.categories.length === 1 ? 'y' : 'ies'}
                                    <div style={{ fontSize: '11px', color: '#999', marginTop: '4px' }}>
                                        IDs: {attributes.categories.map(c => String(c)).join(', ')}
                                    </div>
                                </div>
                            )}
                        </div>

                        <ToggleControl
                            label={__('Hide Empty Category', 'filter-plus')}
                            checked={attributes.hide_empty_cat}
                            onChange={(value) => setAttributes({ hide_empty_cat: value })}
                        />

                        <ToggleControl
                            label={__('Show Sub Categories', 'filter-plus')}
                            checked={attributes.sub_categories}
                            onChange={(value) => setAttributes({ sub_categories: value })}
                        />

                        <ToggleControl
                            label={__('Show Product Count', 'filter-plus')}
                            checked={attributes.product_count}
                            onChange={(value) => setAttributes({ product_count: value })}
                        />

                        <ToggleControl
                            label={__('Show Color', 'filter-plus')}
                            checked={attributes.colors}
                            onChange={(value) => setAttributes({ colors: value })}
                        />

                        {attributes.colors && (
                            <>
                                <SelectControl
                                    label={__('Select Color Filter Template', 'filter-plus')}
                                    value={attributes.color_template}
                                    options={[
                                        { value: '1', label: __('Template 1', 'filter-plus') },
                                        { value: '2', label: __('Template 2', 'filter-plus') },
                                        { value: '3', label: __('Template 3', 'filter-plus') }
                                    ]}
                                    onChange={(value) => setAttributes({ color_template: value })}
                                />

                                <TextControl
                                    label={__('Color Label', 'filter-plus')}
                                    value={attributes.color_label}
                                    onChange={(value) => setAttributes({ color_label: value })}
                                    placeholder={__('Place Color Label Here', 'filter-plus')}
                                />
                            </>
                        )}

                        <ToggleControl
                            label={__('Show Size', 'filter-plus')}
                            checked={attributes.size}
                            onChange={(value) => setAttributes({ size: value })}
                        />

                        {attributes.size && (
                            <TextControl
                                label={__('Size Label', 'filter-plus')}
                                value={attributes.size_label}
                                onChange={(value) => setAttributes({ size_label: value })}
                                placeholder={__('Place Size Label Here', 'filter-plus')}
                            />
                        )}

                        <ToggleControl
                            label={__('Show Tags', 'filter-plus')}
                            checked={attributes.show_tags}
                            onChange={(value) => setAttributes({ show_tags: value })}
                        />

                        {attributes.show_tags && (
                            <>
                                <TextControl
                                    label={__('Tag Label', 'filter-plus')}
                                    value={attributes.tag_label}
                                    onChange={(value) => setAttributes({ tag_label: value })}
                                    placeholder={__('Place Tag Label Here', 'filter-plus')}
                                />

                                <SelectControl
                                    multiple
                                    label={__('Tags', 'filter-plus')}
                                    value={attributes.tags}
                                    options={window.filterPlus?.tags || []}
                                    onChange={(value) => setAttributes({ tags: value })}
                                />
                            </>
                        )}

                        <ToggleControl
                            label={__('Show Attributes', 'filter-plus')}
                            checked={attributes.show_attributes}
                            onChange={(value) => setAttributes({ show_attributes: value })}
                        />

                        {attributes.show_attributes && (
                            <>
                                <TextControl
                                    label={__('Attribute Label', 'filter-plus')}
                                    value={attributes.attribute_label}
                                    onChange={(value) => setAttributes({ attribute_label: value })}
                                    placeholder={__('Place Attribute Label Here', 'filter-plus')}
                                />

                                <SelectControl
                                    multiple
                                    label={__('Attributes', 'filter-plus')}
                                    value={attributes.attributes}
                                    options={window.filterPlus?.attributes || []}
                                    onChange={(value) => setAttributes({ attributes: value })}
                                />
                            </>
                        )}

                        <ToggleControl
                            label={__('Show Price Range', 'filter-plus')}
                            checked={attributes.show_price_range}
                            onChange={(value) => setAttributes({ show_price_range: value })}
                        />

                        {attributes.show_price_range && (
                            <TextControl
                                label={__('Price Range Label', 'filter-plus')}
                                value={attributes.price_range_label}
                                onChange={(value) => setAttributes({ price_range_label: value })}
                                placeholder={__('Place Price Range Label Here', 'filter-plus')}
                            />
                        )}

                        <ToggleControl
                            label={__('Show Reviews', 'filter-plus')}
                            checked={attributes.show_reviews}
                            onChange={(value) => setAttributes({ show_reviews: value })}
                        />

                        {attributes.show_reviews && (
                            <>
                                <SelectControl
                                    label={__('Select Review Filter Template', 'filter-plus')}
                                    value={attributes.review_template}
                                    options={[
                                        { value: '1', label: __('Template 1', 'filter-plus') },
                                        { value: '2', label: __('Template 2', 'filter-plus') },
                                        { value: '3', label: __('Template 3', 'filter-plus') },
                                    ]}
                                    onChange={(value) => setAttributes({ review_template: value })}
                                />

                                <TextControl
                                    label={__('Review Label', 'filter-plus')}
                                    value={attributes.review_label}
                                    onChange={(value) => setAttributes({ review_label: value })}
                                    placeholder={__('Place Review Label Here', 'filter-plus')}
                                />
                            </>
                        )}

                        <ToggleControl
                            label={__('Filter By Stock', 'filter-plus')}
                            checked={attributes.stock}
                            onChange={(value) => setAttributes({ stock: value })}
                        />

                        {attributes.stock && (
                            <TextControl
                                label={__('Stock Label', 'filter-plus')}
                                value={attributes.stock_label}
                                onChange={(value) => setAttributes({ stock_label: value })}
                                placeholder={__('Place Stock Label Here', 'filter-plus')}
                            />
                        )}

                        <ToggleControl
                            label={__('Sales', 'filter-plus')}
                            checked={attributes.on_sale}
                            onChange={(value) => setAttributes({ on_sale: value })}
                        />

                        {attributes.on_sale && (
                            <TextControl
                                label={__('On Sale Label', 'filter-plus')}
                                value={attributes.on_sale_label}
                                onChange={(value) => setAttributes({ on_sale_label: value })}
                                placeholder={__('Place On Sale Label Here', 'filter-plus')}
                            />
                        )}
                    </PanelBody>

                    <PanelBody title={__('Filter Result Options', 'filter-plus')}>
                        <ToggleControl
                            label={__('Display Title', 'filter-plus')}
                            checked={attributes.hide_prod_title}
                            onChange={(value) => setAttributes({ hide_prod_title: value })}
                        />

                        <ToggleControl
                            label={__('Display Description', 'filter-plus')}
                            checked={attributes.hide_prod_desc}
                            onChange={(value) => setAttributes({ hide_prod_desc: value })}
                        />

                        <ToggleControl
                            label={__('Display Price', 'filter-plus')}
                            checked={attributes.hide_prod_price}
                            onChange={(value) => setAttributes({ hide_prod_price: value })}
                        />

                        <ToggleControl
                            label={__('Display Add to Cart', 'filter-plus')}
                            checked={attributes.hide_prod_add_cart}
                            onChange={(value) => setAttributes({ hide_prod_add_cart: value })}
                        />

                        <ToggleControl
                            label={__('Display Rating', 'filter-plus')}
                            checked={attributes.hide_prod_rating}
                            onChange={(value) => setAttributes({ hide_prod_rating: value })}
                        />

                        <ToggleControl
                            label={__('Display Sorting', 'filter-plus')}
                            checked={attributes.sorting}
                            onChange={(value) => setAttributes({ sorting: value })}
                        />

                        <ToggleControl
                            label={__('Display Categories', 'filter-plus')}
                            checked={attributes.product_categories}
                            onChange={(value) => setAttributes({ product_categories: value })}
                        />

                        <ToggleControl
                            label={__('Display Tags', 'filter-plus')}
                            checked={attributes.product_tags}
                            onChange={(value) => setAttributes({ product_tags: value })}
                        />
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps}>
                    <div style={{
                        border: '2px solid #e0e0e0',
                        borderRadius: '4px',
                        padding: '20px',
                        backgroundColor: '#fff',
                        fontFamily: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif'
                    }}>
                        {/* Header */}
                        <div style={{
                            display: 'flex',
                            alignItems: 'center',
                            marginBottom: '20px',
                            padding: '12px',
                            backgroundColor: '#f5f5f5',
                            borderRadius: '4px'
                        }}>
                            <span style={{ fontSize: '20px', marginRight: '10px' }}>🛍️</span>
                            <h3 style={{
                                margin: '0',
                                fontSize: '16px',
                                fontWeight: '600',
                                color: '#1e1e1e'
                            }}>
                                {attributes.title || __('Woo Product Filter', 'filter-plus')}
                            </h3>
                            <div style={{
                                marginLeft: 'auto',
                                fontSize: '12px',
                                color: '#666',
                                backgroundColor: '#fff',
                                padding: '4px 10px',
                                borderRadius: '3px',
                                border: '1px solid #ddd'
                            }}>
                                {__('Template', 'filter-plus')} {attributes.template}
                            </div>
                        </div>

                        {/* Filter Layout Preview */}
                        <div style={{
                            display: 'grid',
                            gridTemplateColumns: attributes.filter_position === 'top' ? '1fr' : (attributes.filter_position === 'left' ? '250px 1fr' : '1fr 250px'),
                            gap: '20px'
                        }}>
                            {/* Filters Sidebar */}
                            {attributes.filter_position !== 'top' && (
                                <div style={{
                                    order: attributes.filter_position === 'right' ? 2 : 1,
                                    padding: '15px',
                                    backgroundColor: '#fafafa',
                                    borderRadius: '4px',
                                    border: '1px solid #e0e0e0'
                                }}>
                                    <div style={{ fontSize: '13px', fontWeight: '600', marginBottom: '10px', color: '#555' }}>
                                        {__('Filters', 'filter-plus')}
                                    </div>

                                    {attributes.product_count && (
                                        <div style={{ fontSize: '11px', color: '#999', marginBottom: '15px' }}>
                                            ✓ {attributes.category_label || __('Categories', 'filter-plus')}
                                        </div>
                                    )}
                                    {attributes.colors && (
                                        <div style={{ fontSize: '11px', color: '#999', marginBottom: '15px' }}>
                                            ✓ {attributes.color_label || __('Colors', 'filter-plus')}
                                        </div>
                                    )}
                                    {attributes.size && (
                                        <div style={{ fontSize: '11px', color: '#999', marginBottom: '15px' }}>
                                            ✓ {attributes.size_label || __('Size', 'filter-plus')}
                                        </div>
                                    )}
                                    {attributes.show_price_range && (
                                        <div style={{ fontSize: '11px', color: '#999', marginBottom: '15px' }}>
                                            ✓ {attributes.price_range_label || __('Price Range', 'filter-plus')}
                                        </div>
                                    )}
                                    {attributes.show_reviews && (
                                        <div style={{ fontSize: '11px', color: '#999', marginBottom: '15px' }}>
                                            ✓ {attributes.review_label || __('Reviews', 'filter-plus')}
                                        </div>
                                    )}
                                    {attributes.stock && (
                                        <div style={{ fontSize: '11px', color: '#999', marginBottom: '15px' }}>
                                            ✓ {attributes.stock_label || __('Stock', 'filter-plus')}
                                        </div>
                                    )}
                                    {attributes.on_sale && (
                                        <div style={{ fontSize: '11px', color: '#999', marginBottom: '15px' }}>
                                            ✓ {attributes.on_sale_label || __('On Sale', 'filter-plus')}
                                        </div>
                                    )}
                                </div>
                            )}

                            {/* Products Area */}
                            <div style={{
                                order: attributes.filter_position === 'right' ? 1 : 2,
                                padding: '15px',
                                backgroundColor: '#fafafa',
                                borderRadius: '4px',
                                border: '1px solid #e0e0e0'
                            }}>
                                {/* Top Filters (if position is top) */}
                                {attributes.filter_position === 'top' && (
                                    <div style={{
                                        display: 'flex',
                                        flexWrap: 'wrap',
                                        gap: '10px',
                                        marginBottom: '15px',
                                        padding: '10px',
                                        backgroundColor: '#fff',
                                        borderRadius: '4px',
                                        fontSize: '11px',
                                        color: '#666'
                                    }}>
                                        {attributes.product_count && <span>✓ {__('Categories', 'filter-plus')}</span>}
                                        {attributes.colors && <span>✓ {__('Colors', 'filter-plus')}</span>}
                                        {attributes.size && <span>✓ {__('Size', 'filter-plus')}</span>}
                                        {attributes.show_price_range && <span>✓ {__('Price', 'filter-plus')}</span>}
                                    </div>
                                )}

                                {/* Sorting & Results Count */}
                                {attributes.sorting && (
                                    <div style={{
                                        display: 'flex',
                                        justifyContent: 'space-between',
                                        alignItems: 'center',
                                        marginBottom: '15px',
                                        fontSize: '12px',
                                        color: '#666'
                                    }}>
                                        <span>{__('Showing results', 'filter-plus')}</span>
                                        <span>{__('Sort by:', 'filter-plus')} ▼</span>
                                    </div>
                                )}

                                {/* Product Grid Preview */}
                                <div style={{
                                    display: 'grid',
                                    gridTemplateColumns: 'repeat(3, 1fr)',
                                    gap: '10px',
                                    marginBottom: '15px'
                                }}>
                                    {[1, 2, 3].map((item) => (
                                        <div key={item} style={{
                                            backgroundColor: '#fff',
                                            padding: '10px',
                                            borderRadius: '4px',
                                            border: '1px solid #e0e0e0',
                                            textAlign: 'center'
                                        }}>
                                            <div style={{
                                                width: '100%',
                                                height: '80px',
                                                backgroundColor: '#f0f0f0',
                                                borderRadius: '3px',
                                                marginBottom: '8px',
                                                display: 'flex',
                                                alignItems: 'center',
                                                justifyContent: 'center',
                                                fontSize: '24px'
                                            }}>📦</div>
                                            {attributes.hide_prod_title && (
                                                <div style={{ fontSize: '11px', fontWeight: '500', marginBottom: '4px' }}>
                                                    {__('Product', 'filter-plus')} {item}
                                                </div>
                                            )}
                                            {attributes.hide_prod_price && (
                                                <div style={{ fontSize: '10px', color: '#666', marginBottom: '4px' }}>$99</div>
                                            )}
                                            {attributes.hide_prod_rating && (
                                                <div style={{ fontSize: '10px', color: '#ffa500' }}>★★★★★</div>
                                            )}
                                            {attributes.hide_prod_add_cart && (
                                                <div style={{
                                                    fontSize: '10px',
                                                    marginTop: '6px',
                                                    padding: '4px',
                                                    backgroundColor: '#0073aa',
                                                    color: '#fff',
                                                    borderRadius: '2px'
                                                }}>
                                                    {__('Add to Cart', 'filter-plus')}
                                                </div>
                                            )}
                                        </div>
                                    ))}
                                </div>

                                {/* Pagination Preview */}
                                <div style={{
                                    display: 'flex',
                                    justifyContent: 'center',
                                    gap: '8px',
                                    fontSize: '11px',
                                    color: '#666'
                                }}>
                                    {attributes.pagination_style === 'numbers' && (
                                        <>
                                            <span style={{ padding: '4px 8px', backgroundColor: '#0073aa', color: '#fff', borderRadius: '2px' }}>1</span>
                                            <span style={{ padding: '4px 8px', backgroundColor: '#fff', border: '1px solid #ddd', borderRadius: '2px' }}>2</span>
                                            <span style={{ padding: '4px 8px', backgroundColor: '#fff', border: '1px solid #ddd', borderRadius: '2px' }}>3</span>
                                        </>
                                    )}
                                    {attributes.pagination_style === 'load_more' && (
                                        <span style={{ padding: '6px 16px', backgroundColor: '#0073aa', color: '#fff', borderRadius: '3px' }}>
                                            {__('Load More', 'filter-plus')}
                                        </span>
                                    )}
                                    {attributes.pagination_style === 'infinite' && (
                                        <span style={{ color: '#999', fontSize: '10px' }}>
                                            {__('Infinite Scroll', 'filter-plus')}
                                        </span>
                                    )}
                                </div>
                            </div>
                        </div>

                        {/* Footer Info */}
                        <div style={{
                            marginTop: '15px',
                            padding: '10px',
                            backgroundColor: '#e7f5fe',
                            borderRadius: '4px',
                            fontSize: '11px',
                            color: '#0073aa',
                            textAlign: 'center'
                        }}>
                            {__('Filter Position:', 'filter-plus')} <strong>{attributes.filter_position.toUpperCase()}</strong> |
                            {__(' Items per page:', 'filter-plus')} <strong>{attributes.no_of_items}</strong> |
                            {__(' Masonry:', 'filter-plus')} <strong>{attributes.masonry_style ? __('ON', 'filter-plus') : __('OFF', 'filter-plus')}</strong>
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
