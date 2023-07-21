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

        console.log(action+ "===" + postId);
        // Get the current URL then route name
        var currentUrl = window.location.href;
        var currentRouteName = currentUrl.split("/").slice(-1)[0];
        currentRouteName = String(currentRouteName);

        $.ajax({
            type: "post",
            url: action,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                post_id: postId
            },
            dataType: 'json',
            beforeSend: function () {
                console.log("like")
            },
            success: function (data) {
                if (data.code == 0) {
                    $.each(data.error, function (prefix, val) {
                        // $(form).find('span.'+prefix+'_error').text(val[0])
                        // alert("error" + val[0])
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-top-center",
                            "showDuration": "600",
                        }
                        toastr.error("error" + val[0]);
                    });
                } else {
                    console.log('Success:', data);
                    $('#page-content').load(currentRouteName);
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    });
});