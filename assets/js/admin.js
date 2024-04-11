(function ($) {
	'use strict';

	$(document).ready(function () {
		// load select 2
		var ids = [
			'#woo_pro_categories',
			'#wp_categories',
			'#woo_pro_tags',
			'#woo_pro_attributes',
			'#seo_elements',
			'#post_tags',
			'#author_list',
			'#custom_field_list',
		];
		$.each(ids, function (index, value) {
			$(value).select2({ width: '100%' });
		});

		/**
		 * Tab functions
		 */
		const $settings_tab_li = $('.settings_tab_pan li');
		const active_tab =
			window.location?.hash.slice(1) == ''
				? 'settings'
				: window.location?.hash.slice(1);

		$settings_tab_li.removeClass('active');
		$('.tab-content div').removeClass('active');
		$(`li[data-item="${active_tab}"]`).addClass('active');
		$(`#${active_tab}`).addClass('active');
		$settings_tab_li.on('click', function () {
			const $this = $(this);
			$settings_tab_li.removeClass();
			$('.tab-content > div').hide();
			$this.addClass('active');
			const index = $settings_tab_li.index(this);
			$('.tab-content > div:eq(' + index + ')').show();
			window.history.replaceState(null, null, `#${$this.data('item')}`);
		});

		/**
		 * ShortCode generator
		 */
		generateShortCode();
		function generateShortCode() {
			$('.generate-block').each(function (index, value) {
				const _this = $(this);
				_this.on('click', function (e) {
					e.preventDefault();
					if (_this.hasClass('disable')) {
						return;
					}
					const results = _this.siblings('.full_input');
					const parent_block = _this.parents('.shortcode-block');
					const shortcode_name = parent_block.data('name');
					const input_value = findInputValue(
						parent_block.find('.input-section')
					);
					const shortcode = `[${shortcode_name} ${input_value}]`;
					results.val('').val(shortcode);
					copyTextData(results);
				});
			});
		}
		// copy text
		function copyTextData(fieldId) {
			if (fieldId.length > 0) {
				fieldId.select();
				document.execCommand('copy');
				alert('Copied On clipboard');
			}
		}
		// find input value
		function findInputValue(_this) {
			let result = '';
			const checkbox = _this.find('input:checkbox');
			const input_text = _this.find('input:text');
			const select_box = _this.find('select');

			// select box
			if (select_box.length > 0) {
				select_box.each(function () {
					const $this = $(this);
					const is_true = shortcode_input_disable($this);
					if (is_true) {
						return;
					}
					// select option
					if ($.isArray($this.val())) {
						result += ` ${$this.data('option')}="${$this.val().toString()}"`;
					} else {
						result += ` ${$this.data('option')}="${$this.val()}"`;
					}
				});
			}

			// check box
			if (checkbox.length > 0) {
				checkbox.each(function () {
					const $this = $(this);
					const is_true = shortcode_input_disable($this);
					if (is_true) {
						return;
					}
					const value = $this.is(':checked') ? 'yes' : 'no';

					result += ` ${$this.data('label')}="${value}"`;
				});
			}

			// input text
			result = shortcode_input_value(input_text, result);

			return result;
		}

		function shortcode_input_value(input_data, result) {
			if (input_data.length > 0) {
				input_data.each(function () {
					const $this = $(this);
					const is_true = shortcode_input_disable($this);
					if (is_true) {
						return;
					}
					// input value
					if ($.isArray($this.val())) {
						result += ` ${$this.data('option')}="${$this.val().toString()}"`;
					} else {
						result += ` ${$this.data('option')}="${$this.val()}"`;
					}
				});
			}

			return result;
		}

		function shortcode_input_disable($this) {
			const disable = $this.parent().hasClass('disable');
			const disable_pro = $this.parent().hasClass('pro-disable');
			const d_none = $this.parents('.d-none');
			if (disable_pro || disable || d_none.length > 0) {
				return true;
			}
			return false;
		}

		/**
		 * Toggle Show/Hide
		 *
		 */
		var ids = [
			'show_tags',
			'show_attributes',
			'show_wp_tags',
			'filter_type',
			'author',
			'custom_field',
			'refresh_url',
			'on_sale',
			'stock',
			'show_reviews',
			'show_price_range',
			'show_size',
			'show_colors',
		];
		$.each(ids, function (index, data) {
			const value = $('#' + data);
			value.on('change', function () {
				if (data == 'filter_type') {
					if (value.val() == 'custom_post') {
						$('.' + data).removeClass('d-none');
					} else {
						$('.' + data).addClass('d-none');
					}
				} else if (value.is(':checked')) {
					$('.' + data).removeClass('d-none');
				} else {
					$('.' + data).addClass('d-none');
				}
			});
		});

		/**
		 * Get settings options
		 * @param {*} main_div
		 * @return
		 */
		function getAllValues(main_div) {
			const obj = {};
			$(main_div).map(function (x, item) {
				const $this = $(this);
				if (typeof $this.attr('name') === 'undefined') {
					return;
				}

				const type = $this.prop('type');

				if (type == 'checkbox' || type == 'radio') {
					if (this.checked) {
						obj[$this.attr('name')] = $this.val();
					} else {
						obj[$this.attr('name')] = 'no';
					}
					return obj;
				}
				if (type == 'select-multiple' || type == 'select-one') {
					obj[$this.attr('name')] = $this.val();
					return obj;
				}

				if (
					type == 'text' ||
					type == 'hidden' ||
					type == 'color' ||
					type == 'number'
				) {
					obj[$this.attr('name')] = $this.val();
					return obj;
				}
			});

			return obj;
		}

		/**
		 * Get tab data
		 * @return
		 */
		function getTabData() {
			const tabs = [
				'#settings :input',
				'#seo :input',
				'#woo-order :input',
			];
			const form_data = {};
			tabs.forEach((element) => {
				const input_data = getAllValues(element);
				$.each(input_data, function (i, value) {
					form_data[i] = value;
				});
			});

			return form_data;
		}

		/**
		 * Save admin settings
		 */
		const $admin_button = $('.admin-button');
		$('#filter-settings').on('submit', function (e) {
			e.preventDefault();
			const $message = $('.settings_message');
			const form_data = getTabData();

			const data = {
				action: 'filter_save_settings',
				filter_plus_nonce: filter_admin.filter_plus_nonce,
				params: form_data,
			};
			$.ajax({
				url: filter_admin.ajax_url,
				method: 'POST',
				data,
				beforeSend() {
					$admin_button.addClass('loading');
				},
				success(response) {
					$admin_button.removeClass('loading');
					$message
						.removeClass('d-none')
						.html('')
						.html(response?.data?.message)
						.fadeIn()
						.delay(2000)
						.fadeOut();
				},
			});
		});

		/**
		 * Accordion
		 */
		$('.accordion-button').on('change', function () {
			$('.accordion-button').not(this).prop('checked', false);
			const isChecked = $(this).prop('checked');
			const content = $(this).closest('.accordion-item').find('.content');

			$('.content').removeClass('show');
			if (isChecked) {
				content.addClass('show');
			} else {
				content.removeClass('show');
			}
		});

		// Load color picker
		const color_array = ['#primary_color', '#secondary_color'];
		$.each(color_array, function (index, value) {
			$(value).wpColorPicker();
		});
	});
})(jQuery);
