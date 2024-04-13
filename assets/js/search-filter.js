(function ($) {
	'use strict';

	$(document).ready(function () {
		/*
		 * Get Product dat from filter
		 */

		//list click/change
		const category_li = $('.category-list li');
		let action = 'click';
		if (category_li.find('input[type="checkbox"]').length !== 0 ) {
			action = 'change';
		}

		category_li.on(action, function (event) {
			event.stopPropagation();
			const _this = $(this);
			const active_li = $('#cat_li_' + _this.data('cat_id'));
			if (active_li.length > 0) {
				if (active_li.is(':checked')) {
					_this.addClass('active');
				}
			} else {
				_this.addClass('active');
			}

			get_products();
			// reset block
			reset_block(_this, _this.parents('.sidebar-row'));
		});

		//search product
		$('.sidebar-input').on('keyup', function () {
			const _this = $(this);
			get_products();
			reset_block(_this, _this.parents('.sidebar-row'));
		});

		//attribute/tag click
		const sidebar_row = $('.sidebar-row');
		if (sidebar_row.length > 0) {
			$.each(sidebar_row, function (index, value) {
				const param_box = $(this).find('.param-box');
				param_box.on('click', '.radio-item', function () {
					const _this = $(this);
					param_box.find('.radio-item').removeClass('active');
					_this.addClass('active');
					get_products();
					// reset block
					reset_block(_this, _this.parents('.sidebar-row'));
				});
				param_box.on('change', '.checkbox-item input', function () {
					const _this = $(this);
					if (_this.is(':checked')) {
						_this.prop('checked', true);
					} else {
						_this.prop('checked', false);
					}
					get_products();
					//reset block
					reset_block(_this, _this.parents('.sidebar-row'));
				});
			});
		}

		// price range
		const price_range = $('.range-slider');
		const min = price_range.data('min');
		const max = price_range.data('max');
		price_range_picker();
		function price_range_picker() {
			price_range.jRange({
				from: min,
				to: max,
				step: 1,
				scale: [min, max],
				width: '250',
				showLabels: true,
				isRange: true,
				ondragend(val) {
					price_range_actions(val, price_range);
				},
				onbarclicked(val) {
					price_range_actions(val, price_range);
				},
			});
			price_range.jRange('setValue', min + ',' + max);
		}

		function price_range_actions(val, price_range) {
			price_range.attr('data-action', true);
			const prices = val.split(',');
			if ($('.input-min').length > 0) {
				$('.input-min').val('').val(prices[0]);
				$('.input-max').val('').val(prices[1]);
			}
			if (prices[1]) {
				get_products();
				// reset block
				reset_block(price_range, price_range.parents('.sidebar-row'));
			}
		}
		const min_input = $('.input-min');
		if (min_input.length > 0) {
			$('.field .input-min,.field .input-max').on(
				'change paste keyup',
				function () {
					const $this = $(this);
					let latest_min = min;
					let latest_max = max;
					if ($this.hasClass('input-min')) {
						latest_min = $this.val() > max ? min : $this.val();
						$this.val('').val(latest_min);
						price_range.jRange('setValue', latest_min + ',' + max);
					} else {
						latest_max = $this.val() > max ? max : $this.val();
						$this.val('').val(latest_max);
					}
					price_range.attr('data-action', true);
					price_range.jRange(
						'setValue',
						latest_min + ',' + latest_max
					);
					get_products();
					// reset block
					reset_block(
						price_range,
						price_range.parents('.sidebar-row')
					);
				}
			);
		}

		//default call
		if ($('.prods-grid-view').length > 0) {
			get_products({ default_call: true });
		}

		/**
		 * Fetch products
		 * @param {*} params
		 */
		function get_products(params = {}) {
			const products_wrap = $('.products-wrap');
			const prod_grid_wrap = $('.prods-grid-view');
			const prod_list_wrap = $('.wp-list-view,.prods-list-view');
			const message_info = $('.message');
			const template = $('#shopContainer').data('template');
			const product_categories =
				$('#shopContainer').data('product_categories');
			const product_tags = $('#shopContainer').data('product_categories');
			const post_author = $('#shopContainer').data('post_author');
			const selected_data = selected_param(params);
			show_selected_data(selected_data);

			const data = {
				action: 'get_filtered_data',
				filter_plus_nonce: filter_client.filter_plus_nonce,
				template,
				product_categories,
				product_tags,
				post_author,
				params: selected_data,
			};

			$.ajax({
				url: filter_client.ajax_url,
				method: 'POST',
				data,
				beforeSend() {
					products_wrap.addClass('loader_box');
				},
				success(response) {
					if (response?.success) {
						const products = response?.data?.data?.products;
						const total = response?.data?.data?.total;
						$('.total').html('').html(total);
						$('.pages').html('').html(products.length);
						prod_grid_wrap.html('');
						prod_list_wrap.html('');
						message_info.html('');
						if (response?.data?.message !== '') {
							$('.sort-bar').fadeOut();
							const message = response?.data?.message;
							message_info.html(
								`<div class="filter-plus woocommerce-error">${message}</div>`
							);
							$('ul.pagination').html('');
						} else {
							if ($('.sort-bar').css('display') == 'none') {
								$('.sort-bar').fadeIn();
							}
							// product data
							const source_grid = $(
								'#search_products_grid'
							).html();
							const source_list = $(
								'#search_products_list'
							).html();
							for (let i = 0; i < products.length; i++) {
								if (source_grid) {
									var template_grid =
										Handlebars.compile(source_grid);
									var template_grid = template_grid(
										products[i]
									);
									prod_grid_wrap.append(template_grid);
								}

								if (source_list) {
									var template_list =
										Handlebars.compile(source_list);
									var template_list = template_list(
										products[i]
									);
									prod_list_wrap.append(template_list);
								}
							}
							// pagination
							pagination_html(
								response?.data?.data?.pages,
								params?.offset
							);
							const first_page = $('.pagination li.first-page');
							const last_page = $('.pagination li.last-page');
							if (params.offset == response?.data?.data?.pages) {
								last_page.fadeOut();
							} else {
								last_page.fadeIn();
							}
							if (params.offset == 1) {
								first_page.fadeOut();
							} else {
								first_page.fadeIn();
							}
						}
						// disable tags
						disable_items(response?.data?.disable_terms);
						$('html, body').animate({ scrollTop: 150 }, 'slow');
					}
					products_wrap.removeClass('loader_box');
				},
			});
		}

		/**
		 * Show selected data
		 * @param {*} selected_data
		 */
		function show_selected_data(selected_data) {
			if (filter_client.refresh_url == 'yes') {
				refresh_url(selected_data);
			}

			let selected_html = '';
			let clear_all = `<div class="clear-filter">${filter_client.localize.clear_all}</div>`;
			const cross = '<span>X</span>';
			for (const [key, value] of Object.entries(selected_data)) {
				if (
					!selected_data.default_call &&
					typeof value !== 'undefined'
				) {
					if (key == 'price_range' && value == true) {
						selected_html += `<div class='filter-tag' data-node='.range-slider'>${filter_client.localize.price} ${cross}</div>`;
					}
					if (key == 'rating' && value !== '') {
						selected_html += `<div class='filter-tag' data-node='.ratings'>${filter_client.localize.rating}${cross}</div>`;
					}
					if (key == 'product_cat' && value !== '') {
						selected_html += `<div class='filter-tag' data-node='.category-list li'>${value}${cross}</div>`;
					}
					if (key == 'search_value' && value !== '') {
						selected_html += `<div class='filter-tag' data-node='.search-form'>${filter_client.localize.search}${cross}</div>`;
					}
					if (key == 'stock' && value !== '') {
						selected_html += `<div class='filter-tag' data-node='stock'>${selected_data.stock_text}${cross}</div>`;
					}
					if (key == 'author' && value !== '') {
						selected_html += `<div class='filter-tag' data-node='author'>${selected_data.author_text}${cross}</div>`;
					}
					if (key == 'on_sale' && value !== '') {
						selected_html += `<div class='filter-tag' data-node='on_sale'>${selected_data.on_sale_text}${cross}</div>`;
					}
					if (key == 'custom_field_value' && value !== '') {
						selected_html += `<div class='filter-tag' data-node='custom-field'>${selected_data.custom_field_value}${cross}</div>`;
					}
					if (key == 'taxonomies_name') {
						for (const [name, data] of Object.entries(value)) {
							selected_html += `<div class='filter-tag' data-node='taxonomy' data-term_value='${name}'>${data}${cross}</div>`;
						}
					}
				}
			}

			if (selected_html == '') {
				clear_all = '';
			}
			$('.selected-filter').html('').html(`${clear_all}${selected_html}`);
		}

		/**
		 * Refresh url
		 * @param selected_data
		 */
		function refresh_url(selected_data) {
			if (
				typeof selected_data?.default_call === 'undefined' &&
				filter_client.is_pro_active == '1'
			) {
				const urlKey = [
					'product_cat',
					'rating',
					'price_range',
					'stock',
					'author',
					'on_sale',
					'taxonomies_name',
				];
				const format = { data: urlKey, sign: '[]', seo_data: false };
				const $urlPart = filterOption.get_taxonomies_data(
					$,
					selected_data,
					format
				);
				if ($urlPart !== '') {
					window.history.pushState(null, null, `?fp=` + $urlPart);
				} else {
					window.history.replaceState(
						null,
						'',
						window.location.pathname
					);
				}
			} else {
				window.history.replaceState(null, '', window.location.pathname);
			}
			seo_optimize(selected_data);
		}

		/**
		 * SEO elements apply
		 * @param selected_data
		 */
		function seo_optimize(selected_data) {
			const seo_elements = filter_client.seo_elements;
			if (
				selected_data?.default_call == true ||
				!$.isArray(seo_elements)
			) {
				return;
			}
			const title = $('.fplus-title');
			const page_title = title.data('page_title');
			const $result_text = filterOption.seo_data(
				$,
				selected_data,
				page_title
			);
			if ($.inArray('header', seo_elements) !== -1) {
				title.html('').html($result_text);
			}
			if ($.inArray('title', seo_elements) !== -1) {
				document.title = $result_text;
			}
			if ($.inArray('description', seo_elements) !== -1) {
				$('meta[name=description]').attr('content', $result_text);
			}
		}

		/**
		 * Get data
		 * @param {*} params
		 * @return
		 */
		function selected_param(params) {
			if (params?.clear_all) {
				return params;
			}
			const price_range = $('.range-slider');
			// category
			params.filter_type = $('#shopContainer').data('filter_type');
			params.cat_id = filterOption.get_category_list($);
			params.product_cat = filterOption.category_formatted_text($);
			params.rating = $('ul.ratings').attr('id');
			params.taxonomies = get_tags(true);
			params.taxonomies_name =
				filter_client.seo_slug_url == 'yes'
					? get_tags('slug')
					: get_tags('name');
			params.filter_param = get_tags(false);
			params.search_value = params.default_call == true ? '' : $('.sidebar-input').val();
			params.order_by = $('#filter-sort-by option:selected').val();
			params.author = $(".author input[type='checkbox']:checked").val();
			params.author_text = $(
				".author input[type='checkbox']:checked"
			).data('author_text');
			params.stock = $(".stock input[type='checkbox']:checked").val();
			params.stock_text = $(".stock input[type='checkbox']:checked").data(
				'stock_text'
			);
			params.on_sale = $(".on_sale input[type='checkbox']:checked").val();
			params.on_sale_text = $(
				".on_sale input[type='checkbox']:checked"
			).data('on_sale_text');
			params.custom_field_key = $(
				".custom-field input[type='checkbox']:checked"
			).val();
			params.custom_field_value = $(
				".custom-field input[type='checkbox']:checked"
			).data('meta_value');
			params.meta_condition = $(
				".custom-field input[type='checkbox']:checked"
			).data('meta_condition');

			if (price_range.length > 0) {
				const prices = price_range.val().split(',');
				params.min = prices[0];
				params.max = prices[1];
				params.price_range =
					price_range.attr('data-action') == 'true' ? true : false;
			}

			return params;
		}

		/**
		 * Pagination
		 * @param {*} pages
		 * @param     offset
		 */
		function pagination_html(pages, offset) {
			const current_page = offset ? offset : 1;
			const pagination = $('.pagination');

			if (pages > 0) {
				pagination.html('');
				pagination.append(
					`<li class="first-page"> <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"/></svg> </li>`
				);
				for (let i = 1; i <= pages; i++) {
					const current_class =
						current_page == i ? ' class="current"' : '';

					pagination.append(
						`<li ` + current_class + `>` + i + `</li>`
					);
				}
				pagination.append(
					`<li class="last-page"> <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg> </li>`
				);
			}

			$('.pagination li').on('click', function () {
				const offset = $(this).text();
				get_products({
					offset,
				});
			});
		}
		/**
		 * Disable item
		 * @param {*} disable_terms
		 * @param     terms
		 */
		function disable_items(terms) {
			$('.param-box div').removeClass('disable');
			$.each(terms, function (key, value) {
				if (value?.length > 0) {
					for (let index = 0; index < value.length; index++) {
						$(
							'.radio-item[data-term_id=' + value[index] + ']'
						).addClass('disable');
					}
				}
			});
		}

		/**
		 * List Grid Switcher
		 */
		const params = { list: $('.product-list'), grid: $('.product-grid') };
		list_grid_view(params);
		function list_grid_view(params) {
			$('.prods-list-view').css('display', 'none');
			params.list.on('click', function () {
				$('.prods-grid-view').fadeOut();
				$('.prods-list-view').fadeIn();
			});
			params.grid.on('click', function () {
				$('.prods-grid-view').fadeIn();
				$('.prods-list-view').fadeOut();
			});
		}

		/**
		 *
		 * @param {*} $this
		 */
		if ($('ul.ratings').length > 0) {
			ratings();
		}
		function ratings() {
			$('ul.ratings').on('click', 'li', function () {
				const $this = $(this);
				const $template = $('.ratings').data('template');
				if ($template == 1) {
					$('.ratings li').not($this).addClass('rating_disable');
				} else {
					$('.rating-label').html('').html($(this).html());
				}
				$('ul.ratings').attr('id', $this.data('star'));
				get_products();
				// reset block
				reset_block($this, $this.parents('.ratings'));
			});
		}

		/**
		 * reset
		 * @param     $parent
		 * @param {*} $this
		 * @param     clear_all
		 * @param     action
		 */
		function reset_block($parent, $this, clear_all = false, action = '') {
			const reset_button = $this.find('.reset');
			if (action == '') {
				if (reset_button.hasClass('d-none')) {
					reset_button.removeClass('d-none');
				}
				reset_button.fadeIn();
			}
			reset_button.on('click', function () {
				section_reset(
					$parent,
					$this,
					(clear_all = false),
					(action = '')
				);
			});
		}

		function section_reset($parent, $this, clear_all = false, action = '') {
			const reset_button = $this.find('.reset');

			if ($this.hasClass('ratings')) {
				$this.attr('id', '');
				$('.ratings li').removeClass('rating_disable');
				$('.rating-label').html('');
			}
			if ($parent.hasClass('ratings')) {
				$parent.attr('id', '');
				$('.ratings li').removeClass('rating_disable');
				$('.rating-label').html('');
			} else if ($parent.hasClass('range-slider')) {
				$parent.attr('data-action', false);
				const min = $parent.data('min');
				const max = $parent.data('max');
				$parent.val(min + ',' + max);
				$parent.jRange('setValue', min + ',' + max);
			} else if ($parent.hasClass('sidebar-input')) {
				$parent.val('');
			} else {
				$parent.removeClass('active');
				$parent.find('input[type=checkbox]').removeAttr('checked');
			}
			if (!clear_all) {
				get_products();
			}
			reset_button.fadeOut();
		}

		/**
		 * Get tags
		 * @param selected
		 * @return
		 */
		function get_tags(selected = false) {
			const obj = {};
			const attribute = $('.param-box');
			if (attribute.length > 0) {
				attribute.each(function (i, value) {
					if (typeof value === 'undefined') {
						return;
					}
					const label = $(value)
						.parents('.sidebar-row')
						.find('.sidebar-label')
						.text();
					const single_attr = $(value).find('div');
					const active_tag = $(
						'.active[data-taxonomy="' +
							single_attr.data('taxonomy') +
							'"]'
					);
					if (!selected) {
						obj[single_attr.data('taxonomy')] = single_attr
							.map(function () {
								return $(this).data('term_id');
							})
							.get();
					} else if (selected == 'name' || selected == 'slug') {
						if (typeof active_tag.data('term_id') === 'undefined') {
							return;
						}

						if (selected == 'name') {
							if (active_tag.data('taxonomy') == 'pa_color') {
								obj[label] = active_tag.data('name');
							} else {
								obj[label] = active_tag.text();
							}
						} else {
							obj[label] = active_tag.data('slug');
						}
					} else if (active_tag.data('term_id')) {
						obj[single_attr.data('taxonomy')] =
							active_tag.data('term_id');
					}
				});
			}
			if (!selected && $('.category-list').length > 0) {
				obj.product_cat = $('.category-list li')
					.map(function () {
						return $(this).data('cat_id');
					})
					.get();
			}

			return obj;
		}

		/**
		 * Clear all
		 */
		const clear_filter = '.selected-filter .clear-filter';
		const filter_tag = '.selected-filter .filter-tag';
		const clean_block = [
			clear_filter,
			filter_tag,
			'.title-and-clean-area .clear_all',
		];
		clean_block.forEach((element) => {
			$(document).on('click', element, function (e) {
				e.preventDefault();
				const $this = $(this);
				const parent = '';
				if (element == filter_tag) {
					const node = $this.data('node');
					let cursor = $(node);
					let parent = cursor.parents('.sidebar-row');
					$this.find('.filter-tag').remove();
					if (node == 'taxonomy') {
						parent = $(
							`div[data-taxonomy="${$this.data('term_value')}"]`
						).parent('.param-box');
						cursor = $(
							`div[data-taxonomy="${$this.data('term_value')}"]`
						);
					}
					if (
						node == 'on_sale' ||
						node == 'stock' ||
						node == 'custom-field'
					) {
						if (
							$(`.${node} input[type='checkbox']`).is(':checked')
						) {
							$(`.${node} input[type='checkbox']`).prop(
								'checked',
								false
							);
						}
						parent = $(`.${node}`).parent('.param-box');
						cursor = $(`.${node}`);
					} else {
						cursor.parents('.sidebar-row');
					}

					cursor.closest('.reset').fadeOut();

					if ($(filter_tag).length == 0) {
						$(clear_filter).remove();
					}
					section_reset(cursor, parent, false, 'filter-tag');
				} else {
					clear_all($this);
				}
			});
		});

		function clear_all(element = $('.clear_all'), action = '') {
			const clear_all = element;
			if (clear_all.length > 0) {
				// reset block
				const sidebar = $('.sidebar-row');
				const param_box = $('.param-box');
				const ratings = $('.ratings');
				const category = $('.category-list li');
				const search = $('.sidebar-input');
				const price_range = $('.range-slider');

				category.removeClass('active');
				search.val('');
				param_box.find('.radio-item').removeClass('active');

				if (ratings.length > 0) {
					ratings.attr('id', '');
					const rating_label = $('.rating-label');
					rating_label.html(rating_label.data('rating_label'));
					$('.ratings li').removeClass('rating_disable');
				}
				if (price_range.length > 0) {
					price_range.jRange(
						'setValue',
						price_range.data('min') + ',' + price_range.data('max')
					);
				}
				$('input[type=checkbox]').removeAttr('checked');
				sidebar.find('.reset').fadeOut();
				if (action == '') {
					get_products({ default_call: true });
				} else {
					get_products();
				}
			}
		}

		/**
		 * Slider
		 */
		$('.down-arrow').css('display', 'none');
		sidebar_slider($('.sidebar-label'));
		sidebar_slider($('.dropdown-label'));
		function sidebar_slider($handle) {
			$handle.on('click', function () {
				const _this = $(this);

				_this.siblings('.down-arrow').slideToggle();
				_this.siblings('.up-arrow').slideToggle();

				_this.siblings('.panel').slideToggle(700, function () {
					if (_this.hasClass('closed')) {
						_this.removeClass('closed').addClass('open');
					} else {
						_this.removeClass('open').addClass('closed');
					}
				});
			});
		}

		/**
		 * Sorting
		 */
		sorting();
		function sorting() {
			const filter_by = $('#filter-sort-by');
			filter_by.on('change', function () {
				get_products();
			});
		}

		mobile_filter_slide();
		function mobile_filter_slide() {
			const $sidebarAndWrapper = $('.shop-sidebar');

			$('.filter-mb-search').click(function (e) {
				e.stopPropagation();
				$sidebarAndWrapper.toggleClass('active-sidebar');
			});
			$('body,html').click(function (e) {
				const container = $('.active-sidebar');

				if (
					!container.is(e.target) &&
					container.has(e.target).length === 0
				) {
					container.removeClass('active-sidebar');
				}
			});
		}
	});
})(jQuery);
