{{-- <div class="max-w-xl mx-auto">
    @if (count($my_posts) < 1)
        <div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg mb-4 p-6">
            <div class="flex justify-between">
                <h1>You do not have any posts yet!</h1>
            </div>
        </div>
    @endif

    @foreach ($my_posts as $my_post)
        <div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg p-6">
            <div class="flex justify-between mb-4">
                <!-- View user Profle link-->
                <a href="" title="View {{ $my_post->user->first_name }} 's Profile">
                    <div class="flex flex-shrink-0">
                        <div>
                            @if ($my_post->user->profile_picture == null)
                                <img src="{{ asset('images/user-logo.png') }}"
                                    alt="" class="h-12 w-12 rounded-full">
                            @else
                                <img src="{{ url('storage/' . $my_post->user->profile_picture) }}"
                                    alt="{{ $my_post->user->first_name }}"
                                    class="h-12 w-12 rounded-full object-cover overflow-hidden border-2 border-indigo-600">
                            @endif
                        </div>
                        <div class="ml-2">
                            <div class="font-semibold text-lg">
                                {{ $my_post->user->first_name . ' ' . $my_post->user->last_name }}
                            </div>
                            <div class="text-sm text-gray-800 dark:text-white">
                                {{ date('F d, Y - h:i a', strtotime($my_post->created_at)) }}</div>
                        </div>
                    </div>
                </a>

                <div>
                    <button type="submit" class="text-slate-800 dark:text-slate-300 hover:text-indigo-600 pr-4"><i
                            class="fa-solid fa-pen-to-square" title="Edit post"></i></button>
                    <button type="submit" class="text-slate-800 dark:text-slate-300 hover:text-indigo-600"><i
                            class="fa-solid fa-trash-can" title="Delete post"></i></button>
                </div>
            </div>

            <!-- View Post link-->
            <a href="{{ route('post.show', $my_post->id) }}" title="View post">
                <div>
                    <p class="text-gray-800 dark:text-white">{{ $my_post->content }}</p>
                    @if ($my_post->image)
                        <img src="{{ url('storage/' . $my_post->image) }}" alt="" title="">
                    @endif
                </div>
            </a>

            <div class="flex flex-items-center mt-5 rounded-full border-2 border-slate-300 p-2 dark:border-slate-700">
                <div class="grow w-full ">
                    <!--  LIKE/UNLIKE -->
                    @if (!$my_post->isAuthUserLikedPost())
                        <button type="button" post_id="{{ $my_post->id }}" action="/like"
                            class="like_unlike_btn text-slate-800 dark:text-white  hover:text-red-600 pl-4">
                            <i class="fa-regular fa-heart"></i>
                        </button>
                    @else
                        <button type="button" post_id="{{ $my_post->id }}" action="/unlike"
                            class="like_unlike_btn text-red-700 hover:text-white pl-4">
                            <i class="fa-solid fa-heart"></i>
                        </button>
                    @endif
                    <span class="text-xs text-gray-700 dark:text-white pl-2">{{ $my_post->likes()->count() }}
                        likes</span>
                </div>
                <div class="grow w-full">
                    <!-- COMMENTS -->
                    <button type="button" post_id="{{ $my_post->id }}"
                        class="addComment text-slate-800 dark:text-white hover:text-indigo-500">
                        <i class="fa-regular fa-comment"></i>
                    </button>
                    <a href="{{ route('post.show', $my_post->id) }}"
                        class="text-xs text-gray-700 dark:text-white pl-2">{{ $my_post->comments()->count() }}
                        comments</a>
                </div>
                <div class="grow w-20">
                    <button type="submit" class="text-slate-800 dark:text-white   hover:text-indigo-500">
                        <i class="fa-solid fa-share"></i>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>
 --}}
