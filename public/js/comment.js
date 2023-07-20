// // Show Add comment box
// $(".addComment").click(function () {
//     var postId = $(this).attr('post_id');
//     // console.log(postId);
//     $("#commentBox_" + postId).toggle(500);
// });

$(document).ready(function () {
    var maxLength = 140;
    var textarea = $('#comment');
    textarea.on('input', function () {
        var currentLength = textarea.val().length;
        $('#comment_character_count').text(currentLength + ' / ' + maxLength + ' characters used');
    });


    $('.addComment').on('click', function () {
        let post_id = $(this).attr('post_id');
        let user = $(this).attr('user_name');
        $.get('share/' + post_id, function (data) {
            $('#commentModal').show();
            $('#comment-modal-title').text('Add Comment');
            $('#comment-sub-title').text('Share your thoughts about this post!');
            $('#comment_post_content').show();
            $("#commentForm").attr('action', "/sendComment");
            $('#comment_post_id').val(post_id);
            $('#comment-user-info').text(user+"'s Post");
            $('#comment-content').text(data.content);
            if (data.image != null) {
                $('#comment-image').show();
                $('#comment-image').attr('src', "storage/" + data.image);
            }
            $('#saveBtn').text('Share Post');
        })
    });


    // Close Modal
    $('.closeModalComment').on('click', function (e) {
        $('#commentForm').trigger("reset");
        $('#comment_character_count').text('');
        $('#comment-image').hide();
        $('#commentModal').hide();
    });
});

// create comment - submit form
$('#commentForm').submit(function (e) {
    console.log("submitted Form");
    e.preventDefault();
    var form = this;
    let formData = new FormData(this);
    // for (var pair of formData.entries()) {
    //     console.log(pair[0] + ', ' + pair[1]);
    // }
    $.ajax({
        url: '/sendComment',
        type: 'POST',
        data: formData,
        cache: false,
        dataType: 'json',
        processData: false,
        contentType: false,
        beforeSend: function () {
            $(form).find('span.error-text').text('');
        },
        success: function (data) {
            $(form)[0].reset;
            $('#commentForm').trigger("reset");
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "showDuration": "300",
            }
            toastr.success(data.success);
            setTimeout(function () {// wait for 5 secs(2)
                location.reload(); // then reload the page.(3)
            }, 3000);
        },
        error: function (xhr) {
            $.each(xhr.responseJSON.errors, function (key, value) {
                $(form).find('span.' + key + '_error').text(value)
            });
        }
    });
});
