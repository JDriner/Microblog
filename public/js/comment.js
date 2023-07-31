
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
        let post_id = $(this).attr('post_id');
        let user = $(this).attr('user_name');
        $.get('/share/' + post_id, function (data) {
            $('#commentModal').show();
            $('#comment-modal-title').text('Add Comment');
            $('#comment-sub-title').text('Share your thoughts about this post!');
            $('#commentForm').show();
            $('#comment_post_content').show();
            $('#delete_comment_modal_btn').hide();
            $("#commentForm").attr('action', "/send-comment/"+post_id);
            $("#commentForm").attr('method', "POST");
            $('#comment-user-info').text(user + "'s Post");
            $('#comment-content').text(data.content);
            if (data.image != null) {
                $('#comment-image').show();
                $('#comment-image').attr('src', "/storage/" + data.image);
            }
            $('#saveCommentBtn').text('Submit Comment!');
        })
    });

    $('.editComment').on('click', function () {
        let comment_id = $(this).attr('comment_id');
        let user = $(this).attr('user_name');
        $.get('/view-comment/' + comment_id, function (data) {
            $('#commentModal').show();
            $('#commentForm').show();
            $('#comment_post_content').hide();
            $('#delete_comment_modal_btn').hide();
            $('#comment-modal-title').text('Edit Comment');
            $('#comment-sub-title').text('Make the necessary revisions for your comment!');
            $("#commentForm").attr('action', "/edit-comment/" + comment_id);
            $("#commentForm").attr('method', "POST");
            $('#comment_id').val(data.id);
            $('#comment').text(data.comment);
            $('#saveCommentBtn').text('Update Comment!');
        })
    });

    $('.deleteComment').on('click', function () {
        let comment_id = $(this).attr('comment_id');
        $('#commentModal').show();
        $('#delete_comment_modal_btn').show();
        $('#comment_post_content').hide();
        $('#commentForm').hide();
        $('#comment-modal-title').text('Delete Comment');
        $('#comment-sub-title').text('Are you sure you want to delete this comment?');
        $("#deleteCommentBtn").attr('value', comment_id);
    });

    // Close Modal
    $('.closeModalComment').on('click', function (e) {
        $('#commentForm').trigger("reset");
        $('#comment_character_count').text('');
        $('.error-text').text('');
        $('#comment-image').hide();
        $('#commentModal').hide();
        $('#comment').text("");
        $('#edit_comment_error').text('');
        $('#delete_comment_error').text('');
    });

    // create comment - submit form
    $('#commentForm').submit(function (e) {
        // console.log("submitted Form");
        e.preventDefault();
        var form = this;
        let formData = new FormData(this);
        // Get the current URL then route name
        var currentUrl = window.location.href;
        var currentRouteName = currentUrl.split("/").slice(-1)[0];
        currentRouteName = String(currentRouteName);

        $.ajax({
            // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: $(form).attr('action'),
            type: $(form).attr('method'),
            data: formData,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function (request) {
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                request.setRequestHeader('X-CSRF-TOKEN', csrfToken);

                $(form).find('span.error-text').text('');
                $('#edit_comment_error').text('');
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
                $('#edit_comment_error').text('Something went wrong upon editing this comment!');
            }
        });
    });

    // Delete Commment
    $('#deleteCommentBtn').click(function (e) {
        e.preventDefault();
        let comment_id = $(this).attr('value');
        // Get the current URL then route name
        var currentUrl = window.location.href;
        var currentRouteName = currentUrl.split("/").slice(-1)[0];
        currentRouteName = String(currentRouteName);
        $.ajax({
            // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "DELETE",
            url: '/comment/' + comment_id,
            beforeSend: function (request) {
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                request.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            },
            success: function (data) {
                $('#commentForm').hide();
                // console.log(data)
                $('#commentModal').hide();
                // alert(data.success);
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-center",
                    "showDuration": "600",
                }
                toastr.success(data.success);
                $('#page-content').load(currentRouteName);
            },
            error: function (data) {
                  $('#delete_comment_error').text('Something went wrong upon deleting this comment!');
                // console.log('Error:', data);
            }
        });
    });
});
