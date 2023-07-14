
// console.log("modal-post javascript");

// Character Counter
$(document).ready(function () {
    // $('#postModal').hide();

    var maxLength = 140;
    var textarea = $('#content');
    textarea.on('input', function () {
        var currentLength = textarea.val().length;
        $('#character_count').text(currentLength + ' / ' + maxLength + ' characters used');
    });

    //  IMAGE PREVIEW
    $('#image').on('change', function(evt) {
        var preview = $('#preview')[0];
        var filename = $(this).val().split('\\').pop();
        preview.style.display = 'block';
        var file = this.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            $('.image_label').text('File uploaded: '+ filename);
        }else{
            preview.src = "";
            $('.image_label').text('No image selected.');
            $('#preview').hide();
        }
    });

    // $('#image').on('click', function(evt) {
    //     var preview = $('#preview')[0];
    //     preview.src = "";
    //     $('#preview').hide();
    // });
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
        $("#postForm").attr('action', "/post");
        $('#image_selection_input').show();
        $('#delete_post_modal_btn').hide();
        $('#shared_post_content').hide();
        $('#saveBtn').text('Create Post');
    });

    // Edit Button shows modal
    $('.editPost').on('click', function (e) {
        let post_id = $(this).attr('post_id');
        console.log("edit: " + post_id);
        // $.get("{{"+ route('post.show', post_id)+"}}", function(data) {
        $.get('post/' + post_id + '/edit', function (data) {
            $('#postModal').show();
            $('#post-modal-title').text('Edit Post');
            $('#modal-sub-title').text('Please make your desired changes for your post!');
            $('#postForm').show();
            $("#postForm").attr('action', "/post");
            $('#delete_post_modal_btn').hide();
            $('#shared_post_content').hide();
            console.log(data);
            $('#content').val(data.content);
            $('#post_id').val(data.id);
            if (data.post_id !=null) {
                $('#shared_post_id').val(data.post_id);
            }else{
                $('#image_selection_input').show();
            }
            if (data.image != null) {
                $("#preview").css('display', 'block');
                $('#preview').attr('src', "storage/" + data.image + "");
            }
            $('#saveBtn').text('Update Post');
        })
    });

    // Share Button shows modal
    $('.sharePost').on('click', function (e) {
        let post_id = $(this).attr('post_id');
        $.get('share/' + post_id , function (data) {
            $('#postModal').show();
            $('#post-modal-title').text('Sharing Post');
            $('#modal-sub-title').text('Tell something about this post!');
            $('#postForm').show();
            $('#shared_post_content').show();
            $('#image_selection_input').hide();
            $('#delete_post_modal_btn').hide();
            $("#postForm").attr('action', "/sharepost");
            $('#post_id').val(post_id);
            // $('#shared-user-info').text(data.user_id+">first_name 's Post");
            $('#shared-content').text(data.content);
            if(data.image != null){
                $('#shared-image').show();
                $('#shared-image').attr('src', "storage/"+data.image);
            }
            $('#saveBtn').text('Share Post'); 
        })
    });

    // Delete Button shows modal
    $('.deletePost').on('click', function (e) {
        let post_id = $(this).attr('post_id');
        console.log("delete: " + post_id);
        $('#postModal').show();
        $('#delete_post_modal_btn').show();
        $('#post-modal-title').text('Delete Post');
        $('#modal-sub-title').text('Are you sure you want to delete this post?');
        $("#deletePostBtn").attr('value', post_id);
    });

    // Close Modal
    $('.closeModal').on('click', function (e) {
        $('#postForm').trigger("reset");
        $('#character_count').text('');
        $("#preview").css('display', 'none');
        // $('#preview').trigger("reset");
        $('#shared-image').hide();
        $('#postForm').hide();
        $('#postModal').hide();
    });

    // Create post form ----- SUBMISSION of form
    $('#postForm').submit(function (e) {
        e.preventDefault();
        var form = this;
        let formData = new FormData(this);
        // Display the key/value pairs
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }
        console.log("form data: " + formData);
        $.ajax({
            url: $(form).attr('action'),
            type: $(form).attr('method'),
            data: formData,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function () {
                console.log("form data: " + formData);
                $(form).find('span.error-text').text('');
            },
            success: function (data) {
                if (data.code == 0) {
                    $.each(data.error, function (prefix, val) {
                        console.log(data);
                        $(form).find('span.' + prefix + '_error').text(val[0])
                    });
                } else {
                    $(form)[0].reset;
                    $('#postForm').trigger("reset");
                    $('#postForm').hide();
                    $('#postModal').hide();
                    alert(data.success)
                    location.reload();
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('#deletePostBtn').click(function (e) {
        e.preventDefault();
        let post_id = $(this).attr('value');
        console.log("Post_id: " + post_id);
        $.ajax({
            type: "DELETE",
            url: 'post/' + post_id,
            success: function (data) {
                $('#postForm').hide();
                console.log(data)
                $('#postModal').hide();
                alert(data.success);
                location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});