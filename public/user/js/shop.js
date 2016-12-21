var shop = function() {
    this.data = {
        avatar: null,
        userId: null,
        shopId: null,

    }

    this.init = function(data) {
        this.data.avatar = data.avatar;
        this.data.userId = data.idUser;
        this.data.shopId = data.idShop;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
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
        if ($('#btn-follow').data('follow') > 0) {
            $('#btn-follow').css({'border-color': 'red', 'color': 'red'});
        }
        $('#list-product').easyPaginate({
            paginateElement: 'div.block-product-category-all',
            elementsPerPage: 24,
            effect: 'climb'
        });
        $('#btn-follow').on('click', function(event) {
            if (!current.data.userId) {
                alert(lang['cart']['unauthenticated']);

                return;
            }
            follow.changeFollow({
                shopId: current.data.shopId
            }, current.changeSinceFollow, current.error);
        });
    }

    this.changeSinceFollow = function() {
        if ($('#btn-follow').data('follow') == 0) {
            $('#btn-follow').data('follow', 1)
                .html(lang['shop']['follow-full'])
                .css({'border-color': 'red', 'color': 'red'});
            $('#number-follow').html(parseInt($('#number-follow').html()) + 1);
        } else {
            $('#btn-follow').data('follow', 0)
                .html(lang['shop']['not-follow'])
                .css({'border-color': '#fff', 'color': '#fff'});
            $('#number-follow').html(parseInt($('#number-follow').html()) - 1);
        }
    }

    this.error = function() {
        alert(lang['cart']['error']);
    }
}
