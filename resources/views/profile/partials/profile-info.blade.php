<div class="bg-white shadow rounded-lg mb-4 p-6">
    <div class="flex justify-center mb-4">
        @if (Auth::user()->profile_picture == null)
            <img src="{{ asset('images/user-logo.png') }}"
                alt="Profile Picture"
                class="w-64 h-64 object-cover rounded-full overflow-hidden border-2 border-indigo-600">
        @else
            <img src="{{ url('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture"
                class="w-64 h-64 object-cover rounded-full overflow-hidden border-2 border-indigo-600">
        @endif
    </div>
    
    <div class="flex justify-center mb-4">
        <button
            class="changePicModal text-sm text-black bg-gray-100 outline outline-offset-2 outline-indigo-500 hover:bg-indigo-600 hover:text-white rounded-full px-4 py-0 ml-2">Change
            profile picture</button>
    </div>

    <div class="flex justify-center flex-col items-center">
        <div class="text-center mb-4">
            <h2 class="text-xl font-bold">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h2>
            <h2 class="text-sm font-light">{{ Auth::user()->email }}</h2>
        </div>
        <div class="self-end">
            <a class="text-white bg-indigo-500 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"
                href="{{ route('profile.edit') }}">Edit
                Profile</a>
        </div>
    </div>
</div>


<!-- Change Picture modal-->
<div class="fixed z-10 inset-0 invisible overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    id="changePicModal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Change Profile Picture
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Picture should be with the types jpg, jpeg, png. The file size should not exceed 4mb.
                            </p>
                        </div>

                        <form action="{{ route('profile.updatePicture') }}" method="POST" name="changePictureForm"
                            id="changePictureForm" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-8">
                                <div class="max-w-xl mx-auto">
                                    <div class="flex justify-center flex-col items-center">
                                        <div class="w-64 h-64 rounded-full overflow-hidden border-2 border-indigo-600"
                                            id="preview-div" style="display:none;">
                                            <img id="image-preview" src="#" alt="Profile Picture"
                                                class="object-cover w-full h-full" />
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="file" name="profile_picture" id="profile_picture"
                                            class="hidden">
                                        <label for="profile_picture"
                                            class="bg-gray-200 px-4 py-2 rounded-lg cursor-pointer">
                                            Select Image
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="submit"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Update
                                </button>
                                <button type="button"
                                    class="closeModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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
