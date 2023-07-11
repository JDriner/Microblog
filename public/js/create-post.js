$(document).ready(function() {
    $('.createPost').on('click', function(e) {
        $('#createPostModal').removeClass('invisible');
    });
    $('.closeModal').on('click', function(e) {
        $('#createPostForm').trigger("reset");
        $("#preview").css('display', 'none');
        // $('#preview').trigger("reset");
        $('#createPostModal').addClass('invisible');
    });
});


// Character Counter
$(document).ready(function() {
  var maxLength = 140;
  var textarea = $('#content');

  textarea.on('input', function() {
    var currentLength = textarea.val().length;
    console.log(currentLength);
    $('#character_count').text(currentLength + ' / ' + maxLength + ' characters used');
  });
  
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

$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Create post form
    $('#createPostForm').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        $('#saveBtn').html('Submitting post...');
        // let myUsername = document.getElementById('image').value;
        // console.log(myUsername);

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend:function(){
                $(form).find('span.error-text').text('')
                $('#saveBtn').html('Create Post');
            },
            success: function(data) {
                if(data.code == 0) {
                    $.each(data.error, function(prefix,val){
                        $(form).find('span.'+prefix+'_error').text(val[0])
                    });
                }else{
                    $(form)[0].reset;
                    $('#createPostForm').trigger("reset");
                    $('#createPostModal').addClass('invisible');
                    alert("Post has been created successfully!")
                    location.reload();
                }
            },
            error: function(data) {
                console.log('Error:', data);
                $('#saveBtn').html('Create Post');
            }
        });
    });
});