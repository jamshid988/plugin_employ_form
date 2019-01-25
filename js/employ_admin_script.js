jQuery(document).ready(function($) {








    $('.employ_user_delete').on('click', function () {
        if (!confirm("برای پاک کردن این متقاضی اطمینان دارید ؟ ")) {
            return false;
        }
        var el = $(this);


        eid = el.data('id');

        var loader = $('#wp_employ_loader');
        loader.fadeIn(300);

        $.ajax({
            url: wpemploy.ajaxurl,
            type: 'post',
            dataType: 'json',
            data: {
                action: 'employ_user_delete',
                eid: eid
            },
            success: function (response) {
                loader.fadeOut(300);

                if (response.result == 1) {
                    el.closest('tr').remove();
                }

                alert(response.text);

            },
            error: function () {

                alert('خطا در ایجکس');
            }
        });
        return false;
    });
    //end function





    $('.emoloy_user_selected').on('change', function () {
        if (!confirm("برای  تغییر وضعیت  اطمینان دارید ؟ ")) {
            return false;
        }
        var el = $(this);


        eid = el.data('id');

        var loader = $('#wp_employ_loader');
        loader.fadeIn(300);

        $.ajax({
            url: wpemploy.ajaxurl,
            type: 'post',
            dataType: 'json',
            data: {
                action: 'emoloy_user_selected',
                eid: eid
            },
            success: function (response) {
                loader.fadeOut(300);


                alert(response.text);

            },
            error: function () {

                alert('خطا در ایجکس');
            }
        });
        return false;
    });

});
//end function