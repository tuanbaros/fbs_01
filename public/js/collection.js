var collection = function() {

    this.init = function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        this.update();
        this.remove();
    }

    this.update = function() {
        var dataId;
        $('.update').on('click', function() {
            dataId = $(this).data('id');
            $('#nameCollection').val($(this).parent().prev().html());
        });

        $('.edit-collection').on('click', '.btn-primary', function() {
            $.ajax({
                type: 'POST',
                url: '/user/collection/updateAjax',
                data: {
                    id: dataId,
                    name: $('#nameCollection').val()
                },
                async: false,
                dataType: 'json',
                success: function (data) {
                    $('#collection-' + dataId).html($('#nameCollection').val());
                    $('.modal').modal('hide');
                }
            });
        });
    }

    this.remove = function() {
        var dataId;
        $('.delete').on('click', function () {
            dataId = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: '/user/collection/deleteAjax',
                data: { 
                    id: dataId 
                },
                async: false,
                dataType: 'json',
                success: function (data) {
                    alert(data.sms);
                }
            });
            $(this).parent().parent().remove();
        });
    }
}
