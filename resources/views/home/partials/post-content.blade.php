<!-- Post Display -->
<div class="mt-8">
    <div class="max-w-xl mx-auto">
        @foreach ($posts as $post)
            <div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg mt-3 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        @if ($post->user->profile_picture == null)
                            <img src="https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png"
                                alt="" class="h-12 w-12 rounded-full">
                        @else
                            <img src="{{ url('storage/' . $post->user->profile_picture) }}"
                                alt="{{ $post->user->first_name }}"
                                class="h-12 w-12 rounded-full object-cover overflow-hidden border-2 border-indigo-600">
                        @endif

                    </div>
                    <div class="ml-4">
                        <div class="font-semibold text-lg">{{ $post->user->first_name . ' ' . $post->user->last_name }}
                        </div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            {{ date('F d, Y - h:i a', strtotime($post->created_at)) }}</div>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-gray-800 dark:text-white">{{ $post->content }}</p>
                    @if ($post->image)
                        <img src="{{ url('storage/' . $post->image) }}" alt="" title=""></a>
                    @endif
                </div>

                {{-- Buttons --}}

                <div class="flex justify-end mt-4">
                    <p class="text-sm text-gray-400 dark:text-white pt-3">{{ $post->likes()->count() }} Likes </p>
                    @if (!$post->isAuthUserLikedPost())
                        {{-- User has not liked this post(yet?) --}}
                        <button type="button" post_id="{{ $post->id }}" action="/like"
                            class="like_unlike_btn text-white bg-indigo-500 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i
                                class="fa-regular fa-heart"></i></button>
                    @else
                        {{-- User has liked this post --}}
                        <button type="button" post_id="{{ $post->id }}" action="/unlike"
                            class="like_unlike_btn text-red-700 bg-red-300 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i
                                class="fa-solid fa-heart"></i></button>
                    @endif



                    <button type="submit"
                        class="text-white bg-indigo-500 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i
                            class="fa-regular fa-comment"></i></button>
                    {{-- <button type="submit" class="text-red-700 bg-red-300 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i class="fa-solid fa-comment"></i></button> --}}

                    <button type="submit"
                        class="text-white bg-indigo-500 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i
                            class="fa-solid fa-share"></i></button>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Like post --}}
<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Like post
        $(document).on('click', '.like_unlike_btn', function(e) {
            var postId = $(this).attr('post_id');
            var action = $(this).attr('action');
            e.preventDefault();
            console.log("liked" + postId);

            $.ajax({
                type: "post",
                url: action,
                data: {
                    post_id: postId
                },
                dataType: 'json',
                beforeSend: function() {
                    console.log("like")
                    // $(form).find('span.error-text').text('')
                    // $('#saveBtn').html('Create Post');
                },
                success: function(data) {
                    if (data.code == 0) {
                        $.each(data.error, function(prefix, val) {
                            // $(form).find('span.'+prefix+'_error').text(val[0])
                            alert("error" + val[0])
                        });
                    } else {
                        location.reload();
                        console.log('Success:', data);
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });

        });
    });
</script>
