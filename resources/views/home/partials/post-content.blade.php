<!-- Post Display -->
<div class="mt-1">
    <div class="max-w-xl mx-auto">
        @foreach ($posts as $post)
            <div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg mt-3 p-6">
                <a href="{{ route('blogpost.show', $post->id) }}">
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
                            <div class="font-semibold text-lg">
                                {{ $post->user->first_name . ' ' . $post->user->last_name }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                {{ date('F d, Y - h:i a', strtotime($post->created_at)) }}</div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-gray-800 dark:text-white">{{ $post->content }}</p>
                        @if ($post->image)
                            <img src="{{ url('storage/' . $post->image) }}" alt="" title="">
                        @endif
                    </div>
                </a>

                {{-- Buttons --}}

                <div class="flex justify-end mt-4">
                    {{-- LIKE/UNLIKE --}}
                    <p class="text-sm text-gray-400 dark:text-white pt-3">{{ $post->likes()->count() }} Likes </p>
                    @if (!$post->isAuthUserLikedPost())
                        <button type="button" post_id="{{ $post->id }}" action="/like"
                            class="like_unlike_btn text-white bg-indigo-500 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i
                                class="fa-regular fa-heart"></i></button>
                    @else
                        <button type="button" post_id="{{ $post->id }}" action="/unlike"
                            class="like_unlike_btn text-red-700 bg-red-300 hover:bg-indigo-600 hover:text-white rounded-full px-4 py-2 ml-2"><i
                                class="fa-solid fa-heart"></i></button>
                    @endif

                    {{-- COMMENTS --}}
                    <a href=""
                        class="text-sm text-gray-400 dark:text-white pt-3">{{ $post->comments()->count() }}
                        comments</a>
                    <button type="button" post_id="{{ $post->id }}"
                        class="addComment text-white bg-indigo-500 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i
                            class="fa-regular fa-comment"></i></button>

                    {{-- SHARE --}}
                    <button type="submit"
                        class="text-white bg-indigo-500 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i
                            class="fa-solid fa-share"></i></button>
                </div>
            </div>



            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @error('comment')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
            <div id="commentBox_{{ $post->id }}"
                class="bg-white dark:bg-slate-800 dark:text-black shadow rounded-lg ml-6 mt-3 p-3" hidden>
                <form action="{{ route('sendComment') }}" method="POST" name="" id=""
                    enctype="multipart/form-data">
                    @csrf
                    <div class="max-w-xl mx-auto">
                        <input type="text" name="post_id" value="{{ $post->id }}" hidden>
                        <textarea name="comment" id="comment" rows="2" placeholder="Write your thoughts here..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"></textarea>
                        <div class="text-sm text-gray-400" id="comment_character_count">0 / 140 characters used</div>
                        <span class="text-red-600 text-sm error-text comment_error"></span>
                    </div>
                    <div class="px-4 sm:px-2 sm:flex sm:flex-row-reverse">
                        <button type="submit" post_id="{{ $post->id }}"
                            class="addComment text-white bg-indigo-500 hover:bg-indigo-600 rounded-md px-4 py-2 ml-2"><i
                                class="fa-regular fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>


            {{-- Comments --}}
            @if ($post->hasComments())
                @foreach ($post->comments as $comment)
                    <div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg ml-6 mt-3 p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                @if ($comment->user->profile_picture == null)
                                    <img src="https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png"
                                        alt="" class="h-12 w-12 rounded-full">
                                @else
                                    <img src="{{ url('storage/' . $comment->user->profile_picture) }}"
                                        alt="{{ $comment->user->first_name }}"
                                        class="h-6 w-6 rounded-full object-cover overflow-hidden border-2 border-indigo-600">
                                @endif
                            </div>
                            <div class="ml-2">
                                <div class="text-sm text-gray-600 dark:text-gray-400 ">
                                    {{ $comment->user->first_name . ' ' . $comment->user->last_name }}
                                </div>
                                <div class="font-semibold text-sm text-black dark:text-white">{{ $comment->message }}
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            @endif
        @endforeach
    </div>
</div>

