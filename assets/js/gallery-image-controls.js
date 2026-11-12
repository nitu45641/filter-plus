(function (wp) {
    'use strict';
    if (!wp || !wp.hooks || !wp.element || !wp.components || !wp.compose) return;
    const createElement = wp.element.createElement;
    const Fragment = wp.element.Fragment;
    const InspectorControls = wp.blockEditor ? wp.blockEditor.InspectorControls : wp.editor.InspectorControls;
    const PanelBody = wp.components.PanelBody;
    const ToggleControl = wp.components.ToggleControl;
    const SelectControl = wp.components.SelectControl;
    const NumberControl = wp.components.__experimentalNumberControl || wp.components.TextControl;
    if (!InspectorControls || !PanelBody || !ToggleControl || !SelectControl || !NumberControl) return;
    const withGalleryOptions = wp.compose.createHigherOrderComponent(function (BlockEdit) {
        return function (props) {
            if (props.name !== 'filter-plus/woo-filter') {
                return createElement(BlockEdit, props);
            }
            const pro = !!(window.filterPlus && window.filterPlus.is_pro_active === 0);
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
                        createElement(ToggleControl, { label: label('Rollover Image'), help: modeHelp, checked: !!attrs.rollover_image, disabled: !pro || sliderOn, onChange: function (v) { props.setAttributes({ rollover_image: v, gallery_slider: v ? false : !!attrs.gallery_slider }); } }),
                        rolloverOn ? createElement(NumberControl, { label: label('Hover Gallery Image (1-5)'), help: pro ? 'Choose the gallery image shown on hover; the last available image is used when needed.' : help, min: 1, max: 5, value: attrs.rollover_image_number || 1, disabled: !pro, onChange: function (v) { props.setAttributes({ rollover_image_number: Math.max(1, Math.min(5, parseInt(v, 10) || 1)) }); } }) : null,
                        rolloverOn ? createElement(SelectControl, { label: label('Rollover Transition'), help: help, value: attrs.rollover_effect || 'fade', disabled: !pro, options: [{ label: 'Fade', value: 'fade' }, { label: 'Fade + Zoom', value: 'zoom' }, { label: 'None', value: 'none' }], onChange: function (v) { props.setAttributes({ rollover_effect: v }); } }) : null,
                        createElement(ToggleControl, { label: label('Gallery Slider'), help: modeHelp, checked: !!attrs.gallery_slider, disabled: !pro || rolloverOn, onChange: function (v) { props.setAttributes({ gallery_slider: v, rollover_image: v ? false : !!attrs.rollover_image }); } })
                    )
                )
            );
        };
    }, 'withGalleryOptions');
    wp.hooks.addFilter('editor.BlockEdit', 'filter-plus/gallery-image-options', withGalleryOptions);
})(window.wp);
