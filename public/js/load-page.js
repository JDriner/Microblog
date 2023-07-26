$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var page = 1;
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            loadMoreData(page);
        }
    });

    function loadMoreData(page) {
        $.ajax({
            url: '?page=' + page,
            type: "get",
            beforeSend: function () {
                $('.show-next-posts').show();
            }
        })
            .done(function (data) {
                if (data.html == "") {
                    $('.loading-posts').hide();
                    $('.no-posts').show();
                    return;
                }
                $('.show-next-posts').hide();
                $("#post-data").append(data.html);
            })
    }
});