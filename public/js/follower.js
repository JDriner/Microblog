
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Follow/Unfollow user
    $('.follow_unfollow').on('click', function (e) {
        e.preventDefault();
        let user_to_id = $(this).attr('user_id');
        let action = $(this).attr('action');
        // Get the current URL then route name
        var currentUrl = window.location.href;
        var currentRouteName = currentUrl.split("/").slice(-1)[0];
        currentRouteName = String(currentRouteName);
        // console.log(user_to_id);
        // console.log(action);
        $.ajax({
            type: "post",
            url: action,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                user_id: user_to_id
            },
            dataType: 'json',
            beforeSend: function () {
                // console.log("follow/unfollow")
            },
            success: function (data) {
                // console.log('Success:', data);
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "showDuration": "600",
                }
                toastr.success(data.success);
                $('#page-content').load(currentRouteName);
            },
            error: function (data) {
                // console.log('Error:', data);
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "showDuration": "600",
                }
                toastr.error("<strong>Something went wrong!</strong><br> Please try again.");
            }
        });
    });
});