var product = function() {
    this.dataRate = {
        product_id: null,
        user_id: null,
        number: null,
        content: null,
        user_name: null,
        url_avatar: null,
    }

    this.init = function(data) {
        this.dataRate.product_id = data.idProduct;
        this.dataRate.user_id = data.idUser;
        this.dataRate.user_name = data.user_name,
        this.dataRate.url_avatar = data.url_avatar,
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        this.addEvent();
    }

    this.addEvent = function() {
        var current = this;
        $('.nav-tabs a').click(function() {
            $(this).tab('show');
        });
        $('.block-product-category').hover(
            function() {
                $(this).css('z-index', 1);
            }, function() {
                $(this).css('z-index', 0);
            }
        );
        $('#input-rate').on('rating.change', function(event, value) {
            current.dataRate.number = value;
            console.log(current.dataRate.number);
        });
        $('.button.btn-rate').on('click', function(event) {
            current.dataRate.content = $('#content-comment').val();
            $('#rate-comment .rating span.filled-stars').css('width', '0');
            $('#content-comment').val('');
            if (!current.dataRate.user_id) {
                alert(lang['cart']['unauthenticated']);
                return;
            }
            if (current.dataRate.content != '') {
                current.rate(current.dataRate);
            } else {
                alert(lang['rate']['not-fill']);
            }
        });
        $('#list-rating').easyPaginate({
            paginateElement: 'div.block-rate',
            elementsPerPage: 10,
            effect: 'climb'
        });
    }

    this.rate = function(data) {
        var current = this;
        $.ajax({
            url: '/products/' + data.product_id + '/rate',
            type: 'POST',
            data: {
                number: data.number,
                content: data.content,
            },
        })
        .done(function(data) {
            if (data === 'rated') {
                alert(lang['rate']['rated']);
                return;
            }
            if (data === 'not-product') {
                alert(lang['rate']['not-found-product']);
                return;
            }
            if (data != null && data != 'error') {
                $('.rate#rate-product-detail .rating .filled-stars').css('width', data.point_rate * 20 + '%');
                $('#list-rating').prepend(
                    '<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 block-rate">'
                    + '<div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 avatar">'
                    + '<img src="' + current.dataRate.url_avatar + '" width="50" height="50"></div>'
                    + '<div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 row block-content">'
                    + '<a href="javascript:void(0)" class="user-name">'
                    + '<span>' + current.dataRate.user_name + '</span>'
                    + '</a>'
                    + '<div class="number-rate">'
                    + '<div class="rating-container rating-md rating-animate rating-disabled">'
                    + '<div class="clear-rating " title="Clear">'
                    + '<i class="glyphicon glyphicon-minus-sign"></i>'
                    + '</div>'
                    + '<div class="rating">'
                    + '<span class="empty-stars">'
                    + '<span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>'
                    + '<span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>'
                    + '<span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>'
                    + '<span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>'
                    + '<span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>'
                    + '</span>'
                    + '<span class="filled-stars" style="width: ' + current.dataRate.number * 20 + '%;">'
                    + '<span class="star"><i class="glyphicon glyphicon-star"></i></span>'
                    + '<span class="star"><i class="glyphicon glyphicon-star"></i></span>'
                    + '<span class="star"><i class="glyphicon glyphicon-star"></i></span>'
                    + '<span class="star"><i class="glyphicon glyphicon-star"></i></span>'
                    + '<span class="star"><i class="glyphicon glyphicon-star"></i></span>'
                    + '</span></div>'
                    + '<div class="caption">'
                    + '<span class="label label-warning">Two Stars</span>'
                    + '</div>'
                    + '<input id="input-1" name="input-1" class="rating hide" value="' + current.dataRate.number + '" readonly="readonly">'
                    + '</div>'
                    + '</div>'
                    + '<div class="content-rate">' + current.dataRate.content + '</div>'
                    + '<div class="date-rate">'
                    + '<span>' + new Date() + '</span>'
                    + '</div></div></div>'
                );
                $('#count-rate').html(parseInt($('#count-rate').html()) + 1);
            }
        });
    }
}
