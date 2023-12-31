// Character Counter
$(document).ready(function () {
    var maxLength = 140;
    var textarea = $('#content');
    textarea.on('input', function () {
        var text = $(textarea).val();
        var currentLength = textarea.val().length;
        var newLinesCount = (text.match(/\n/g) || []).length;
        currentLength += newLinesCount;
        $('#character_count').text(currentLength + ' / ' + maxLength + ' characters used');
    });

    //  IMAGE PREVIEW
    $('#image').on('change', function (e) {
        const size = (this.files[0].size / 1024 / 1024).toFixed(2);
        var selectedFile = this.files[0];
        // console.log("size" + size);
        if (size > 2) {
            $('.image_error').text('The file size should not be more than 2mb.');
            $('#preview_div').hide();
        } else if(!selectedFile.type.startsWith('image/')) {
            $('.image_error').text('Please upload images only (jpg, png, gif).');
            $('#preview_div').hide();
        }
        else {
            var preview = $('#preview')[0];
            var filename = $(this).val().split('\\').pop();
            preview.style.display = 'block';
            $('.image_error').text('');
            var file = this.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                $('.image_label').text('File uploaded: ' + filename);
                $("#preview_div").show();

            } else {
                preview.src = "";
                $('.image_label').text('No image selected.');
                $('#preview_div').hide();
            }
        }
    });
});

// Ajax Functions
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Create post Modal
    $('.createPost').on('click', function (e) {
        $('#postModal').show();
        $('#post-modal-title').text('Create Post');
        $('#modal-sub-title').text('Express your ideas, feelings, or anything you\'d like to share with others!');
        $('#postForm').show();
        $('#image_value').attr('value', 0);
        $("#preview_div").hide();
        $("#postForm").attr('action', "/post");
        $("#postForm").attr('method', "POST");
        $('#image_selection_input').show();
        $('#delete_post_modal_btn').hide();
        $('#shared_post_content').hide();
        $('#saveBtn').text('Create Post');
    });

    // Edit Button shows modal
    $('.editPost').on('click', function (e) {
        let post_id = $(this).attr('post_id');
        $('#image_value').attr('value', 0);
        $("#preview_div").hide();
        $.get('/post/' + post_id + '/edit', function (data) {
            $('#postModal').show();
            $('#post-modal-title').text('Edit Post');
            $('#modal-sub-title').text('Please make your desired changes for your post!');
            $('#postForm').show();
            $("#postForm").attr('action', "/update-post/" + data.id);
            $("#postForm").attr('method', "POST");
            $('#shared_post_content').hide();
            $('#delete_post_modal_btn').hide();
            $('#content').val(data.content);

            if (data.post_id != null) {
                // if the post beign edited is a shared post
                $('#image_selection_input').hide();
                $('#image_value').attr('value', 1);
            } else {
                // else allow file upload (for post editing)
                $('#image_selection_input').show();
            }
            if (data.image != null) {
                // if there is an image in the post being edited
                $("#preview_div").show();
                $('#preview').attr('src', "/storage/" + data.image + "");
                $('#image_value').attr('value', 1);
            }
            $('#saveBtn').text('Update Post');
        })
    });

    // Remove image
    $('.removeImageBtn').on('click', function (e) {
        $('#image_value').attr('value', 0);
        $('#image').val('');
        $('.image_label').text('Upload Image');
        $("#preview_div").hide();
    });

    $('.sharePost').on('click', function (e) {
        let post_id = $(this).attr('post_id');
        $.get('/share/' + post_id)
            .done(function (data) {
                $('#postModal').show();
                $('#post-modal-title').text('Sharing Post');
                $('#modal-sub-title').text('Tell something about this post!');
                $('#postForm').show();
                $('#shared_post_content').show();
                $('#image_selection_input').hide();
                $('#delete_post_modal_btn').hide();
                $("#postForm").attr('action', "/share-post/" + post_id);
                $("#postForm").attr('method', "POST");
                $('#shared-content').text(data.content);
                if (data.image != null) {
                    $('#shared-image').show();
                    $('#shared-image').attr('src', "/storage/" + data.image);
                }
                $('#saveBtn').text('Share Post');
            })
            .fail(function (data) {
                toastr.error("<strong>Error!</strong><br>This post is no longer available and it cannot be shared!");
            });
    });

    // Delete Button shows modal
    $('.deletePost').on('click', function (e) {
        let post_id = $(this).attr('post_id');
        // console.log("delete: " + post_id);
        $('#postModal').show();
        $('#delete_post_modal_btn').show();
        $('#delete_post_error').text('');
        $('#post-modal-title').text('Delete Post');
        $('#modal-sub-title').text('Are you sure you want to delete this post?');
        $("#deletePostBtn").attr('value', post_id);
    });

    // Close Modal
    $('.closeModal').on('click', function (e) {
        $('#postForm').trigger("reset");
        $('#character_count').text('');
        $("#preview_div").hide();
        $('.error-text').text('');
        $('.image_label').text('Upload Image');
        $('.post_submit_error').text('');
        $('#shared_post_content').hide();
        $('#shared-image').hide();
        $('#postForm').hide();
        $('#postModal').hide();
        $('#delete_post_error').text('');
    });

    // Create post form ----- SUBMISSION of form
    $('#postForm').submit(function (e) {
        e.preventDefault();
        var form = this;
        let formData = new FormData(this);
        for (let [key, value] of formData.entries()) {
            console.log(`Key: ${key}, Value: ${value}`);
            // You can replace the console.log with your desired display logic
        }
        console.log(formData)
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
                $('.post_submit_error').text('');
                $('#saveBtn').prop("disabled", true);
            },
            success: function (data) {
                $(form)[0].reset;
                $('#postForm').trigger("reset");
                $('#postForm').hide();
                $('#postModal').hide();
                toastr.success("<strong>Success!</strong><br>" + data.success);
                $('#saveBtn').prop("disabled", false);
                $('#page-content').load(currentRouteName);
            },
            error:
                function (data) {
                    $('#saveBtn').prop("disabled", false);
                    if (data.responseJSON.hasOwnProperty('errors')) {
                        $.each(data.responseJSON.errors, function (key, value) {
                            $(form).find('span.' + key + '_error').text(value)
                        });
                    } else {
                        $('.post_submit_error').text(data.responseJSON.message);
                    }
                }
        });
    });

    // Delete Post
    $('#deletePostBtn').click(function (e) {
        e.preventDefault();
        let post_id = $(this).attr('value');
        // Get the current URL then route name
        var currentUrl = window.location.href;
        var currentRouteName = currentUrl.split("/").slice(-1)[0];
        currentRouteName = String(currentRouteName);
        $.ajax({
            // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "DELETE",
            url: '/post/' + post_id,
            beforeSend: function (request) {
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                request.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                $('#deletePostBtn').prop("disabled", true);
            },
            success: function (data) {
                $('#postForm').hide();
                // console.log(data)
                $('#postModal').hide();
                toastr.success(data.success);
                $('#deletePostBtn').prop("disabled", false);
                $('#page-content').load(currentRouteName);
            },
            error: function (data) {
                $('#deletePostBtn').prop("disabled", false);
                $('#delete_post_error').text('Error!! ' + data.responseJSON.message);
            }
        });
    });
});