
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Follow/Unfollow user
    $('.follow_unfollow').on('click', function (e) {
        e.preventDefault();
        let action = $(this).attr('action');
        // Get the current URL then route name
        var currentUrl = window.location.href;
        var currentRouteName = currentUrl.split("/").slice(-1)[0];
        currentRouteName = String(currentRouteName);
        $.ajax({
            type: "post",
            url: action,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: 'json',
            beforeSend: function () {
                // console.log("follow/unfollow")
            },
            success: function (data) {
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