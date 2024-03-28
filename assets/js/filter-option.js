
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

    get_taxonomies_data:function ($,selected_data) {
        let $urlPart = '';
        let urlKey 	 = ['product_cat','rating','price_range','stock','author','on_sale','taxonomies_name'];
        for (const [key, value] of Object.entries(selected_data)) {
            if ($.inArray(key,urlKey) !== -1 && 
            typeof value !== "undefined" && value !== '' && value !== false ) {
                if ( key == 'price_range' && value == true ) {
                    $urlPart += `${'price'}=[${selected_data['min']}-${selected_data['max']}]`;
                }
                else if( key == 'taxonomies_name' ){
                    for (const [index, item] of Object.entries(value)) {
                        $urlPart += `${index}=${item}`;
                    }
                }
                else{
                    $urlPart += `${key}=[${value}]`;
                }
            }
        }

        return $urlPart;
    }
}
