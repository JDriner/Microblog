<!-- Display the Post and its contents -->
<div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg mt-6 p-6">
    <div class="flex justify-between mb-4">
        <a href="{{ route('profile.view-profile', $post->user->id) }}"
            title="View {{ $post->user->first_name }} 's Profile">
            <div class="flex flex-shrink-0">
                <div>
                    @if ($post->user->profile_picture == null)
                        <img src="{{ asset('images/user-logo.png') }}" alt="" class="h-12 w-12 rounded-full">
                    @else
                        <img src="{{ url('storage/' . $post->user->profile_picture) }}"
                            alt="{{ $post->user->first_name }}"
                            class="h-12 w-12 rounded-full object-cover overflow-hidden border-2 border-indigo-600">
                    @endif
                </div>
                <div class="ml-2">
                    <div class="font-semibold text-lg">
                        {{ $post->user->first_name . ' ' . $post->user->last_name }}
                    </div>
                    <div class="text-xs text-gray-800 dark:text-slate-400">
                        {{ date('F d, Y - h:i a', strtotime($post->created_at)) }}</div>
                </div>
            </div>
        </a>

        <!-- If the current user owns the post, they can edit/delete the post -->
        @if (auth()->id() == $post->user->id)
            <div>
                <button type="button" post_id="{{ $post->id }}"
                    class="editPost text-slate-800 dark:text-slate-300 hover:text-indigo-600 pr-4"><i
                        class="fa-solid fa-pen-to-square"></i></button>
                <button type="button" post_id="{{ $post->id }}"
                    class="deletePost text-slate-800 dark:text-slate-300 hover:text-indigo-600"><i
                        class="fa-solid fa-trash-can"></i></button>
            </div>
        @endif
    </div>

    <!-- View Post link-->
    <a href="{{ route('post.show', $post->id) }}">
        <div>
            <p class="text-gray-800 dark:text-white">
                {!! nl2br(e($post->content)) !!}
            </p>
            @if ($post->image)
            <div class="flex justify-center items-center">
                <img src="{{ url('storage/' . $post->image) }}" alt="Image for post" class="max-w-full">
            </div>
            @endif
        </div>
    </a>

    <!-- If the post is shared, display the contents.-->
    @if ($post->post_id)
        @include('post.partials.shared-post')
    @endif
    <!-- Buttons for the post (like/unlike, comment, share)-->
    @include('post.partials.post-buttons')
</div>

<!-- Comment Box - add comment, comment modal and comment/s-->
@include('post.partials.comment-box')

