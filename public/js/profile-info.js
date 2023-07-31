$(document).ready(function () {
    $('.changePicModal').on('click', function (e) {
        // $('#changePictureForm').trigger("reset");
        $('#changePicModal').removeClass('invisible');
    });
    $('.closeModal').on('click', function (e) {
        $('#changePictureForm').trigger("reset");
        $('#changePicModal').addClass('invisible');
        $('.dp_label').text('Select Image');
        $('#preview-dp-div').hide();

    });
});

//  IMAGE Validation and preview
$('#profile_picture').on('change', function (e) {
    const size = (this.files[0].size / 1024 / 1024).toFixed(2);
    // console.log(size);
    if (size > 2) {
        $('.profile_picture_error').text('File must be less than 2mb');
    } else {
        let preview = $('#image_preview')[0];
        let filename = $(this).val().split('\\').pop();
        preview.style.display = 'block';
        let file = this.files[0];
        $('.profile_picture_error').text('');
        if (file) {
            $('#preview-dp-div').show();
            preview.src = URL.createObjectURL(file);
            $('.dp_label').text('File has been selected! Click here to change.');
        } else {
            preview.src = "";
            $('.dp_label').text('No image selected.');
            $('#preview-dp-div').hide();
        }
    }
});

// Submit the picture form
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Change Picture form
    $('#changePictureForm').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        // console.log("picture submit");
        let file_name = document.getElementById('profile_picture').value;
        // console.log(file_name);
        // Get the current URL then route name
        var currentUrl = window.location.href;
        var currentRouteName = currentUrl.split("/").slice(-1)[0];
        currentRouteName = String(currentRouteName);

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(form).find('span.error-text').text('')
            },
            success: function (data) {
                if (data.code == 0) {
                    $.each(data.error, function (prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0])
                    });
                } else {
                    $(form)[0].reset;
                    $('#changePictureForm').trigger("reset");
                    $('#changePicModal').addClass('invisible');
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-center",
                        "showDuration": "600",
                    }
                    toastr.success("Profile Picture has been updated.");
                    $('#page-content').load(currentRouteName);
                }
            },
            error: function (xhr) {
                console.log('XHR:', xhr);
                $.each(xhr.responseJSON.errors, function (key, value) {
                    $(form).find('span.' + key + '_error').text(value)
                });
            }
        });
    });
});