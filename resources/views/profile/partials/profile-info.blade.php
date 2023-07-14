<div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg mb-4 p-6">
    <div class="flex justify-center mb-4">
        @if (Auth::user()->profile_picture == null)
            <img src="{{ asset('images/user-logo.png') }}" alt="Profile Picture"
                class="w-64 h-64 object-cover rounded-full overflow-hidden border-2 border-indigo-600">
        @else
            <img src="{{ url('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture"
                class="w-64 h-64 object-cover rounded-full overflow-hidden border-2 border-indigo-600">
        @endif
    </div>

    <div class="flex justify-center mb-4">
        <button class="changePicModal text-sm outline  outline-indigo-500 dark:text-slate-100  hover:bg-indigo-500 hover:text-white dark:hover:text-white rounded-full px-4 py-2 ml-2">
            Change profile picture
        </button>
    </div>

    <div class="flex justify-center flex-col items-center">
        <div class="text-center mb-4">
            <h2 class="text-xl font-bold">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h2>
            <h2 class="text-sm font-light">{{ Auth::user()->email }}</h2>
        </div>
        <div class="mb-4">
            <a href="{{ route('listFollows') }}" class="text-xs text-gray-600 dark:text-gray-300 hover:text-white">
                <p>{{ Auth::user()->followers->count() }} Followers | {{ Auth::user()->followings->count() }} Following</p>
            </a>
        </div>
        <div class="mt-4">
            <a class="text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg px-4 py-2"
                href="{{ route('profile.edit') }}">Edit
                Profile</a>
        </div>
    </div>
</div>

@include('profile.partials.change-profile-picture-modal')



<script type="text/javascript">
    $(document).ready(function() {
        $('.changePicModal').on('click', function(e) {
            // $('#changePictureForm').trigger("reset");
            $('#changePicModal').removeClass('invisible');
        });
        $('.closeModal').on('click', function(e) {
            $('#changePictureForm').trigger("reset");
            $('#changePicModal').addClass('invisible');
        });
    });
</script>

{{-- Image Preview --}}
<script>
    profile_picture.onchange = evt => {
        preview = document.getElementById('image-preview');
        div = document.getElementById('preview-div');
        div.style.display = 'block';
        const [file] = profile_picture.files
        if (file) {
            preview.src = URL.createObjectURL(file)
        }
    }
</script>

{{-- AJAX --}}
<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Change Picture form
        $('#changePictureForm').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            console.log("picture submit");
            let file_name = document.getElementById('profile_picture').value;
            console.log(file_name);

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('')
                },
                success: function(data) {
                    if (data.code == 0) {
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0])
                        });
                    } else {
                        $(form)[0].reset;
                        $('#changePictureForm').trigger("reset");
                        $('#changePicModal').addClass('invisible');
                        alert("Profile Picture has been updated!")
                        location.reload();
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Update');
                }
            });
        });
    });
</script>
