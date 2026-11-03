/**
 * Filter Sets - live sidebar preview.
 *
 * Builds the same shortcode the Copy / Save buttons produce and posts it to
 * the front-end preview endpoint inside an iframe. The endpoint renders the
 * real shortcode templates with the theme and public assets, so the preview
 * always matches the front end - no preview-specific markup to maintain.
 */
(function ($) {
	'use strict';

	$(function () {
		const $form = $('#filter-set-form-wrap');
		const $preview = $form.find('.filter-set-preview');

		if (!$preview.length || typeof window.filterPlusBuildShortcode !== 'function') {
			return;
		}

		const $frame = $preview.find('.flp-preview-frame');
		const frame = $frame.get(0);
		const $postForm = $preview.find('.flp-preview-form');
		const $shortcodeInput = $postForm.find('input[name="shortcode"]');

		let lastShortcode = '';
		let timer = null;
		let resizeObserver = null;

		function activeBlock() {
			// tabs toggle via show()/hide(); the active accordion item names the tab
			const type = $form.find('.accordion-list .accordion-item.active').first().data('name');
			let $content = type ? $form.find('.filter-set-content[data-name="' + type + '"]') : $();
			if (!$content.length) {
				$content = $form.find('.filter-set-content.active');
			}
			return $content.find('.shortcode-block').first();
		}

		function refresh(force) {
			// nothing to show while the form itself is hidden
			if ($form.hasClass('d-none')) {
				return;
			}
			const $block = activeBlock();
			if (!$block.length) {
				return;
			}
			const shortcode = window.filterPlusBuildShortcode($block);
			if (!shortcode || (!force && shortcode === lastShortcode)) {
				return;
			}
			lastShortcode = shortcode;
			$preview.addClass('is-loading');
			$shortcodeInput.val(shortcode);
			$postForm.get(0).submit();
		}

		function schedule(delay, force) {
			clearTimeout(timer);
			timer = setTimeout(function () {
				refresh(force);
			}, delay || 400);
		}

		// fit the iframe to the sidebar's height (same origin, so we can measure)
		function fitHeight() {
			let doc;
			try {
				doc = frame.contentDocument;
			} catch (error) {
				return;
			}
			if (!doc || !doc.body) {
				return;
			}
			// body is height:auto in the preview page, so this shrinks as well as grows
			const height = Math.ceil(doc.body.getBoundingClientRect().height);
			if (height) {
				$frame.css('height', height + 'px');
			}
		}

		$frame.on('load', function () {
			$preview.removeClass('is-loading');
			fitHeight();
			if (resizeObserver) {
				resizeObserver.disconnect();
				resizeObserver = null;
			}
			try {
				const doc = frame.contentDocument;
				const win = frame.contentWindow;
				// use the iframe's own ResizeObserver - it keeps firing when the
				// frame goes from hidden (form sliding open) to visible
				if (doc && doc.body && win && 'ResizeObserver' in win) {
					resizeObserver = new win.ResizeObserver(fitHeight);
					resizeObserver.observe(doc.body);
				}
			} catch (error) {
				// cross-origin (unexpected) - keep last height
			}
			// late fonts/images or the form's slide-in animation
			[300, 1000].forEach(function (delay) {
				setTimeout(fitHeight, delay);
			});
		});

		$form.on('input change', '.filter-set-content input, .filter-set-content select', function () {
			schedule(500);
		});

		// tab switch / opening the form hydrate fields without firing change on checkboxes
		$(document).on('click', '.accordion-list .accordion-item', function () {
			schedule(150);
		});
		$(document).on('click', '.add-filter-set, .edit-filter-set', function () {
			schedule(450, true);
		});

		refresh(true);
	});
})(jQuery);
