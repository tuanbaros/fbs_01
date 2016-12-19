var shop = function() {

    this.data = {
        avatar: null,
    }

    this.init = function(data) {
        this.data.avatar = data.avatar;
        this.addEvent();
    }

    this.addEvent = function() {
        var current = this;
        $('.block-info-detail-shop .avatar-shop').css('background-image', 'url(' + current.data.avatar + ')');
        $('.nav-tabs a').on('click', function() {
            $(this).tab('show');
        });
        $('.block-product-category').hover(
            function() {
                $(this).css('z-index', 1);
            }, function() {
                $(this).css('z-index', 0);
            }
        );
        $('#list-product').easyPaginate({
            paginateElement: 'div.block-product-category-all',
            elementsPerPage: 24,
            effect: 'climb'
        });
    }
}
