(function ($) {
	'use strict';

	$(document).ready(function () {
		/*
		* Get Product dat from filter
		*/
		//list click
		$(".category-list li").on('click', function () {
			let _this = $(this);
			$(".category-list li").removeClass("active");
			_this.addClass("active");
			let filter_param = get_tags();

			get_products({
				search_value: $(".sidebar-input").val(),
				filter_param: filter_param
			});

			// reset block
			reset_block(_this.parents(".sidebar-row"));
		});

		//search product
		$(".sidebar-input").on('keyup', function () {
			get_products({ search_value: $(this).val() });
		});

		//attribute click
		var sidebar_row = $('.sidebar-row');
		if (sidebar_row.length > 0) {
			$.each(sidebar_row, function (index, value) {
				let param_box = $(this).find(".param-box");
				param_box.on('click', '.radio-item', function () {
					let _this = $(this);
					param_box.find('.radio-item').removeClass("active");
					_this.addClass("active");
					get_products();
					// reset block
					reset_block(_this.parents(".sidebar-row"));
				});
			})
		}
		// price range
		price_range();
		function price_range() {
			let price_range = $('.range-slider');
			price_range.jRange({
				from: price_range.data("min"),
				to: price_range.data("max"),
				step: 1,
				format: '%s',
				width: 238,
				showLabels: true,
				isRange : true,
				onstatechange: function(val){
					let prices = val.split(',');
					if ( prices[1] ) {
						get_products({ search_value: "", min: prices[0], max: prices[1] });
						// reset block
						reset_block(price_range.parents(".sidebar-row"));
					}
				}
			});
		}

		//default call
		if ($(".prods-grid-view").length > 0) {
			get_products();
		}

		function get_products(params = {}) {

			var products_wrap = $(".products-wrap");
			var prod_grid_wrap = $(".prods-grid-view");
			var prod_list_wrap = $(".prods-list-view");
			var message_info = $(".message");
			var template = $(".shopContainer").data("template");
			var product_categories = $(".shopContainer").data("product_categories");
			var product_tags = $(".shopContainer").data("product_categories");
			var data =
			{
				action: 'get_filtered_data',
				template: template,
				product_categories: product_categories,
				product_tags: product_tags,
				params: selected_param(params)
			};
			var live_search = false;
			$.ajax({
				url: client_data.ajax_url,
				method: 'POST',
				data: data,
				beforeSend: function () {
					live_search = true;
					products_wrap.addClass("loader_box")
				},
				success: function (response) {
					products_wrap.removeClass("loader_box");
					if (response?.success) {
						var products = response?.data?.data?.products;
						let total = response?.data?.data?.total;
						$(".total").html("").html(total);
						$(".pages").html("").html(products.length);
						prod_grid_wrap.html("");
						prod_list_wrap.html("");
						message_info.html("");
						if (response?.data?.message !== "") {
							let message = response?.data?.message;
							message_info.html(message);
							$("ul.pagination").html("");
						} else {
							// product data
							var source_grid = $("#search_products_grid").html();
							var source_list = $("#search_products_list").html();
							for (var i = 0; i < products.length; i++) {
								var template_grid = Handlebars.compile(source_grid);
								var template_grid = template_grid(products[i])
								prod_grid_wrap.append(template_grid);
								if (source_list) {
									var template_list = Handlebars.compile(source_list);
									var template_list = template_list(products[i])
									prod_list_wrap.append(template_list);
								}
							}
							// pagination
							pagination_html(response?.data?.data?.pages, params?.offset);
							let first_page = $(".pagination li.first-page");
							let last_page = $(".pagination li.last-page");
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
					}
				},
				complete: function () {
					live_search = false;
				},
			})
		}

		/**
		 * Get data
		 * @param {*} params 
		 * @returns 
		 */
		function selected_param(params) {
			// category
			params['cat_id'] = $(".category-list .active").data('cat_id');
			params['taxonomies'] = get_tags(true);
			return params
		}

		/**
		 * Pagination
		 * @param {*} pages 
		 */
		function pagination_html(pages, offset) {
			let current_page = offset ? offset : 1;
			let pagination = $(".pagination");

			if (pages > 0) {
				pagination.html("");
				pagination.append(`<li class="first-page"> <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"/></svg> </li>`);
				for (var i = 1; i <= pages; i++) {
					let current_class = current_page == i ? ' class="current"' : '';

					pagination.append(`<li ` + current_class + `>` + i + `</li>`);
				}
				pagination.append(`<li class="last-page"> <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg> </li>`);
			}

			$(".pagination li").on('click', function () {
				let offset = $(this).text();
				get_products({
					offset: offset
				});
			})
		}
		/**
		 * Disable item
		 * @param {*} disable_terms 
		 */
		function disable_items(terms) {
			$(".param-box div").removeClass('disable')
			$.each(terms, function (key, value) {
				if (value.length > 0) {
					for (let index = 0; index < value.length; index++) {
						$('.radio-item[data-term_id=' + value[index] + ']').addClass('disable');
					}
				}
			});
		}

		/**
		 * List Grid Switcher
		*/
		var params = { list: $(".product-list"), grid: $(".product-grid") }
		list_grid_view(params);
		function list_grid_view(params) {
			$(".prods-list-view").css("display", "none");
			params.list.on('click', function () {
				$(".prods-grid-view").fadeOut();
				$(".prods-list-view").fadeIn();
			});
			params.grid.on('click', function () {
				$(".prods-grid-view").fadeIn();
				$(".prods-list-view").fadeOut();
			});
		}

		/**
		 * 
		 * @param {*} $this 
		 */
		ratings();
		function ratings() {
			$(".ratings").on("click", ".rating_block", function () {
				let $this = $(this);
				let star = $this.data("star");
				get_products({ star: star });
				// reset block
				reset_block($this.parents(".ratings"));
			})
		}

		/**
		 * reset
		 * @param {*} $this 
		 */
		function reset_block($this) {
			let reset_button = $this.find(".reset");
			reset_button.fadeIn();
			reset_button.on('click', function () {
				reset_button.fadeOut();
			})
		}

		/**
		 * Get tags
		 * @returns 
		 */
		function get_tags(selected = "") {
			let obj = {};
			let attribute = $(".param-box");
			if (attribute.length > 0) {
				attribute.each(function (i, value) {
					let single_attr = $(value).find('div');
					if (selected == "") {
						obj[single_attr.data('taxonomy')] = single_attr.map(function () {
							return $(this).data('term_id');
						}).get();
					} else {
						let active_tag = $('.active[data-taxonomy="' + single_attr.data('taxonomy') + '"]');
						if (active_tag.data("term_id")) {
							obj[single_attr.data('taxonomy')] = active_tag.data("term_id");
						}
					}

				});
			}
			return obj;
		}
	});
})(jQuery);