{{-- <script>
    @if (Session::has('comment_success'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-center",
        }
        toastr.success("<b>Success!!</b><br>{{ Session::get('comment_success') }}");
    @endif

    @error('comment')
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
        }
        toastr.error("{{ $message }}");
    @enderror
</script> --}}
