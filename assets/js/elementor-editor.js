/**
 * Filter Plus — Elementor editor helpers.
 *
 * Rollover Image and Gallery Slider are mutually exclusive image modes.
 * Both switches stay visible (same as the Gutenberg block); turning one on
 * switches the other off.
 */
(function () {
    'use strict';

    var EXCLUSIVE = { rollover_image: 'gallery_slider', gallery_slider: 'rollover_image' };

    var bound = false;

    function bind() {
        if (bound || !window.elementor || !elementor.channels || !elementor.channels.editor) {
            return;
        }
        bound = true;
        elementor.channels.editor.on('change', function (controlView, elementView) {
            if (!controlView || !controlView.model || !elementView || !elementView.model) {
                return;
            }
            if ('filter-plus-woo' !== elementView.model.get('widgetType')) {
                return;
            }
            var name = controlView.model.get('name');
            var other = EXCLUSIVE[name];
            if (!other) {
                return;
            }
            var settings = elementView.model.get('settings');
            if ('yes' !== settings.get(name) || 'yes' !== settings.get(other)) {
                return;
            }
            var update = {};
            update[other] = '';
            var container = controlView.container || (elementView.getContainer && elementView.getContainer());
            if (window.$e && container) {
                // external: true re-renders the switch in the panel.
                $e.run('document/elements/settings', { container: container, settings: update, options: { external: true } });
            } else {
                settings.set(update);
            }
        });
    }

    if (window.elementor && elementor.channels) {
        bind();
    } else {
        window.addEventListener('elementor/init', bind);
        if (window.jQuery) {
            jQuery(window).on('elementor:init', bind);
        }
    }
})();
