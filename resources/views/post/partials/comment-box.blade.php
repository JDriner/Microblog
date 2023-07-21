<div class="bg-white dark:bg-slate-700 dark:text-black shadow rounded-lg ml-6 mt-2 p-2">
    <button type="button" post_id="{{ $post->id }}" user_name="{{ $post->user->first_name }}"
        class="addComment italic text-xs text-slate-800 dark:text-white  hover:font-medium ml-2">
        <i class="fa-solid fa-comment-dots fa-bounce fa-lg"></i> Write a comment to {{ $post->user->first_name }}'s post.
    </button>
</div>

{{-- Only one comment & latest --}}
@if ($post->hasComments())
    @if (request()->routeIs('post.show'))
        {{-- All comment & latest first --}}
        @foreach ($post->getCommentByLatestDate() as $comment)
            <div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg ml-6 mt-2 p-3">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        @if ($comment->user->profile_picture == null)
                            <img src="{{ asset('images/user-logo.png') }}" alt=""
                                class="h-6 w-6 rounded-full object-cover overflow-hidden border-2 border-indigo-600">
                        @else
                            <img src="{{ url('storage/' . $comment->user->profile_picture) }}"
                                alt="{{ $comment->user->first_name }}"
                                class="h-6 w-6 rounded-full object-cover overflow-hidden border-2 border-indigo-600">
                        @endif
                    </div>
                    <div class="ml-2">
                        <div class="text-sm text-gray-400 dark:text-gray-400 ">
                            {{ $comment->user->first_name . ' ' . $comment->user->last_name }}
                        </div>
                        <div class="font-semibold text-sm text-black dark:text-white">
                            {{ $comment->comment }}
                        </div>
                    </div>
                </div>
            </div>
            @if ($comment->user->id == auth()->user()->id)
                <div class="ml-6 text-xs text-slate-800 dark:text-white text-right">
                    <button type="button" class="editComment mx-3" comment_id="{{ $comment->id }}">
                        Edit
                    </button>
                    <button type="button" class="deleteComment mx-3" comment_id="{{ $comment->id }}">
                        Delete
                    </button>
                </div>
            @endif
        @endforeach
    @else
        <div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg ml-6 mt-2 p-6">
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
                    <div class="text-sm text-gray-400 dark:text-gray-400 ">
                        {{ $post->firstComment()->user->first_name . ' ' . $post->firstComment()->user->last_name }}
                    </div>
                    <div class="font-semibold text-sm text-black dark:text-white">
                        {{ $post->firstComment()->comment }}
                    </div>
                </div>
            </div>
        </div>
        @if ($post->firstComment()->user->id == auth()->user()->id)
        <div class="ml-6 text-xs text-slate-800 dark:text-white text-right">
            <button type="button" class="editComment mx-3" comment_id="{{ $post->firstComment()->id }}">
                Edit
            </button>
            <button type="button" class="deleteComment mx-3" comment_id="{{ $post->firstComment()->id }}">
                Delete
            </button>
        </div>
    @endif
    @endif
@endif
