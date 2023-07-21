
// Add Comment JS
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var maxLength = 140;
    var textarea = $('#comment');
    textarea.on('input', function () {
        var currentLength = textarea.val().length;
        $('#comment_character_count').text(currentLength + ' / ' + maxLength + ' characters used');
    });


    $('.addComment').on('click', function () {
        console.log("Add comment!");
        let post_id = $(this).attr('post_id');
        let user = $(this).attr('user_name');
        $.get('/share/' + post_id, function (data) {
            $('#commentModal').show();
            $('#comment-modal-title').text('Add Comment');
            $('#comment-sub-title').text('Share your thoughts about this post!');
            $('#comment_post_content').show();
            $("#commentForm").attr('action', "/sendComment");
            $('#comment_post_id').val(post_id);
            $('#comment-user-info').text(user + "'s Post");
            $('#comment-content').text(data.content);
            if (data.image != null) {
                $('#comment-image').show();
                $('#comment-image').attr('src', "/storage/" + data.image);
            }
            $('#saveCommentBtn').text('Submit Comment!');
        })
    });


    // Close Modal
    $('.closeModalComment').on('click', function (e) {
        $('#commentForm').trigger("reset");
        $('#comment_character_count').text('');
        $('.error-text').text('');
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
    // Get the current URL then route name
    var currentUrl = window.location.href;
    var currentRouteName = currentUrl.split("/").slice(-1)[0];
    currentRouteName = String(currentRouteName);

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
            $('#comment_character_count').text('');
            $('#comment-image').hide();
            $('#commentModal').hide();
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "showDuration": "300",
            }
            toastr.success(data.success);
            // $('#page-content').click(false);
            $('#page-content').load(currentRouteName);
            // $('#page-content').click(true);
        },
        error: function (xhr) {
            $.each(xhr.responseJSON.errors, function (key, value) {
                $(form).find('span.' + key + '_error').text(value)
            });
        }
    });
});
