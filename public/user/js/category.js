var category = function() {

    this.data = {
        parent_id: null,
        category_id: null,
    }

    this.init = function(data) {
        var current = this;
        this.data.parent_id = data.parent_id;
        this.data.category_id = data.category_id;
        $('.metismenu').metisMenu();
        $('.block-product-category').mouseover(function(event) {
            $(this).css('z-index', '1 !important');
        });
        $('.block-product-category').mouseout(function(event) {
            $(this).css('z-index', '0 !important');
        });
        $('#list-product').easyPaginate({
            paginateElement: 'div.block-product-category',
            elementsPerPage: 32,
            effect: 'climb'
        });

        if (current.data.parent_id == null) {
            var category_current = "#category_" + current.data.category_id;
            $(category_current).css('color', 'red');
            $(category_current).parent().addClass('active');
            $(category_current).next().attr('aria-expanded', 'true').addClass('in');
        } else {
            var root_category = "#category_" + current.data.parent_id;
            var category_current = "#sub_category_" + current.data.category_id;
            $(category_current).css('color', 'red');
            $(root_category).css('color', 'red');
            $(root_category).parent().addClass('active');
            $(root_category).next().attr('aria-expanded', 'true').addClass('in');
        }
    }
}
