var shopCollection = function() {

    this.data = {
        imageUrl: null,
        idItemCollection: null,
    }

    this.init = function(data) {
        this.data.imageUrl = data.imageUrl;
        this.data.idItemCollection = data.idItemCollection;
        this.addEvent();
    }

    this.addEvent = function() {
        var current = this;
        $('#item-collection-' + current.data.idItemCollection).css('color', 'red');
        $('.nav-tabs a').on('click', function() {
            $(this).tab('show');
        });
        $('.block-left-info-shop .image-background').css('background-image', 'url(' + current.data.imageUrl + ')');
        $('.block-product-category').hover(
            function() {
                $(this).css('z-index', 1);
            }, function() {
                $(this).css('z-index', 0);
            }
        );
        $('.list-collection a div.item-collection').hover(
            function() {
                $(this).css('background', 'rgb(224, 224, 224)');
            }, function() {
                $(this).css('background', '#fff');
            }
        );
    }
}
