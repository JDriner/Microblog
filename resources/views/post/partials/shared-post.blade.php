@if ($post->share->deleted_at != null)
    <div class="border-2 border-slate-300 dark:border-slate-600 p-2 mt-4">
        <p class="text-xs text-gray-800 dark:text-white">
            This content is not available. It may have been deleted by the original owner.
        </p>
    </div>
@else
    <div class="border-2 border-slate-300 dark:border-slate-600 p-2 mt-4">
        <div class="flex justify-between mb-4">
            <a href="{{ route('profile.view-profile', $post->share->user->id) }}"
                title="View {{ $post->share->user->first_name }}'s Profile" class="flex flex-shrink-0 items-center">
                <div class="border-2 border-indigo-600 rounded-full overflow-hidden">
                    @if ($post->share->user->profile_picture == null)
                        <img src="{{ asset('images/user-logo.png') }}" alt="" class="h-6 w-6 object-cover">
                    @else
                        <img src="{{ url('storage/' . $post->share->user->profile_picture) }}"
                            alt="{{ $post->share->user->first_name }}" class="h-6 w-6 object-cover">
                    @endif
                </div>
                <div class="ml-2">
                    <div class="font-semibold text-xs">
                        {{ $post->share->user->first_name . ' ' . $post->share->user->last_name }}
                    </div>
                    <div class="text-xs text-gray-800 dark:text-slate-400">
                        {{ date('F d, Y - h:i a', strtotime($post->share->created_at)) }}
                    </div>
                </div>
            </a>
        </div>
        <!-- View Post link-->
        <a href="{{ route('post.show', $post->share->id) }}">
            <div>
                <p class="text-gray-800 dark:text-white">
                    {!! nl2br(e($post->share->content)) !!}
                </p>
                @if ($post->share->image)
                <div class="flex justify-center items-center">
                    <img src="{{ url('storage/' . $post->share->image) }}" alt="" title="" class="mt-2">
                </div>
                    @endif
            </div>
        </a>
    </div>

@endif
