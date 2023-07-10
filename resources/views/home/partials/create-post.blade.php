<div class="mt-8">
    <div class="max-w-xl mx-auto">
        <div class="bg-zinc-200 dark:bg-slate-800 rounded-lg flex items-center">
            <button class="createPost text-white dark:text-white bg-indigo-500 hover:bg-indigo-600 px-4 py-2 rounded-lg ml-4">
                <i class="fa-solid fa-plus"></i>
            </button>
            <div class="mr-auto m-6">
                <h2 class="text-lg  dark:text-white font-semibold">Create post</h2>
                <p class="text-gray-600 dark:text-gray-400">Express your ideas, feelings, or anything you'd like!</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal-->
<div class="fixed z-10 inset-0 invisible overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    id="createPostModal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Create a Post
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Express your ideas, feelings, or anything you'd like to share with others!
                            </p>
                        </div>
                        <form action="{{ route('posting.store') }}" method="POST" name="createPostForm" id="createPostForm" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-4">
                                <div class="max-w-xl mx-auto">
                                    <textarea name="content" id="content" rows="5" placeholder="Write your thoughts here..."
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"></textarea>
                                        <div class="text-sm text-gray-400" id="character_count">0 / 140 characters used</div>
                                        <span class="text-red-600 text-sm error-text content_error"></span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="max-w-xl mx-auto">
                                    <div class="flex items-center">
                                        <input type="file" name="image" id="image" class="hidden">
                                        <label for="image"
                                            class="bg-gray-200 px-4 py-2 rounded-lg cursor-pointer">
                                            Select Image
                                        </label>
                                    </div>
                                    <span class="text-red-600 text-sm error-text image_error"></span>
                                    <p class="text-sm text-gray-500">If you have any images related to your
                                        post, you can upload them here. Images should be with the types jpg, jpeg, png. The file size should not exceed 4mb.</p>

                                    <img id="preview" src="#" alt="your image" class="" style="display:none;" />
                                </div>
                            </div>

                            <div class="px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="submit" id="saveBtn" value="create"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Create Post
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



{{-- MODAL --}}
<script type="text/javascript">
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
</script>

{{-- AJAX --}}
<script type="text/javascript">
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
</script>
