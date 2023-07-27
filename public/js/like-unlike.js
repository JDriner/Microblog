// Character Counter
$(document).ready(function () {
    let maxLength = 140;
    let commentText = $('#comment');
    commentText.on('input', function () {
        let currentLength = commentText.val().length;
        // console.log(currentLength);
        $('#comment_character_count').text(currentLength + ' / ' + maxLength + ' characters used');
    });
});

// AJAX Functions - like and unlike
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Like post
    $('.like_unlike_btn').click(function (e) {
        e.preventDefault();
        let postId = $(this).attr('post_id');
        let action = $(this).attr('action');

        console.log(action + "===" + postId);
        // Get the current URL then route name
        var currentUrl = window.location.href;
        var currentRouteName = currentUrl.split("/").slice(-1)[0];
        currentRouteName = String(currentRouteName);

        $.ajax({
            type: "post",
            url: action,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                post_id: postId
            },
            dataType: 'json',
            beforeSend: function () {
                console.log("like")
            },
            success: function (data) {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "showDuration": "600",
                    }
                    toastr.success(data.success);
                    $('#page-content').children().off();
                    $('#page-content').load(currentRouteName);
                    $('#page-content').children().on();
            },
            error: function (data) {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "showDuration": "600",
                }
                toastr.error("<strong>Something went wrong!</strong><br> Please try again.");
            }
        });

    });
});