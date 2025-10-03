import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, SelectControl, TextControl, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType('filter-plus/woo-filter', {
    title: __('WooCommerce Product Filter', 'filter-plus'),
    icon: 'image-filter',
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
                { value: '1', label: __('Template-1', 'filter-plus') + ' ' + isPro(), disabled }
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

                        <SelectControl
                            label={__('Select Style', 'filter-plus')}
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

                        <SelectControl
                            multiple
                            label={__('Categories', 'filter-plus')}
                            value={attributes.categories}
                            options={window.filterPlus?.woo_categories || []}
                            onChange={(value) => setAttributes({ categories: value })}
                        />

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
                                        { value: '2', label: __('Template 2', 'filter-plus') }
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
                                        { value: '2', label: __('Template 2', 'filter-plus') }
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
                    <div className="filter-plus-block-placeholder">
                        <p>{__('WooCommerce Product Filter', 'filter-plus')}</p>
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
