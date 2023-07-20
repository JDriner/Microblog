<div class="flex flex-items-center mt-5 rounded-full border-2 border-slate-300 p-2 dark:border-slate-700">
    <!-- like or unlike post -->
    <div class="grow w-full ">
        @if (!$post->isAuthUserLikedPost())
            <button type="button" post_id="{{ $post->id }}" action="/like"
                class="like_unlike_btn text-slate-800 hover:text-red-600 dark:text-white dark:hover:text-red-600 pl-4">
                <i class="fa-regular fa-heart"></i>
            </button>
        @else
            <button type="button" post_id="{{ $post->id }}" action="/unlike"
                class="like_unlike_btn text-red-700 hover:text-slate-800 pl-4 dark:hover:text-white">
                <i class="fa-solid fa-heart"></i>
            </button>
        @endif
        @if ($post->likes()->count() >= 1)
            <span class="text-xs text-gray-700 dark:text-white pl-2">{{ $post->likes()->count() }}
                likes</span>
        @endif
    </div>

    <!-- Add Comment Button -->
    <div class="grow w-full">
        <button type="button" post_id="{{ $post->id }}" user_name="{{ $post->user->first_name }}"
            class="addComment text-slate-800 dark:text-white hover:text-indigo-500 dark:hover:text-indigo-500">
            <i class="fa-regular fa-comment"></i>
        </button>
        @if ($post->comments()->count() >= 1)
            <a href="{{ route('post.show', $post->id) }}"
                class="text-xs text-gray-700 dark:text-white pl-2">{{ $post->comments()->count() }}
                comments</a>
        @endif
    </div>

    <!-- Share posts. Users are allowed to reshare posts -->
    <div class="grow w-20">
        @if ($post->post_id != null)
            <button type="button" post_id="{{ $post->post_id }}"
                class="sharePost text-slate-800 dark:text-white hover:text-indigo-500 dark:hover:text-indigo-500">
                <i class="fa-solid fa-share"></i>
            </button>
        @else
            <button type="button" post_id="{{ $post->id }}"
                class="sharePost text-slate-800 dark:text-white hover:text-indigo-500 dark:hover:text-indigo-500">
                <i class="fa-solid fa-share"></i>
            </button>
        @endif
    </div>
</div>
