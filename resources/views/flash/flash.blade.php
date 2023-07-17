<script>
    @if (Session::has('success'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-full-width",
        }
        toastr.success("{{ Session::get('success') }}");
    @endif

    @if ($errors->any())
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-full-width",
        }
        toastr.error("<b>Error!!</b><br>Change a few things up and try submitting again.");
    @endif

    @if (Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.info("{{ session('info') }}");
    @endif

    // @error('comment')
    //     toastr.options = {
    //         "closeButton": true,
    //         "progressBar": true
    //     }
    //     toastr.warning("{{ $message }}");
    // @enderror
</script>
