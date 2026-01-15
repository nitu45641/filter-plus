(function ($) {
	'use strict';

	$(document).ready(function () {
		/*
		 * Get Product from filter
		 */

		// Check if apply button mode is enabled
		const applyButtonMode = $('#shopContainer').data('apply_button_mode');
		const isApplyMode = (applyButtonMode === 'yes');

		//list click/change
		const category_li = $('.category-list li');
		let action = 'click';
		if (category_li.find('input[type="checkbox"]').length !== 0 ) {
			action = 'change';
		}
		
		category_li.on(action, function (event) {
			event.preventDefault();
			let _this = $(this);
			let active_li = $('#cat_li_parent_' + _this.data('cat_id'));
			if (_this.parent().hasClass('sub_categories')) {
				active_li = $('#cat_li_child_' + _this.data('cat_id'));
			}		
			if (active_li.length > 0) {
				if (active_li.is('input')) {
					let parent = _this.data("parent");

					if (active_li.is(':checked')) {
						_this.addClass('active');
						// If this is a parent category, select all child sub categories
						if (_this.hasClass('parent')) {
							let parent = _this.data('cat_id');
							// Try to find child li elements in all .sub_categories lists
							let child_li = $(".sub_categories li[data-parent='" + parent + "']");							
							child_li.addClass('active');
							child_li.find("input[type='checkbox']").prop('checked', true);
						}
						// sub category child category un-check
						if (_this.data("parent")) {
							let parent_li = $('.category-list li[data-parent="' + parent + '"]');
							let child_cat = _this.parent("ul.sub_categories").find("li");							
							if (child_cat.length == child_cat.find("input:checked").length) {
								parent_li.find("input").prop("checked", true);
								parent_li.addClass("active");
							}
						}
					} else {
						_this.removeClass('active');
						// sub category parent category un-check
						if (_this.hasClass("parent")) {
							let child_li = $('.sub_categories li[data-parent="' + parent + "']");
							child_li.removeClass("active");
							child_li.find("input").prop("checked", false);
						}

						// sub category child category un-check
						if (_this.data("parent")) {
							// Only uncheck the clicked subcategory, not all
							_this.find("input").prop("checked", false);
							_this.removeClass("active");
							// Optionally, update parent if needed (do not uncheck all siblings)
						}
						
					}
				} 
				else if (active_li.is('li')) {
					category_li.removeClass('active');					
					if (!active_li.hasClass('active')) {
						_this.addClass('active');
					} else {
						_this.removeClass('active');
					}
				}
			}

			// Only auto-filter if apply button mode is disabled
			if (!isApplyMode) {
				get_products();
			} else {
				// In apply mode, just update the selected filter tags
				show_selected_data(selected_param({}));
			}
			// reset block
			reset_block(_this, _this.parents('.sidebar-row'));
		});

		//search product
		$('.sidebar-input').on('keyup', function () {
			const _this = $(this);
			// Only auto-filter if apply button mode is disabled
			if (!isApplyMode) {
				get_products();
			} else {
				// In apply mode, just update the selected filter tags
				show_selected_data(selected_param({}));
			}
			reset_block(_this, _this.parents('.sidebar-row'));
		});

		//attribute/tag click
		const sidebar_row = $('.sidebar-row');
		if (sidebar_row.length > 0) {
			$.each(sidebar_row, function (index, value) {
				const param_box = $(this).find('.param-box');
				param_box.on('click', '.radio-item,.color-item', function () {
					const _this = $(this);
					param_box.find('.radio-item,.color-item').removeClass('active');
					_this.addClass('active');
					// Only auto-filter if apply button mode is disabled
					if (!isApplyMode) {
						get_products();
					} else {
						// In apply mode, just update the selected filter tags
						show_selected_data(selected_param({}));
					}
					// reset block
					reset_block(_this, _this.parents('.sidebar-row'));
				});
				param_box.on('change', '.color-item input,.checkbox-item input,select[name="custom-field"]', function () {
					const _this = $(this);
					if ( _this.attr('type') !== 'select' ) {
						if (_this.is(':checked') ) {
							_this.prop('checked', true);
							_this.parents('.color-item').addClass('active');
						} else {
							_this.prop('checked', false);
							_this.parents('.color-item').removeClass('active');

						}
					}
					// Only auto-filter if apply button mode is disabled
					if (!isApplyMode) {
						get_products();
					} else {
						// In apply mode, just update the selected filter tags
						show_selected_data(selected_param({}));
					}
					//reset block
					reset_block(_this, _this.parents('.sidebar-row'));
				});
			});
		}
		
		// price range
		const price_range = $('.range-slider');
		const min = Math.max(1, price_range.data('min') || 1);
		const max = price_range.data('max');

		price_range_picker();
		function price_range_picker() {
			// Custom price range picker implementation
			const slider = $('.custom-range-slider');
			if (slider.length === 0) return;

			const track = slider.find('.range-track');
			const fill = slider.find('.range-fill');
			const minThumb = slider.find('.range-thumb-min');
			const maxThumb = slider.find('.range-thumb-max');
			const minLabel = $('.range-label-min');
			const maxLabel = $('.range-label-max');

			let isDragging = false;
			let activeThumb = null;
			let currentMin = min;
			let currentMax = max;

			// Set initial positions
			updateSlider();

			function getPositionFromValue(value) {
				return ((value - min) / (max - min)) * 100;
			}

			function getValueFromPosition(position) {
				const value = min + (position / 100) * (max - min);
				return Math.round(value);
			}

			function updateSlider() {
				const minPos = getPositionFromValue(currentMin);
				const maxPos = getPositionFromValue(currentMax);

				minThumb.css('left', minPos + '%');
				maxThumb.css('left', maxPos + '%');
				fill.css({
					'left': minPos + '%',
					'width': (maxPos - minPos) + '%'
				});

				// Update labels with currency formatting
				const currency = price_range.siblings('.default-range').find('.min').text().replace(/[0-9]/g, '');
				minLabel.text(currency + currentMin);
				maxLabel.text(currency + currentMax);
			}

			function handleMouseMove(e) {
				if (!isDragging || !activeThumb) return;

				const rect = track[0].getBoundingClientRect();
				const position = Math.max(0, Math.min(100, ((e.clientX - rect.left) / rect.width) * 100));
				const value = getValueFromPosition(position);

				if (activeThumb.hasClass('range-thumb-min')) {
					currentMin = Math.max(1, Math.min(value, currentMax - 1));
				} else {
					currentMax = Math.max(value, Math.max(1, currentMin) + 1);
				}

				updateSlider();
			}

			function handleMouseUp() {
				if (isDragging) {
					isDragging = false;
					activeThumb = null;

					// Trigger the same action as jRange
					const val = currentMin + ',' + currentMax;
					price_range_actions(val, price_range);
				}
			}

			// Event listeners
			minThumb.on('mousedown', function(e) {
				e.preventDefault();
				isDragging = true;
				activeThumb = $(this);
			});

			maxThumb.on('mousedown', function(e) {
				e.preventDefault();
				isDragging = true;
				activeThumb = $(this);
			});

			track.on('click', function(e) {
				if (isDragging) return;

				const rect = this.getBoundingClientRect();
				const position = ((e.clientX - rect.left) / rect.width) * 100;
				const value = getValueFromPosition(position);

				// Determine which thumb to move based on proximity
				const minDistance = Math.abs(value - currentMin);
				const maxDistance = Math.abs(value - currentMax);

				if (minDistance < maxDistance) {
					currentMin = Math.max(1, Math.min(value, currentMax - 1));
				} else {
					currentMax = Math.max(value, Math.max(1, currentMin) + 1);
				}

				updateSlider();

				// Trigger action
				const val = currentMin + ',' + currentMax;
				price_range_actions(val, price_range);
			});

			$(document).on('mousemove', handleMouseMove);
			$(document).on('mouseup', handleMouseUp);

			// Custom setValue method for compatibility
			price_range.customSetValue = function(value) {
				const values = value.split(',');
				currentMin = Math.max(1, parseInt(values[0]) || min);
				currentMax = parseInt(values[1]) || max;
				updateSlider();
			};

			// Set initial values
			price_range.customSetValue(min + ',' + max);
		}

		/**
		 * Re-initialize the range slider on window resize
		 */

		let resizeTimeout;
		$(window).on('resize', function () {
		clearTimeout(resizeTimeout);
		resizeTimeout = setTimeout(function () {
			price_range_picker();
		}, 200); // wait 200ms after resize ends
		});

		function price_range_actions(val, price_range) {
			price_range.attr('data-action', true);
			// Set the value on the price_range element
			price_range.val(val);
			const prices = val.split(',');
			if ($('.input-min').length > 0) {
				$('.input-min').val('').val(prices[0]);
				$('.input-max').val('').val(prices[1]);
			}
			if (prices[1]) {
				// Only auto-filter if apply button mode is disabled
				if (!isApplyMode) {
					get_products();
				} else {
					// In apply mode, just update the selected filter tags
					show_selected_data(selected_param({}));
				}
				// reset block
				reset_block(price_range, price_range.parents('.sidebar-row'));
			}
		}
		const min_input = $('.input-min');
		if (min_input.length > 0) {
			// Enhanced price input validation and UX
			function validatePriceInput($input, value, isMin = true) {
				const container = $input.closest('.input-container');
				const errorSpan = $input.closest('.field').find('.input-error');
				let isValid = true;
				let errorMessage = '';

				// Clear previous states
				container.removeClass('error success');
				errorSpan.text('');

				// Validate value - allow empty for clearing
				if (value !== '' && value !== null && !isNaN(value)) {
					if (value < 0) {
						isValid = false;
						errorMessage = 'Price cannot be negative';
					} else if (isMin && value > max) {
						isValid = false;
						errorMessage = `Min price cannot exceed ${max}`;
					} else if (!isMin && value < min) {
						isValid = false;
						errorMessage = `Max price must be at least ${min}`;
					} else if (!isMin && value <= parseFloat($('.input-min').val() || min)) {
						isValid = false;
						errorMessage = 'Max price must be greater than min price';
					}
				}

				// Apply visual feedback
				if (isValid) {
					container.addClass('success');
				} else {
					container.addClass('error');
					errorSpan.text(errorMessage);
				}

				return isValid;
			}

			// Real-time input validation and sync
			$('.field .input-min,.field .input-max').on('input', function () {
				const $this = $(this);
				const rawValue = $this.val();
				const value = parseFloat(rawValue) || 0;
				const isMin = $this.hasClass('input-min');

				// Skip validation for partial decimal entries (e.g., "5.")
				if (rawValue.endsWith('.') || rawValue.endsWith('.0')) {
					return;
				}

				// Validate input
				const isValid = validatePriceInput($this, value, isMin);

				// Sync with slider if valid
				if (isValid && price_range.customSetValue) {
					const currentMin = isMin ? value : (parseFloat($('.input-min').val()) || min);
					const currentMax = isMin ? (parseFloat($('.input-max').val()) || max) : value;
					price_range.customSetValue(currentMin + ',' + currentMax);
				}

				// Trigger real-time filtering
				triggerFilter();
			});

			// Real-time filtering with debounce
			let filterTimeout;
			function triggerFilter() {
				clearTimeout(filterTimeout);
				filterTimeout = setTimeout(() => {
					const minVal = parseFloat($('.input-min').val()) || min;
					const maxVal = parseFloat($('.input-max').val()) || max;

					// Validate both inputs
					const minValid = validatePriceInput($('.input-min'), minVal, true);
					const maxValid = validatePriceInput($('.input-max'), maxVal, false);

					if (minValid && maxValid) {
						price_range.attr('data-action', true);
						// Only auto-filter if apply button mode is disabled
						if (!isApplyMode) {
							get_products();
						} else {
							// In apply mode, just update the selected filter tags
							show_selected_data(selected_param({}));
						}
						reset_block(price_range, price_range.parents('.sidebar-row'));
					}
				}, 800); // Wait 800ms after user stops typing
			}

			// Legacy input handling for backwards compatibility
			$('.field .input-min,.field .input-max').on(
				'change blur',
				function () {
					const $this = $(this);
					const rawValue = $this.val();

					// Skip if empty or partial decimal
					if (rawValue === '' || rawValue.endsWith('.')) {
						return;
					}

					let latest_min = min;
					let latest_max = max;
					if ($this.hasClass('input-min')) {
						latest_min = Math.max(0, Math.min(parseFloat($this.val()) || min, max));
						$this.val(latest_min);
						if (price_range.customSetValue) {
							price_range.customSetValue(latest_min + ',' + max);
						}
					} else {
						const currentMin = parseFloat($('.input-min').val()) || min;
						latest_max = Math.max(currentMin, parseFloat($this.val()) || max);
						$this.val(latest_max);
					}
					price_range.attr('data-action', true);
					if (price_range.customSetValue) {
						price_range.customSetValue(latest_min + ',' + latest_max);
					}
				}
			);
		}

		//default call
		if ($('.prods-grid-view').length > 0) {
			// Always load products on initial page load
			get_products({ default_call: true });
		}

		/**
		 * Show empty state with total count in apply button mode
		 */
		function show_empty_state_with_count() {
			let products_wrap = $('.products-wrap');
			let prod_grid_wrap = $('.prods-grid-view');
			let message_info = $('.message');
			let template = $('#shopContainer').data('template');
			let limit = $('#shopContainer').data('limit');
			let product_categories = $('#shopContainer').data('product_categories');
			let product_tags = $('#shopContainer').data('product_tags');
			let post_author = $('#shopContainer').data('post_author');

			const data = {
				action: 'get_filtered_data',
				filter_plus_nonce: filter_client.filter_plus_nonce,
				template,
				limit,
				product_categories,
				product_tags,
				post_author,
				params: { default_call: true, count_only: true },
			};

			$.ajax({
				url: filter_client.ajax_url,
				method: 'POST',
				data,
				success(response) {
					if (response?.success) {
						const total = response?.data?.data?.total || 0;
						$('.total').html('').html(total);
						prod_grid_wrap.html('');
						message_info.html(`<div class="filter-plus woocommerce-info">${total} items found. Click "Apply" to show results.</div>`);
					}
				},
			});
		}

		/**
		 * Fetch products
		 * @param {*} params
		 */
		function get_products(params = {}) {			
			let products_wrap 	= $('.products-wrap');
			let prod_grid_wrap 	= $('.prods-grid-view');
			let prod_list_wrap 	= $('.prods-list-view');
			let message_info 		= $('.message');
			let pagination_style 	= $('#shopContainer').data('pagination_style');
			let masonry_style 		= $('#shopContainer').data('masonry_style');
			let template 			= $('#shopContainer').data('template');
			let limit 			= $('#shopContainer').data('limit');
			let product_categories =
				$('#shopContainer').data('product_categories');
			let product_tags 	= $('#shopContainer').data('product_tags');
			let post_author 	= $('#shopContainer').data('post_author');
			let selected_data 	= selected_param(params);
			show_selected_data(selected_data);
			
			const data = {
				action: 'get_filtered_data',
				filter_plus_nonce: filter_client.filter_plus_nonce,
				pagination_style: pagination_style,
				template,
				masonry_style,
				limit,
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
						$('.naviation').html('');
						const products 	= response?.data?.data?.products;
						const total 	= response?.data?.data?.total;						

						showing_nav_num( total ,  products.length , selected_data['offset'] , pagination_style );

						// clear product data
						if ( ( typeof params?.load_more === 'undefined'
								&& pagination_style == 'loadmore' ) ||
							pagination_style == 'numbers') {
							// Ensure grid-sizer and gutter-sizer are present for Isotope
							let $isotop_html = not_masonry(params, masonry_style, template);
							prod_grid_wrap.html( $isotop_html );
							prod_list_wrap.html('');
						}
						
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

							// product data from server response
							if (response?.data?.data?.products_grid_html) {
								prod_grid_wrap.append(response.data.data.products_grid_html);
							}

							if (response?.data?.data?.products_list_html) {
								prod_list_wrap.append(response.data.data.products_list_html);
							}

							// pagination
							pagination_html(response?.data?.data?.pagination_markup);
						}
						// disable tags
						disable_items(response?.data?.disable_terms);
					}

					loadIsotope( template , masonry_style , selected_data.filter_type );
					// (Re)initialize Swiper after AJAX loads new carousel
					filterCorosuel({element: '.post-coursel-view-2'});
					products_wrap.removeClass('loader_box');
					
				},
			});

		}

		/**
		 * Showing number of products
		 * @param {*} total 
		 * @param {*} pages 
		 * @param {*} offset 
		 * @param {*} pagination_style 
		 */
		function showing_nav_num(total,pages,offset,pagination_style) {
			$('.total').html('').html(total);
			let page_markup = $('.pages').html('');
			if (pagination_style == 'loadmore') {
				offset = typeof offset !== 'undefined' ? offset : 1;
				page_markup.html( pages * offset );
			} else {
				page_markup.html( pages );
			}

		}

		function loadIsotope( template , masonry_style ){			

			if ( masonry_style !== 'yes' ) {
				return;
			}

			let $isotopeGrid = $('.prods-grid-view');
			let $notMasonry = $('.post-coursel-view-2');

			// Masonary style
			if ($notMasonry.length > 0) {
				return;
			}
			// Destroy previous Masonry instance if exists
			if ($isotopeGrid.data('masonry')) {
				$isotopeGrid.masonry('destroy');
			}
			$isotopeGrid.imagesLoaded(function(){
				$isotopeGrid.masonry({
					itemSelector: '.product-style-' + template,
					layoutMode: 'masonry',
					percentPosition: true,
					columnWidth: '.grid-sizer',
					gutter: ".gutter-sizer"
				});
			});
		}

		function filterCorosuel(params) {
			// Destroy previous Swiper instance if exists
			if (window.swiperInstance) {
				window.swiperInstance.destroy(true, true); // destroy previous instance
			}
			// Only initialize if element exists
			if ($(params.element).length > 0) {
				window._swiperInstance = new Swiper(params.element, {
					navigation: {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev'
					},
					pagination: {
						el: '.swiper-pagination',
						clickable: true,
					},
					slidesPerView: 3,
					slidesPerGroup: 3, 
					spaceBetween: 10,
					paginationClickable: true,
					autoplay: {
						delay: 4000,
					},
					breakpoints: {
						1024: {slidesPerView: 3},
						768: {slidesPerView: 2},
						425: { slidesPerView: 1},
					},
					
				});
			}
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
			const cross = '<span>X</span>';
			let clear_all = `<div class="clear-filter">${filter_client.localize.clear_all}</div>`;
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

						let cat_tag = value.split(',');
						cat_tag.forEach((element,index) => {
							selected_html += `<div class='filter-tag' data-node='.category-list li' data-cat='${element}' data-cat_id='${selected_data['cat_id'][index]}'>${element}${cross}</div>`;
						});
						// Remove category tag on click
						setTimeout(function() {
							$('.filter-tag[data-node=".category-list li"]').off('click').on('click', function() {
								const cat_id = $(this).data('cat_id');								
								// Check if the category is represented by an input or a list item
                                const $input = $(`.category-list li[data-cat_id='${cat_id}'] input[type='checkbox']`);
                                const $li = $(`.category-list li[data-cat_id='${cat_id}']`);								
								if ($input.length) {
                                    $input.prop('checked', false).trigger('change');
                                } else if ($li.length) {
                                    $li.removeClass('active');
									get_products()
                                }
								// Remove the tag visually
								$(this).remove();
							});
						}, 0);
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
					'seo_taxonomy',
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
			params.taxonomies_name = get_tags('name');
			params.seo_taxonomy =
			filter_client.seo_slug_url == 'yes'
				? get_tags('slug')
				: get_tags('seo_data');
			params.filter_param = get_tags(false);
			params.search_value = filterOption.filterSearch($);
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

			params = filterOption.customFieldValue($,params);
			if (price_range.length > 0) {
				const priceValue = price_range.val();
				const defaultMin = price_range.data('min') || 1;
				const defaultMax = price_range.data('max') || 1000;

				// Parse price values with proper handling of empty strings
				if (priceValue && priceValue.trim() !== '' && priceValue.includes(',')) {
					const prices = priceValue.split(',');
					// Parse and validate both min and max
					const parsedMin = prices[0] ? parseFloat(prices[0].trim()) : null;
					const parsedMax = prices[1] ? parseFloat(prices[1].trim()) : null;

					params.min = (!isNaN(parsedMin) && parsedMin !== null) ? parsedMin : defaultMin;
					params.max = (!isNaN(parsedMax) && parsedMax !== null) ? parsedMax : defaultMax;
				} else {
					// If no valid value, use defaults
					params.min = defaultMin;
					params.max = defaultMax;
				}

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
		function pagination_html(pagination_markup) {
			
			let pagination 	= $('.naviation');
			let $footer 	= $('.pagination-footer');
			let $inside 	= $footer.find('.showing');
			
			if ($inside.length > 0) {
				$footer.addClass('two-section').removeClass('one-section');
			} else {
				$footer.addClass('one-section').removeClass('two-section');
			}
			
			pagination.html(pagination_markup);
			$('.products-wrap').find('.naviation li:not(.disabled)').on('click', function () {
				let load_more = false;
				let _this = $(this);

				// Check if button is disabled
				if (_this.hasClass('disabled')) {
					return false;
				}

				// Check for invalid page data
				let offset = _this.data('page');
				if (offset === 0 || offset === '#' || !offset) {
					return false;
				}

				if (_this.hasClass('load-more')) {
					load_more = true;
				}

				get_products({offset:offset,load_more:load_more});
			});

			// Explicitly prevent clicks on disabled pagination buttons
			$('.products-wrap').find('.naviation li.disabled').on('click', function (e) {
				e.preventDefault();
				e.stopPropagation();
				e.stopImmediatePropagation();
				return false;
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
				$('.prods-grid-view').removeClass('active').fadeOut();
				$('.prods-list-view').addClass('active').fadeIn();

				$('.sort-bar .product-grid').removeClass('active')
				$('.sort-bar .product-list').addClass('active');

				$('.wp-list-view.tab-item').fadeOut();
			});
			params.grid.on('click', function () {
				$('.prods-grid-view').addClass('active').fadeIn();
				$('.prods-list-view').removeClass('active').fadeOut();

				$('.sort-bar .product-grid').addClass('active');
				$('.sort-bar .product-list').removeClass('active');

				$('.wp-list-view.tab-item').fadeIn();
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
				$(this).addClass('active').siblings().removeClass('active');
				$('.rating-label').html('').html($(this).html());
				$('ul.ratings').attr('id', $this.data('star'));
				// Only auto-filter if apply button mode is disabled
				if (!isApplyMode) {
					get_products();
				} else {
					// In apply mode, just update the selected filter tags
					show_selected_data(selected_param({}));
				}
				// reset block
				reset_block($this, $this.closest('.panel') );
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

			if ( $this.find('.filter-tab-pane').length > 0 ) {
				$('.filter-top').addClass('d-none');
				return
			}
			
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
			if ($this.find('ul').hasClass('ratings')) {
				let label = $('.rating-label');
				$this.find('ul').attr('id', '');
				$('.ratings li').removeClass('rating_disable');
				label.html('').html(label.data('rating_label'));
			}
			if ($parent.hasClass('ratings')) {
				$parent.attr('id', '');
				$('.ratings li').removeClass('rating_disable');
				$('.rating-label').html('Any Rating');
			} else if ($parent.hasClass('range-slider')) {
				$parent.attr('data-action', false);
				const min = $parent.data('min');
				const max = $parent.data('max');
				$parent.val(min + ',' + max);
				if ($parent.customSetValue) {
					$parent.customSetValue(min + ',' + max);
				}
			} else if ($parent.hasClass('sidebar-input')) {
				$parent.val('');
			} else {
				$parent.removeClass('active');
				if ( typeof $parent.attr('type') !=='undefined' && $parent.attr('type') !== 'select' ) {
					$parent.prop('checked',false);
				} else {
					let list_checkbox = $parent.find('input').attr('type');
					if( list_checkbox !=='undefined' && list_checkbox == 'checkbox' ) {
						$parent.find('input').prop('checked',false);
					}
					$parent.val('');
					let niceSelect = $('.nice-select');
					$(".custom-field option:eq(0)").prop("selected", true);
					if (niceSelect.length>0) {
						$('select').niceSelect('update'); 
					}
				}
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
					} else if (selected == 'name' || selected == 'slug' || selected == 'seo_taxonomy' ) {
						if (typeof active_tag.data('term_id') === 'undefined') {
							return;
						}
						let property_name = selected == 'seo_taxonomy' ? label : active_tag.data('taxonomy'); 
 	
						if (selected == 'name') {
							if (active_tag.data('taxonomy') == 'pa_color') {
								obj[property_name] = active_tag.data('name');
							} else {
								obj[property_name] = active_tag.text();
							}
						} else {
							obj[property_name] = active_tag.data('slug');
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
				param_box.find('.color-item').removeClass('active');

				if (ratings.length > 0) {
					ratings.attr('id', '');
					const rating_label = $('.rating-label');
					rating_label.html(rating_label.data('rating_label'));
					$('.ratings li').removeClass('rating_disable');
				}
				if (price_range.length > 0) {
					if (price_range.customSetValue) {
						price_range.customSetValue(
							price_range.data('min') + ',' + price_range.data('max')
						);
					}
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
		$('.up-arrow').css('display', 'none');
		sidebar_slider($('.heading-wrap'));
		sidebar_slider($('.dropdown-label'));
		function sidebar_slider($handle) {
			$handle.on('click', function () {
			const _this = $(this);
			// Find the closest heading-wrap and toggle arrows and panel
			let headingWrap = _this.closest('.heading-wrap');
			if (headingWrap.length === 0) {
				headingWrap = _this.closest('.dropdown-label');
			}
			const downArrow = headingWrap.find('.down-arrow');
			const upArrow = headingWrap.find('.up-arrow');
			const panel = headingWrap.parent().find('.panel').first();
			
			// Always hide both arrows initially
			downArrow.hide();
			upArrow.hide();

			downArrow.slideToggle();
			upArrow.slideToggle();
			// Show/hide arrows based on open/close state
			if (_this.hasClass('closed')) {
				downArrow.show();
				upArrow.hide();
			} else {
				downArrow.hide();
				upArrow.show();
			}

			panel.slideToggle(700, function () {
				if (_this.hasClass('closed')) {
					if (panel.hasClass('d-none')) {
						panel.removeClass('d-none');
					}
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
				// Only auto-filter if apply button mode is disabled
				if (!isApplyMode) {
					get_products();
				}
			});
		}

		mobile_filter_slide();
		function mobile_filter_slide() {
			const $sidebarAndWrapper = $('.shop-sidebar');
			const animationDuration = 350; // ms

			$('.filter-mb-search,.filter-bar-mb-search').on('click', function (e) {
				e.stopPropagation();
				
				if (!$sidebarAndWrapper.hasClass('active-sidebar')) {
					$sidebarAndWrapper.css('left:100%; opacity: 1;');
					$sidebarAndWrapper.addClass('active-sidebar').stop(true, true).animate({ left: 0, opacity: 1 }, animationDuration);
				} else {
					$sidebarAndWrapper.css('left: -100%; opacity: 0;');
					$sidebarAndWrapper.removeClass('active-sidebar').stop(true, true).animate({ left: '-100%', opacity: 0 }, animationDuration);
				}
			});
			$('.side-cart-close').click(function (e) {
				$sidebarAndWrapper.removeClass('active-sidebar').stop(true, true).animate({ left: '-100%', opacity: 0 }, animationDuration);
			});

			$('body,html').click(function (e) {
				const container = $sidebarAndWrapper.filter('.active-sidebar');
				if (
					container.length &&
					!container.is(e.target) &&
					container.has(e.target).length === 0
				) {
					container.removeClass('active-sidebar').stop(true, true).animate({ left: '-100%', opacity: 0 }, animationDuration);
				}
			});
			// Ensure sidebar is hidden initially on mobile
			if ($(window).width() < 700) {
				$sidebarAndWrapper.css({ left: '-100%', opacity: 0 });
			}else{
				$sidebarAndWrapper.css({ left: '0%', opacity: 1 });

			}
		}
		//watch window resize
		$(window).on('resize', function() {
			resize()
		});
		//Resize window
		function resize() {
			if ($(window).width() < 700) {
				$('.sidebar-label').addClass('closed');
			}
		}

		/**
		 * Filter Reset Button - Reset all filters
		 */
		$(document).on('click', '.filter-reset-btn', function(e) {
			e.preventDefault();
			e.stopPropagation();

			// Reset all filters
			const sidebar = $('.sidebar-row');
			const param_box = $('.param-box');
			const ratings = $('.ratings');
			const category = $('.category-list li');
			const search = $('.sidebar-input');
			const price_range = $('.range-slider');

			// Remove active states
			category.removeClass('active');
			category.find('input[type="checkbox"]').prop('checked', false);

			// Clear search
			search.val('');

			// Reset attribute/tag selections
			param_box.find('.radio-item').removeClass('active');
			param_box.find('.color-item').removeClass('active');
			param_box.find('input[type="checkbox"]').prop('checked', false);

			// Reset ratings
			if (ratings.length > 0) {
				ratings.attr('id', '');
				const rating_label = $('.rating-label');
				rating_label.html(rating_label.data('rating_label'));
				$('.ratings li').removeClass('rating_disable active');
			}

			// Reset price range
			if (price_range.length > 0) {
				const minPrice = price_range.data('min');
				const maxPrice = price_range.data('max');
				price_range.attr('data-action', false);
				price_range.val(minPrice + ',' + maxPrice);
				if (price_range.customSetValue) {
					price_range.customSetValue(minPrice + ',' + maxPrice);
				}
				if ($('.input-min').length > 0) {
					$('.input-min').val(minPrice);
					$('.input-max').val(maxPrice);
				}
			}

			// Uncheck all checkboxes
			$('input[type=checkbox]').prop('checked', false);

			// Hide reset buttons
			sidebar.find('.reset').fadeOut();

			// Clear selected filter tags
			$('.selected-filter').html('');

			// Reload products with default settings
			get_products({ default_call: true });
		});

		/**
		 * Filter Apply Button - Trigger filtering
		 */
		$(document).on('click', '.filter-apply-btn', function(e) {
			e.preventDefault();
			e.stopPropagation();

			// Ensure price range data-action is set if price has changed from default
			const price_range = $('.range-slider');
			if (price_range.length > 0) {
				const currentPrices = price_range.val().split(',');
				const minPrice = price_range.data('min');
				const maxPrice = price_range.data('max');

				// If price has changed from default, set data-action to true
				if (currentPrices[0] != minPrice || currentPrices[1] != maxPrice) {
					price_range.attr('data-action', 'true');
				}
			}

			// Trigger product filtering with current selections
			get_products();
		});

	});
})(jQuery);

function not_masonry(params, masonry_style , template) {
    let $html = '';
	if ( masonry_style =='yes'  ) {
		if ( ( params?.filter_type !== 'product' && template == '2' ) ) {
			$html = '';
		}
		else if ( ( params?.filter_type == 'product' && template == '2' ) ) {
			$html = '<div class="grid-sizer"></div><div class="gutter-sizer"></div>'
		}
		else{			
			$html = '<div class="grid-sizer"></div><div class="gutter-sizer"></div>'
		}
	}

	return $html;
}
