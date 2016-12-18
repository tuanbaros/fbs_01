var product = function() {
    this.init = function() {
        this.addEvent();
    }

    this.addEvent = function() {
        $('.nav-tabs a').click(function() {
            $(this).tab('show');
        });
        $('.block-product-category').mousemove(function(event) {
            $(this).css('z-index', '1');
        });
        $('.block-product-category').mouseout(function(event) {
            $(this).css('z-index', '0');
        });
    }
}
var product = new product();
product.init();
