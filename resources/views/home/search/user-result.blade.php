<div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg mt-1 p-3">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            @if ($user->profile_picture == null)
                <img src="{{ asset('images/user-logo.png') }}" alt=""
                    class="h-12 w-12 rounded-full object-cover overflow-hidden border-2 border-indigo-600">
            @else
                <img src="{{ url('storage/' . $user->profile_picture) }}" alt="{{ $user->first_name }}"
                    class="h-12 w-12 rounded-full object-cover overflow-hidden border-2 border-indigo-600">
            @endif
        </div>
        <div class="ml-2">
            <div class="text-sm text-gray-600 dark:text-gray-200 ">
                {{ $user->first_name . ' ' . $user->last_name }}
            </div>
            <div class="font-semibold text-xs text-black dark:text-white mt-2">
                <a type="button" href="{{ route('profile.view-profile', $user->id) }}"
                    class="text-white bg-indigo-600 hover:bg-indigo-500 rounded-md px-4 p-1 m-1">
                    View Profile
                </a>

                @if ($user->id != Auth::user()->id)
                    @if ($user->isUserFollowed())
                        <button type="button" action="/unfollow/{{ $user->id }}"
                            class="follow_unfollow text-slate-700 dark:text-white border-2 hover:text-white border-indigo-500  hover:bg-indigo-500 rounded-md px-4 py-1 ml-2">
                            Unfollow
                        </button>
                    @else
                        <button type="button" action="/follow/{{ $user->id }}"
                            class="follow_unfollow text-white bg-indigo-600 hover:bg-indigo-500 rounded-md px-4 p-1 m-1">
                            Follow
                        </button>
                    @endif
                @endif

            </div>
        </div>
    </div>
</div>
