var filterOption = {
	get_category_list($) {
		const selected_cat = $('.category-list li.active');
		const get_cat_list = selected_cat
			.map(function () {
				return $(this).data('cat_id');
			})
			.get();
		return get_cat_list;
	},
	category_formatted_text($) {
		const selected_cat = $('.category-list li.active');
		const get_cat_list = selected_cat
			.map(function () {
				return filter_client.seo_slug_url == 'yes'
					? $(this).data('slug')
					: $.trim($(this).data('name'));
			})
			.get();
		return get_cat_list.join(',');
	},
	get_taxonomies_data($, selected_data, format) {
		let $urlPart = '';
		const urlKey = format.data;
		for (const [key, value] of Object.entries(selected_data)) {
			if (
				$.inArray(key, urlKey) !== -1 &&
				typeof value !== 'undefined' &&
				value !== '' &&
				value !== false
			) {
				if (key == 'price_range' && value == true) {
					$urlPart += `${'price'}=[${selected_data.min}-${selected_data.max}]`;
				} else if (key == 'taxonomies_name') {
					let sign = ' ';
					if (format.seo_data == true) {
						sign = filterOption.seo_format();
					} else {
						sign = '=';
					}

					for (const [index, item] of Object.entries(value)) {
						if (sign == ':') {
							$urlPart += `[${index}]${sign}[${item}]`;
						} else {
							$urlPart += `[${index}${sign}${item}]`;
						}
					}
				} else {
					const key_name = key == 'product_cat' ? 'categories' : key;
					$urlPart += `${key_name}=[${value}]`;
				}
			}
		}

		return $urlPart;
	},
	seo_format() {
		let format = ' ';
		switch (filter_client.seo_elements_format) {
			case '1':
				format = ' ';
				break;
			case '2':
				format = '/';
				break;
			case '3':
				format = ':';
				break;
			case '4':
				format = ':';
				break;
			default:
				format = ' ';
				break;
		}

		return format;
	},
	seo_data($, selected_data, page_title) {
		let line = '';
		const urlKey = ['taxonomies_name'];
		const format = { data: urlKey, sign: '[]', seo_data: true };
		const data = filterOption.get_taxonomies_data($, selected_data, format);
		const part1 =
			data !== '' ? `${' '}${filter_client.and}${' '}${data}` : '';
		switch (filter_client.seo_elements_format) {
			case '1':
				line = `${page_title} ${' '} ${filter_client.with} ${' '} ${selected_data.product_cat}${part1}`;
				break;
			case '2':
				line = `${page_title} ${' - '} ${selected_data.product_cat}${part1}`;
				break;
			case '3':
				line = `${selected_data.product_cat}${part1}${' - '}${page_title}`;
				break;
			case '4':
				line = `${page_title}${' - '}${selected_data.product_cat}${part1}`;
				break;
			default:
				line = `${page_title} ${' '} ${filter_client.with} ${' '} ${selected_data.product_cat}${part1}`;
				break;
		}
		return line;
	},
	filterSearch($){
		let $not_in = ['Search here','Search'];
		let $search_value = $('.sidebar-input').val();

		return $.inArray( $search_value , $not_in ) !== -1 ? '' : $search_value;
	},
	customFieldValue($,params){
		let custom_field = $(".custom-field input[name='custom-field']:checked");
		let get_cf_list  =[];
		let input_data   =[];
		let get_cf_list_select  =[];

		if (custom_field.length>0) {
			input_data = custom_field
			.map(function () {
				let $this = $(this);
				return {
					custom_field_key:$this.data('meta_key'),custom_field_value:$this.val(),
					meta_condition: $this.data('meta_condition')
				};
			}).get();

		}

		if ($("select[name='custom-field']").length > 0 ) {
			custom_field_select = $("select[name='custom-field']");
			get_cf_list_select 		= custom_field_select
			.map(function () {
				let $this = $(this);
				return {
					custom_field_key:$this.data('meta_key'),custom_field_value:$this.val(),
					meta_condition: $this.data('meta_condition')
				};
			}).get();
		}
		get_cf_list = $.merge(input_data,get_cf_list_select);
		params.cf_list = get_cf_list; 

		return params;
	}
};
