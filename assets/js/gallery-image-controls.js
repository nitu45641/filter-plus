(function (wp) {
    'use strict';
    if (!wp || !wp.hooks || !wp.element || !wp.components || !wp.compose) return;
    const createElement = wp.element.createElement;
    const Fragment = wp.element.Fragment;
    const InspectorControls = wp.blockEditor ? wp.blockEditor.InspectorControls : wp.editor.InspectorControls;
    const PanelBody = wp.components.PanelBody;
    const ToggleControl = wp.components.ToggleControl;
    const SelectControl = wp.components.SelectControl;
    const FormTokenField = wp.components.FormTokenField;
    const BaseControl = wp.components.BaseControl || wp.element.Fragment;
    const NumberControl = wp.components.__experimentalNumberControl || wp.components.TextControl;
    if (!InspectorControls || !PanelBody || !ToggleControl || !SelectControl || !NumberControl) return;
    const withGalleryOptions = wp.compose.createHigherOrderComponent(function (BlockEdit) {
        return function (props) {
            if (props.name !== 'filter-plus/woo-filter') {
                return createElement(BlockEdit, props);
            }
            // wp_localize_script normally passes a number, but another script
            // may expose the same flag as a numeric string. Accept both.
            const pro = !!(window.filterPlus && Number(window.filterPlus.is_pro_active) === 0);
            const attrs = props.attributes || {};
            const sliderOn = !!attrs.gallery_slider;
            const rolloverOn = !!attrs.rollover_image && !sliderOn;
            const label = function (text) { return text + (pro ? '' : ' (Pro)'); };
            const help = pro ? undefined : 'Upgrade to Filter Plus Pro to use this feature.';
            const modeHelp = pro ? 'Choose one image mode: Rollover Image or Gallery Slider. They cannot be enabled at the same time.' : help;
            return createElement(Fragment, null,
                createElement(BlockEdit, props),
                createElement(InspectorControls, null,
                    createElement(PanelBody, { title: 'Gallery Image Options' + (pro ? '' : ' (Pro)'), initialOpen: false },
                        createElement(ToggleControl, { label: label('Rollover Image'), help: modeHelp, checked: !!attrs.rollover_image, disabled: !pro, onChange: function (v) { props.setAttributes({ rollover_image: v, gallery_slider: v ? false : !!attrs.gallery_slider }); } }),
                        rolloverOn ? createElement(NumberControl, { label: label('Hover Gallery Image (1-5)'), help: pro ? 'Choose the gallery image shown on hover; the last available image is used when needed.' : help, min: 1, max: 5, value: attrs.rollover_image_number || 1, disabled: !pro, onChange: function (v) { props.setAttributes({ rollover_image_number: Math.max(1, Math.min(5, parseInt(v, 10) || 1)) }); } }) : null,
                        rolloverOn ? createElement(SelectControl, { label: label('Rollover Transition'), help: help, value: attrs.rollover_effect || 'fade', disabled: !pro, options: [{ label: 'Fade', value: 'fade' }, { label: 'Fade + Zoom', value: 'zoom' }, { label: 'None', value: 'none' }], onChange: function (v) { props.setAttributes({ rollover_effect: v }); } }) : null,
                        createElement(ToggleControl, { label: label('Gallery Slider'), help: modeHelp, checked: !!attrs.gallery_slider, disabled: !pro, onChange: function (v) { props.setAttributes({ gallery_slider: v, rollover_image: v ? false : !!attrs.rollover_image }); } })
                    ),
                    createElement(PanelBody, { title: 'Product Attributes' + (pro ? '' : ' (Pro)'), initialOpen: false },
                        createElement(ToggleControl, {
                            label: label('Show Attributes'),
                            help: help,
                            checked: !!attrs.show_product_attributes,
                            disabled: !pro,
                            onChange: function (v) { props.setAttributes({ show_product_attributes: v }); }
                        }),
                        attrs.show_product_attributes ? (function () {
                            const opts = (window.filterPlus && Array.isArray(window.filterPlus.attributes) ? window.filterPlus.attributes : []).map(function (item) {
                                return { label: String(item.label), value: String(item.value) };
                            });
                            const selected = Array.isArray(attrs.product_attributes) ? attrs.product_attributes.map(String) : [];
                            const byValue = function (v) { const f = opts.find(function (o) { return o.value === String(v); }); return f ? f.label : String(v); };
                            const byLabel = function (l) { const f = opts.find(function (o) { return o.label === String(l); }); return f ? f.value : null; };
                            // Select2-style searchable multi select (chips + dropdown).
                            if (!FormTokenField) {
                                return createElement(SelectControl, { multiple: true, label: label('Attribute List'), help: help, value: selected, options: opts, disabled: !pro, onChange: function (v) { props.setAttributes({ product_attributes: v || [] }); } });
                            }
                            return createElement(BaseControl, { help: help, __nextHasNoMarginBottom: true },
                                createElement(FormTokenField, {
                                    label: label('Attribute List'),
                                    value: selected.map(byValue),
                                    suggestions: opts.map(function (o) { return o.label; }),
                                    disabled: !pro,
                                    __experimentalExpandOnFocus: true,
                                    __experimentalShowHowTo: false,
                                    __experimentalValidateInput: function (t) { return null !== byLabel(t); },
                                    __next40pxDefaultSize: true,
                                    __nextHasNoMarginBottom: true,
                                    onChange: function (tokens) {
                                        const values = [];
                                        tokens.forEach(function (t) {
                                            const v = byLabel(t && 'object' === typeof t ? t.value : t);
                                            if (null !== v && values.indexOf(v) === -1) { values.push(v); }
                                        });
                                        props.setAttributes({ product_attributes: values });
                                    }
                                })
                            );
                        })() : null
                    )
                )
            );
        };
    }, 'withGalleryOptions');
    wp.hooks.addFilter('editor.BlockEdit', 'filter-plus/gallery-image-options', withGalleryOptions);
})(window.wp);
