(function ($, elementor) {

    "use strict";
    
    var etn = {

        init: function () {
            var widgets = {
            };
            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });

        },

    };
    $(window).on('elementor/frontend/init', etn.init);
}(jQuery, window.elementorFrontend));