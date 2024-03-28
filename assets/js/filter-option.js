
var filterOption = {
    get_category_list: function($) {
        let selected_cat = $(".category-list li.active");
        let get_cat_list = selected_cat.map(function () {
            return $(this).data('cat_id');
        }).get();

        return get_cat_list;
    },
    category_formatted_text: function($) {
        let selected_cat = $(".category-list li.active");
        let get_cat_list = selected_cat.map(function () {
            return filter_client.seo_slug_url == 'yes' ? $(this).data('slug') : $.trim($(this).text());
        }).get();

        return get_cat_list.join(",");
    },
    get_taxonomies_data:function ($,selected_data,format) {
        let $urlPart = '';
        let urlKey 	 = format.data;
        for (const [key, value] of Object.entries(selected_data)) {
            if ( $.inArray(key,urlKey) !== -1 && 
            typeof value !== "undefined" && value !== '' && value !== false ) {
                if ( key == 'price_range' && value == true ) {
                    $urlPart += `${'price'}=[${selected_data['min']}-${selected_data['max']}]`;
                }
                else if( key == 'taxonomies_name' ){
                    let sign = ' ';
                    if ( format.seo_data == true ) {
                        sign = filterOption.seo_format();;
                    }else{
                        sign = '=';
                    }

                    for (const [index, item] of Object.entries(value)) {
                        if (sign == ':') {
                            $urlPart += `[${index}]${sign}[${item}]`;

                        } else {
                            $urlPart += `[${index}${sign}${item}]`;
                        }
                    }
                }
                else{
                    let key_name = key == 'product_cat' ? 'categories' : key;
                    $urlPart += `${key_name}=[${value}]`;
                }
            }
        }

        return $urlPart;
    },
    seo_format:function(){
        let format = '[]';
        switch ( filter_client.seo_elements_format ) {
            case '1':
                format = '[]';
                break;
            case '2':
                format = '/';
                break;
            case '3' || '4':
                format = ':';
                break;
            default:
                format = '[]';
                break;

        }

        return format;
    },
    seo_data:function($,selected_data,page_title){
        let line    = '';
        let urlKey 	= ['taxonomies_name'];
        let format  = {data:urlKey,sign:'[]',seo_data:true};
        let data    = filterOption.get_taxonomies_data($,selected_data,format);
        let part1   = data !== '' ? `${' '}${filter_client.and}${' '}${data}` : '';
        switch (filter_client.seo_elements_format) {
            case '1':
                line        = `${page_title} ${' '} ${filter_client.with} ${' '} ${selected_data.product_cat }${part1}`;
                break;
            case '2':
                line        = `${page_title} ${' - '} ${selected_data.product_cat }${part1}`;
                break;
            case '3':
                line        = `${selected_data.product_cat }${part1}${' - '}${page_title}`;
                break;
            case '4':
                line        = `${page_title}${' - '}${selected_data.product_cat }${part1}`;
                break;
            default:
                line        = `${page_title} ${' '} ${filter_client.with} ${' '} ${selected_data.product_cat }${part1}`;
                break;
        }
        return line;
    }
}


