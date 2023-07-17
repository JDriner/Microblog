
<!-- Comment box -->
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

{{-- Only one comment & latest --}}
@if ($post->hasComments())
    @if (request()->routeIs('post.show'))
        {{-- All comment & latest first --}}
        @foreach ($post->getCommentByLatestDate() as $comment)
            <div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg ml-6 mt-3 p-6">
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
                        <div class="text-sm text-gray-600 dark:text-gray-400 ">
                            {{ $comment->user->first_name . ' ' . $comment->user->last_name }}
                        </div>
                        <div class="font-semibold text-sm text-black dark:text-white">
                            {{ $comment->comment }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
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
                        {{ $post->firstComment()->comment }}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif