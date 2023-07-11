<!-- Post Display -->
<div class="mt-1">
    <div class="max-w-xl mx-auto">
        @foreach ($posts as $post)
            <div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg mt-3 p-6">
                <a href="{{ route('blogpost.show', $post->id) }}">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            @if ($post->user->profile_picture == null)
                                <img src="{{ asset('images/user-logo.png') }}" alt=""
                                    class="h-12 w-12 rounded-full object-cover border-2 border-indigo-600">
                            @else
                                <img src="{{ url('storage/' . $post->user->profile_picture) }}"
                                    alt="{{ $post->user->first_name }}"
                                    class="h-12 w-12 rounded-full object-cover border-2 border-indigo-600">
                            @endif
                        </div>
                        <div class="ml-4">
                            <div class="font-semibold text-lg">
                                {{ $post->user->first_name . ' ' . $post->user->last_name }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                {{ date('F d, Y - h:i a', strtotime($post->created_at)) }}
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="text-gray-800 dark:text-white">{{ $post->content }}</p>
                        @if ($post->image)
                            <img src="{{ url('storage/' . $post->image) }}" alt="" title="">
                        @endif
                    </div>
                </a>

                <div
                    class="flex flex-items-center mt-5 rounded-full border-2 border-slate-300 p-2 dark:border-slate-700">
                    <div class="grow w-full ">
                        {{-- LIKE/UNLIKE --}}

                        @if (!$post->isAuthUserLikedPost())
                            <button type="button" post_id="{{ $post->id }}" action="/like"
                                class="like_unlike_btn text-slate-800 dark:text-white  hover:text-red-600 pl-4">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        @else
                            <button type="button" post_id="{{ $post->id }}" action="/unlike"
                                class="like_unlike_btn text-red-700 hover:text-white pl-4">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        @endif
                        <span class="text-xs text-gray-700 dark:text-white pl-2">{{ $post->likes()->count() }}
                            likes</span>
                    </div>
                    <div class="grow w-full">
                        {{-- COMMENTS --}}
                        <button type="button" post_id="{{ $post->id }}"
                            class="addComment text-slate-800 dark:text-white hover:text-indigo-500">
                            <i class="fa-regular fa-comment"></i>
                        </button>
                        <a href="{{ route('blogpost.show', $post->id) }}"
                            class="text-xs text-gray-700 dark:text-white pl-2">{{ $post->comments()->count() }}
                            comments</a>
                    </div>
                    <div class="grow w-20">
                        <button type="submit" class="text-slate-800 dark:text-white   hover:text-indigo-500">
                            <i class="fa-solid fa-share"></i>
                        </button>
                    </div>
                </div>
            </div>

            @if (session('status') && session('postId') == $post->id)
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                    role="alert">
                    <div class="flex">
                        <div class="py-1 fill-current h-6 w-6 text-teal-500 mr-4">
                            <i class="fa-regular fa-circle-check"></i>
                        </div>
                        <div>
                            <p class="font-bold">Success!</p>
                            <p class="text-bold">{{ session('status') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @error('comment')
            <div role="alert">
                <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                  Error
                </div>
                <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                  <p>{{ $message }}</p>
                </div>
              </div>
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

            {{-- Only one comment || latest --}}
            @if ($post->hasComments())
                <div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg ml-6 mt-3 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            @if ($post->firstComment()->user->profile_picture == null)
                                <img src="{{ asset('images/user-logo.png') }}"
                                    alt="{{ $post->firstComment()->user->first_name }}"
                                    class="h-6 w-6 rounded-full object-cover overflow-hidden border-2 border-indigo-600">
                            @else
                                <img src="{{ url('storage/' . $post->firstComment()->user->profile_picture) }}"
                                    alt="{{ $post->firstComment()->user->first_name }}"
                                    class="h-6 w-6 rounded-full object-cover overflow-hidden border-2 border-indigo-600">
                            @endif
                        </div>
                        <div class="ml-2">
                            <div class="text-sm text-gray-600 dark:text-gray-400 ">
                                {{ $post->firstComment()->user->first_name . ' ' . $post->firstComment()->user->last_name }}
                            </div>
                            <div class="font-semibold text-sm text-black dark:text-white">
                                {{ $post->firstComment()->message }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
