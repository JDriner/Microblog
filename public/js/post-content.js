 // Character Counter
 $(document).ready(function() {
    var maxLength = 140;
    var textarea = $('#comment');
    textarea.on('input', function() {
        var currentLength = textarea.val().length;
        console.log(currentLength);
        $('#comment_character_count').text(currentLength + ' / ' + maxLength + ' characters used');
    });
});

// AJAX Functions
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Like post
    $(document).on('click', '.like_unlike_btn', function(e) {
        var postId = $(this).attr('post_id');
        var action = $(this).attr('action');
        e.preventDefault();
        console.log("liked" + postId);

        $.ajax({
            type: "post",
            url: action,
            data: {
                post_id: postId
            },
            dataType: 'json',
            beforeSend: function() {
                console.log("like")
            },
            success: function(data) {
                if (data.code == 0) {
                    $.each(data.error, function(prefix, val) {
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
                    location.reload();
                }
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });

    });

    // Show Add comment box
    $(".addComment").click(function() {
        var postId = $(this).attr('post_id');
        // console.log(postId);
        $("#commentBox_" + postId).toggle(500);
    });
});