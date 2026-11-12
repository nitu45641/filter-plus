(function (wp) {
    'use strict';
    if (!wp || !wp.hooks || !wp.element || !wp.components || !wp.compose) return;
    const createElement = wp.element.createElement;
    const Fragment = wp.element.Fragment;
    const InspectorControls = wp.blockEditor ? wp.blockEditor.InspectorControls : wp.editor.InspectorControls;
    const PanelBody = wp.components.PanelBody;
    const ToggleControl = wp.components.ToggleControl;
    if (!InspectorControls || !PanelBody || !ToggleControl) return;
    const withGalleryOptions = wp.compose.createHigherOrderComponent(function (BlockEdit) {
        return function (props) {
            if (props.name !== 'filter-plus/woo-filter' || String((props.attributes || {}).template || '1') !== '3') {
                return createElement(BlockEdit, props);
            }
            const pro = !!(window.filterPlus && window.filterPlus.is_pro_active === 0);
            const attrs = props.attributes || {};
            const label = function (text) { return text + (pro ? '' : ' (Pro)'); };
            const help = pro ? undefined : 'Upgrade to Filter Plus Pro to use this feature.';
            return createElement(Fragment, null,
                createElement(BlockEdit, props),
                createElement(InspectorControls, null,
                    createElement(PanelBody, { title: 'Gallery Image Options' + (pro ? '' : ' (Pro)'), initialOpen: false },
                        createElement(ToggleControl, { label: label('Rollover Image'), help: help, checked: !!attrs.rollover_image, disabled: !pro, onChange: function (v) { props.setAttributes({ rollover_image: v }); } }),
                        createElement(ToggleControl, { label: label('Gallery Slider'), help: help, checked: !!attrs.gallery_slider, disabled: !pro, onChange: function (v) { props.setAttributes({ gallery_slider: v }); } })
                    )
                )
            );
        };
    }, 'withGalleryOptions');
    wp.hooks.addFilter('editor.BlockEdit', 'filter-plus/gallery-image-options', withGalleryOptions);
})(window.wp);
