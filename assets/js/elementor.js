(function ($, elementor) {
	'use strict';

	const etn = {
		init() {
			const widgets = {};
			$.each(widgets, function (widget, callback) {
				elementor.hooks.addAction(
					'frontend/element_ready/' + widget,
					callback
				);
			});
		},
	};
	$(window).on('elementor/frontend/init', etn.init);
})(jQuery, window.elementorFrontend);
