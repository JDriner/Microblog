
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // Follow/Unfollow user
    $(document).on('click', '.follow_unfollow', function(e) {
        e.preventDefault();
        console.log("asdfasdfasdfasf");
        let user_to_id = $(this).attr('user_id');
        let action = $(this).attr('action');
        console.log(user_to_id);
        console.log(action);
        $.ajax({
            type: "post",
            url: action,
            data: {
                user_id: user_to_id
            },
            dataType: 'json',
            beforeSend: function() {
                console.log("asdfasdfasdfasdfa")
            },
            success: function(data) {
                if (data.code == 0) {
                    $.each(data.error, function(prefix, val) {
                        alert("error" + val[0])
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

});