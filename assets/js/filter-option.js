
var filterOption = {
    get_category_list: function($) {
        let selected_cat = $(".category-list li.active");
        let get_cat_list = selected_cat.map(function () {
            return $(this).data('cat_id');
        }).get();

        return get_cat_list;
    }
}
