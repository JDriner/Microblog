
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
    image.onchange = evt => {
        preview = document.getElementById('preview');
        preview.style.display = 'block';
        const [file] = image.files
        if (file) {
            preview.src = URL.createObjectURL(file)
        }
    }
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
        $('#modal-title').text('Create Post');
        $('#modal-sub-title').text('Express your ideas, feelings, or anything you\'d like to share with others!');
        $('#postForm').show();
        $('#saveBtn').text('Create Post');
    });

    // Edit Button shows modal
    $('.editPost').on('click', function (e) {
        let post_id = $(this).attr('post_id');
        console.log("edit: " + post_id);
        $.get('blogpost/' + post_id + '/edit', function (data) {
            $('#postModal').show();
            $('#modal-title').text('Edit Post');
            $('#modal-sub-title').text('Please make your desired changes for your post!');
            $('#postForm').show();
            console.log(data);
            $('#content').val(data.content);
            $('#post_id').val(data.id);
            if (data.image != null) {
                $("#preview").css('display', 'block');
                $('#preview').attr('src', "storage/" + data.image + "");
            }
            $('#saveBtn').text('Update Post');
        })
    });

    // Delete Button shows modal
    $('.deletePost').on('click', function (e) {
        let post_id = $(this).attr('post_id');
        console.log("delete: " + post_id);
        $('#postModal').show();
        $('#modal-title').text('Delete Post');
        $('#modal-sub-title').text('Are you sure you want to delete this post?');
    });
    // Close Modal
    $('.closeModal').on('click', function (e) {
        $('#postForm').trigger("reset");
        $('#character_count').text('');
        $("#preview").css('display', 'none');
        // $('#preview').trigger("reset");
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
            console.log(pair[0]+ ', ' + pair[1]); 
        }
        console.log("form data: "+ formData);
        $.ajax({
            url: $(form).attr('action'),
            type: $(form).attr('method'),
            data: formData,
            cache:false,
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function () {
                console.log("form data: "+ formData);
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
                    $('#createPostModal').addClass('invisible');
                    alert("Post has been created successfully!")
                    location.reload();
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});